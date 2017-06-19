<?php
/*
Plugin Name: BCC Jyoti Yatra
Plugin URI: http://google.co.in
Description: Plugin for adding Event .
Version: 1.0
Author: Girish Vas
Author URI: http://google.co.in
*/

add_action('admin_menu', 'itinerary_admin_menu');

add_action( 'admin_enqueue_scripts', 'location_admin_css' );

add_action ('admin_enqueue_scripts', 'country_admin_js' );

global $wpdb;


function location_admin_itinerary_css() {
    wp_enqueue_style( 'prefix-style', plugins_url('location_admin.css', __FILE__) );
}

function country_admin_itinerary_js() {
    wp_enqueue_script( 'my-script', plugins_url('/country/countries.js', __FILE__) );
}


function itinerary_admin_menu() {

	add_menu_page ('CCMT','BCC Itinerary','administrator','ccmt-itinerary','display_ccmt_itinerary' );
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
		$blogusers = get_users($args1);
	$form1 .= "<div class='l-left'>Acharya:</div>";
	$form1 .= "<div class='l-right'>";

    //$form1 .= "<select name='acharya-name'>";
	//foreach ($blogusers as $user) {
    //    $form1 .= '<option value='.$user->display_name . '>' . $user->display_name . '</option>';
    //                                }
    //$form1 .="</select>";

    global $wpdb;

	$form1 .= "<div class='l-left'>From Date:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<input type='text' class='dater' name='datefrom' />";
	$form1 .= "</div><br/>";

	$form1 .= "<div class='l-left'>To Date:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<input type='text' class='dateto' name='dateto' />";
	$form1 .= "</div><br/>";

	
	$form1 .= "<div class='l-left'>Place:</div>";
	$form1 .= "<div class='l-right'>";
//	$form1 .= "<input type='text' name='location-state' />";
	$form1 .= "<input type='text' name='state' />";
	$form1 .= "</div><br/>";

	$form1 .= "<div class='l-left'>State:</div>";
	$form1 .= "<div class='l-right'>";
//	$form1 .= "<input type='text' name='location-state' />";
	$form1 .= "<input type='text' name='statename' />";
	$form1 .= "</div><br/>";

	$form1 .= "<div class='l-left'>Days:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<input type='text' name='days' />";
	$form1 .= "</div><br/>";

	$form1 .= "<div class='l-left'>Distance to the next centre:</div>";
	$form1 .= "<div class='l-right'>";
	$form1 .= "<input type='text' name='dis_to_next' />";
	$form1 .= "</div><br/>";

	$form1 .="<input type='hidden' name='submitted-event' id='submitted-event' value='event' />";
	$form1 .="<input type='submit' value='Add Itinerary' name='add-event' />";

$form1 .= "</form>";


echo "<div id='l-event' style='display:none;'>".$form1."</div>";



?>
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

<? }

//ity	State	Country	Continent	Latitude	Longitude	Added On	Updated

/* event query*/
if(isset($_POST['submitted-event'])) {
$a_datefrom = $_POST['datefrom'];
$a_dateto = $_POST['dateto'];
$a_state = trim($_POST['state']);
$a_statename = trim($_POST['statename']);
$a_days = trim($_POST['days']);
$a_dis = $_POST['dis_to_next'];

global $wpdb;
$wpdb->insert(
        'wp_7_jyotiyatra',
        array(
                'id' => '',
                'from_date' => $a_datefrom,
                'to_date' => $a_dateto,
                'place' => $a_state,
				'state' => $a_statename,
				'days' => $a_days,
				'dis_to_next' => $a_dis,
				// 'latitude' => $a_latitude,
				// 'longitude' => $a_longitude,
        ),
        array(
                '%d',
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

$wpdb->query($wpdb->prepare("DELETE FROM  wp_7_jyotiyatra WHERE `datefrom` ='0000-00-00 00:00:00'"));
$event = true;
}


function view_itinerary() {

    global $wpdb;
	echo "<h2>Itinerary</h2>";

	if($_GET['delete-itinerary']) {

	$cd = $_GET['delete-itinerary'];

	$wpdb->query(
		$wpdb->prepare(
			"DELETE FROM wp_7_jyotiyatra
			WHERE id = %d",$cd
        )
	);
	echo "Record Deleted for ID ".$cd;
	}


	if ($_GET['update-itinerary'])
    {
	   $wid = $_GET['update-itinerary'];
	   echo "Update Itinerary";
	   $ws = $wpdb->get_results("SELECT * FROM `wp_7_jyotiyatra` WHERE `id` = $wid");

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
       $uitinerary .= "<input type='text' name='udatefrom' value='".$ws[0]->from_date."' />";
       $uitinerary .= "</div>";

       $uitinerary .= "<div class='l-left'>Dateto:</div>";
       $uitinerary .= "<div class='l-right'>";
       $uitinerary .= "<input type='text' name='udateto' value='".$ws[0]->to_date."' />";
       $uitinerary .= "</div>";

       $uitinerary .= "<div class='l-left'>Place:</div>";
       $uitinerary .= "<div class='l-right'>";
       $uitinerary .= "<input type='text' name='uplace' value='".$ws[0]->place."' />";
       $uitinerary .= "</div>";

       $uitinerary .= "<div class='l-left'>State:</div>";
       $uitinerary .= "<div class='l-right'>";
       $uitinerary .= "<input type='text' name='ustate' value='".$ws[0]->state."' />";
       $uitinerary .= "</div>";

       $uitinerary .= "<div class='l-left'>Days:</div>";
       $uitinerary .= "<div class='l-right'>";
       $uitinerary .= "<input type='text' name='udays' value='".$ws[0]->days."' />";
       $uitinerary .= "</div>";

       $uitinerary .= "<div class='l-left'>Distance to next:</div>";
       $uitinerary .= "<div class='l-right'>";
       $uitinerary .= "<input type='text' name='udis_to_next' value='".$ws[0]->dis_to_next."' />";
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
			$uplace = $_POST['uplace'];
            $ustate = $_POST['ustate'];
			$udays = $_POST['udays'];
			$udis_to_next = $_POST['udis_to_next'];
			// $ulongitude = $_POST['longitude'];
			// $ulatitude = $_POST['latitude'];

			// $u_date = $udatefrom;
			// $ordertime = explode(' ', $u_date);
			// $udate = $ordertime[0];
			// $orderdate = explode('-', $udate);
			// $u_year = $orderdate[0];

	$wpdb->update(
	'wp_7_jyotiyatra',
	array(
		//'acharya_id' => $uacharya_id,	// string
		'from_date' => $udatefrom,
		'to_date' => $udateto,
		'place' => $uplace,
		'state' => $ustate,
		'days' => $udays,
		'dis_to_next' => $udis_to_next,
		// 'longitude' => $ulongitude,
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
	$ws_details = $wpdb->get_results("SELECT * FROM `wp_7_jyotiyatra` ORDER BY from_date DESC");
	
	//else
	//{
	  //  $ws_details = $wpdb->get_results("SELECT * FROM `wp_itinerary` WHERE YEAR(datefrom) BETWEEN (YEAR(curdate())) AND (YEAR(curdate()) +1)  ORDER BY datefrom DESC ");
	//}

     echo "<div style='width:1235px;max-height:800px;overflow-x: auto;overflow-y:auto;'>";
	 echo "<table class='loc-table'style='empty-cells:show;' border='1'>";
		// echo "<th>ID</th>";
		echo "<th>ID</th>";
		echo "<th>Date From</th>";
		echo "<th>Date To</th>";
		echo "<th>Place</th>";
		echo "<th>State</th>";
		echo "<th>Days</th>";
		echo "<th>Distance to next</th>";
		// echo "<th>Longitude</th>";
		// echo "<th>Latitude</th>";
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
			echo "<td>".$data->from_date."</td>";
			echo "<td>".$data->to_date."</td>";
			echo "<td>".$data->place."</td>";
            echo "<td>".$data->state."</td>";
			echo "<td>".$data->days."</td>";
			echo "<td>".$data->dis_to_next."</td>";
			// echo "<td>".$data->longitude."</td>";
			// echo "<td>".$data->latitude."</td>";
			echo "<td><a href='/wp-admin/admin.php?page=itinerary&update-itinerary=".$data->id."'>Edit</a></td>";
			echo "<td><a href='/wp-admin/admin.php?page=itinerary&delete-itinerary=".$data->id."'>Delete</a></td>";
			echo "</tr>";

		}
	echo "</table>";
	echo "</div>";
}

add_shortcode("add_itinerary", "itinerary_handler");
add_shortcode("edit_itinerary", "viewitinerary_handler");

function itinerary_handler() {
  //run function that actually does the work of the plugin
  $additinerary_output = display_ccmt_itinerary();
  //send back text to replace shortcode in post
  return $additinerary_output;
}

function viewitinerary_handler() {
  //process plugin
  $viewitinerary_output = view_itinerary();
  //send back text to calling function
  return $viewitinerary_output;
}
