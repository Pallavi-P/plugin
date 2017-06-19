<?php
/*
Plugin Name: GCMW Subsite Functionality Plugin
Description:Important repeated actions for customising and setting up the subsites are added here. Activate this plugin only on the new subsites as required. Please DONOT activate on the Main site and existing sites or else it will replace all the existing items like categories and custom fields.
Version: 1.0
License: GPL
Author: Br Saket Chaitanya
Author URI: www.chinmayamission.com
*/

// Plugin Activation
register_activation_hook( __FILE__, 'ssfunctionality_activate' );
register_deactivation_hook( __FILE__, 'ssfunctionality_deactivate' );
register_uninstall_hook( __FILE__, 'ssfunctionality_deactivate' );


function ssfunctionality_activate() {
//check if 
	if ( ! current_user_can( 'activate_plugins' ) ) 
	{
		echo "<script> alert('You donot have rights to activate this plugin.');</script>";
		return;
	}
	else
	{ 
		//actions to be implemented once when plugin
    //is installed like creating a table in database
		update_option('ss_functionality_active', 'yes');
		
	}
} 

function ssufunctionality_deactivate(){
	update_option ('ss_functionality_active', 'no');

}


//call the plugin functions after theme is loaded

add_action ('after_setup_theme', 'on_activate');	

function on_activate(){
	
	//echo "<script> alert('On activate called');</script>";
     
    //aall the functions to be called here.
	 insert_subsite_categories();
	 add_acf_fields();
	 add_subsite_options();
	
}

/* --- FUNCTIONS HERE -- */

//Adding categories for subsite

  /*
Use this functions to add categories

function example_insert_category() {
	$term = term_exists('Example Category', 'category');
	if ($term !== 0 && $term !== null):
	//do nothing
	else:
	wp_insert_term(
		'Example Category',
		'category',
		array(
		  'description'	=> 'This is an example category created with wp_insert_term.',
		  'slug' 		=> 'example-category'
		)
	);
endif;
}
add_action( 'after_setup_theme', 'example_insert_category' );
*/

function insert_subsite_categories()
{
	$term = term_exists('Other Centres', 'category');
	if ($term !== 0 && $term !== null):
	//do nothing
	else:
	wp_insert_term(
			'Other Centres',
			'category',
			array(
			'description' => 'Other centres in the zone or under this Centre',
			'slug' => 'other centres'
			)
		);
	endif;
	
	$term = term_exists('Centre Activities', 'category');
	if ($term !== 0 && $term !== null):
	//do nothing
	else:	
	wp_insert_term(
			'Centre Activities',
			'category',
			array(
			'description' => 'Centre local activities',
			'slug' => 'centre-activities'
			)
		);
	endif;
	
	$term = term_exists('Centre News', 'category');
	if ($term !== 0 && $term !== null):
	//do nothing
	else:
	wp_insert_term(
			'Centre News',
			'category',
			array(
			'description' => 'Centre local news',
			'slug' => 'centre-news'
			)
		);
	endif;
	
	$term = term_exists('Centre Events', 'category');
	if ($term !== 0 && $term !== null):
	//do nothing
	else:
	wp_insert_term(
			'Centre Events',
			'category',
			array(
			'description' => 'Centre local events',
			'slug' => 'centre-events'
			)
		);	
	endif;

	$term = term_exists('Centre Articles', 'category');
	if ($term !== 0 && $term !== null):
	//do nothing
	else:
	wp_insert_term(
			'Centre Articles',
			'category',
			array(
			'description' => 'Centre local articles',
			'slug' => 'centre-articles'
			)
		);	
	endif;
	
	$term = term_exists('Gallery', 'category');
	if ($term !== 0 && $term !== null):
	//do nothing
	else:
	wp_insert_term(
			'Gallery',
			'category',
			array(
			'description' => 'Centre local gallery',
			'slug' => 'centre-gallery'
			)
		);	
	endif;
	
	$term = term_exists('Featured News', 'category');
	if ($term !== 0 && $term !== null):
	//do nothing
	else:
	wp_insert_term(
			'Featured News',
			'category',
			array(
			'description' => 'Centre local featured news',
			'slug' => 'featured-news'
			)
		);	
	endif;
	
	$term = term_exists('Upcoming Events', 'category');
	if ($term !== 0 && $term !== null):
	//do nothing
	else:
	wp_insert_term(
			'Upcoming Events',
			'category',
			array(
			'description' => 'Centre local upcoming events',
			'slug' => 'upcoming-events'
			)
		);	
	endif;
	
	$term = term_exists('Flash News', 'category');
	if ($term !== 0 && $term !== null):
	//do nothing
	else:
	wp_insert_term(
			'Flash News',
			'category',
			array(
			'description' => 'Announcements and important news flash',
			'slug' => 'flash-news'
			)
		);	
	endif;
	
	$term = term_exists('Centre Downloads', 'category');
	if ($term !== 0 && $term !== null):
	//do nothing
	else:
	wp_insert_term(
			'Centre Downloads',
			'category',
			array(
			'description' => 'Centre local downloads',
			'slug' => 'centre-downloads'
			)
		);	
	endif;
		
	$term = term_exists('Courses', 'category');
	if ($term !== 0 && $term !== null):
	//do nothing
	else:
	wp_insert_term(
			'Courses',
			'category',
			array(
			'description' => 'Courses run by centre',
			'slug' => 'centre -downloads'
			)
		);	
	endif;
	
	$term = term_exists('Donation', 'category');
	if ($term !== 0 && $term !== null):
	//do nothing
	else:
	wp_insert_term(
			'donation',
			'category',
			array(
			'description' => 'Centre donation information',
			'slug' => 'donation'
			)
		);	
	endif;
	
	$term = term_exists('Projects', 'category');
	if ($term !== 0 && $term !== null):
	//do nothing
	else:
	wp_insert_term(
			'Projects',
			'category',
			array(
			'description' => 'Centres own Projects',
			'slug' => 'projects'
			)
		);	
	endif;
	
	$term = term_exists('Contact', 'category');
	if ($term !== 0 && $term !== null):
	//do nothing
	else:
	wp_insert_term(
			'Contact',
			'category',
			array(
			'description' => 'Centre contact information',
			'slug' => 'contact'
			)
		);	
	endif;

	$term = term_exists('FooterContact', 'category');
	if ($term !== 0 && $term !== null):
	//do nothing
	else:
	wp_insert_term(
			'Footer Contact',
			'category',
			array(
			'description' => 'Footer contact information',
			'slug' => 'footer-contact'
			)
		);	
	endif;
}



/* ----- ADD customfields -- */
/*
//Use this function to add the custom fields. 
// This function requires Advanced custom field plugin to be active.

 /**
 * function for checking if field group already exists
 */

	function is_field_exists($value, $type='post_title') {
	    $exists = false;
	    //exclude posts which are trashed
	    if ($fields = get_posts(array('
	    								post_type'=>'acf', 
	    								'post_status'=> array(
	    									'publish', 
	    									'pending', 
	    									'draft',
	    									'auto-draft', 
	    									'future', 
	    									'private', 
	    									'inherit'
	    									)))) 
	    {
	        foreach ($fields as $field) 
	        {
	            if ($field->post_title == $value)
	             {
	                $exists = true;       
	                                       
	            }
	            else $exists = false;		
	        }
	    }
	 
	    return $exists; //true if it exists, false otherwise
	}


	function add_acf_fields()
	{

		/** CAUTION:
		 * This function has to be used only when the plugin Advanced custom field
		 * is enabled on the subsite. Without activation it can create unpredicatable
		 * results
	 	*/

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
		require_once (WP_CONTENT_DIR. '/plugins/advanced-custom-fields/core/api.php');
		if(function_exists("register_field_group")) //checking if it is activated in this theme
		{
			
			if(is_field_exists('news')==false):
			register_field_group(array (
				'id' => 'acf_news',
				'title' => 'news',
				'fields' => array (
					array (
						'key' => 'field_57d96eccdd078',
						'label' => 'author name',
						'name' => 'author_name',
						'type' => 'text',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_57d9723b1071c',
						'label' => 'source',
						'name' => 'source',
						'type' => 'text',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_category',
							'operator' => '==',
							'value' => '2',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
					array (
						array (
							'param' => 'post_category',
							'operator' => '==',
							'value' => '3',
							'order_no' => 0,
							'group_no' => 1,
						),
					),
				),
				'options' => array (
					'position' => 'normal',
					'layout' => 'no_box',
					'hide_on_screen' => array (
						0 => 'excerpt',
						1 => 'custom_fields',
						2 => 'discussion',
						3 => 'comments',
						4 => 'revisions',
						5 => 'slug',
						6 => 'categories',
						7 => 'send-trackbacks',
					),
				),
				'menu_order' => 0,
			));
			endif;

			if(is_field_exists('start and end dates')==false):

				register_field_group(array (
					'id' => 'acf_start-and-end-dates',
					'title' => 'start and end dates',
					'fields' => array (
						array (
							'key' => 'field_000000001',
							'label' => 'Start Date',
							'name' => 'start_date',
							'type' => 'date_picker',
							'date_format' => 'yymmdd',
							'display_format' => 'dd/mm/yy',
							'first_day' => 1,
						),
						array (
							'key' => 'field_000000002',
							'label' => 'End Date',
							'name' => 'end_date',
							'type' => 'date_picker',
							'date_format' => 'yymmdd',
							'display_format' => 'dd/mm/yy',
							'first_day' => 1,
						),
					),
					'location' => array (
						array (
							array (
								'param' => 'post_category',
								'operator' => '==',
								'value' => '2',
								'order_no' => 0,
								'group_no' => 0,
							),
						),
						array (
							array (
								'param' => 'post_category',
								'operator' => '==',
								'value' => '3',
								'order_no' => 0,
								'group_no' => 1,
							),
						),
					),
					'options' => array (
						'position' => 'normal',
						'layout' => 'no_box',
						'hide_on_screen' => array (
						),
					),
					'menu_order' => 0,
				));
			endif;

			if(is_field_exists('General')==false):
				register_field_group(array (
					'id' => 'acf_general',
					'title' => 'General',
					'fields' => array (
						array (
							'key' => 'field_000000003',
							'label' => 'short code',
							'name' => 'short_code',
							'type' => 'text',
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'formatting' => 'html',
							'maxlength' => '',
						),
						array (
							'key' => 'field_000000004',
							'label' => 'level',
							'name' => 'level',
							'type' => 'select',
							'choices' => array (
								'World Wide' => 'World Wide',
								'Country Level' => 'Country Level',
								'State Level' => 'State Level',
								'Centre Specific' => 'Centre Specific',
							),
							'default_value' => '',
							'allow_null' => 0,
							'multiple' => 0,
						),
					),
					'location' => array (
						array (
							array (
								'param' => 'post_category',
								'operator' => '==',
								'value' => '2',
								'order_no' => 0,
								'group_no' => 0,
							),
						),
						array (
							array (
								'param' => 'post_category',
								'operator' => '==',
								'value' => '3', 
								'order_no' => 0,
								'group_no' => 1,
							),
						),
					),
					'options' => array (
						'position' => 'normal',
						'layout' => 'no_box',
						'hide_on_screen' => array (
						),
					),
					'menu_order' => 10,
				));
			endif;
		}

}
function add_subsite_options(){

	/*if (! get_option('homepage_banner_post_id'))
        {
            // home page banner id to be changed from network admin site
            add_option('homepage_banner_post_id','');

        }*/


        if(! get_option('homepage_banner_post_id'))
        {
            add_option('homepage_banner_post_id' ,'');
        }

        if(! get_option('ribbon_front_image_path'))
        {
            add_option('ribbon_front_image_path' ,'');
        }
        
        if(! get_option('ribbon_back_image_path'))
        {
            add_option('ribbon_back_image_path','');
        }

        if(! get_option('default_google_location'))
        {
        	add_option('default_google_location', 'Sandeepany Sadhnalaya, Saki Vihar Road, Mumbai');
        }

}


//add_shortcode('ss_functionality','on_activate');
?>	