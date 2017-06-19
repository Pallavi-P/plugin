<?php
/*
* Plugin Name: CCMT -Magazine
* Plugin URI: /wp_content/plugin/wp_spiritual/wp_magazine.php
* Description: Plugin for managing magazines on magazine page .
* Scope: Global site - admin site
* Version: 1.0
* Author: Girish Vas 
* Author URI: http://google.co.in
* Modified by: Br. Saket
* Modifications:  
*	ver 1.1 - scripts commented & enqueued once again at the top
*	ver 1.2 - changed enqueuing path of scripts to library folder. Removed commented scripts
*/

/*  added by Br Saket  -- 10/10/2016 */
//enqueuing scripts

if (!defined('WP_LIBRARY_URL')):
	define( 'WP_LIBRARY_URL', content_url().'/'.'gcmw-library'.'/');
endif;

add_action('admin_enqueue_scripts', 'add_wp_magazine_scripts');

function add_wp_magazine_scripts()
{  
	
	if(!wp_script_is('datepicker-plugin-jquery')):
		wp_enqueue_script( 'datepicker-plugin-jquery', WP_LIBRARY_URL.'datepicker/jquery-1.9.1.min.js',array(),NULL,true);
	endif;
	if(!wp_script_is('datepicker-plugin-jquery-ui')):	
		wp_enqueue_script( 'datepicker-jquery-ui',WP_LIBRARY_URL.'datepicker/jquery-ui.js',array(),NULL,true);	
	endif;
	if(!wp_script_is('datepicker-datetimepicker-js')):
		wp_enqueue_script( 'datepicker-datetimepicker-js', WP_LIBRARY_URL.'datepicker/DateTimePicker.js',array('datepicker-plugin-jquery'),NULL,true);
	endif;
	if(!wp_script_is('countries-countries-js')):	
		wp_enqueue_script( 'countries-countries-js', WP_LIBRARY_URL.'country/countries.js', array(),NULL,false);
	endif;
	if(!wp_script_is('datepicker-wp_plugins_common_events-js')):
		wp_enqueue_script( 'datepicker-wp_plugins_common_events-js', WP_LIBRARY_URL.'wp_plugins_common_events.js',array(),NULL,false);
	endif;
	//wp_enqueue_script( 'wp-magazine-wp-magazine-js',plugins_url('js/wp_magazine.js', __FILE__),array(),NULL,false);
	if(!wp_style_is('datepicker-datepicker-css')):
		wp_enqueue_style('datepicker-datepicker-css', WP_LIBRARY_URL.'datepicker/jquery-ui.css');
	endif;

	if(!wp_style_is('cust-plugin-admin-css')):
		wp_enqueue_style('cust-plugin-admin-css', WP_LIBRARY_URL.'cust_plugin_admin.css');
	endif;
}

/* ------ */


	add_action('admin_menu', 'magazine_admin_menu');

	global $wpdb;

	function magazine_admin_css() 
	{
	        wp_enqueue_style( 'prefix-style', plugins_url('magazine_admin.css', __FILE__) );
	}


	function magazine_admin_menu() 
	{

		add_menu_page ('CCMT','CCMT Magazine','administrator','ccmt-magazine','display_ccmt_magazine' , 'dashicons-book' );
		add_submenu_page('ccmt-magazine','magazine','magazine','magazine','magazine','view_magazine');

	}

	function display_ccmt_magazine() 
	{

		echo "<div id='l-wrapper'>";
		echo "<h1>Magazine Manager</h1>";
		echo "<button id='addevent'> Add</button>";
		echo "</div>";

		if (!isset($form1)) { $form1 = ""; }
		$form1 .= "<h3>Add New Magazine</h3>";
		$form1 .= "<form enctype='multipart/form-data' name='magazine' id='magazine' method='post' action=''>";

		$form1 .= "<div class='l-left'>Title:</div>";
		$form1 .= "<div class='l-right'>";
		$form1 .= "<input type='text' name='title' />";
		$form1 .= "</div><br/>";

		$form1 .= "<div class='l-left'>Book Name:</div>";
		$form1 .= "<div class='l-right'>";
		$form1 .= "<input type='text' name='bname' />";
		$form1 .= "</div><br/>";

		$form1 .= "<div class='l-left'>Editor:</div>";
		$form1 .= "<div class='l-right'>";
		$form1 .= "<input type='text' name='editor' />";
		$form1 .= "</div><br/>";

		$form1 .= "<div class='l-left'>Contact Address:</div>";
		$form1 .= "<div class='l-right'>";
		$form1 .= "<textarea name='address' rows='10' cols='20'></textarea>";
		$form1 .= "</div><br/>";

		$form1 .= "<div class='l-left'>Phone:</div>";
		$form1 .= "<div class='l-right'>";
		$form1 .= "<input type='text' name='phone' />";
		$form1 .= "</div><br/>";

		$form1 .= "<div class='l-left'>Email:</div>";
		$form1 .= "<div class='l-right'>";
		$form1 .= "<input type='text' name='email' />";
		$form1 .= "</div><br/>";

		$form1 .= "<div class='l-left'>Website:</div>";
		$form1 .= "<div class='l-right'>";
		$form1 .= "<input type='text' name='website' />";
		$form1 .= "</div><br/>";

		$form1 .= "<div class='l-left'>Subscription Rate:</div>";
		$form1 .= "<div class='l-right'>";
		$form1 .= "<input type='text' name='subscription' />";
		$form1 .= "</div><br/>";

		$form1 .= "<div class='l-left'>Single Issue:</div>";
		$form1 .= "<div class='l-right'>";
		$form1 .= "<input type='text' name='single' />";
		$form1 .= "</div><br/>";

		$form1 .= "<div class='l-left'>Image:</div>";
		$form1 .= "<div class='l-right'>";
		$form1 .= "<input type='file' name='image' accept='image/*''>";
		$form1 .= "</div><br/>";

		$form1 .="<input type='hidden' name='submitted-magazine' id='submitted-magazine' value='magazine' />";
		$form1 .="<input type='submit' value='Add Magazine' name='add-magazine' />";

		$form1 .= "</form>";

		echo "<div id='l-event' style='display:none;'>".$form1."</div>";



	} //function display ccmt_magazine ends

	//City	State	Country	Continent	Latitude	Longitude	Added On	Updated 

	/* event query*/
	if(isset($_POST['submitted-magazine'])) 
	{
		$a_title = trim($_POST['title']);
		$a_name = trim($_POST['bname']);
		$a_editor = $_POST['editor'];
		$a_address = $_POST['address'];
		$a_phone = trim($_POST['phone']);
		$a_email = trim($_POST['email']);
		$a_website = trim($_POST['website']);
		$a_subscription = trim($_POST['subscription']);
		$a_single = $_POST['single'];
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
		$wpdb->insert( 
			        'wp_magazine',
			        array(
			                'id' => '', 
			                'title' => $a_title,
			                'bname' => $a_name,
			                'editor' => $a_editor,
			                'address' => $a_address,
							'phone' => $a_phone,
					        'email' => $a_email,
							'website' => $a_website,
							'subscription' => $a_subscription,
							'single' => $a_single,
							'image' => $filepath,
							
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
			        )
			);

		$magazine = true;
	}//if (isset($_POST['submitted-magazine']) ends

	function view_magazine()
	{
		global $wpdb;
		echo "<h2>Magazine</h2>";

		if($_GET['delete-magazine']) 
		{

			$cd = $_GET['delete-magazine'];
			$wpdb->query( 
				$wpdb->prepare( 
					"
		                DELETE FROM wp_magazine
						WHERE id = %d
					",
				        $cd
		        	)
			);
			echo "Record Deleted for ID ".$cd;
		}


		if ($_GET['update']) 
		{
			$wid = $_GET['update'];
			echo "Update Magazine";
			$ws = $wpdb->get_results("SELECT * FROM `wp_magazine` WHERE `id` = $wid");

			$umagazine ='';
			$umagazine .="<form enctype='multipart/form-data' method='post' action=''>";
		
	        $umagazine .= "<div class='l-left'>Title:</div>";
	        $umagazine .= "<div class='l-right'>";
	        $umagazine .= "<input type='text' name='utitle' value='".$ws[0]->title."' />";
	        $umagazine .= "</div>";

	        $umagazine .= "<div class='l-left'>Book Name:</div>";
	        $umagazine .= "<div class='l-right'>";
	        $umagazine .= "<input type='text' name='ubname' value='".$ws[0]->bname."' />";
	        $umagazine .= "</div>";

	        $umagazine .= "<div class='l-left'>Editor:</div>";
	        $umagazine .= "<div class='l-right'>";
	        $umagazine .= "<input type='text' name='ueditor' value='".$ws[0]->editor."' />";
	        $umagazine .= "</div>";
		
	        $umagazine .= "<div class='l-left'>Contact Address:</div>";
	        $umagazine .= "<div class='l-right'>";
	        $umagazine .= "<textarea name='uaddress' rows='10' cols='20'>".$ws[0]->address."</textarea>";
	        $umagazine .= "</div>";

	        $umagazine .= "<div class='l-left'>Phone:</div>";
	        $umagazine .= "<div class='l-right'>";
	        $umagazine .= "<input type='text' name='uphone' value='".$ws[0]->phone."' />";
	        $umagazine .= "</div>";

	        $umagazine .= "<div class='l-left'>Email:</div>";
	        $umagazine .= "<div class='l-right'>";
	        $umagazine .= "<input type='text' name='uemail' value='".$ws[0]->email."' />";
	        $umagazine .= "</div>";
		
	        $umagazine .= "<div class='l-left'>Website:</div>";
	        $umagazine .= "<div class='l-right'>";
	        $umagazine .= "<input type='text' name='uwebsite' value='".$ws[0]->website."'/>";
	        $umagazine .= "</div>";

	        $umagazine .= "<div class='l-left'>Subscription Rate:</div>";
	        $umagazine .= "<div class='l-right'>";
	        $umagazine .= "<input type='text' name='usubscription' value='".$ws[0]->subscription."'/>";
	        $umagazine .= "</div>";
		
			$umagazine .= "<div class='l-left'>Single Issue:</div>";
	        $umagazine .= "<div class='l-right'>";
	        $umagazine .= "<input type='text' name='usingle' value='".$ws[0]->single."'/>";
	        $umagazine .= "</div>";

			$umagazine .= "<div class='l-left'>Image:</div>";
		    $umagazine .= "<div class='l-right'>";
		    $umagazine .= "<input type='file' name='uimage' accept='uimage/*''>";
		    $umagazine .= "</div><br/>";

			$umagazine .="<input type='hidden' name='update-magazine' id='update-magazine' value='magazine' />";
	        $umagazine .="<input type='submit' value='Update-Magazine' />";

			$umagazine .="</form>";
		
			echo "<div id='u-magazine' style='width:800px;'>".$umagazine."</div>";

			if($_POST['update-magazine'])	
			{
				
				$uid = $_GET['update'];
				$utitle = $_POST['utitle']; 
	            $ubname = $_POST['ubname'];
				$ueditor = $_POST['ueditor']; 
				$uaddress = $_POST['uaddress']; 
				$uphone = $_POST['uphone']; 
				$uemail = $_POST['uemail']; 
				$uwebsite = $_POST['uwebsite'];
				$usubscription = $_POST['usubscription'];
				$usingle = $_POST['usingle'];
	            //$uimage = $_POST['uimage'];
	            $uattachement =$_FILES['uimage']['name'];
				//print_r($uattachement);
				if ($_FILES["file"]["error"] > 0)
				{
					echo "Error: " . $_FILES["file"]["error"] . "<br>";
				}
				else
				{
				
					$utemp = $_FILES["uimage"]["tmp_name"];			
					$umove = move_uploaded_file($utemp, get_template_directory()."/images/".$uattachement);			
					$ufilepath = "wp-content/themes/GCMW/images/".$uattachement;
				}

				$wpdb->update( 
				'wp_magazine', 
				array( 
					'title' => $utitle,
					'bname' => $ubname,
					'editor' => $ueditor,
					'address' => $uaddress,
					'phone' => $uphone,
					'email' => $uemail,
					'website' => $uwebsite,
					'subscription' => $usubscription,
					'single' => $usingle,
			        'image' => $ufilepath,
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
				), 
				array( '%d' ) 
				);

			}	

		}// if ($_GET['update']) ends


		//pagination
		$num_magazine = $wpdb->get_results("SELECT count(*) as total_nr FROM `wp_magazine`");
		$n_magazine = $num_magazine[0]->total_nr;
		$n_x_magazine = 49;
		$n_magazine = (($n_magazine / $n_x_magazine) < 1 ? 1 : ($n_magazine / $n_x_magazine));
		$pitinerary=0;

		if( isset($_REQUEST['pmagazine'])) 
		{
			$pitinerary=$_REQUEST['pmagazine'];
		}

		function get_page1_scrolling ($n_magazine,$pmagazine,$n_magazine)
		{
			$base_url ='/wp-admin/admin.php?page=magazine';
			$scroll1 ='';

			if ($n_magazines > 1)
			{
				if ($pmagazine >= 1) 
				{
					$scroll1 ='<div id="prev_btn" style="float:left;"><a style="padding-right:30px;" href="'.$base_url.'&pmagazine='.($pmagazine - 49).'">Previous</a></div>';
				}
				if ($pmagazine < ($n_magazine - 1)) {
					$scroll1 .= '<div id="next_btn" style="float:right;margin-right: 21px;"><a style="padding-right:43px;" href="'.$base_url.'&pmagazine='.($pmagazine + 49).'">Next</a></div>';
				}
		
				if (trim($scroll1) != "1")
				{		
					return $scroll1;
				}
			}
			return $scroll1;
		}//function get_page1_scrolling ends


		$scrolling = get_page1_scrolling($n_magazine,$pmagazine,$n_magazines); 
		echo "<div class='l-pagination'>".$scrolling."</div>";
		global $wpdb;
		$ws_details = "";
		if ($_GET['submitted-search']) 
		{
	      $word = $_GET['search'];
			$args = array(
	                       	'display_name'      => $word,
	           			 );
	     	$acharya = get_users($args);
			$ws_details = $wpdb->get_results("SELECT * FROM `wp_magazine`");
		}
		else
		{
			$ws_details = $wpdb->get_results("SELECT * FROM `wp_magazine`");
		}
		echo "<div style='width:1138px;max-height:800px;overflow-x:auto;overflow-y:auto;'>";
		echo "<table class='loc-table' style='empty-cells:show;'>";
		echo "<th>ID</th>";
		echo "<th>Title</th>";
	    echo "<th>Book Name</th>";
		echo "<th>Editor</th>";
		echo "<th>Contact Address</th>";
		echo "<th>Phone</th>";
		echo "<th>Email</th>";
		echo "<th>Website</th>";
		echo "<th>Subscription Rate</th>";
		echo "<th>Single Issue</th>";
	    echo "<th>Image</th>";
		echo "<th></th>";
		echo "<th></th>";

		foreach ($ws_details as $data) 
		{
			$i++;
			echo "<tr>";
			echo "<td>".$i."</td>";
			echo "<td>".$data->title."</td>";
			echo "<td>".$data->bname."</td>";
			echo "<td>".$data->editor."</td>";
			echo "<td>".$data->address."</td>";
			echo "<td>".$data->phone."</td>";
			echo "<td>".$data->email."</td>";
			echo "<td>".$data->website."</td>";
			echo "<td>".$data->subscription."</td>";
			echo "<td>".$data->single."</td>";
	        echo "<td>".$data->image."</td>";
	        echo "<td><a href='/wp-admin/admin.php?page=magazine&update=".$data->id."'>Edit</a></td>";
	        echo "<td><a href='/wp-admin/admin.php?page=magazine&delete-magazine=".$data->id."'>Delete</a></td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</div>";
	}//function view magazine ends


//CREATING SHORT CODES AND LINKING TO CALLING FUNCTIONS

	add_shortcode("add_magazine", "magazine_handler");
	add_shortcode("edit_magazine", "viewmagazine_handler");

	function magazine_handler() 
	{
	  //run function that actually does the work of the plugin
	  $addmagazine_output = display_ccmt_magazine();
	  //send back text to replace shortcode in post
	  return $addmagazine_output;
	}

	function viewmagazine_handler() 
	{
	  //process plugin
	  $viewmagazine_output = view_magazine();
	  //send back text to calling function
	  return $viewmagazine_output;
	}

?>
