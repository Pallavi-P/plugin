<?php
/*
* Plugin Name: CCMT Event Registration
* Plugin URI: http://google.co.in
* Description: Plugin for downloading events registration information sent on Events Page on front end.
* Version: 1.0
* Author: Girish Vas 
* Author URI:
*/

    add_action( 'admin_enqueue_scripts', 'add_event_reg_scripts' );


if (!defined('WP_LIBRARY_URL')):
    define( 'WP_LIBRARY_URL', content_url().'/'.'gcmw-library'.'/');
endif;

//echo WP_LIBRARY_URL;
function add_event_reg_scripts()
{
   
    if(!wp_script_is('datepicker-plugin-jquery')):
        wp_enqueue_script( 'datepicker-plugin-jquery', WP_LIBRARY_URL.'datepicker/jquery-1.9.1.min.js',array(),NULL,true);
    endif;
    /*if(!wp_script_is('datepicker-plugin-jquery-ui')):   
        wp_enqueue_script( 'datepicker-jquery-ui',WP_LIBRARY_URL.'datepicker/jquery-ui.js',array(),NULL,true); 
    endif;
    if(!wp_script_is('datepicker-datetimepicker-js')):
        wp_enqueue_script( 'datepicker-datetimepicker-js', WP_LIBRARY_URL.'datepicker/DateTimePicker.js',array('datepicker-plugin-jquery'.'datepicker-plugin-jquery-ui'),NULL,true);
    endif;
    
    if(!wp_script_is('countries-countries-js')):    
        wp_enqueue_script( 'countries-countries-js', WP_LIBRARY_URL.'country/countries.js', array(),NULL,true);
    endif;
    
    if(!wp_script_is('datepicker-wp_plugins_common_events-js')):
        wp_enqueue_script( 'datepicker-wp_plugins_common_events-js', WP_LIBRARY_URL.'wp_plugins_common_events.js',array(),NULL,true);
    endif;
    
    if(!wp_style_is('datepicker-datepicker-css')):
        wp_enqueue_style('datepicker-datepicker-css', WP_LIBRARY_URL.'datepicker/jquery-ui.css');
    endif;*/
  
    wp_enqueue_style('event_register_admin-css', plugins_url('event_register_admin.css',__FILE__));   

    wp_enqueue_script('jquery-2-2-4','http://code.jquery.com/jquery-2.2.4.min.js',array(),NULL, true);
    wp_enqueue_script('wp_event_register-js', plugins_url('wp_event_register.js', __FILE__),array('jquery-2-2-4'),NULL,true);
    if(!wp_style_is('cust-plugin-admin-css')):
        wp_enqueue_style('cust-plugin-admin-css', WP_LIBRARY_URL.'cust_plugin_admin.css');
    endif;
    
}

    /*
     $con = mysqli_connect("localhost",DB_USER,DB_PASSWORD,DB_NAME);
    if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    else
        {
          ?><!--script>alert('connection successful');</script --><?
        }
    */

 
    global $wpdb;
    require_once('includes/event-reg-downloads.php'); 


    add_action('admin_menu', 'eventreg_admin_menu');
    function eventreg_admin_css() 
    {
            wp_enqueue_style( 'prefix-style', plugins_url('location_admin.css', __FILE__) );
    }

    function eventreg_admin_menu() 
    {
        add_menu_page ('CCMT','CCMT Event Reg','administrator','ccmt-eventreg','display_ccmt_eventreg','dashicons-clipboard' );
        add_submenu_page('ccmt-eventreg','Event Registration','Event Registration','acharya','eventreg','view_eventreg');
        add_submenu_page('ccmt-eventreg','Event Reg Addr','Event Reg Add','manage_options','eventregadd','view_eventregadd');
        add_submenu_page('ccmt-eventreg','Event Reg Acco','Event Reg Acco','manage_options','eventregacco','view_eventregacco');
        add_submenu_page('ccmt-eventreg','Event Reg Arrival','Event Reg Arrival','manage_options','eventregarr','view_eventregarr');
        add_submenu_page('ccmt-eventreg','Event Reg Dep','Event Reg Dep','manage_options','eventregdep','view_eventregdep');
        add_submenu_page('ccmt-eventreg','Event Reg Vip','Event Reg Vip','manage_options','eventregvip','view_eventregvip');
        add_submenu_page('ccmt-eventreg','Event Reg Donation','Event Reg Donation','manage_options','eventregdon','view_eventregdon');

    }

    
    function display_ccmt_eventreg() 
    {
        ?>
            <h2> Download various details for registrations recieved on Events Page </h2>
            <h3> Click on the links in the side bar under CCMT EVENT REG Menu </h3>
        <?php
    }

    function view_eventreg() 
    {
        //Event Registration details
            global $wpdb;        
            echo "<form action='.' method='post'>";
                echo "<input class='itin' name='event-download' type='submit' value='Download Event Register' style='background-color:white;border:none;color:#000;font-size:15px;cursor:pointer;'>";
            echo "</form>";
            echo "<h2>Event Register Form</h2>";
                //$result = mysqli_query($con,"SELECT * FROM `wp_event_register`");
            $wpdb->flush();
            $resultreg = $wpdb->get_results("SELECT * FROM `wp_event_register`");            
            echo "<div class='loc-table-div'>";
            echo "<table class='loc-table'>";
                echo "<th>ID</th>";
                echo "<th>Event Name</th>";
                echo "<th>First Name</th>";
                echo "<th>Middle Name</th>";
                echo "<th>Last Name</th>";
                echo "<th>Gender</th>";
                echo "<th>Date of Birth</th>";
                echo "<th>Chinmaya ID</th>";
                 //while($row = mysqli_fetch_array($result))
                //while($row = $resultreg)
                foreach($resultreg as $row)
                {
                    // $eid = $row['id;
                    // $eevent = $row['Event_Name'];
                    // $efname = $row['first_name'];
                    // $emname = $row['middle_name'];
                    // $elname = $row['last_name'];
                    // $egender = $row['gender'];
                    // $edob = $row['date_of_birth'];
                    // $echinid = $row['Chinmaya_id'];
                    $eid = $row->id;
                    $eevent = $row->Event_Name;
                    $efname = $row->first_name;
                    $emname = $row->middle_name;
                    $elname = $row->last_name;
                    $egender = $row->gender;
                    $edob = $row->date_of_birth;
                    $echinid = $row->Chinmaya_id;
                    echo "<tr>";
                    echo "<td>" . $eid. "</td>";
                    echo "<td>" . $eevent. "</td>";
                    echo "<td>" . $efname. "</td>";
                    echo "<td>" . $emname. "</td>";
                    echo "<td>" . $elname. "</td>";
                    echo "<td>" . $egender. "</td>";
                    echo "<td>" . $edob. "</td>";
                    echo "<td>" . $echinid. "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            echo "</div>";       
    }//function view event reg ends

    function view_eventregadd() 
    {
        global $wpdb;
            //reg_load_css();
            echo "<form action='.' method='post'>";
            echo "<input class='itin' name='event-add-download' type='submit' value='Download Event Register Address' style='background-color:white;border:none;color:#000;font-size:15px;cursor:pointer;'>";
            echo "</form>";
            echo "<h2>Event Register Address Form</h2>";
            //$result = mysqli_query($con,"SELECT * FROM wp_event_register as r, wp_event_reg_address as a, wp_event_reg_passport as p WHERE r.address_id = a.address_id and r.passport_id = p.passport_id");
            $wpdb->flush();
            $result = $wpdb->get_results(
                            "SELECT * FROM 
                            wp_event_register as r, wp_event_reg_address as a, wp_event_reg_passport 
                            as p 
                            WHERE r.address_id = a.address_id 
                            and r.passport_id = p.passport_id
                            ");
            echo "<div class='loc-table-div'>";
            echo "<table class='loc-table'>";
            echo "<th>ID</th>";
            echo "<th>First Name</th>";
            echo "<th>Middle Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Building</th>";
            echo "<th>Block</th>";
            echo "<th>Landmark</th>";
            echo "<th>Country</th>";
            echo "<th>State</th>";
            echo "<th>City</th>";
            echo "<th>Pin Code</th>";
            echo "<th>Phone Resi</th>";
            echo "<th>Mobile</th>";
            echo "<th>Email</th>";
            echo "<th>Passport No</th>";
            echo "<th>Nationality</th>";
            echo "<th>Issue Date</th>";
            echo "<th>Expire Date</th>";
            echo "<th>Visa Type</th>";
            echo "<th>Visa No</th>";
            echo "<th>Visa issue date</th>";
            echo "<th>Visa expire date</th>";
            // while($row = mysqli_fetch_array($result))
            //while($row =$result)
            foreach($result as $row)
            {              

                $eid = $row->id;
                $efname = $row->first_name;
                $emname = $row->middle_name;
                $elname = $row->last_name;
                $building = $row->building;
                $block = $row->block;
                $landmark = $row->landmark;
                $ecountry = $row->country;
                $estate = $row->state;
                $ecity = $row->city;
                $epin = $row->postalcode;
                $eresi = $row->residenceno;
                $emobile = $row->mobile;
                $eemail = $row->email;
                $epassno = $row->passportno ;
                $enation = $row->nationnality;
                $eidate = $row->issuedate;
                $eedate = $row->expiredate;
                $evisa = $row->visatype;
                $evisano = $row->visano;
                $evisaissue = $row->visaissuedate;
                $evisaexpir = $row->visaexpiredate;
                echo "<tr id='$eid'>";
                echo "<td>" . $eid. "</td>";
                echo "<td>" . $efname. "</td>";
                echo "<td>" . $emname. "</td>";
                echo "<td>" . $elname. "</td>";
                echo "<td>" . $building. "</td>";
                echo "<td>" . $block. "</td>";
                echo "<td>" . $landmark. "</td>";
                echo "<td>" . $ecountry. "</td>";
                echo "<td>" . $estate. "</td>";
                echo "<td>" . $ecity. "</td>";
                echo "<td>" . $epin. "</td>";
                echo "<td>" . $eresi. "</td>";
                echo "<td>" . $emobile. "</td>";
                echo "<td>" . $eemail. "</td>";
                echo "<td>" . $epassno. "</td>";
                echo "<td>" . $enation. "</td>";
                echo "<td>" . $eidate. "</td>";
                echo "<td>" . $eedate. "</td>";
                echo "<td>" . $evisa. "</td>";
                echo "<td>" . $evisano. "</td>";
                echo "<td>" . $evisaissue. "</td>";
                echo "<td>" . $evisaexpir. "</td>";
    			echo "<td><button type='button' name='reply-$eid' id='$eid' class='reply'>Reply</button></td>";
                echo "<td>";
                  ?>
                  <!-- OUR content_box  DIV-->          
                  <div class='plugin_box plugin_box-$eid'> 
                        <h1 style='font-weight:bold;text-align:center;font-size:30px;'></h1>
                        <a class='pluginBoxClose'>Close</a>"
                        <div class='projectcontent'>;
                            <div class='select-style'>
                                <form method='post' action='.'>
                                    From: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='from'><br/>
                                    To: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' value='$eemail' name='to' readonly><br/>
                                    Subject:&nbsp;&nbsp;<input type='text' name='subject' value='test' readonly><br/>
                                    <p><span style='vertical-align:top;'>Message:</span><textarea rows='5' cols='30' name='message' ></textarea></p>
                                    <div style='width:520px;margin-left:200px;'>
                                        <input type='submit' name='submit' value='Send'>
                                    </div>
                               </form>
                           </div>
                    </div>
                </div>
                <!-- content_box -->
                <?php
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>"; 
            //reg_load_js();       
    }//function view event reg add ends

    function view_eventregacco() 
    {
        global $wpdb;        
            echo "<form action='.' method='post'>";
            echo "<input class='itin' name='event-acco-download' type='submit' value='Download Event Accomodation' style='background-color:white;border:none;color:#000;font-size:15px;cursor:pointer;'>";
            echo "</form>";
            echo "<h2>Event Register Accomodation Form</h2>";
            $wpdb->flush();
            $result = $wpdb->get_results(
                "SELECT * FROM wp_event_register 
                as r, wp_event_reg_accomodation as a 
                WHERE r.accomodation_id = a.accomodation_id
                ");
            echo "<div class='loc-table-div'>";
            echo "<table class='loc-table'>";
                echo "<th>ID</th>";
                echo "<th>First Name</th>";
                echo "<th>Middle Name</th>";
                echo "<th>Last Name</th>";
                echo "<th>Attached Bath</th>";
                echo "<th>Common Bath</th>";
                echo "<th>Common Dormitory</th>";
                echo "<th>Individual Cottage</th>";
                echo "<th>Sponsor Details</th>";
                // while($row = mysqli_fetch_array($result))
                //while($row = $result)
                foreach($result as $row)
                {
                    $eid = $row->id;
                    $efname = $row->first_name;
                    $emname = $row->middle_name;
                    $elname = $row->last_name;
                    $attached = $row->multisharing_attachedbath;
                    $common = $row->multisharing_commonbath;
                    $dormitory = $row->common_dormitory;
                    $cottage = $row->individual_cottage;
                    $sponsor = $row->sponsored_details;
                    echo "<tr>";
                    echo "<td>" . $eid. "</td>";
                    echo "<td>" . $efname. "</td>";
                    echo "<td>" . $emname. "</td>";
                    echo "<td>" . $elname. "</td>";
                    echo "<td>" . $attached. "</td>";
                    echo "<td>" . $common. "</td>";
                    echo "<td>" . $dormitory. "</td>";
                    echo "<td>" . $cottage. "</td>";
                    echo "<td>" . $sponsor. "</td>";
                    echo "</tr>";
                    }   
            echo "</table>";
            echo "</div>";        
    }

    function view_eventregarr() 
    {
        global $wpdb;        
            echo "<form action='.' method='post'>";
            echo "<input class='itin' name='event-arr-download' type='submit' value='Download Event Arrival' style='background-color:white;border:none;color:#000;font-size:15px;cursor:pointer;'>";
            echo "</form>";
            echo "<h2>Event Register Arrival Form</h2>";
            $wpdb->flush();
            $result = $wpdb->get_results(
                    "SELECT * FROM wp_event_register 
                    as r, wp_event_reg_arrival as a 
                    WHERE r.arrival_id = a.arrival_id
                    ");
            echo "<div class='loc-table-div'>";
            echo "<table class='loc-table'>";
            echo "<th>ID</th>";
                echo "<th>First Name</th>";
                echo "<th>Middle Name</th>";
                echo "<th>Last Name</th>";
                echo "<th>Arrival Date</th>";
                echo "<th>Arrival time</th>";
                echo "<th>Mode of Arrival</th>";
                echo "<th>Pickup</th>";
                echo "<th>Pickup Location</th>";
                // while($row = mysqli_fetch_array($result))
                //while($row = $result)
                foreach($result as $row)
                {
                    $eid = $row->id;
                    $efname = $row->first_name;
                    $emname = $row->middle_name;
                    $elname = $row->last_name;
                    $arrdate = $row->arrival_date;
                    $arrtime = $row->arrival_time;
                    $modarr = $row->mode_of_arrival;
                    $pickup = $row->need_pickup;
                    $pickuploc = $row->location_of_pickup;
                    echo "<tr>";
                    echo "<td>" . $eid. "</td>";
                    echo "<td>" . $efname. "</td>";
                    echo "<td>" . $emname. "</td>";
                    echo "<td>" . $elname. "</td>";
                    echo "<td>" . $arrdate. "</td>";
                    echo "<td>" . $arrtime. "</td>";
                    echo "<td>" . $modarr. "</td>";
                    echo "<td>" . $pickup. "</td>";
                    echo "<td>" . $pickuploc. "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            echo "</div>";
    }
    function view_eventregdep() 
    {
        global $wpdb;
       
            echo "<form action='.' method='post'>";
            echo "<input class='itin' name='event-dep-download' type='submit' value='Download Event Departure' style='background-color:white;border:none;color:#000;font-size:15px;cursor:pointer;'>";
            echo "</form>";
            echo "<h2>Event Register Departure Form</h2>";
            $wpdb->flush();
            $result = $wpdb->get_results(
                    "SELECT * FROM wp_event_register 
                    as r, wp_event_reg_departure as d
                    WHERE r.departure_id = d.departure_id
                    ");
            echo "<div class='loc-table-div'>";
                echo "<table class='loc-table'>";
                    echo "<th>ID</th>";
                    echo "<th>First Name</th>";
                    echo "<th>Middle Name</th>";
                    echo "<th>Last Name</th>";
                    echo "<th>Departure Date</th>";
                    echo "<th>Departure time</th>";
                    echo "<th>Mode of Departure</th>";
                    echo "<th>Dropoff</th>";
                    echo "<th>Dropoff Location</th>";
                    //while($row = $result)
                    foreach($result as $row)
                    {
                        $eid = $row->id;
                        $efname = $row->first_name;
                        $emname = $row->middle_name;
                        $elname = $row->last_name;
                        $depdate = $row->departure_date;
                        $deptime = $row->departure_time;
                        $moddep = $row->mode_of_departure;
                        $dropoff = $row->need_dropoff;
                        $dropoffloc = $row->location_of_dropoff;
                        echo "<tr>";
                        echo "<td>" . $eid. "</td>";
                        echo "<td>" . $efname. "</td>";
                        echo "<td>" . $emname. "</td>";
                        echo "<td>" . $elname. "</td>";
                        echo "<td>" . $depdate. "</td>";
                        echo "<td>" . $deptime. "</td>";
                        echo "<td>" . $moddep. "</td>";
                        echo "<td>" . $dropoff. "</td>";
                        echo "<td>" . $dropoffloc. "</td>";
                        echo "</tr>";
                    }
                echo "</table>";
            echo "</div>";
        
    }//function view event regdep ends

    function view_eventregvip() 
    {
        global $wpdb;        
            echo "<form action='.' method='post'>";
            echo "<input class='itin' name='event-vip-download' type='submit' value='Download Event Vip Register' style='background-color:white;border:none;color:#000;font-size:15px;cursor:pointer;'>";
            echo "</form>";
            echo "<h2>Event Register Vip Form</h2>";
            $wpdb->flush();
            $result =$wpdb->get_results(
                    "SELECT * FROM wp_event_register 
                     as r, wp_event_reg_vipbooking as v 
                     WHERE r.vipbooking_id = v.vipbooking_id
                    ");
            // $result = mysqli_query($con,"SELECT * FROM wp_event_register as r, wp_event_reg_vipbooking as v WHERE r.vipbooking_id = v.vipbooking_id");
            echo "<div class='loc-table-div'>";
                echo "<table class='loc-table'>";
                    echo "<th>ID</th>";
                    echo "<th>First Name</th>";
                    echo "<th>Middle Name</th>";
                    echo "<th>Last Name</th>";
                    echo "<th>Hotel Name</th>";
                    echo "<th>Location</th>";
                    echo "<th>Room type</th>";
                    echo "<th>Booking from</th>";
                    echo "<td>Booking to</th>";
                    echo "<th>Arrival Time</th>";
                    echo "<th>Departure Time</th>";
                    // while($row = mysqli_fetch_array($result))
                    //while($row = $result)
                    foreach($result as $row)
                    {
                        $eid = $row->id;
                        $efname = $row->first_name;
                        $emname = $row->middle_name;
                        $elname = $row->last_name;
                        $hotel = $row->hotel_name;
                        $location = $row->location;
                        $room = $row->types_of_room;
                        $bfrom = $row->booking_from;
                        $bto = $row->booking_to;
                        $arrtime = $row->time_of_arrival;
                        $deptime = $row->time_of_departure;
                        echo "<tr>";
                            echo "<td>" . $eid. "</td>";
                            echo "<td>" . $efname. "</td>";
                            echo "<td>" . $emname. "</td>";
                            echo "<td>" . $elname. "</td>";
                            echo "<td>" . $hotel. "</td>";
                            echo "<td>" . $location. "</td>";
                            echo "<td>" . $room. "</td>";
                            echo "<td>" . $bfrom. "</td>";
                            echo "<td>" . $bto. "</td>";
                            echo "<td>" . $arrtime. "</td>";
                            echo "<td>" . $deptime. "</td>";
                        echo "</tr>";
                    }
                echo "</table>";
            echo "</div>";      
    }// function view event regvip ends

    function view_eventregdon() 
    {
        global $wpdb;        
        echo "<form action='.' method='post'>";
        echo "<input class='itin' name='event-don-download' type='submit' value='Download Event Donation Register' style='background-color:white;border:none;color:#000;font-size:15px;cursor:pointer;'>";
        echo "</form>";
        echo "<h2>Event Register Donation Form</h2>";
        $wpdb->flush();
        $result = $wpdb->get_results(
                "SELECT * FROM wp_event_register 
                 as r, wp_event_reg_donation as d, wp_event_reg_donationoption as o 
                 WHERE r.donation_id = d.donation_id 
                 and r.donationoption_id = o.donationoption_id
                ");
        // $result = mysqli_query($con,"SELECT * FROM wp_event_register as r, wp_event_reg_donation as d, wp_event_reg_donationoption as o WHERE r.donation_id = d.donation_id and r.donationoption_id = o.donationoption_id");
        echo "<div class='loc-table-div'>";
            echo "<table class='loc-table'>";
                echo "<th>ID</th>";
                echo "<th>First Name</th>";
                echo "<th>Middle Name</th>";
                echo "<th>Last Name</th>";
                echo "<th>Option</th>";
                echo "<th>Bank Name</th>";
                echo "<th>Branch</th>";
                echo "<th>Date</th>";
                echo "<th>Currency</th>";
                echo "<th>Event</th>";
                echo "<th>Breakfast</th>";
                echo "<th>Lunch</th>";
                echo "<th>Dinner</th>";
                echo "<th>Donation 1</th>";
                echo "<th>Amount 1</th>";
                echo "<th>Donation 2</th>";
                echo "<th>Amount 2</th>";
                echo "<th>Donation 3</th>";
                echo "<th>Amount 3</th>";
                echo "<th>Total</th>";
                // while($row = mysqli_fetch_array($result))
                //while($row = $result)
                foreach($result as $row)          
                {
                    $eid = $row->id;
                    $efname = $row->first_name;
                    $emname = $row->middle_name;
                    $elname = $row->last_name;
                    $option = $row->option;
                    $bname = $row->bank_name;
                    $branch = $row->branch;
                    $date = $row->dated;
                    $currency = $row->currency_for_donation;
                    $event = $row->event_donation;
                    $breakfast = $row->breakfast_bhiksa;
                    $lunch = $row->lunch_bhiksa;
                    $dinner = $row->dinner_bhiksa;
                    $donation1 = $row->donationtype_1;
                    $amount1 = $row->amount_1;
                    $donation2 = $row->donationtype_2;
                    $amount2 = $row->amount_2;
                    $donation3 = $row->donationtype_3;
                    $amount3 = $row->amount_3;
                    $total = $row->total_amount;
                    echo "<tr>";
                    echo "<td>" . $eid. "</td>";
                    echo "<td>" . $efname. "</td>";
                    echo "<td>" . $emname. "</td>";
                    echo "<td>" . $elname. "</td>";
                    echo "<td>" . $option. "</td>";
                    echo "<td>" . $bname. "</td>";
                    echo "<td>" . $branch. "</td>";
                    echo "<td>" . $date. "</td>";
                    echo "<td>" . $currency. "</td>";
                    echo "<td>" . $event. "</td>";
                    echo "<td>" . $breakfast. "</td>";
                    echo "<td>" . $lunch. "</td>";
                    echo "<td>" . $dinner. "</td>";
                    echo "<td>" . $donation1. "</td>";
                    echo "<td>" . $amount1. "</td>";
                    echo "<td>" . $donation2. "</td>";
                    echo "<td>" . $amount2. "</td>";
                    echo "<td>" . $donation3. "</td>";
                    echo "<td>" . $amount3. "</td>";
                    echo "<td>" . $total. "</td>";
                    echo "</tr>";
                }
            echo "</table>";
        echo "</div>"; 
    } 


    function reg_load_js(){

     echo"   
        <script>

            jQuery(document).ready(function(){ 

                jQuery('#wpbody-content').css({ 
                    // this is just for style       
                    'overflow': 'visible!important' 
                });
                var status = '';        
                jQuery('input.reply').click( function() {

                        status = jQuery(this).attr('id');
                        loadPluginBox();

                });
                jQuery('input.pluginBoxClose').click( function() {           
                        unloadPluginBox();
                });

                function unloadPluginBox() {    
                    // TO Unload the Popupbox
                        jQuery('.plugin_box').fadeOut('slow');
                        jQuery('#container').css({ // this is just for style       
                            'opacity': '1'
                    });
                }    
                function loadPluginBox() {    
                    // To Load the Popupbox
                        jQuery('.plugin_box-'+status).fadeIn('slow');
                        jQuery('#container').css({ // this is just for style
                            'opacity': '0.3' 
                        });        
                }        
            });
        </script>"; 
    }
    ?>
      
    
    
        
        

