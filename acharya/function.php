<?php
/**
 * Plugin Name: Acharya Plugin 
 * Plugin URI: http://www.chinmayamission.com/wp-content/plugin/acharya
 * Description: GCMW Plugin for Acharya
 * Version: 0.1
 * Author: Shubhangi Wani
 * Author URI: http://www.chinmayamission.com
 * License: GPL2
 */

/*  Copyright 2017  CCMT

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


    //add_action('admin_menu', 'acharya_post');

// Register Custom Post Type
function acharya_post() {
    echo"coming";
    $labels = array(
        'name'                  => _x( 'acharyas', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'acharya', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'acharya', 'text_domain'),
        //'name_admin_bar'        => __( 'acharya', 'text_domain'),
        'parent_item_colon'     => __( 'Parent acharya:', 'text_domain' ),
        //'all_items'             => __( 'All acharya', 'text_domain' ),
        'add_new_item'          => __( 'Add New acharya', 'text_domain' ),
        'add_new'               => __( 'Add Acharya', 'text_domain' ),
        //'title'             => __( 'Acharya', 'text_domain' ),
        'new_item'              => __( 'New acharya', 'text_domain' ),
        'edit_item'             => __( 'Edit acharya', 'text_domain' ),
        'update_item'           => __( 'Update acharya', 'text_domain' ),
        'view_item'             => __( 'View acharya', 'text_domain' ),
        'search_items'          => __( 'Search acharya', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'items_list'            => __( 'Items list', 'text_domain' ),
        'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter items list', 'text_domain' )
    );
    $args = array(
        'label'                 => __( 'acharya', 'text_domain' ),
        'description'           => __( 'acharya post type.', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'Name', 'editor', 'thumbnail', 'author','comments','editor','revisions'),
        'taxonomies'            => array( 'model', 'transmission', 'doors', 'color' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-admin-users',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page'
        
    );
   
    register_post_type( 'acharya', $args );

}
add_action( 'init', 'acharya_post', 0 );


include('ui/metabox/acharya_info.php');
new personal_Info_Meta_Box;

include('ui/metabox/address_metabox.php');
new address_Info_Meta_Box;


  
  //Added by Pallavi
/*add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );

function wpdocs_register_my_custom_menu_page(){
    add_menu_page('Acharyaa', 'Acharyaa', 'manage_options', 'acharyaa','my_render_list_page');

add_submenu_page( 'acharyaa', 'All Acharyaa', 'All Acharyaa', 'manage_options', 'acharyaa','all_acharyaa');

add_submenu_page( 'acharyaa', 'Add Acharyaa', 'Add Acharyaa', 'manage_options', 'acharyaa','add_acharyaa');
}

*/

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}


class My_Example_List_Table extends WP_List_Table {
  var $found_data = array(); 
  var $example_data = array();
    
    function table_data()
    {
        global $wpdb;
        $this->example_data  = $wpdb->get_results("SELECT post_id, salutation as title, acharya_name as author, acharya_dob as isbn  FROM db_acharya limit 25",ARRAY_A );
    }

    function __construct(){
        global $status, $page;
        parent::__construct( array(
            'singular'  => __( 'book', 'mylisttable' ),     //singular name of the listed records
            'plural'    => __( 'books', 'mylisttable' ),   //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );
        $this->table_data();
        add_action( 'admin_head', array( &$this, 'admin_header' ) );

            
    }


  function admin_header() {
    $page = ( isset($_GET['page'] ) ) ? esc_attr( $_GET['page'] ) : false;
    if( 'my_list_test' != $page )
    return;
    echo '<style type="text/css">';
    echo '.wp-list-table .column-id { width: 5%; }';
    echo '.wp-list-table .column-post_title{ width: 40%; }';
    echo '.wp-list-table .column-author { width: 35%; }';
    echo '.wp-list-table .column-isbn { width: 20%;}';
    echo '</style>';
  }

  function no_items() {
    _e( 'No books found, dude.' );
  }
  function column_default( $item, $column_name ) {
    switch( $column_name ) { 
        case 'post_title':
        case 'author':
        case 'isbn':
            return $item[ $column_name ];
        default:
            return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
    }
  }
function get_sortable_columns() {
  $sortable_columns = array(
    'post_title'  => array('post_title',false),
    'author' => array('author',false),
    'isbn'   => array('isbn',false)
  );
  return $sortable_columns;
}
function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />',
            'post_title' => __( 'Salutation', 'mylisttable' ),
            'author'    => __( 'Acharya Name', 'mylisttable' ),
            'isbn'      => __( 'Acharya DOB', 'mylisttable' )
        );
         return $columns;
    }
function usort_reorder( $a, $b ) {
  $orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'booktitle';
  $order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'asc';
  $result = strcmp( $a[$orderby], $b[$orderby] );
  return ( $order === 'asc' ) ? $result : -$result;
}
function column_post_title($item){
  $actions = array(
            'edit'      => sprintf('<a href="?page=%s&action=%s&postId=%s">Edit Acharya</a>',$_REQUEST['page'],'edit',$item['ID']),
            'delete'    => sprintf('<a href="?page=%s&action=%s&podtId=%s">Delete Acharya</a>',$_REQUEST['page'],'delete',$item['ID']),
        );
  return sprintf('%1$s %2$s', $item['post_title'], $this->row_actions($actions) );
}
function get_bulk_actions() {
  $actions = array(
    'delete'    => 'Delete'
  );
  return $actions;
}
function column_cb($item) {
        return sprintf(
            '<input type="checkbox" name="book[]" value="%s" />', $item['ID']
        );    
    }
function prepare_items() {
  $columns  = $this->get_columns();
  $hidden   = array();
  $sortable = $this->get_sortable_columns();
  $this->_column_headers = array( $columns, $hidden, $sortable );
  
  $per_page = 5;
  $current_page = $this->get_pagenum();
  $total_items = count( $this->example_data );
  // only ncessary because we have sample data
  $this->found_data = array_slice( $this->example_data,( ( $current_page-1 )* $per_page ), $per_page );
  $this->set_pagination_args( array(
    'total_items' => $total_items,                  //WE have to calculate the total number of items
    'per_page'    => $per_page                     //WE have to determine how many items to show on a page
  ) );
  $this->items = $this->found_data;
}
} //class


function my_add_menu_items(){
  $hook = add_menu_page( 'My Plugin List Table', 'Acharya', 'activate_plugins', 'my_list_test', 'my_render_list_page' );
  add_action( "load-$hook", 'add_options' );

  add_submenu_page('my_list_test','acharya','Add Acharya','acharya','acharya','acharya_post');

}

function add_options() {
  global $myListTable;
  $option = 'per_page';
  $args = array(
         'label' => 'Books',
         'default' => 10,
         'option' => 'books_per_page'
         );
  add_screen_option( $option, $args );
  $myListTable = new My_Example_List_Table();
}
add_action( 'admin_menu', 'my_add_menu_items' );

function my_render_list_page(){
  global $myListTable;
  echo '</pre><div class="wrap"><h2>My List Table Test</h2>'; 
  $myListTable->prepare_items(); 
?>
  <form method="post">
    <input type="hidden" name="page" value="ttest_list_table">
    <?php
    $myListTable->search_box( 'search', 'search_id' );
  $myListTable->display(); 
  echo '</form></div>'; 
}
 
?>