<?php
/*
Plugin Name: CCMT Event
Plugin URI: http://google.co.in
Description: Plugin for adding Event .
Version: 1.0
Author: Kishor Mehare
Author URI: http://google.co.in
*/



add_action('admin_menu', 'event_admin_menu');

add_action( 'admin_enqueue_scripts', 'location_admin_css' );

add_action ('admin_enqueue_scripts', 'country_admin_js' );

global $wpdb;


function location_admin_event_css() {
        wp_enqueue_style( 'prefix-style', plugins_url('location_admin.css', __FILE__) );
}

function country_admin_event_js() {
        wp_enqueue_script( 'my-script', plugins_url('/country/countries.js', __FILE__) );
}


function event_admin_menu() {

	add_menu_page ('CCMT','CCMT Events','administrator','ccmt-event','display_ccmt_event' );

	add_submenu_page('ccmt-event','event','event','event','event','view_event');


}

function display_ccmt_event() {

	echo "<div id='l-wrapper'>";
	echo "</div>";
?>
<script type='text/javascript' src='/wp-content/plugins/wp_event/js/jquery-1.9.1.min.js'></script>
<script type='text/javascript' src='/wp-content/plugins/wp_event/datepicker/jquery-ui.js'></script>
<script type='text/javascript' src='/wp-content/plugins/wp_event/js/DateTimePicker.js'></script>
<script type='text/javascript' src='/wp-content/plugins/wp_event/country/countries.js'></script>
<link rel="stylesheet" href="/wp-content/plugins/wp_event/datepicker/jquery-ui.css" />
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

<?php
}

	//City	State	Country	Continent	Latitude	Longitude	Added On	Updated

	/* event query*/
	if(isset($_POST['submitted-event'])) 
	{
		$a_name = trim($_POST['acharya-name']);
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
		$a_latitude = $_POST['latitude'];
		$a_longitude = $_POST['longitude'];
		$ev_date = $a_datefrom;
		$ordertime = explode(' ', $ev_date);
		$date = $ordertime[0];
		$orderdate = explode('-', $date);
		$a_year = $orderdate[0];

		$wpdb->insert(
			        'wp_event',
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
						'latitude' => $a_latitude,
						'longitude' => $a_longitude,
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
				        '%f',
				        '%f',
		        	)
				);
		$event = true;
	}//if(isset($_POST['submitted-event'])) ends

	function view_event() 
	{
		global $wpdb;
		echo "<h2>event</h2>";

		if($_GET['delete-event']) 
		{
			$cd = $_GET['delete-event'];
			$wpdb->query(
				$wpdb->prepare(
					"
	                	DELETE FROM wp_event
						WHERE id = %d
					",
				        $cd
		        	)
			);	
		}//function view event ends

		if ($_GET['update-event']) 
		{
			$wid = $_GET['update-event'];
			echo "Update event";
			$ws = $wpdb->get_results("SELECT * FROM `wp_event_register` WHERE `id` = $wid");
			$uevent ='';
			$uevent .="<form method='post' action=''>";	
			$args1['role'] = 'acharya';
	        $blogusers = get_users($args1);
	        $uevent .= "<div class='l-left'>Acharya Name:</div>";
	        $uevent .= "<div class='l-right'>";
	        $uevent .= "<select name='updateacharya' >";
	        foreach ($blogusers as $user) 
	        {
	        	$uevent .= '<option value='.$user->display_name . '>' . $user->display_name . '</option>';
			}
	    	$uevent .= "</select>";
	        $uevent .= "</div>";

	        $uevent .= "<div class='l-left'>Datefrom:</div>";
	        $uevent .= "<div class='l-right'>";
	        $uevent .= "<input type='text' name='udatefrom' value='".$ws[0]->datefrom."' />";
	        $uevent .= "</div>";

	        $uevent .= "<div class='l-left'>Dateto:</div>";
	        $uevent .= "<div class='l-right'>";
	        $uevent .= "<input type='text' name='udateto' value='".$ws[0]->dateto."' />";
	        $uevent .= "</div>";


	        $uevent .= "<div class='l-left'>Event:</div>";
	        $uevent .= "<div class='l-right'>";
	        $uevent .= "<textarea name='uevent' rows='10' cols='20'>".$ws[0]->event."</textarea>";
	        $uevent .= "</div>";


	        $uevent .= "<div class='l-left'>Purpose:</div>";
	        $uevent .= "<div class='l-right'>";
	        $uevent .= "<input type='text' name='upurpose' value='".$ws[0]->purpose."'/>";
	        $uevent .= "</div>";

	        $uevent .= "<div class='l-left'>Place:</div>";
	        $uevent .= "<div class='l-right'>";
	        $uevent .= "<input type='text' name='uplace' value='".$ws[0]->place."' />";
	        $uevent .= "</div>";

	        $uevent .= "<div class='l-left'>Address:</div>";
	        $uevent .= "<div class='l-right'>";
	        $uevent .= "<input type='text' name='uaddress' value='".$ws[0]->address."' />";
	        $uevent .= "</div>";

			$uevent .= "<div class='l-left'>Country:</div>";
	        $uevent .= "<div class='l-right'>";
	        $uevent .= "<input type='text' name='country' value='".$ws[0]->country."' />";     
	        $uevent .= "</select>";
	        $uevent .= "</div>";

	        $uevent .= "<div class='l-left'>State:</div>";
	        $uevent .= "<div class='l-right'>";
	        $uevent .= "<input type='text' name='state' value='".$ws[0]->state."'/>";
	        $uevent .= "</select>";
	        $uevent .= "</div>";

	        $uevent .= "<div class='l-left'>City:</div>";
	        $uevent .= "<div class='l-right'>";
	        $uevent .= "<input type='text' name='city' value='".$ws[0]->city."'/>";
	        $uevent .= "</div>";

	        $uevent .= "<div class='l-left'>Continent:</div>";
	        $uevent .= "<div class='l-right'>";
	        $uevent .= "<select name='continent'>";
	        $uevent .= "<option value='Asia'";
		 	if($ws[0]->continent == "Asia")
		 	{
	        $uevent .= "selected ";
	        }
			$uevent .=" >Asia</option>";
	        $uevent .= "<option value='Africa' ";
	        if($ws[0]->continent == "Africa")
	     	{
	        	$uevent .= "selected ";
	        }
	        $uevent .=" >Africa</option>";
	        $uevent .= "<option value='North America'";
	         if($ws[0]->continent == "North America"){
	        	$uevent .= "selected ";
	        }
	        $uevent .=">North America</option>";
	        $uevent .= "<option value='South America'";
	         if($ws[0]->continent == "South America")
	        {
	        	$uevent .= "selected ";
	        }
	        $uevent .=">South America</option>";
	        $uevent .= "<option value='Antarctica' ";
	         if($ws[0]->continent == "Antarctica")
	         {
	        	$uevent .= "selected ";
	        }
	        $uevent .=">Antarctica</option>";
	        $uevent .= "<option value='Europe' ";
	         if($ws[0]->continent == "Europe")
	         {
	       	 $uevent .= "selected ";
	        }
	        $uevent .=">Europe</option>";
	        $uevent .= "<option value='Australia' ";
	     	if($ws[0]->continent == "Australia"){
	        	$uevent .= "selected ";
	        }
	        $uevent .=">Australia</option>";
	        $uevent .= "</select>";
	        $uevent .= "</div>";

	        $uevent .= "<div class='l-left'>Longitude:</div>";
	        $uevent .= "<div class='l-right'>";
	        $uevent .= "<input type='text' name='longitude' value='".$ws[0]->longitude."'/>";
	        $uevent .= "</div>";

			$uevent .= "<div class='l-left'>Latitude:</div>";
	        $uevent .= "<div class='l-right'>";
	        $uevent .= "<input type='text' name='latitude' value='".$ws[0]->latitude."'/>";
	        $uevent .= "</div>";

	        $uevent .= "<div class='l-left'>Contact:</div>";
	        $uevent .= "<div class='l-right'>";
	        $uevent .= "<input type='text' name='ucontact' value='".$ws[0]->contact."' />";
	        $uevent .= "</div>";

	        $uevent .="<input type='hidden' name='update-event' id='update-event' value='event' />";
	        $uevent .="<input type='submit' value='Update-event' />";

			$uevent .="</form>";

			echo "<div id='u-event' style='width:800px;'>".$uevent."</div>";

			if($_POST['update-event'])	
			{
				$uid = $_GET['update-event'];
				$uacharya_id = $_POST['updateacharya'];
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
				$ulongitude = $_POST['longitude'];
				$ulatitude = $_POST['latitude'];
				$u_date = $udatefrom;
				$ordertime = explode(' ', $u_date);
				$udate = $ordertime[0];
				$orderdate = explode('-', $udate);
				$u_year = $orderdate[0];
				$wpdb->update(
							'wp_event',
							array(
								'acharya_id' => $uacharya_id,	// string
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
								'latitude' => $ulatitude,
								'longitude' => $ulongitude,
								'year' => $u_year,
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
									'%s',
							),
							array( '%d' )
						);
			}		

		}//if ($_GET['update-event']) ends	
		//pagination

		$num_event = $wpdb->get_results("SELECT count(*) as total_nr FROM `wp_event`");
		$n_event = $num_event[0]->total_nr;
		$n_x_event = 49;
		$n_event = (($n_event / $n_x_event) < 1 ? 1 : ($n_event / $n_x_event));
		$pevent=0;

		if( isset($_REQUEST['pevent'])) 
		{
			$pevent=$_REQUEST['pevent'];
		}

		function get_page1_scrolling ($n_event,$pevent,$n_event)
		{
			$base_url ='/wp-admin/admin.php?page=event';
			$scroll1 ='';

			if ($n_events > 1)
			{
				if ($pevent >= 1)
				{
					$scroll1 ='<div id="prev_btn" style="float:left;"><a style="padding-right:30px;" href="'.$base_url.'&pevent='.($pevent - 49).'">Previous</a></div>';
				}
				if ($pevent < ($n_events - 1)) {
					$scroll1 .= '<div id="next_btn" style="float:right;margin-right: 21px;"><a style="padding-right:43px;" href="'.$base_url.'&pevent='.($pevent + 49).'">Next</a></div>';
				}

				if (trim($scroll1) != "1")
				{
					return $scroll1;
				}
			}
			return $scroll1;
		}
		$scrolling = get_page1_scrolling($n_event,$pevent,$n_events);
		echo "<div class='l-pagination'>".$scrolling."</div>";
?>

<!-- displaying the form -->
	<div style="display:inline;">
		<div><h3>Event ID</h3>	
			<form name 'eventname' id='eventname' method="post" action="">
				<?php
					global $wpdb;		
					$data =  $wpdb->get_results("SELECT * FROM `wp_ai1ec_events`");
				?>
				<select id="myList" onchange="favb()">
					<?php  
						foreach ($data as $key => $rows)	
						{ 
						
							?>	
						 	<option value= "<?php echo $rows->post_id;?>" id= "<?php echo $rows->post_id;?>"> <?php echo $rows->post_id;?></option>

							<?php 

						} 
					?>
				</select>
				<p>Selected Event Name:<input type="text" id="favorite"></p>
			</form>
		</div>
	</div>
	<div id="message"></div>
<!--  -->

 <?php
	   	$ws_details = "";
		if ($_GET['submitted-search']) 
		{
			$word = $_GET['search'];
			$args = array(
	           			'display_name' => $word,);
	 					$acharya = get_users($args);
						$ws_details = $wpdb->get_results("SELECT * FROM `wp_event_register`");
		}
		else
		{
			$ws_details = $wpdb->get_results("SELECT * FROM `wp_event_register`");
		}
		echo "<table class='loc-table'>";
		echo "<th>id</th>";
		echo "<th>eventid</th>";
		echo "<th>name</th>";
		echo "<th>gender</th>";
		echo "<th>phone</th>";
		echo "<th>email</th>";
        echo "<th>Event_Name</th>";
		foreach ($ws_details as $data)
		{
			$args = array(
							'ID' => $data->acharya_id,
						);
			$blogusers = get_users($args);
			$i++;
			echo "<tr>";
			echo "<td>".$data->id."</td>";
			echo "<td>".$data->eventid."</td>";
			echo "<td>".$data->name."</td>";
			echo "<td>".$data->gender."</td>";
			echo "<td>".$data->phone."</td>";
            echo "<td>".$data->email."</td>";
			echo "<td>".$data->Event_Name."</td>";
			echo "<td><a href='/wp-admin/admin.php?page=event&update-event=".$data->id."'>Edit</a></td>";
			echo "<td><a href='/wp-admin/admin.php?page=event&delete-event=".$data->id."'>Delete</a></td>";
			echo "</tr>";
		}
		echo "</table>";
}	


//CREATING SHORT CODES AND LINKING TO FUNCTIONS

	add_shortcode("add_event", "event_handler");
	add_shortcode("edit_event", "viewevent_handler");

	function event_handler() {
	  //run function that actually does the work of the plugin
	  $addevent_output = display_ccmt_event();
	  //send back text to replace shortcode in post
	  return $addevent_output;
	}

	function viewevent_handler() {
	  //process plugin
	  $viewevent_output = view_event();
	  //send back text to calling function
	  return $viewevent_output;
	}
?>