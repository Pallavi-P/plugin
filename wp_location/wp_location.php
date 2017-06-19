<?php
/*
*Plugin Name: CCMT Location
*Plugin URI: /wp-content/plugins/wp_location/wp_location.php
*Description: Plugin for adding location.
* Scope: Global site - admin site
* Version: 1.0
* Author: Girish Vas 
* Author URI: http://google.co.in
* Modified by: Br. Saket
* Modifications:  
*   ver 1.1 - scripts commented & enqueued once again at the top
*   ver 1.2 - changed enqueuing path of scripts to library folder. Removed commented scripts
*/

/*  added by Br Saket  -- 10/10/2016 */
//enqueuing scripts

if (!defined('WP_LIBRARY_URL')):
    define( 'WP_LIBRARY_URL', content_url().'/'.'gcmw-library'.'/');
endif;

add_action('admin_enqueue_scripts', 'add_location_scripts');

function add_location_scripts()
{  
    
    if(!wp_script_is('datepicker-plugin-jquery-4-loc')):
        wp_enqueue_script( 'datepicker-plugin-jquery-4-loc', WP_LIBRARY_URL.'datepicker/jquery-1.9.1.min.js',array(),NULL,true);
    endif;
    if(!wp_script_is('datepicker-plugin-jquery-ui-4-loc')):   
        wp_enqueue_script( 'datepicker-jquery-ui',WP_LIBRARY_URL.'datepicker/jquery-ui.js',array(),NULL,true); 
    endif;
    if(!wp_script_is('datepicker-datetimepicker-js')):
        wp_enqueue_script( 'datepicker-datetimepicker-js', WP_LIBRARY_URL.'datepicker/DateTimePicker.js',array('datepicker-jquery-ui'),NULL,true);
    endif;
    if(!wp_script_is('countries-countries-js')):    
        wp_enqueue_script( 'countries-countries-js', WP_LIBRARY_URL.'country/countries.js', array(),NULL,false);
    //if(!wp_script_is('wp_location-countries-js')):  
        //wp_enqueue_script( 'wp_location-countries-js',plugins_url('country/countries.js', __FILE__ ),array(),NULL,false);
    endif;
     //wp_enqueue_script( 'wp_location_-wp_location_add-js',plugins_url('js/wp_location_add.js', __FILE__ ),array('countries-countries-js'),NULL,false);
    
    if(!wp_script_is('datepicker-wp_plugins_common_events-js')):
        wp_enqueue_script( 'datepicker-wp_plugins_common_events-js', WP_LIBRARY_URL.'wp_plugins_common_events.js',array('datepicker-datetimepicker-js'),NULL,true);
    endif;  
    //if(!wp_script_is('wp_location-wp_location-js')):
        wp_enqueue_script( 'wp_location-wp_location-js',plugins_url('js/wp_location.js', __FILE__ ),array(),false,true);
   // endif;    
    if(!wp_style_is('datepicker-datepicker-css')):
        wp_enqueue_style('datepicker-datepicker-css', WP_LIBRARY_URL.'datepicker/jquery-ui.css');
    endif;
    //if(!wp_style_is('location-admin-css')):
        //wp_enqueue_style('location-admin-css', plugins_url('location_admin.css',__FILE__));
    //endif;
        if(!wp_style_is('cust-plugin-admin-css')):
        wp_enqueue_style('cust-plugin-admin-css', WP_LIBRARY_URL.'cust_plugin_admin.css');
    endif;
}
?>

<?php
/* ------ */
    global $wpdb;

    add_action('admin_menu', 'location_admin_menu'); 

    function location_admin_menu() 
    {
    	add_menu_page ('CCMT','CCMT Location','administrator','ccmt-location','display_ccmt_location' ,'dashicons-store');
    	add_submenu_page('ccmt-location','Center','Center','administrator','center','display_center');
    	add_submenu_page('ccmt-location','Ashram','Ashram','administrator','ashram','display_ashram');
    	add_submenu_page('ccmt-location','Temple','Temple','administrator','temple','display_temple');
        add_submenu_page('ccmt-location','Trust','Trust','administrator','trust','display_trust');    	
        add_submenu_page('ccmt-location','Committee','Committee','administrator','committee','display_committee');
        add_submenu_page('ccmt-location','School','School','administrator','school','display_school');
        add_submenu_page('ccmt-location','CORD','CORD','administrator','chord','display_chord');
        add_submenu_page('ccmt-location','Region','Region','administrator','region','display_region');
    	add_submenu_page('ccmt-location','Region-Country','Region-Country','administrator','region_country','display_reg_country');
    }


    function display_ccmt_location() 
    {
    	echo "<div id='l-wrapper'>";
    	echo "<h1>Location Manager</h1>";
    	echo "<div class='l-type'>";
    	echo "<select name='ltype' class='ltype'>";
    	echo "<option>Select Location Type</option>";
        echo "<option value='ashram'>Ashram</option>";
    	echo "<option value='center'>Center</option>";
    	echo "<option value='temple'>Temple</option>";
        echo "<option value='trust'>Trust</option>";
    	echo "<option value='region'>Region</option>";
    	echo "<option value='committee'>Committee</option>";
        echo "<option value='school'>School</option>";
        echo "<option value='chord'>CORD</option>";
    	//echo "<option value='country_region'>Country-Center</option>";
    	echo "<option value='region_country'>Region-Country</option>";
    	echo "</select>";
    	echo "</div>";
    	echo "</div>";

        //displaying form for adding New school
         require_once('includes/school.php');


        //displaying form for adding CORD
         require_once('includes/CORD.php');      


        //displaying form for adding for adding committee members
        require_once('includes/committee.php');

        //displaying form for adding new trusts

        require_once('includes/trust.php');

        //displaying form for adding for new ashrams

        require_once('includes/ashram.php');


        //displaying form for adding new center
        require_once('includes/centre.php');

        //displaying form for adding new temple
        require_once('includes/temple.php');
    

        //displaying form for adding new region
        require_once('includes/region.php');



        //displaying form for adding a new state center
        //this is retained for compatibility -- not used anywhere
        require_once('includes/state-centre.php');
        

     } //function display ccmt location ends

        add_action('admin_enqueue_scripts', 'add_location_scripts');

        //now displaying committee for update or delete
        require_once('includes/fn_disp_committees.php');

        //now displaying regions for update or delete
        require_once('includes/fn_disp_regions.php');

        //now displaying CORD for update or delete
        require_once('includes/fn_disp_CORD.php');

        //now displaying trust for update or delete
        require_once('includes/fn_disp_trusts.php');

        //now displaying centre for update or delete
        require_once('includes/fn_disp_centres.php');

        //now displaying ashram for update or delete
        require_once('includes/fn_disp_ashrams.php');

        //now displaying schools for update or delete

        require_once('includes/fn_disp_schools.php');

        //now displaying temples for update or delete
        require_once('includes/fn_disp_temples.php');    

        //now displaying reg_country for update or delete
        function display_reg_country(){
            global $wpdb;
            echo "<h2>Region-Country</h2>";
            $ws_details = $wpdb->get_results("SELECT * FROM `wp_region_country`");
            echo "<table class='loc-table'>";
                echo "<th>ID</th>";
                echo "<th>Region</th>";
                echo "<th>Country</th>";
                echo "<th></th>";
                echo "<th></th>";
                foreach ($ws_details as $data) 
                {
                    $i++;
                    echo "<tr>";
                    echo "<td>".$i."</td>";
                    echo "<td>".$data->region_id."</td>";
                    echo "<td>".$data->country."</td>";
                    echo "<td><a href='/wp-admin/admin.php?page=region&update-region-country=".$data->id."'>Edit</a></td>";
                    echo "<td><a href='/wp-admin/admin.php?page=region&delete-region-country=".$data->id."'>Delete</a></td>";
                    echo "</tr>";
                }
            echo "</table>";
        }//function display reg country ends 
        
    

    /* ashram insert query */
    if(isset($_POST['submitted-ashram'])) 
    {
        $a_name = trim($_POST['ashram-name']);
        $a_description = trim($_POST['ashram-description']);
        $a_trust = trim($_POST['ashram-trust']);
        $a_url = trim($_POST['ashram-url']);
        $a_phone = trim($_POST['ashram-phone']);
        $fax = trim($_POST['ashram-fax']);
        $a_email = trim($_POST['ashram-email']);
        $a_acharya = trim($_POST['ashram-acharya']);
        $a_president = trim($_POST['ashram-president']);
        $a_secretary = trim($_POST['ashram-secretary']);
        $a_treasurer = trim($_POST['ashram-treasurer']);
        $a_address1 = trim($_POST['ashram-address1']);
        $a_country = trim($_POST['ashram-country']);
        $a_zip = trim($_POST['ashram-zip']);
        $a_state = trim($_POST['ashram-state']);
        $a_city = trim($_POST['ashram-city']);
        $a_continent = trim($_POST['location-continent']);
        $a_latitude = trim($_POST['ashram-latitude']);
        $a_longitude = trim($_POST['ashram-longitude']);
        $a_add_on = date('Y-m-d H:i:s');
        $a_contact = trim($_POST['ashram-contact']);
        $a_image = trim($_POST['ashram-image']);
        $a_type = $_POST['submitted-ashram'];

        $wpdb->insert(
                    'wp_location',
                    array(
                            'id' => '',
                            'location_type' => $a_type,
                            'name' => $a_name,
                            'trust' => $a_trust,
                            'description' => $a_description,
                            'url' => $a_url,
                            'phone' => $a_phone,
                            'fax' => $a_fax,
                            'email' => $a_email,
                            'acharya' => $a_acharya,
                            'president' => $a_president,
                            'secretary' => $a_secretary,
                            'treasurer' => $a_treasurer,
                            'address1' => $a_address1,
                            'city' => $a_city,
                            'state' => $a_state,
                            'country' => $a_country,
                            'zip' => $a_zip,
                            'continent' => $a_continent,
                            'latitude' => $a_latitude,
                            'longitude' => $a_longitude,
                            'added_on' => $a_add_on,
                            'contact' => $a_contact,
                        ),
                    array(
                            '%d',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                    		'%s',
                            '%s',
                    		'%s',
                            '%s',
                            '%s',
                            '%s',
                        	'%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
            	            '%s',
                            '%f',
                            '%f',
                            '%s',
                        )
                    );

        $ashram = true;
    }//ashram query ends


    /* Trust insert query */
    if(isset($_POST['submitted-trust'])) 
    {
        $a_name = trim($_POST['trust-name']);
        $a_email = trim($_POST['trust-email']);
        $a_phone = trim($_POST['trust-phone']);
        $a_fax = trim($_POST['trust-fax']);
        $a_description = trim($_POST['trust-description']);
        $a_activities = trim($_POST['trust-activities']);
        $a_url = trim($_POST['trust-url']);
        $a_address1 = trim($_POST['trust-address1']);
        $a_address2 = trim($_POST['trust-address2']);
        $a_address3 = trim($_POST['trust-address3']);
        $a_country = trim($_POST['trust-country']);
        $a_state = trim($_POST['trust-state']);
        $a_city = trim($_POST['trust-city']);
        $a_continent = trim($_POST['trust-continent']);
        $a_latitude = trim($_POST['trust-latitude']);
        $a_longitude = trim($_POST['trust-longitude']);
        $a_add = date('Y-m-d H:i:s');
        $a_type = $_POST['submitted-trust'];

        $wpdb->insert(
                    'wp_location',
                    array(
                            'id' => '',
                            'location_type' => $a_type,
                            'name' => $a_name,
                            'email' => $a_email,
                            'phone' => $a_phone,
                            'fax' => $a_fax,
                            'description' => $a_description,
                            'url' => $a_url,
                            'address1' => $a_address1,
                            'address2' => $a_address2,
                            'address3' => $a_address3,
                            'city' => $a_city,
                            'state' => $a_state,
                            'country' => $a_country,
                            'continent' => $a_continent,
                            'latitude' => $a_latitude,
                            'longitude' => $a_longitude,
                            'activities' => $a_activities,
                            'added_on' => $a_add
                    ),
                    array(
                            '%d',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
    	                    '%s',
            		        '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%f',
                            '%f',
                            '%s',
                            '%s'
                    )
        );
        $trust = true;
    }//trust query ends


    /* center insert query */
    if(isset($_POST['submitted-center'])) 
    {

        $name = trim($_POST['location-name']);
        $description = trim($_POST['location-description']);
        $trust = trim($_POST['location-trust']);
        $url = trim($_POST['location-url']);
        $phone = trim($_POST['location-phone']);
        $fax = trim($_POST['location-fax']);
        $email = trim($_POST['location-email']);
        $acharya = trim($_POST['location-acharya']);
        $president = trim($_POST['location-president']);
        $secretary = trim($_POST['location-secretary']);
        $treasurer = trim($_POST['location-treasurer']);
        $address1 = trim($_POST['location-address1']);
        $address2 = trim($_POST['location-address2']);
        $address3 = trim($_POST['location-address3']);
        $country = trim($_POST['location-country']);
        $state = trim($_POST['location-state']);
        $city = trim($_POST['location-city']);
        $continent = trim($_POST['location-continent']);
        $latitude = trim($_POST['location-latitude']);
        $longitude = trim($_POST['location-longitude']);
        $add_on = date('Y-m-d H:i:s');
        $contact = trim($_POST['location-contact']);
        $image = trim($_POST['location-image']);
        $type = $_POST['submitted-center'];

        $wpdb->insert(
                    'wp_location',
                    array(
                            'id' => '',
                    		'location_type' => $type,
                            'name' => $name,
            		        'trust' => $trust,
                            'description' => $description,
                            'url' => $url,
                	        'phone' => $phone,
                            'fax' => $fax,
                            'email' => $email,
                            'acharya' => $acharya,
                            'president' => $president,
                            'secretary' => $secretary,
                            'treasurer' => $treasurer,
                            'address1' => $address1,
                            'address2' => $address2,
                            'address3' => $address3,
                            'city' => $city,
                            'state' => $state,
                            'country' => $country,
                            'continent' => $continent,
                    		'latitude' => $latitude,
                            'longitude' => $longitude,
                            'added_on' => $add_on,
                            'contact' => $contact,
            		        'image' => $image
                        ),
                        array(
                            '%d',
            		        '%s',
                            '%s',
                            '%s',
                            '%s',
                    		'%s',
            		        '%s',
                    		'%s',
            		        '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                        	'%s',
                        	'%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
            	            '%s',
                            '%f',
                            '%f',
                            '%s',
                            '%s',
                    		'%s'
                    )
                );
        if ($wpdb->last_error) {
        echo 'Error inserting centre ' . $wpdb->last_error;
        }

        $wpdb->query($wpdb->prepare("DELETE FROM wp_location WHERE `location_type` = 'centre' and  `name` =''" ));
         if ($wpdb->last_error) {
        echo 'Error deleting centre where name is not entered ' . $wpdb->last_error;
        }
        $center = true;
       
    }//center query ends

    /* temple insert query */
    if(isset($_POST['submitted-temple'])) 
    {

        $tname = trim($_POST['temple-name']);
        $tdescription = trim($_POST['temple-description']);
        $tdeity = trim($_POST['temple-deity']);
        $tdate = trim($_POST['temple-date']);
        $tadd = date('Y-m-d H:i:s');
        $turl = trim($_POST['temple-url']);
        $taddress1 = trim($_POST['temple-address1']);
        $tcountry = trim($_POST['temple-country']);
        $tstate = trim($_POST['temple-state']);
        $tcity = trim($_POST['temple-city']);
        $tcontinent = trim($_POST['temple-continent']);
        $tlatitude = trim($_POST['temple-latitude']);
        $tlongitude = trim($_POST['temple-longitude']);
        $ttype = $_POST['submitted-temple'];

        $wpdb->insert(
                    'wp_location',
                    array(
                            'id' => '',
            	   	        'location_type' => $ttype,
                            'name' => $tname,
                            'description' => $tdescription,
                            'url' => $turl,
                            'address1' => $taddress1,
                            'city' => $tcity,
                            'state' => $tstate,
                            'country' => $tcountry,
                            'continent' => $tcontinent,
                            'latitude' => $tlatitude,
                            'longitude' => $tlongitude,
                    		'deity' => $tdeity,
                    		'consecrated' => $tdate,
                    		'added_on' => $tadd
                    ),
                    array(
                            '%d',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%f',
                            '%f',
                    		'%s',
                    		'%s',
                    		'%s'
                    )
                );
        $temple = true;
    }//temple query ends

    /*region insert query */
    if(isset($_POST['submitted-region'])) 
    {
        $a_region = trim($_POST['region-name']);

        $wpdb->insert(
                    'wp_region',
                    array(
                            'id' => '',
                            'region' => $a_region,
                    ),
                    array(
                            '%d',
                            '%s',
                    )
            );
        $region = true;
    }//region insert query ends

    /* region-country insert query*/
    if(isset($_POST['submitted-region-country'])) 
    {
        $a_region = $_POST['reg_country'];
        $a_region_country = trim($_POST['region_country']);

        $wpdb->insert(
                    'wp_region_country',
                    array(
                            'id' => '',
                            'region_id' => $a_region,
                            'country' => $a_region_country,
                    ),
                    array(
                            '%d',
                            '%d',
                            '%s',
                    )
                );
        $region_country = true;
    }// region-country query ends

    /* --- no longer used -- */
    /* country_expand_center insert query
    if(isset($_POST['submitted-country-center'])) 
    {
        $a_country_center = trim($_POST['center_country']);
        $a_expand = trim($_POST['expand']);
        $wpdb->insert(
                    'wp_country_expand_center',
                    array(
                            'id' => '',
                            'center_country' => $a_country_center,
                            'expand' => $a_expand,


                    ),
                    array(
                            '%d',
                            '%s',
                            '%d',

                    )
                );
        $country_center = true;
    }//country expand center ends
    */
    /* state_expand_center query
    if(isset($_POST['submitted-state-center'])) 
    {
        $a_state_center = trim($_POST['center_state']);
        $a_expand = $_POST['expand'];
        $wpdb->insert(
                    'wp_state_expand_center',
                    array(
                            'id' => '',
                            'center_state' => $a_state_center,
                            'expand' => $a_expand,


                    ),
                    array(
                            '%d',
                            '%s',
                            '%d',

                    )
                );
        $state_center = true;
    } // state expand center ends
   */
    /*  ----------------------- */

    /* School insert query*/
    if(isset($_POST['submitted-school'])) 
    {
        $name = trim($_POST['school-name']);
        $description = trim($_POST['school-description']);
        $url = trim($_POST['school-url']);
        $address1 = trim($_POST['school-address1']);
        // $address2 = trim($_POST['school-address2']);
        // $address3 = trim($_POST['school-address3']);
        $country = trim($_POST['school-country']);
        $state = trim($_POST['school-state']);
        $city = trim($_POST['school-city']);
        $pincode = trim($_POST['school-pincode']);
        $continent = trim($_POST['school-continent']);
        $phone = trim($_POST['school-phone']);
        $email = trim($_POST['school-email']);
        $affiliation = trim($_POST['school-affiliation']);
        $type = $_POST['submitted-school'];

        $wpdb->insert(
                    'wp_school',
                    array(
            			'id' => '',
            			'school_type' => $type,
            			'name' => $name,
            			'description' => $description,
            			'url' => $url,
            			'address1' => $address1,
            			// 'address2' => $address2,
            			// 'address3' => $address3,
            			'city' => $city,
            			'state' => $state,
            			'country' => $country,
                        'continent' => $continent,
            			'zip' => $pincode,
            			'phone' => $phone,
            			'email' => $email,
            			'affiliation' => $affiliation
                    ),
                    array(
            			'%d',
            			'%s',
            			'%s',
            			'%s',
            			// '%s',
            			// '%s',
            			'%s',
            			'%s',
            			'%s',
            			'%s',
                        '%s',
            			'%s',
            			'%s',
            			'%s',
            			'%s',
            			'%s'
                    )
                );
        $school = true;
    }//school ends

    /* Committee insert query*/
    if(isset($_POST['submitted-committee'])) 
    {

        $cuser = trim($_POST['committee-user']);
        $cmember = trim($_POST['committee-type']);
        $cname = trim($_POST['committee-name']);
        $cphone = trim($_POST['committee-phone']);
        $cemail = trim($_POST['committee-email']);
        $ccenter = trim($_POST['committee-center']);

        $wpdb->insert(
                    'wp_committee',
                    array(
                            'id' => '',
        	                'member_type' => $cmember,
                            'user' => $cuser,
                            'name' => $cname,
                            'phone' => $cphone,
                            'email' => $cemail,
        		            'center' => $ccenter,
                    ),
                    array(
                            '%d',
                            '%s',
        	                '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s'
                    )
                );
        $committee = true;
    }//committee ends


    /* cord insert query*/
    if(isset($_POST['submitted-chord'])) 
    {

        $tlocation = trim($_POST['chord-location']);
        $taddress1 = trim($_POST['chord-address1']);
        $taddress2 = trim($_POST['chord-address2']);
        $taddress3 = trim($_POST['chord-address3']);
        $tcountry = trim($_POST['chord-country']);
        $tstate = trim($_POST['chord-state']);
        $tcity = trim($_POST['chord-city']);
        $tcontinent = trim($_POST['chord-continent']);
        $tphone = trim($_POST['chord-phone']);
        $temail = trim($_POST['chord-email']);
        $ttype = $_POST['submitted-chord'];

        $wpdb->insert(
                'wp_location',
                    array(
                    'id' => '',
                    'location_type' => $ttype,
                    'location' => $tlocation,
                    'address1' => $taddress1,
                    'address2' => $taddress2,
                    'address3' => $taddress3,
                    'city' => $tcity,
                    'state' => $tstate,
                    'country' => $tcountry,
                    'continent' => $tcontinent,
                    'phone' => $tphone,
                    'email' => $temail,

                    ),
                    array(
                    '%d',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    )
                );
            $chord = true;
        $wpdb->query($wpdb->prepare("DELETE FROM wp_location WHERE `location_type` = 'chord' and` and  `location` =''" ));
    }//cord ends

    

?>