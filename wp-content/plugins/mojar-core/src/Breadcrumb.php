<?php

namespace MojarCore;

class Breadcrumb
{
    private $breadcrumbs = array();
    private $options;

    public function __construct($options = array())
    {
        $this->options = wp_parse_args($options, array(
            'home_title' => 'Home',
            'separator' => '/',
            'class' => 'mscore-breadcrumb',
            'home_class' => 'home',
            'current_class' => 'current',
            'show_on_home' => false,
            'show_home_link' => true,
            'show_current' => true,
            'before' => '<span class="breadcrumb-item">',
            'after' => '</span>',
        ));

        add_action('wp', array($this, 'generate'));
    }

    public function generate()
    {
        // Home page
        if (is_front_page()) {
            if ($this->options['show_on_home']) {
                $this->add_breadcrumb($this->options['home_title'], home_url('/'), $this->options['home_class']);
            }
        } else {
            if ($this->options['show_home_link']) {
                $this->add_breadcrumb($this->options['home_title'], home_url('/'), $this->options['home_class']);
            }

            if (is_home()) {
                $this->add_breadcrumb(get_the_title(get_option('page_for_posts')));
            } elseif (is_category()) {
                $this->add_category_breadcrumbs();
            } elseif (is_tag()) {
                $this->add_breadcrumb(single_tag_title('', false));
            } elseif (is_author()) {
                $this->add_breadcrumb(get_the_author());
            } elseif (is_day()) {
                $this->add_breadcrumb(get_the_date());
            } elseif (is_month()) {
                $this->add_breadcrumb(get_the_date('F Y'));
            } elseif (is_year()) {
                $this->add_breadcrumb(get_the_date('Y'));
            } elseif (is_single() && !is_attachment()) {
                $this->add_single_post_breadcrumbs();
            } elseif (is_page() && !$post->post_parent) {
                $this->add_breadcrumb(get_the_title());
            } elseif (is_page() && $post->post_parent) {
                $this->add_page_breadcrumbs();
            } elseif (is_attachment()) {
                $this->add_attachment_breadcrumbs();
            } elseif (is_search()) {
                $this->add_breadcrumb('Search results for "' . get_search_query() . '"');
            } elseif (is_404()) {
                $this->add_breadcrumb('404 Not Found');
            }
        }
    }

    private function add_breadcrumb($title, $url = '', $class = '')
    {
        $this->breadcrumbs[] = array(
            'title' => $title,
            'url' => $url,
            'class' => $class
        );
    }

    private function add_category_breadcrumbs()
    {
        $category = get_queried_object();
        if ($category->parent != 0) {
            $ancestors = get_ancestors($category->term_id, 'category');
            $ancestors = array_reverse($ancestors);
            foreach ($ancestors as $ancestor) {
                $ancestor = get_term($ancestor, 'category');
                $this->add_breadcrumb($ancestor->name, get_term_link($ancestor->term_id));
            }
        }
        $this->add_breadcrumb(single_cat_title('', false));
    }

    private function add_single_post_breadcrumbs()
    {
        $post_type = get_post_type();
        if ($post_type != 'post') {
            $post_type_object = get_post_type_object($post_type);
            $this->add_breadcrumb($post_type_object->labels->singular_name, get_post_type_archive_link($post_type));
        } else {
            $category = get_the_category();
            if ($category) {
                $this->add_category_breadcrumbs();
            }
        }
        if ($this->options['show_current']) {
            $this->add_breadcrumb(get_the_title());
        }
    }

    private function add_page_breadcrumbs()
    {
        $parent_id = $post->post_parent;
        $parents = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $parents[] = array('title' => get_the_title($page->ID), 'url' => get_permalink($page->ID));
            $parent_id = $page->post_parent;
        }
        $parents = array_reverse($parents);
        foreach ($parents as $parent) {
            $this->add_breadcrumb($parent['title'], $parent['url']);
        }
        if ($this->options['show_current']) {
            $this->add_breadcrumb(get_the_title());
        }
    }

    private function add_attachment_breadcrumbs()
    {
        $parent = get_post($post->post_parent);
        $category = get_the_category($parent->ID);
        if ($category) {
            $this->add_category_breadcrumbs();
        }
        $this->add_breadcrumb($parent->post_title, get_permalink($parent));
        if ($this->options['show_current']) {
            $this->add_breadcrumb(get_the_title());
        }
    }

    public function render()
    {
        if (empty($this->breadcrumbs)) {
            return;
        }

        $output = '<div class="' . esc_attr($this->options['class']) . '">';
        $output .= '<ul>';

        foreach ($this->breadcrumbs as $key => $breadcrumb) {
            $class = $breadcrumb['class'];
            if ($key === count($this->breadcrumbs) - 1) {
                $class .= ' ' . $this->options['current_class'];
            }

            $output .= '<li class="' . esc_attr($class) . '">';
            if (!empty($breadcrumb['url']) && $key !== count($this->breadcrumbs) - 1) {
                $output .= '<a href="' . esc_url($breadcrumb['url']) . '">';
            }
            $output .= $this->options['before'] . esc_html($breadcrumb['title']) . $this->options['after'];
            if (!empty($breadcrumb['url']) && $key !== count($this->breadcrumbs) - 1) {
                $output .= '</a>';
            }
            if ($key !== count($this->breadcrumbs) - 1) {
                $output .= '<span class="separator">' . esc_html($this->options['separator']) . '</span>';
            }
            $output .= '</li>';
        }

        $output .= '</ul>';
        $output .= '</div>';

        return $output;
    }
}