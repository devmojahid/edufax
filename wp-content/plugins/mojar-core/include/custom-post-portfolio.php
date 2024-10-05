<?php
class MsProjectPost
{
	function __construct()
	{
		add_action('init', array($this, 'register_custom_post_type'));
		add_action('init', array($this, 'create_cat'));
		add_filter('template_include', array($this, 'portfolio_template_include'));
	}

	public function portfolio_template_include($template)
	{
		if (is_singular('portfolio')) {
			return $this->get_template('single-portfolio.php');
		}
		return $template;
	}

	public function get_template($template)
	{
		if ($theme_file = locate_template(array($template))) {
			$file = $theme_file;
		} else {
			$file = MSCORE_ADDONS_DIR . '/include/template/' . $template;
		}
		return apply_filters(__FUNCTION__, $file, $template);
	}


	public function register_custom_post_type()
	{

		$harry_port_slug = get_theme_mod('harry_port_slug', __('portfolio', 'mscore'));
		$labels = array(
			'name'                  => esc_html_x('Portfolios', 'Post Type General Name', 'mscore'),
			'singular_name'         => esc_html_x('Portfolio', 'Post Type Singular Name', 'mscore'),
			'menu_name'             => esc_html__('Portfolio', 'mscore'),
			'name_admin_bar'        => esc_html__('Portfolio', 'mscore'),
			'archives'              => esc_html__('Item Archives', 'mscore'),
			'parent_item_colon'     => esc_html__('Parent Item:', 'mscore'),
			'all_items'             => esc_html__('All Items', 'mscore'),
			'add_new_item'          => esc_html__('Add New Portfolio', 'mscore'),
			'add_new'               => esc_html__('Add New', 'mscore'),
			'new_item'              => esc_html__('New Item', 'mscore'),
			'edit_item'             => esc_html__('Edit Item', 'mscore'),
			'update_item'           => esc_html__('Update Item', 'mscore'),
			'view_item'             => esc_html__('View Item', 'mscore'),
			'search_items'          => esc_html__('Search Item', 'mscore'),
			'not_found'             => esc_html__('Not found', 'mscore'),
			'not_found_in_trash'    => esc_html__('Not found in Trash', 'mscore'),
			'featured_image'        => esc_html__('Featured Image', 'mscore'),
			'set_featured_image'    => esc_html__('Set featured image', 'mscore'),
			'remove_featured_image' => esc_html__('Remove featured image', 'mscore'),
			'use_featured_image'    => esc_html__('Use as featured image', 'mscore'),
			'inserbt_into_item'     => esc_html__('Insert into item', 'mscore'),
			'uploaded_to_this_item' => esc_html__('Uploaded to this item', 'mscore'),
			'items_list'            => esc_html__('Items list', 'mscore'),
			'items_list_navigation' => esc_html__('Items list navigation', 'mscore'),
			'filter_items_list'     => esc_html__('Filter items list', 'mscore'),
		);

		$args   = array(
			'label'                 => esc_html__('Portfolio', 'mscore'),
			'labels'                => $labels,
			'supports'              => array('title', 'editor', 'excerpt', 'thumbnail'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'   			=> 'dashicons-index-card',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'rewrite' => array(
				'slug' => $harry_port_slug,
				'with_front' => false
			),
		);

		register_post_type('portfolio', $args);
	}

	public function create_cat()
	{
		$labels = array(
			'name'                       => esc_html_x('Portfolio Categories', 'Taxonomy General Name', 'mscore'),
			'singular_name'              => esc_html_x('Portfolio Categories', 'Taxonomy Singular Name', 'mscore'),
			'menu_name'                  => esc_html__('Portfolio Categories', 'mscore'),
			'all_items'                  => esc_html__('All Portfolio Category', 'mscore'),
			'parent_item'                => esc_html__('Parent Item', 'mscore'),
			'parent_item_colon'          => esc_html__('Parent Item:', 'mscore'),
			'new_item_name'              => esc_html__('New Portfolio Category Name', 'mscore'),
			'add_new_item'               => esc_html__('Add New Portfolio Category', 'mscore'),
			'edit_item'                  => esc_html__('Edit Portfolio Category', 'mscore'),
			'update_item'                => esc_html__('Update Portfolio Category', 'mscore'),
			'view_item'                  => esc_html__('View Portfolio Category', 'mscore'),
			'separate_items_with_commas' => esc_html__('Separate items with commas', 'mscore'),
			'add_or_remove_items'        => esc_html__('Add or remove items', 'mscore'),
			'choose_from_most_used'      => esc_html__('Choose from the most used', 'mscore'),
			'popular_items'              => esc_html__('Popular Portfolio Category', 'mscore'),
			'search_items'               => esc_html__('Search Portfolio Category', 'mscore'),
			'not_found'                  => esc_html__('Not Found', 'mscore'),
			'no_terms'                   => esc_html__('No Portfolio Category', 'mscore'),
			'items_list'                 => esc_html__('Portfolio Category list', 'mscore'),
			'items_list_navigation'      => esc_html__('Portfolio Category list navigation', 'mscore'),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);

		register_taxonomy('portfolio-cat', 'portfolio', $args);
	}
}

new MsProjectPost();
