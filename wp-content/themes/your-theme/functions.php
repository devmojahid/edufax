function theme_widgets_init() {
register_sidebar(array(
'name' => 'Sidebar',
'id' => 'sidebar-1',
'before_widget' => '<div class="widget">',
    'after_widget' => '</div>',
'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
));
}
add_action('widgets_init', 'theme_widgets_init');