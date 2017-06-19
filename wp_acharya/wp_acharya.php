<?php
/*
* Plugin Name: CCMT - Acharya
* Plugin URI: /wp_content/plugin/wp_acharya/wp_acharya.php
* Description: Plugin for managing acharyas in global site.
* Scope: Global site - admin site
* Version: 1.2
* Author: Girish Vas
* Author URI: http://google.co.in
* Modified by: Br. Saket
* Modifications:  
*	ver 1.1 - scripts commented & enqueued once again at the top
*	ver 1.2 - changed enqueuing path of scripts to library folder. Removed commented scripts
*/

//creating references to stylesheets and scripts

/*  added by Br Saket  -- 10/10/2016 */

 add_action( 'admin_enqueue_scripts', 'add_wp_acharya_scripts' );


if (!defined('WP_LIBRARY_URL')):
	define( 'WP_LIBRARY_URL', content_url().'/'.'gcmw-library'.'/');
endif;

//echo WP_LIBRARY_URL;
function add_wp_acharya_scripts()
{
	//wp_enqueue_script( 'wp-acharya-plugin-jquery',plugins_url('js/jquery-1.9.1.min.js', __FILE__),array(),false,false);
	//wp_enqueue_script( 'wp-acharya--jquery-ui',plugins_url('datepicker/jquery-ui.js', __FILE__),array(),false,false);
	//wp_enqueue_script( 'wp-acharya--datetimepicker-js',plugins_url('js/DateTimePicker.js', __FILE__),array(),false,false);
	//wp_enqueue_script( 'wp-acharya--countries-js',plugins_url('country/countries.js', __FILE__),array(),false,false);
	// wp_enqueue_style('wp-acharya-datepicker-css',plugins_url('datepicker/jquery-ui.css', __FILE__));

	if(!wp_script_is('datepicker-plugin-jquery')):
		wp_enqueue_script( 'datepicker-plugin-jquery', WP_LIBRARY_URL.'datepicker/jquery-1.9.1.min.js',array(),NULL,true);
	endif;
	if(!wp_script_is('datepicker-plugin-jquery-ui')):	
		wp_enqueue_script( 'datepicker-jquery-ui',WP_LIBRARY_URL.'datepicker/jquery-ui.js',array(),NULL,true);	
	endif;
	if(!wp_script_is('datepicker-datetimepicker-js')):
		wp_enqueue_script( 'datepicker-datetimepicker-js', WP_LIBRARY_URL.'datepicker/DateTimePicker.js',array(),NULL,true);
	endif;
	if(!wp_script_is('countries-countries-js')):	
		wp_enqueue_script( 'countries-countries-js', WP_LIBRARY_URL.'country/countries.js', array(),NULL,false);
	endif;
	if(!wp_script_is('datepicker-wp_plugins_common_events-js')):
		wp_enqueue_script( 'datepicker-wp_plugins_common_events-js', WP_LIBRARY_URL.'wp_plugins_common_events.js',array(),NULL,true);
	endif;
	//wp_enqueue_script( 'wp-acharya-wp-acharya-js',plugins_url('js/wp_acharya.js', __FILE__),array(),NULL,false);
	if(!wp_style_is('datepicker-datepicker-css')):
		wp_enqueue_style('datepicker-datepicker-css', WP_LIBRARY_URL.'datepicker/jquery-ui.css');
	endif;

	if(!wp_style_is('cust-plugin-admin-css')):
		wp_enqueue_style('cust-plugin-admin-css', WP_LIBRARY_URL.'cust_plugin_admin.css');
	endif;
}



/* ------ */

global $wpdb;
add_action('admin_menu', 'acharya_admin_menu');

function acharya_admin_menu() 
{


	add_menu_page ('CCMT','CCMT Acharya','administrator','ccmt-acharya','display_ccmt_acharya','dashicons-groups') ;

	add_submenu_page('ccmt-acharya','acharya','acharya','acharya','acharya','view_acharya');
}

function display_ccmt_acharya() 
{

	echo "<div id='l-wrapper'>";
	echo "<h1>Acharya Manager</h1>";
	echo "<button id='addevent'> Add</button>";
	echo "</div>";

	if (!isset($form1)) { $form1 = ""; }

	$form1 .= "<h3>Add New Acharya</h3>";
	$form1 .= "<form enctype='multipart/form-data' name='acharya' id='acharya' method='post' action=''>";

	$form1 .= "<div class='l-left'>Salutation:</div>";
    $form1 .= "<div class='l-right'>";
    $form1 .= "<select name='salutation' >";
    $form1 .= "<option value='Swami'>Swami</option>";
    $form1 .= "<option value='Swamini'>Swamini</option>";
    $form1 .= "<option value='Br'>Br</option>";
    $form1 .= "<option value='Brni'>Brni</option>";
    $form1 .= "<option value='Acharya'>Acharya</option>";
    $form1 .= "</select>";
    $form1 .= "</div><br/>";

    $form1 .= "<div class='l-left'>First Name:</div>";
    $form1 .= "<div class='l-right'>";
    $form1 .= "<input type='text' name='aname' />";
    $form1 .= "</div><br/>";

    $form1 .= "<div class='l-left'>Last Name:</div>";
    $form1 .= "<div class='l-right'>";
    $form1 .= "<input type='text' name='last_name' />";
    $form1 .= "</div><br/>";

  	$form1 .= "<div class='l-left'>Centre:</div>";
    $form1 .= "<div class='l-right'>";
	global $wpdb;
	$form1 .= "<select name = 'centre'>";
	$form1 .= "<option value=''>-- Select Center --</option>";
	foreach($wpdb->get_results("select name,id from `wp_location` WHERE `location_type` <> 'temple' ORDER BY name ASC" ) as $key => $page)
	{
		$form1 .= "<option value='".$page->id."'>" .$page->name ."</option>";
	}
	$form1 .= "</select>";
    $form1 .= "</div><br/>";
    $form1 .= "or<br/>";
    $form1 .= "<div class='l-left'>Other Centre:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<input type='text' name='centre1' />";
	$form1 .= "</div><br/>";

    $form1 .= "<div class='l-left'>Address:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<textarea name='address1' rows='10' cols='20'></textarea>";
	$form1 .= "</div><br/>";

    $form1 .= "<div class='l-left'>Address2:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<textarea name='address2' rows='10' cols='20'></textarea>";
	$form1 .= "</div><br/>";

    $form1 .= "<div class='l-left'>Address3:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<textarea name='address3' rows='10' cols='20'></textarea>";
	$form1 .= "</div><br/>";

    $form1 .= "<div class='l-left'>Pin Code:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<input type='text' name='pincode' />";
	$form1 .= "</div><br/>";

	$form1 .= "<div class='l-left'>Country:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<select onchange='gstate(this.selectedIndex);' id='country' name='country' >";
	$form1 .= "</select>";
	$form1 .= "</div><br/>";

	$form1 .= "<div class='l-left'>State:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<select type='text' name='state' id='state'>";
	$form1 .= "</select>";
	$form1 .= "<script language='javascript'>print_country('country');</script>";
	$form1 .= "</div><br/>";

	$form1 .= "<div class='l-left'>City:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<input type='text' name='city' />";
	$form1 .= "</div><br/>";

	$form1 .= "<div class='l-left'>Continent:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<select name='continent' >";
	$form1 .= "<option value='Asia'>Asia</option>";
	$form1 .= "<option value='Africa'>Africa</option>";
	$form1 .= "<option value='North America'>North America</option>";
	$form1 .= "<option value='South America'>South America</option>";
	$form1 .= "<option value='Antarctica'>Antarctica</option>";
	$form1 .= "<option value='Europe'>Europe</option>";
	$form1 .= "<option value='Australia'>Australia</option>";
	$form1 .= "</select>";
	$form1 .= "</div><br/>";

	$form1 .= "<div class='l-left'>Phone:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<input type='text' name='phone' />";
	$form1 .= "</div><br/>";

	$form1 .= "<div class='l-left'>Email:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<input type='text' name='aemail' />";
	$form1 .= "</div><br/>";

	$form1 .= "<div class='l-left'>Image:</div>";
    $form1 .= "<div class='l-right'>";
    $form1 .= "<input type='file' name='image' accept='image/*''>";
    $form1 .= "</div><br/>";

	$form1 .="<input type='hidden' name='submitted-acharya' id='submitted-acharya' value='acharya' />";
	$form1 .="<input type='submit' value='Add Acharya' name='add-acharya' />";

	$form1 .= "</form>";

	echo "<div id='l-event' style='display:none;'>".$form1."</div>";
	}//function display ccmt acharya ends


?> 

<?php


	//city	State	Country	Continent	Latitude	Longitude	Added On	Updated

	/* event query*/
	if(isset($_POST['submitted-acharya'])) 
	{
		$a_salutation = trim($_POST['salutation']);
		$a_name = trim($_POST['aname']);
		$last_name = trim($_POST['last_name']);
		if($_POST['centre1']==null)
		{
		$a_centre = $_POST['centre'];
		echo("other");
		}else{
		$a_centre = $_POST['centre1'];
		echo("select center");
		}

		$a_address1 = $_POST['address1'];
		$a_address2 = $_POST['address2'];
		$a_address3 = $_POST['address3'];
		$a_pincode = $_POST['pincode'];
		$a_contry = trim($_POST['country']);
		$a_state = trim($_POST['state']);
		$a_city = trim($_POST['city']);
		$a_continent = trim($_POST['continent']);
		$a_phone = trim($_POST['phone']);
		$a_email = trim($_POST['aemail']);
		$attachement =($_FILES['image']['name']);

		if ($_FILES["file"]["error"] > 0)
		{
			echo "Error: " . $_FILES["file"]["error"] . "<br>";
		}
		else
		{
			$temp = $_FILES["image"]["tmp_name"];
			$move = move_uploaded_file($temp,get_template_directory()."/images/".$attachement);
			$filepath ="wp-content/themes/GCMW/images/".$attachement;
		}
		$wpdb->insert(
				        'wp_acharya',
				        array(
				                'id' => '',
				                'salutation' => $a_salutation,
				                'aname' => $a_name,
				                'last_name' => $last_name,
				                'centre' => $a_centre,
				                'address1' => $a_address1,
				                'address2' => $a_address2,
				                'address3' => $a_address3,
				                'pincode' => $a_pincode,
				                'country' => $a_contry,
				                'state' => $a_state,
				                'city'	=> $a_city,
				                'continent'	=> $a_continent,
								'phone' => $a_phone,
						        'email' => $a_email,
								'image' => $attachement,
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
			        	)
					);
		$acharya = true;
	} // if $_POST['submitted-acharya'] ends

	function view_acharya() 
	{

	    global $wpdb;
		echo "<h2>Acharya</h2>";
		if($_GET['delete-acharya']) 
		{
			$cd = $_GET['delete-acharya'];
			$wpdb->query(
				$wpdb->prepare(
					"
			        	DELETE FROM wp_acharya
						WHERE id = %d
					",
				        $cd
		        	)
			);
			echo "Record Deleted for ID ".$cd;
		}


		if ($_GET['update']) 
		{
			echo $wid = $_GET['update'];
			echo "Update acharya";
			$ws = $wpdb->get_results("SELECT * FROM `wp_acharya` WHERE `id` = $wid");
		    $uacharya ='';
		    $uacharya .="<form enctype='multipart/form-data' method='post' action=''>";

	        $uacharya .= "<div class='l-left'>Salutation:</div>";
	        $uacharya .= "<div class='l-right'>";
	        $uacharya .= "<input type='text' name='usalutation' value='".$ws[0]->salutation."' />";
	        $uacharya .= "</div>";

	        $uacharya .= "<div class='l-left'>First Name:</div>";
	        $uacharya .= "<div class='l-right'>";
	        $uacharya .= "<input type='text' name='uaname' value='".$ws[0]->aname."' />";
	        $uacharya .= "</div>";

	        $uacharya .= "<div class='l-left'>Last Name:</div>";
	        $uacharya .= "<div class='l-right'>";
	        $uacharya .= "<input type='text' name='ulname' value='".$ws[0]->last_name."' />";
	        $uacharya .= "</div>";
	        $uacharya .= "<div class='l-left'>Centre:</div>";
	        $uacharya .= "<div class='l-right'>";
	        global $wpdb;
			$uacharya .= "<select name = 'ucentre'>";
			foreach($wpdb->get_results("select name,id from wp_location WHERE `id` = ".$ws[0]->centre."") as $key => $centrename){
			$uacharya .= "<option value='".$centrename->id."'>" .$centrename->name ."</option>";
					}
			$uacharya .= "<option value=' '>Select Centre</option>";
			foreach($wpdb->get_results("SELECT name,id FROM `wp_location` WHERE `location_type` != 'temple' ORDER BY `name` ASC") as $key => $page){
			$uacharya .= "<option value='".$page->id."'>" .$page->name ."</option>";
					}
			$uacharya .= "</select>";
	        $uacharya .= "</div>";

	        $uacharya .= "<div class='l-left'>Address:</div>";
	        $uacharya .= "<div class='l-right'>";
	        $uacharya .= "<textarea name='uaddress1' rows='10' cols='20'>".$ws[0]->address1."</textarea>";
	        $uacharya .= "</div>";

	        $uacharya .= "<div class='l-left'>Address2:</div>";
	        $uacharya .= "<div class='l-right'>";
	        $uacharya .= "<textarea name='uaddress2' rows='10' cols='20'>".$ws[0]->address2."</textarea>";
	        $uacharya .= "</div>";

	        $uacharya .= "<div class='l-left'>Address3:</div>";
	        $uacharya .= "<div class='l-right'>";
	        $uacharya .= "<textarea name='uaddress3' rows='10' cols='20'>".$ws[0]->address3."</textarea>";
	        $uacharya .= "</div>";

	        $uacharya .= "<div class='l-left'>Pincode:</div>";
	        $uacharya .= "<div class='l-right'>";
	        $uacharya .= "<input type='text' name='upincode' value='".$ws[0]->pincode."' />";
	        $uacharya .= "</div>";

	        $uacharya .= "<div class='l-left'>Country:</div>";
	        $uacharya .= "<div class='l-right'>";
	        $uacharya .= "<input type='text' name='ucountry' value='".$ws[0]->country."' />";
	        $uacharya .= "</div>";

	        $uacharya .= "<div class='l-left'>State:</div>";
	        $uacharya .= "<div class='l-right'>";
	        $uacharya .= "<input type='text' name='ustate' value='".$ws[0]->state."' />";
	        $uacharya .= "</div>";

	        $uacharya .= "<div class='l-left'>City:</div>";
	        $uacharya .= "<div class='l-right'>";
	        $uacharya .= "<input type='text' name='ucity' value='".$ws[0]->city."' />";
	        $uacharya .= "</div>";

	        $uacharya .= "<div class='l-left'>Continent:</div>";
	        $uacharya .= "<div class='l-right'>";
	        $uacharya .= "<input type='text' name='ucontinent' value='".$ws[0]->continent."' />";
	        $uacharya .= "</div>";

	        $uacharya .= "<div class='l-left'>Phone:</div>";
	        $uacharya .= "<div class='l-right'>";
	        $uacharya .= "<input type='text' name='uphone' value='".$ws[0]->phone."' />";
	        $uacharya .= "</div>";

	        $uacharya .= "<div class='l-left'>Email:</div>";
	        $uacharya .= "<div class='l-right'>";
	        $uacharya .= "<input type='text' name='uemail' value='".$ws[0]->email."' />";
	        $uacharya .= "</div>";

	       	$image_path = get_theme_root() . "/GCMW/images/".$ws[0]->image;
	        if(!file_exists($image_path))
	        $image_file = content_url() . "/themes/GCMW/images/0000.jpg";
	        else
	        $image_file = content_url() . "/themes/GCMW/images/" . $ws[0]->image;

	        $uacharya .= "<div class='l-left'>Image:</div>";
	        $uacharya .= "<div class='l-right'>";
	        $uacharya .= "<input type='file' name='image' accept='image/*''>";
	        $uacharya .= "<div><img src='" . $image_file . "' width='75px' height='75px'/></div>";
	        $uacharya .= "</div>";


		    $uacharya .="<input type='hidden' name='update-acharya' id='update-acharya' value='acharya' />";
		    $uacharya .="<input type='hidden' name='acharyaid' id='acharyaid' value='".$wid."' />";
	        $uacharya .="<input type='submit' value='Update-acharya' />";

		    $uacharya .="</form>";
		}// if $_GET['update'] ends

	    echo "<div id='u-acharya' style='width:800px;'>".$uacharya."</div>";

		if($_POST['update-acharya'])	
		{
			echo $uid = $_POST['acharyaid'];
			echo $usalutation = $_POST['usalutation'];
	        echo $uaname = $_POST['uaname'];
	        echo $ulname = $_POST['ulname'];
			echo $ucentre = $_POST['ucentre'];
			echo $uaddress1 = $_POST['uaddress1'];
			echo $uaddress2 = $_POST['uaddress2'];
			echo $uaddress3 = $_POST['uaddress3'];
	        echo $upincode = $_POST['upincode'];
	        echo $ucountry = $_POST['ucountry'];
			echo $ustate = $_POST['ustate'];
			echo $ucity = $_POST['ucity'];
			echo $ucontinent = $_POST['ucontinent'];
			echo $uphone = $_POST['uphone'];
			echo $uemail = $_POST['uemail'];
			$attachement =($_FILES['image']['name']);
			$fpath = "home/web/gcmw/wordpress/wp-content/uploads/2013/13";

	        if ($_FILES["file"]["error"] > 0)
			{
			   echo "Error: " . $_FILES["file"]["error"] . "<br>";
			}
			else
			{
			    $temp = $_FILES["image"]["tmp_name"];
			    $move = move_uploaded_file($temp, get_template_directory()."/images/".$attachement);
			    $filepath = "wp-content/themes/GCMW/images/".$attachement;
			}

	       if($attachement)
	       {
		   	$wpdb->update(
						   'wp_acharya',
						   array(
								'salutation' => $usalutation,
								'aname' => $uaname,
								'last_name' => $ulname,
								'centre' => $ucentre,
								'address1' => $uaddress1,
								'address2' => $uaddress2,
								'address3' => $uaddress3,
						        'pincode' => $upincode,
						        'country' => $ucountry,
								'state' => $ustate,
								'city' => $ucity,
								'phone' => $uphone,
								'email' => $uemail,
								'image' => $attachement,
								),
							array( 'ID' => $uid ),
							array(
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
								),
							array( '%d' )
						);
			}
			else
			{
				global $wpdb;
				$wpdb->update(
								'wp_acharya',
								array(
									'salutation' => $usalutation,
									'aname' => $uaname,
									'last_name' => $ulname,
									'centre' => $ucentre,
									'address1' => $uaddress1,
									'address2' => $uaddress2,
									'address3' => $uaddress3,
							        'pincode' => $upincode,
									'country' => $ucountry,
									'state' => $ustate,
									'city' => $ucity,
									'phone' => $uphone,
									'email' => $uemail,
								),
								array( 'ID' => $uid ),
								array(
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
								),
								array( '%d' )
							);

			}
		}//if $_POST['update-acharya'] ends

		//pagination
		$num_acharya = $wpdb->get_results("SELECT count(*) as total_nr FROM `wp_acharya`");
		$n_acharya = $num_acharya[0]->total_nr;
		$n_x_acharya = 49;
		$n_acharya = (($n_acharya / $n_x_acharya) < 1 ? 1 : ($n_acharya / $n_x_acharya));
		$pitinerary=0;

		if( isset($_REQUEST['pacharya'])) 
		{
			$pitinerary=$_REQUEST['pacharya'];
		}

		function get_page1_scrolling ($n_acharya,$pacharya,$n_acharya)
		{
			$base_url ='/wp-admin/admin.php?page=acharya';
			$scroll1 ='';

			if ($n_acharyas > 1)
			{
				if ($pacharya >= 1)
				{
					$scroll1 ='<div id="prev_btn" style="float:left;"><a style="padding-right:30px;" href="'.$base_url.'&pacharya='.($pacharya - 49).'">Previous</a></div>';
				}
				if ($pacharya < ($n_acharya - 1)) {
					$scroll1 .= '<div id="next_btn" style="float:right;margin-right: 21px;"><a style="padding-right:43px;" href="'.$base_url.'&pacharya='.($pacharya + 49).'">Next</a></div>';
				}

				if (trim($scroll1) != "1")
				{
					return $scroll1;
				}
			}
			return $scroll1;
		} // function get_page1_scrolling ends

		$scrolling = get_page1_scrolling($n_acharya,$pacharya,$n_acharyas);
		echo "<div class='l-pagination'>".$scrolling."</div>";

		global $wpdb;
		$ws_details = "";
		if ($_GET['submitted-search']) 
		{
	      $word = $_GET['search'];
		
		$ws_details = $wpdb->get_results("SELECT * FROM `wp_acharya`");

		}
		else
		{
		$ws_details = $wpdb->get_results("SELECT * FROM `wp_acharya`");
		}

		echo "<div style='width:1138px;max-height:800px;overflow-x: auto;overflow-y:auto;'>";
		echo "<table class='loc-table'style='empty-cells:show;'>";
		echo "<th>Sl.No</th>";
		echo "<th>ID</th>";
		echo "<th>Salutation</th>";
	    echo "<th>First Name</th>";
	    echo "<th>Last Name</th>";
		echo "<th>Centre</th>";
		echo "<th>Address </th>";
		echo "<th>Address 2</th>";
		echo "<th>Address 3</th>";
	    echo "<th>Pincode</th>";
	    echo "<th>Country</th>";
		echo "<th>State</th>";
		echo "<th>City</th>";
		//echo "<th>Continent</th>";
		echo "<th>Phone</th>";
		echo "<th>Email</th>";
	    echo "<th>Image</th>";
		echo "<th></th>";
		echo "<th></th>";

		foreach ($ws_details as $data) 
		{
			$i++;
			echo "<tr>";
			echo "<td>".$i."</td>";
			echo "<td>".$data->profile_id."</td>";
			echo "<td>".$data->salutation."</td>";
			echo "<td>".$data->aname."</td>";
			echo "<td>".$data->last_name."</td>";
			echo "<td>".$data->centre."</td>";
			echo "<td>".$data->address1."</td>";
			echo "<td>".$data->address2."</td>";
			echo "<td>".$data->address3."</td>";
	        echo "<td>".$data->pincode."</td>";
			echo "<td>".$data->country."</td>";
			echo "<td>".$data->state."</td>";
			echo "<td>".$data->city."</td>";
			echo "<td>".$data->phone."</td>";
			echo "<td>".$data->email."</td>";
	        $image_path = get_theme_root() . "/GCMW/images/".$data->image;

	        if(!file_exists($image_path) || $data->image=='')
	        {
	            echo "<td><img src='/wp-content/themes/GCMW/images/0000.jpg' width='75px' height='75px'/></td>";
			} else 
			{
	            echo "<td><img src='/wp-content/themes/GCMW/images/".$data->image."' width='75px' height='75px'/></td>";
			}
	        echo "<td><a href='/wp-admin/admin.php?page=acharya&update=".$data->id."'>Edit</a></td>";
	        echo "<td><a href='/wp-admin/admin.php?page=acharya&delete-acharya=".$data->id."'>Delete</a></td>";
			echo "</tr>";

		}//for each -- $ws_details ends
		echo "</table>"; 
		echo "<div>";
	}//function view_acharya ends


	add_shortcode("add_acharya", "acharya_handler");
	add_shortcode("edit_acharya", "viewacharya_handler");

	function acharya_handler() 
	{
	  //run function that actually does the work of the plugin
	  $addacharya_output = display_ccmt_acharya();
	  //send back text to replace shortcode in post
	  return $addacharya_output;
	}

	function viewacharya_handler() 
	{
	  //process plugin
	  $viewacharya_output = view_acharya();
	  //send back text to calling function
	  return $viewacharya_output;
	}
?>