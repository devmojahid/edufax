<?php

namespace MojarCore;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

class Carbon_Fields_Init
{
    public function __construct()
    {
        add_action('carbon_fields_register_fields', array($this, 'register_fields'));
    }

    public function register_fields()
    {
        $this->theme_options();
        $this->post_meta();
        $this->term_meta();
    }

    private function theme_options()
    {
        Container::make('theme_options', __('Mojar Core Options'))
            ->add_fields(array(
                Field::make('text', 'mscore_option_1', __('Option 1')),
                Field::make('textarea', 'mscore_option_2', __('Option 2')),
                Field::make('color', 'mscore_primary_color', __('Primary Color')),
                Field::make('image', 'mscore_logo', __('Site Logo'))
            ));
    }

    private function post_meta()
    {
        Container::make('post_meta', __('Additional Info'))
            ->where('post_type', '=', 'post')
            ->add_fields(array(
                Field::make('text', 'mscore_subtitle', __('Subtitle')),
                Field::make('rich_text', 'mscore_excerpt', __('Custom Excerpt'))
            ));
    }

    private function term_meta()
    {
        Container::make('term_meta', __('Category Options'))
            ->where('term_taxonomy', '=', 'category')
            ->add_fields(array(
                Field::make('color', 'mscore_category_color', __('Category Color')),
                Field::make('image', 'mscore_category_image', __('Category Image'))
            ));
    }
}