<?php
/*
* Plugin Name: CCMT Itinerary
* Plugin URI: http://google.co.in
* Description: Plugin for adding itinerary .
* Scope: Global site - admin site
* Version: 1.0
* Author: Girish Vas 
* Author URI: http://google.co.in
* Modified by: Br. Saket
* Modifications:  
*	ver 1.1 - scripts commented & enqueued once again at the top
*	ver 1.2 - changed enqueuing path of scripts to library folder. Removed commented scripts
*/


/* 
function location_admin_itinerary_css() {
    wp_enqueue_style( 'prefix-style', plugin_dir_url( __FILE__ ).'location_admin.css');
}
  add_action( 'admin_enqueue_style', 'location_admin_itinerary_css' );

function country_admin_itinerary_js() {
    wp_enqueue_script( 'my_custom_script', plugin_dir_url( __FILE__ ).'/country/countries.js');
}
add_action ('admin_enqueue_scripts', 'country_admin_itinerary_js' );
*/

if (!defined('WP_LIBRARY_URL')):
	define( 'WP_LIBRARY_URL', content_url().'/'.'gcmw-library'.'/');
endif;
add_action('admin_enqueue_scripts', 'add_wp_itinerary_scripts');

function add_wp_itinerary_scripts()
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
		wp_enqueue_script( 'datepicker-wp_plugins_common_events-js', WP_LIBRARY_URL.'wp_plugins_common_events.js',array(),NULL,true);
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


add_action('admin_menu', 'itinerary_admin_menu');

global $wpdb;

function itinerary_admin_menu() {

	add_menu_page ('CCMT','CCMT Itinerary','administrator','ccmt-itinerary','display_ccmt_itinerary','dashicons-tickets-alt' );
	add_submenu_page('ccmt-itinerary','itinerary','itinerary','itinerary','itinerary','view_itinerary');
}

function display_ccmt_itinerary() {

	echo "<div id='l-wrapper'>";
		echo "<h1>Itinerary Manager</h1>";
		echo "<button id='addevent'>Add</button>";
	echo "</div>";


if (!isset($form1)) { $form1 = ""; }

	$form1 .= "<h3>Add New Itinerary</h3>";
	$form1 .= "<form name='itinerary' id='itinerary' method='post' action=''>";

	if(isset($itinerary) && $itinerary== true) {
		echo "New itinerary Added";
	}
	$args1['role'] = 'acharya';
	$blogusers = get_users($args1);
	$form1 .= "<div class='l-left'>Acharya:</div>";
	$form1 .= "<div class='l-right'>";

    //$form1 .= "<select name='acharya-name'>";
	//foreach ($blogusers as $user) {
    //    $form1 .= '<option value='.$user->display_name . '>' . $user->display_name . '</option>';
    //                                }
    //$form1 .="</select>";

    global $wpdb;
    $form1 .= "<select name = 'acharya-name'>";
    foreach($wpdb->get_results("SELECT salutation,id,last_name FROM `wp_acharya` ORDER BY salutation,last_name ") as $key => $page){
    	$form1 .= "<option value='".lcfirst($page->id)."'>" .$page->salutation." ".$page->last_name ."</option>";
    	}
	$form1 .="</select>";    	
    //$form1 .= "tejomayananda";
	$form1 .= "</div><br/>";

	$form1 .= "<div class='l-left'>Date From:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<input type='text' class='dater' name='datefrom' />";
	$form1 .= "</div><br/>";

	$form1 .= "<div class='l-left'>End Date:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<input type='text' class='dateto' name='dateto' />";
	$form1 .= "</div><br/>";

	$form1 .= "<div class='l-left'>Event:</div>";
	$form1 .= "<div class='l-right'><select name ='event'>";
    	$form1 .= "<option value=''>-- Select Event --</option>";
	foreach($wpdb->get_results("SELECT `post_id` FROM `wp_posts` as p, `wp_ai1ec_events` as a WHERE p.ID = a.post_id AND p.post_status = 'publish' order by p.post_title asc") as $key => $page){
		$post_ttl = get_the_title($page->post_id);
    	$form1 .= "<option value='".$page->post_id."'>" .$post_ttl."</option>";
    	}
	$form1 .="</select>";    	
	$form1 .= "</div><br/>";

	// $form1 .= "<div class='l-left'>Event:</div>";
	// $form1 .= "<div class='l-right'>";
	// $form1 .= "<textarea name='event' rows='10' cols='20'></textarea>";
	// $form1 .= "</div><br/>";

    $form1 .= "<div class='l-left'>Purpose:</div>";
    $form1 .= "<div class='l-right'>";
    $form1 .= "<input type='text' name='purpose' />";
    $form1 .= "</div><br/>";

	$form1 .= "<div class='l-left'>Place:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<input type='text' name='place' />";
	$form1 .= "</div><br/>";

	$form1 .= "<div class='l-left'>Address:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<textarea name='address' rows='10' cols='20'></textarea>";
	$form1 .= "</div><br/>";

	$form1 .= "<div class='l-left'>Country:</div>";
	$form1 .= "<div class='l-right'>";
//	$form1 .= "<input type='text' name='location-country' />";
	$form1 .= "<select onchange='gstate(this.selectedIndex);' id='country' name='country' >";
	$form1 .= "</select>";
	$form1 .= "</div><br/>";

	$form1 .= "<div class='l-left'>State:</div>";
	$form1 .= "<div class='l-right'>";
//	$form1 .= "<input type='text' name='location-state' />";
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

	$form1 .= "<div class='l-left'>Contact:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<input type='text' name='contact' />";
	$form1 .= "</div><br/>";

	$form1 .="<input type='hidden' name='submitted-event' id='submitted-event' value='event' />";
	$form1 .="<input type='submit' value='Add Itinerary' name='add-event' />";

$form1 .= "</form>";


echo "<div id='l-event' style='display:none;'>".$form1."</div>";



?>
<!--
<script type='text/javascript' src='/wp-content/plugins/wp_itinerary/js/jquery-1.9.1.min.js'></script>
<script type='text/javascript' src='/wp-content/plugins/wp_itinerary/datepicker/jquery-ui.js'></script>
<script type='text/javascript' src='/wp-content/plugins/wp_itinerary/js/DateTimePicker.js'></script>
<script type='text/javascript' src='/wp-content/plugins/wp_itinerary/country/countries.js'></script>
<link rel="stylesheet" href="/wp-content/plugins/wp_itinerary/datepicker/jquery-ui.css" />
<script type="text/javascript" language="javascript">

jQuery(document).ready(function () {

jQuery("#addevent").click(function(){

jQuery("#l-event").show();
});
});

$(function() {
$( ".dater" ).datetimepicker(
{ dateFormat: 'yy-mm-dd' });
});

$(function() {
$( ".dateto" ).datetimepicker(
{ dateFormat: 'yy-mm-dd' });
});

function gstate(abc) {
print_state('state',abc);
}


</script>
-->

<?php }

//ity	State	Country	Continent	Latitude	Longitude	Added On	Updated

/* event query*/
if(isset($_POST['submitted-event'])) {
$a_name = $_POST['acharya-name'];
$a_datefrom = $_POST['datefrom'];
$a_dateto = $_POST['dateto'];
$a_event = trim($_POST['event']);
$a_purpose = $_POST['purpose'];
$a_place = trim($_POST['place']);
$a_address = trim($_POST['address']);
$a_contact = trim($_POST['contact']);
$a_type = $_POST['submitted-event'];
$a_country = $_POST['country'];
$a_state = $_POST['state'];
$a_city = $_POST['city'];
$a_continent = $_POST['continent'];
$ev_date = $a_datefrom;
$ordertime = explode(' ', $ev_date);
$date = $ordertime[0];
$orderdate = explode('-', $date);
$a_year = $orderdate[0];
//	print_r($a_name);

$wpdb->insert(
        'wp_itinerary',
        array(
                'id' => '',
                'acharya_id' => $a_name,
                'datefrom' => $a_datefrom,
                'dateto' => $a_dateto,
				'event' => $a_event,
				'purpose' => $a_purpose,
                'place' => $a_place,
				'address' => $a_address,
				'contact' => $a_contact,
				'country' => $a_country,
				'state' => $a_state,
				'city' => $a_city,
				'continent' => $a_continent,
				// 'latitude' => $a_latitude,
				// 'longitude' => $a_longitude,
				'year' => $a_year,
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
	        	// '%f',
	        	// '%f',
        )
);

$wpdb->query($wpdb->prepare("DELETE FROM wp_itinerary WHERE `datefrom` ='0000-00-00 00:00:00'"));
$event = true;
}


function view_itinerary() {

    global $wpdb;
	echo "<h2>Itinerary</h2>";

	if($_GET['delete-itinerary']) {

	$cd = $_GET['delete-itinerary'];

	$wpdb->query(
		$wpdb->prepare(
			"DELETE FROM wp_itinerary
			WHERE id = %d",$cd
        )
	);
	echo "Record Deleted for ID ".$cd;
	}


	if ($_GET['update-itinerary'])
    {
	   $wid = $_GET['update-itinerary'];
	   echo "Update Itinerary";
	   $ws = $wpdb->get_results("SELECT * FROM `wp_itinerary` WHERE `id` = $wid");

	   // print_r($ws) ;City	State	Country	Continent	Latitude	Longitude	Added On

	   $uitinerary ='';
	   $uitinerary .="<form method='post' action=''>";
       //    foreach ($blogusers as $user) {
       //    $uitinerary .= '<option value='.$user->display_name . '>' . $user->display_name . '</option>';
       // 		}
       // $uitinerary .= "</select>";
       // $uitinerary .= "tejomayananda";
       // $uitinerary .= "</div>";

       $uitinerary .= "<div class='l-left'>Datefrom:</div>";
       $uitinerary .= "<div class='l-right'>";
       $uitinerary .= "<input type='text' name='udatefrom' value='".$ws[0]->datefrom."' />";
       $uitinerary .= "</div>";

       $uitinerary .= "<div class='l-left'>Dateto:</div>";
       $uitinerary .= "<div class='l-right'>";
       $uitinerary .= "<input type='text' name='udateto' value='".$ws[0]->dateto."' />";
       $uitinerary .= "</div>";


       $uitinerary .= "<div class='l-left'>Event:</div>";
       $uitinerary .= "<div class='l-right'>";
       $uitinerary .= "<textarea name='uevent' rows='10' cols='20'>".$ws[0]->event."</textarea>";
       $uitinerary .= "</div>";


       $uitinerary .= "<div class='l-left'>Purpose:</div>";
       $uitinerary .= "<div class='l-right'>";
       $uitinerary .= "<input type='text' name='upurpose' value='".$ws[0]->purpose."'/>";
       $uitinerary .= "</div>";

       $uitinerary .= "<div class='l-left'>Place:</div>";
       $uitinerary .= "<div class='l-right'>";
       $uitinerary .= "<input type='text' name='uplace' value='".$ws[0]->place."' />";
       $uitinerary .= "</div>";

       $uitinerary .= "<div class='l-left'>Address:</div>";
       $uitinerary .= "<div class='l-right'>";
       $uitinerary .= "<textarea name='uaddress' rows='10' cols='20'>".$ws[0]->address."</textarea>";
       $uitinerary .= "</div>";

		$uitinerary .= "<div class='l-left'>Country:</div>";
        $uitinerary .= "<div class='l-right'>";
        $uitinerary .= "<input type='text' name='country' value='".$ws[0]->country."' />";
     //   $uitinerary .= "<select onchange='gstate(this.selectedIndex);' id='country' name='country' >";
        $uitinerary .= "</select>";
        $uitinerary .= "</div>";

        $uitinerary .= "<div class='l-left'>State:</div>";
        $uitinerary .= "<div class='l-right'>";
        $uitinerary .= "<input type='text' name='state' value='".$ws[0]->state."'/>";
//      $uitinerary .= "<select type='text' name='state' id='state'>";
        $uitinerary .= "</select>";
//      $uitinerary .= "<script language='javascript'>print_country('country');</script>";
        $uitinerary .= "</div>";

        $uitinerary .= "<div class='l-left'>City:</div>";
        $uitinerary .= "<div class='l-right'>";
        $uitinerary .= "<input type='text' name='city' value='".$ws[0]->city."'/>";
        $uitinerary .= "</div>";

        $uitinerary .= "<div class='l-left'>Continent:</div>";
        $uitinerary .= "<div class='l-right'>";
        $uitinerary .= "<select name='continent'>";
        $uitinerary .= "<option value='Asia'";

        if($ws[0]->continent == "Asia"){
        $uitinerary .= "selected ";
        }

        $uitinerary .=" >Asia</option>";
        $uitinerary .= "<option value='Africa'>";

        if($ws[0]->continent == "Africa"){
        $uitinerary .= "selected ";
        }
        $uitinerary .=" >Africa</option>";
        $uitinerary .= "<option value='North America'";

        if($ws[0]->continent == "North America"){
        $uitinerary .= "selected ";
        }
        $uitinerary .=">North America</option>";
        $uitinerary .= "<option value='South America'";
         if($ws[0]->continent == "South America"){
        $uitinerary .= "selected ";
        }
        $uitinerary .=">South America</option>";
        $uitinerary .= "<option value='Antarctica' ";
         if($ws[0]->continent == "Antarctica"){
        $uitinerary .= "selected ";
        }
        $uitinerary .=">Antarctica</option>";
        $uitinerary .= "<option value='Europe'";
         if($ws[0]->continent == "Europe"){
        $uitinerary .= "selected ";
        }
        $uitinerary .=">Europe</option>";
        $uitinerary .= "<option value='Australia'";
         if($ws[0]->continent == "Australia"){
        $uitinerary .= "selected ";
        }
        $uitinerary .=">Australia</option>";
        $uitinerary .= "</select>";
        $uitinerary .= "</div>";

        $uitinerary .= "<div class='l-left'>Contact:</div>";
        $uitinerary .= "<div class='l-right'>";
        $uitinerary .= "<input type='text' name='ucontact' value='".$ws[0]->contact."' />";
        $uitinerary .= "</div>";

        $uitinerary .="<input type='hidden' name='update-itinerary' id='update-itinerary' value='itinerary' />";
        $uitinerary .="<input type='submit' value='Update-Itinerary' />";

	    $uitinerary .="</form>";

	    echo "<div id='u-itinerary' style='width:800px;'>".$uitinerary."</div>";

		if($_POST['update-itinerary'])	{

			$uid = $_GET['update-itinerary'];
			//$uacharya_name = $_POST['uacharya-name'];
			//$args = array(
		    //    'display_name'      => $uacharya_name,);
		     //   $uacharya = get_users($args);
			//$uacharya_id = 'tejomayananda';
			$udatefrom = $_POST['udatefrom'];
			$udateto = $_POST['udateto'];
			$uevent = $_POST['uevent'];
            $upurpose = $_POST['upurpose'];
			$uadd = $_POST['uaddress'];
			$uplace = $_POST['uplace'];
			$ucontact = $_POST['ucontact'];
			$ucountry = $_POST['country'];
			$ustate = $_POST['state'];
			$ucity = $_POST['city'];
			$ucontinent = $_POST['continent'];
			// $ulongitude = $_POST['longitude'];
			// $ulatitude = $_POST['latitude'];

			$u_date = $udatefrom;
			$ordertime = explode(' ', $u_date);
			$udate = $ordertime[0];
			$orderdate = explode('-', $udate);
			$u_year = $orderdate[0];

	$wpdb->update(
	'wp_itinerary',
	array(
		//'acharya_id' => $uacharya_id,	// string
		'datefrom' => $udatefrom,
		'dateto' => $udateto,
		'event' => $uevent,
        'purpose' => $upurpose,
		'address' => $uadd,
		'place' => $uplace,
		'contact' => $ucontact,
		'country' => $ucountry,
		'state' => $ustate,
		'city' => $ucity,
		'continent' => $ucontinent,
		// 'latitude' => $ulatitude,
		// 'longitude' => $ulongitude,
		'year' => $u_year,
	),
	array( 'ID' => $uid ),
	array(
		//'%s',
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
		// '%s',
		// '%s',

	),
	array( '%d' )
	);
		}

	}

	//pagination
	$num_itinerary = $wpdb->get_results("SELECT count(*) as total_nr FROM `wp_itinerary`");
	//$num_itinerary = 4;
	$n_itinerary = $num_itinerary[0]->total_nr;
	$n_x_itinerary = 49;
	$n_itinerary = (($n_itinerary / $n_x_itinerary) < 1 ? 1 : ($n_itinerary / $n_x_itinerary));
	$pitinerary=0;

	if( isset($_REQUEST['pitinerary'])) {
		$pitinerary=$_REQUEST['pitinerary'];
	}

	function get_page1_scrolling ($n_itinerary,$pitinerary,$n_itinerary)
	{
		$base_url ='/wp-admin/admin.php?page=itinerary';
		$scroll1 ='';

		if ($n_itinerarys > 1)
		{
			if ($pitinerary >= 1)
			{
				$scroll1 ='<div id="prev_btn" style="float:left;"><a style="padding-right:30px;" href="'.$base_url.'&pitinerary='.($pitinerary - 49).'">Previous</a></div>';
			}
			if ($pitinerary < ($n_itinerarys - 1)) {
				$scroll1 .= '<div id="next_btn" style="float:right;margin-right: 21px;"><a style="padding-right:43px;" href="'.$base_url.'&pitinerary='.($pitinerary + 49).'">Next</a></div>';
			}

			if (trim($scroll1) != "1")
			{
				return $scroll1;
			}
		}
		return $scroll1;
	}
	$scrolling = get_page1_scrolling($n_itinerary,$pitinerary,$n_itinerarys);

	echo "<div class='l-pagination'>".$scrolling."</div>";

	global $wpdb;
	$searchform .="";
	$searchform .="<div>";
	$searchform .="<form action='' method='get'>";
	$searchform .="<input type='hidden' value='itinerary' name='page'/>";
	$searchform .= "<select name = 'acharya-name'>";
    foreach($wpdb->get_results("select distinct i.acharya_id,a.aname,a.last_name from wp_acharya as a, wp_itinerary as i where a.id LIKE i.acharya_id") as $key => $page)
    {
   	      $searchform .= "<option value='".lcfirst($page->acharya_id)."'>" .$page->aname." ".$page->last_name ."</option>";
    }
	$searchform .="</select>";
	// $searchform .= "<select name = 'acharya-name'>";
 //    foreach($wpdb->get_results("SELECT DISTINCT acharya_id  FROM `wp_itinerary") as $key => $page)
 //    {
 //   	      $searchform .= "<option value='".lcfirst($page->acharya_id)."'>" .$page->acharya_id ."</option>";
 //    }
	// $searchform .="</select>";
	// $searchform .= "<input type='text' placeholder='Search' name='search' />";
	// $searchform .="<input type='hidden' value='search-user' name='submitted-search' id='search'/>";
	$searchform .= "<input type='submit' value='search' name='search-admin'/>";
	$searchform .="</form>";
	$searchform .= "</div>";
	echo $searchform;
    $ws_details = "";
    
	if ($_GET['search-admin']=='search') {
    $word = $_GET['acharya-name'];
    echo $word;
    //exit;

    // $args = array('display_name' => $word,);
    // $acharya = get_users($args);
    //// $date = date('Y-m-d H:i:s');
	$ws_details = $wpdb->get_results("SELECT * FROM `wp_acharya` as a, wp_itinerary as i WHERE a.id LIKE i.acharya_id AND i.acharya_id = '$word' AND YEAR(datefrom) BETWEEN (YEAR(curdate())) AND (YEAR(curdate()) +1)  ORDER BY datefrom DESC");
	
	//else
	//{
	  //  $ws_details = $wpdb->get_results("SELECT * FROM `wp_itinerary` WHERE YEAR(datefrom) BETWEEN (YEAR(curdate())) AND (YEAR(curdate()) +1)  ORDER BY datefrom DESC ");
	//}

     echo "<div style='width:1235px;max-height:800px;overflow-x: auto;overflow-y:auto;'>";
	 echo "<table class='loc-table'style='empty-cells:show;'>";
		// echo "<th>ID</th>";
		echo "<th>ID</th>";
		echo "<th>Acharya Name</th>";
		echo "<th>Date From</th>";
		echo "<th>Date To</th>";
		echo "<th>Event</th>";
        echo "<th>Purpose</th>";
		echo "<th>Place</th>";
		echo "<th>Address</th>";
		echo "<th>Country</th>";
		echo "<th>State</th>";
		echo "<th>City</th>";
		echo "<th>Continent</th>";
		// echo "<th>Longitude</th>";
		// echo "<th>Latitude</th>";
		echo "<th>Contact</th>";
		echo "<th></th>";
		echo "<th></th>";
		//print_r($ws_details);
		//exit;
		foreach ($ws_details as $data) {
			//$args = array(
			//'ID'  => $data->acharya_id,);
			//$blogusers = get_users($args);
			//$i++;
			echo "<tr>";
			// echo "<td>".$i."</td>";
			echo "<td>".$data->id."</td>";
			echo "<td>".$data->aname." ".$data->last_name."</td>";
			echo "<td>".$data->datefrom."</td>";
			echo "<td>".$data->dateto."</td>";
			echo "<td>".$data->event."</td>";
            echo "<td>".$data->purpose."</td>";
			echo "<td>".$data->place."</td>";
			echo "<td>".$data->address."</td>";
			echo "<td>".$data->country."</td>";
			echo "<td>".$data->state."</td>";
			echo "<td>".$data->city."</td>";
			echo "<td>".$data->continent."</td>";
			// echo "<td>".$data->longitude."</td>";
			// echo "<td>".$data->latitude."</td>";
			echo "<td>".$data->contact."</td>";
			echo "<td><a href='/wp-admin/admin.php?page=itinerary&update-itinerary=".$data->id."'>Edit</a></td>";
			echo "<td><a href='/wp-admin/admin.php?page=itinerary&delete-itinerary=".$data->id."'>Delete</a></td>";
			echo "</tr>";

		}
	echo "</table>";
	echo "</div>";
	}
}

// add_shortcode("add_itinerary", "itinerary_handler");
// add_shortcode("edit_itinerary", "viewitinerary_handler");

// function itinerary_handler() {
  //run function that actually does the work of the plugin
  // $additinerary_output = display_ccmt_itinerary();
  //send back text to replace shortcode in post
  // return $additinerary_output;
// }

// function viewitinerary_handler() {
  //process plugin
  // $viewitinerary_output = view_itinerary();
  //send back text to calling function
  // return $viewitinerary_output;
// }
?>