<?php function student_post() {
    $labels = array(
        'name'                  => _x( 'students', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'student', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'student', 'text_domain'),
        'name_admin_bar'        => __( 'student', 'text_domain'),
        'parent_item_colon'     => __( 'Parent student:', 'text_domain' ),
        'all_items'             => __( 'All student', 'text_domain' ),
        'add_new_item'          => __( 'Add New student', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New student', 'text_domain' ),
        'edit_item'             => __( 'Edit student', 'text_domain' ),
        'update_item'           => __( 'Update student', 'text_domain' ),
        'view_item'             => __( 'View student', 'text_domain' ),
        'search_items'          => __( 'Search student', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'items_list'            => __( 'Items list', 'text_domain' ),
        'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter items list', 'text_domain' )
    );
    $args = array(
        'label'                 => __( 'student', 'text_domain' ),
        'description'           => __( 'student post type.', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', ),
        'taxonomies'            => array( 'model', 'transmission', 'doors', 'color' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-dashboard',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page'
    );
   
    register_post_type( 'student', $args );

}
add_action( 'init', 'student_post', 0 );


include('/ui/metabox/student_info.php');
new student_Info_Meta_Box;

?>