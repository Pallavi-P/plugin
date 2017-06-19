<?php
/*
* Plugin Name: CCMT - Spiritual
* Plugin URI: /wp_content/plugin/wp_spiritual/wp_spiritual.php
* Description: Plugin for managing contents on spiritual miles page.
* Scope: Global site - admin site
* Version: 1.2
* Author: Girish Vas 
* Author URI: http://google.co.in
* Modified by: Br. Saket
* Modifications:  
*	ver 1.1 - scripts commented & enqueued once again at the top
*	ver 1.2 - changed enqueuing path of scripts to library folder. Removed commented scripts
*/




if (!defined('WP_LIBRARY_URL')):
	define( 'WP_LIBRARY_URL', content_url().'/'.'gcmw-library'.'/');
endif;

/*  added by Br Saket  -- 10/10/2016 */
add_action('admin_enqueue_scripts', 'add_wp_spiritual_scripts');

function add_wp_spiritual_scripts()
{  
	// wp_enqueue_script( 'wp-spiritual-plugin-jquery',plugins_url('js/jquery-1.9.1.min.js', __FILE__),array(),false,false);
	// wp_enqueue_script( 'wp-spiritual-jquery-ui',plugins_url('datepicker/jquery-ui.js', __FILE__),array(),false,false);
	// wp_enqueue_script( 'wp-spiritual-datetimepicker-js',plugins_url('js/DateTimePicker.js', __FILE__),array(),false,false);
	// wp_enqueue_script( 'wp-spiritual-countries-js',plugins_url('country/countries.js', __FILE__),array(),false,false);
	// wp_enqueue_script( 'wp-spiritual-js',plugins_url('js/wp_spiritual.js', __FILE__),array(),false,false);
	// wp_enqueue_style('wp-spiritual-datepicker-css',plugins_url('datepicker/jquery-ui.css', __FILE__));
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
		wp_enqueue_script( 'datepicker-wp_plugins_common_events-js', WP_LIBRARY_URL.'wp_plugins_common_events.js',array(),NULL,true);
	endif;
	//wp_enqueue_script( 'wp-spiritual-wp-spiritual-js',plugins_url('js/wp_spiritual.js', __FILE__),array(),NULL,false);
	if(!wp_style_is('datepicker-datepicker-css')):
		wp_enqueue_style('datepicker-datepicker-css', WP_LIBRARY_URL.'datepicker/jquery-ui.css');
	endif;

	if(!wp_style_is('cust-plugin-admin-css')):
		wp_enqueue_style('cust-plugin-admin-css', WP_LIBRARY_URL.'cust_plugin_admin.css');
	endif;

}

/* ------ */

global $wpdb;

add_action('admin_menu', 'spiritual_admin_menu');

function spiritual_admin_css() 
{
        wp_enqueue_style( 'prefix-style', plugins_url('location_admin.css', __FILE__) );
}

function spiritual_admin_menu()
{


	add_menu_page ('CCMT','CCMT Spiritual Miles','administrator','ccmt-spiritual','display_ccmt_spiritual', 'dashicons-smiley' );

	add_submenu_page('ccmt-spiritual','spiritual','spiritual','spiritual','spiritual','view_spiritual');
}

function display_ccmt_spiritual() 
{

	echo "<div id='l-wrapper'>";
	echo "<h1>Spiritual Manager</h1>";
	echo "<button id='addevent'> Add</button>";
	echo "</div>";

	if (!isset($form1)) { $form1 = ""; }
	$form1 .= "<h3>Add New </h3>";    
	$form1 .= "<form enctype='multipart/form-data' name='magazine' id='magazine' method='post' action=''>";
	$form1 .= "<div class='l-left'>Name:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<input type='text' name='sname' />";
	$form1 .= "</div><br/>";

	$form1 .= "<div class='l-left'>Miles per unit:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<input type='text' name='mpu' />";
	$form1 .= "</div><br/>";

	global $wpdb;
	$form1 .= "<div class='l-left'>Category:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<select name='category' >";
	$form1 .= "<option value=''>Select Category</option>";

	foreach($wpdb->get_results("SELECT 	name FROM wp_spiritual_cat") as $key => $row)
	{
		$form1 .= "<option value='" . $row->name ."'>" . $row->name ."</option>";
	}
	$form1 .= "</select>";
	$form1 .= "</div><br/>";

    $form1 .= "<div class='l-left'>Description:</div>";
    $form1 .= "<div class='l-right'>";
    $form1 .= "<textarea name='description' rows='10' cols='20'></textarea>";;
    $form1 .= "</div><br/>";

    $form1 .= "<div class='l-left'>Spiritual Miles 1:</div>";
    $form1 .= "<div class='l-right'>";
    $form1 .= "<textarea name='spmiles1' rows='4' cols='20'></textarea>";;
    $form1 .= "</div><br/>";

    $form1 .= "<div class='l-left'>Details 1:</div>";
    $form1 .= "<div class='l-right'>";
    $form1 .= "<textarea name='spdetails1' rows='10' cols='20'></textarea>";;
    $form1 .= "</div><br/>";

    $form1 .= "<div class='l-left'>Spiritual Miles 2:</div>";
    $form1 .= "<div class='l-right'>";
    $form1 .= "<textarea name='spmiles2' rows='4' cols='20'></textarea>";;
    $form1 .= "</div><br/>";

    $form1 .= "<div class='l-left'>Details 2:</div>";
    $form1 .= "<div class='l-right'>";
    $form1 .= "<textarea name='spdetails2' rows='10' cols='20'></textarea>";;
    $form1 .= "</div><br/>";

    $form1 .= "<div class='l-left'>Image:</div>";
    $form1 .= "<div class='l-right'>";
    $form1 .= "<input type='file' name='image' accept='image/*''>";
    $form1 .= "</div><br/>";

	$form1 .="<input type='hidden' name='submitted-spiritual' id='submitted-spiritual' value='spiritual' />";
	$form1 .="<input type='submit' value='Add Spiritual' name='add-spiritual' />";
	$form1 .= "</form>";
	echo "<div id='l-event' style='display:none;'>".$form1."</div>";

} 

//City	State	Country	Continent	Latitude	Longitude	Added On	Updated 

/* event query*/
if(isset($_POST['submitted-spiritual'])) 
{
	$description = trim($_POST['description']);
	$s_name = trim($_POST['sname']);
	$mpu = trim($_POST['mpu']);
	$category = $_POST['category'];
	$spmiles1 = $_POST['spmiles1'];
	$spmiles2 = $_POST['spmiles2'];
	$spdetails1 = $_POST['spdetails1'];
	$spdetails2 = $_POST['spdetails2'];
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
		        'wp_spiritual',
		        array(
		                'id' => '', 
		                'name' => $s_name,
		                'miles_per_unit' => $mpu,
		                'category' => $category,
		                'description' => $description,
		                'miles1' => $spmiles1,
		                'miles2' => $spmiles2,
		                'details1' => $spdetails1,
		                'details2' => $spdetails2,
						'image' => $filepath,					
		        ),  
		        array( 
		                '%d', 
						'%s',
						'%d',
						'%s',
						'%s',
		                '%s', 
		                '%s',
						'%s',
		                '%s',
						'%s',		                
		        )	
			);
	$spiritual = true;
}


function view_spiritual() 

{
	global $wpdb;
	echo "<h2>Spiritual Miles</h2>";

	if($_GET['delete-spiritual']) 
	{

		$cd = $_GET['delete-spiritual'];
		$wpdb->query( 
			$wpdb->prepare( 
				"
	               DELETE FROM wp_spiritual
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
		echo "Update Spiritual";
		$ws = $wpdb->get_results("SELECT * FROM wp_spiritual WHERE id = $wid");
		$uspiritual ='';
		$uspiritual .="<form enctype='multipart/form-data' method='post' action=''>";

        $uspiritual .= "<div class='l-left'>Name:</div>";
        $uspiritual .= "<div class='l-right'>";
        $uspiritual .= "<input type='text' name='usname' value='".$ws[0]->name."' />";
        $uspiritual .= "</div>";

        $uspiritual .= "<div class='l-left'>Miles per unit:</div>";
        $uspiritual .= "<div class='l-right'>";
        $uspiritual .= "<input type='text' name='umpu' value='".$ws[0]->miles_per_unit."' />";
        $uspiritual .= "</div>";

        $uspiritual .= "<div class='l-left'>Category:</div>";
        $uspiritual .= "<div class='l-right'>";
        $uspiritual .= "<input type='text' name='ucategory' value='".$ws[0]->category."'/>";
        $uspiritual .= "</div>";

        $uspiritual .= "<div class='l-left'>Description:</div>";
        $uspiritual .= "<div class='l-right'>";
        $uspiritual .= "<textarea name='udescription' rows='10' cols='20'>".$ws[0]->description."</textarea>";
        $uspiritual .= "</div>";

        $uspiritual .= "<div class='l-left'>Spiritual Miles 1:</div>";
        $uspiritual .= "<div class='l-right'>";
        $uspiritual .= "<textarea name='uspmiles1' rows='4' cols='20'>".$ws[0]->miles1."</textarea>";
        $uspiritual .= "</div>";

        $uspiritual .= "<div class='l-left'>Details 1:</div>";
        $uspiritual .= "<div class='l-right'>";
        $uspiritual .= "<textarea name='uspdetails1' rows='10' cols='20'>".$ws[0]->details1."</textarea>";
        $uspiritual .= "</div>";

        $uspiritual .= "<div class='l-left'>Spiritual Miles 2:</div>";
        $uspiritual .= "<div class='l-right'>";
        $uspiritual .= "<textarea name='uspmiles2' rows='4' cols='20'>".$ws[0]->miles2."</textarea>";
        $uspiritual .= "</div>";

        $uspiritual .= "<div class='l-left'>Details 2:</div>";
        $uspiritual .= "<div class='l-right'>";
        $uspiritual .= "<textarea name='uspdetails2' rows='10' cols='20'>".$ws[0]->details2."</textarea>";
        $uspiritual .= "</div>";
		$uspiritual .= "<div class='l-left'>Image:</div>";
		$uspiritual .= "<div class='l-right'>";
		$uspiritual .= "<input type='file' name='image' accept='image/*''>";
		$uspiritual .= "</div><br/>";
		$uspiritual .="<input type='hidden' name='update-spiritual' id='update-spiritual' value='spiritual' />";
        $uspiritual .="<input type='submit' value='Update-Spiritual' />";
		$uspiritual .="</form>";	
		echo "<div id='u-spiritual' style='width:800px;'>".$uspiritual."</div>";

		if($_POST['update-spiritual'])	
		{
			
			$uid = $_GET['update'];
            $usname = $_POST['usname'];
            $umpu = $_POST['umpu'];
			$ucategory = $_POST['ucategory']; 
			$udescription = $_POST['udescription']; 
			$uspmiles1 = $_POST['uspmiles1']; 
			$uspmiles2 = $_POST['uspmiles2'];
			$uspdetails1 = $_POST['uspdetails1'];
			$uspdetails2 = $_POST['uspdetails2'];
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
						
			$wpdb->update( 
					'wp_spiritual', 
					array( 
						'name' => $usname,
						'miles_per_unit' => $umpu,
						'category' => $ucategory,
						'description' => $udescription,
						'miles1' => $uspmiles1,
						'miles2' => $uspmiles2,
						'details1' => $uspdetails1,
						'details2' => $uspdetails2,
				        'image' => $filepath,
					), 
					array( 'ID' => $uid ), 
					array( 
						'%s',
						'%d',
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
	}


	//pagination
	$num_spiritual = $wpdb->get_results("SELECT count(*) as total_nr FROM wp_spiritual");
	//$num_itinerary = 4;
	$n_spiritual = $num_spiritual[0]->total_nr;
	$n_x_spiritual = 49;
	$n_spiritual = (($n_spiritual / $n_x_spiritual) < 1 ? 1 : ($n_spiritual / $n_x_spiritual));
	$pitinerary=0;

	if( isset($_REQUEST['pspiritual'])) {
		$pitinerary=$_REQUEST['pspiritual'];
	}

	function get_page1_scrolling ($n_spiritual,$pspiritual,$n_spiritual)
	{
		$base_url ='/wp-admin/admin.php?page=spiritual';
		$scroll1 ='';

		if ($n_spiritual > 1)
		{
			if ($pspiritual >= 1) 
			{
				$scroll1 ='<div id="prev_btn" style="float:left;"><a style="padding-right:30px;" href="'.$base_url.'&pmagazine='.($pmagazine - 49).'">Previous</a></div>';
			}
			if ($pspiritual < ($n_spiritual - 1)) {
				$scroll1 .= '<div id="next_btn" style="float:right;margin-right: 21px;"><a style="padding-right:43px;" href="'.$base_url.'&pmagazine='.($pmagazine + 49).'">Next</a></div>';
			}
	
			if (trim($scroll1) != "1")
			{		
				return $scroll1;
			}
		}
		return $scroll1;
	}
	$scrolling = get_page1_scrolling($n_spiritual,$pspiritual,$n_spiritual);
	echo "<div class='l-pagination'>".$scrolling."</div>";

	global $wpdb;
	
	if ($_GET['submitted-search']) 
	{
      	$word = $_GET['search'];	

	}	
	$ws_details = $wpdb->get_results("SELECT * FROM wp_spiritual");	
	echo "<table class='loc-table'>";
	echo "<th>ID</th>";
    echo "<th>Name</th>";
    echo "<th>Miles/unit</th>";
	echo "<th>Category</th>";
	echo "<th>Description</th>";
	echo "<th>Spiritual Miles 1</th>";
	echo "<th>Details 1</th>";
	echo "<th>Spiritual Miles 2</th>";
	echo "<th>Details 2</th>";
	echo "<th>Image</th>";
	echo "<th></th>";
	echo "<th></th>";
	foreach ($ws_details as $data) 
	{
		$i++;
		echo "<tr>";
		echo "<td>".$i."</td>";
		echo "<td>".$data->name."</td>";
		echo "<td>".$data->miles_per_unit."</td>";
		echo "<td>".$data->category."</td>";
		echo "<td>".$data->description."</td>";
		echo "<td>".$data->miles1."</td>";
		echo "<td>".$data->details1."</td>";
		echo "<td>".$data->miles2."</td>";
		echo "<td>".$data->details2."</td>";
		echo "<td><img src='/".$data->image."' width='75px' height='75px'/></td>";
        echo "<td><a href='/wp-admin/admin.php?page=spiritual&update=".$data->id."'>Edit</a></td>";
        echo "<td><a href='/wp-admin/admin.php?page=spiritual&delete-spiritual=".$data->id."'>Delete</a></td>";
		echo "</tr>";
	}
	echo "</table>";
}

add_shortcode("add_spiritual", "spiritual_handler");
add_shortcode("edit_spiritual", "viewspiritual_handler");

function spiritual_handler() 
{
  //run function that actually does the work of the plugin
  $addspiritual_output = display_ccmt_spiritual();
  //send back text to replace shortcode in post
  return $addspiritual_output;
}

function viewspiritual_handler() 
{
  //process plugin
  $viewspiritual_output = view_spiritual();
  //send back texspiritualt to calling function
  return $viewspiritual_output;
}

?>
