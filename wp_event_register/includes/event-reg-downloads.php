<?php
    if(isset($_POST['event-download'])){
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=Event_Register.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo "ID Event_Name First_Name Middle_Name Last_Name Gender Date_of_birth Chinmaya_ID";
        echo "\n";       
        $results = $wpdb->get_results("SELECT * FROM wp_event_register");
        foreach ($results as $value) 
        {
            $id = $value->id;
            $event = str_replace(" ",".",$value->Event_Name);
            $fname = str_replace(" ",".",$value->first_name);
            $mname = str_replace(" ",".",$value->middle_name);
            $lname = str_replace(" ",".",$value->last_name);
            $gender = str_replace(" ",".",$value->gender);
            $dob = $value->date_of_birth;
            $chinid = $value->Chinmaya_id;
            echo $id." ".$event." ".$fname." ".$mname." ".$lname." ".$gender." ".$dob." ".$chinid;
            echo "\n";
        }
        exit();
    }
    if (isset($_POST["from"])) 
    {
        $from = $_POST["from"]; // sender
        $to = $_POST["to"];
        $subject = $_POST["subject"];
        $message = $_POST["message"];
        // message lines should not exceed 70 characters (PHP rule), so wrap it
        $message = wordwrap($message, 70);
        // send mail
        mail($to,$subject,$message,"From: $from\n");
        //echo "Thank you for sending us feedback";
    }

    if(isset($_POST['event-add-download'])) 
    {
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=Event_Register_Address.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo "ID First_Name Middle_Name Last_Name Building Block Landmark Country State City Pin Phone_Resi Mobile Email Passport_No Nationality Issue_Date Expire_Date Visa_Type Visa_No Visa_Issue_Date Visa_Expire_Date";
        echo "\n";
        $results = $wpdb->get_results(
                            "SELECT * FROM wp_event_register 
                            as r,wp_event_reg_address 
                            as a,wp_event_reg_passport as p 
                            WHERE r.address_id = a.address_id 
                            and r.passport_id = p.passport_id
                            ");
        foreach ($results as $value) 
        {
            $id = $value->id;
            $fname = str_replace(" ",".",$value->first_name);
            $mname = str_replace(" ",".",$value->middle_name);
            $lname = str_replace(" ",".",$value->last_name);
            $building = str_replace(" ",".",$value->building);
            $block = str_replace(" ",".",$value->block);
            $landmark = str_replace(" ",".",$value->landmark);
            $country = str_replace(" ",".",$value->country);
            $state = str_replace(" ",".",$value->state);
            $city = str_replace(" ",".",$value->city);
            $pin = $value->postalcode;
            $resi = $value->residenceno;
            $mobile = $value->mobile;
            $email = $value->email;
            $pno = $value->passportno;
            $nation = $value->nationnality;
            $issuedate = $value->issuedate;
            $expiredate = $value->expiredate;
            $visatype = $value->visatype;
            $visano = $value->visano;
            $visaissuedate = $value->visaissuedate;
            $visaexpiredate = $value->visaexpiredate;
            echo $id." ".$fname." ".$mname." ".$lname." ".$building." ".$block." ".$landmark." ".$country." ".$state." ".$city." ".$pin." ".$resi." ".$mobile." ".$email." ".$pno." ".$nation." ".$issuedate." ".$expiredate." ".$visatype." ".$visano." ".$visaissuedate." ".$visaexpiredate;
            echo "\n";
        }
        exit();
    }

    if(isset($_POST['event-acco-download'])) 
    {
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=Event_Register_Accomodation.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo "ID First_Name Middle_Name Last_Name Attached_Bath Common_Bath Common_Dormitoty Individual_Cottage Sponsor";
        echo "\n";
        $results = $wpdb->get_results(
                            "SELECT * FROM wp_event_register 
                             as r, wp_event_reg_accomodation as a 
                             WHERE r.accomodation_id = a.accomodation_id
                            ");
        foreach ($results as $value) {
            $id = $value->id;
            $fname = str_replace(" ",".",$value->first_name);
            $mname = str_replace(" ",".",$value->middle_name);
            $lname = str_replace(" ",".",$value->last_name);
            $attached = $value->multisharing_attachedbath;
            $common = $value->multisharing_commonbath;
            $dormitory = $value->common_dormitory;
            $cottage = $value->individual_cottage;
            $sponsor = str_replace(" ",".",$value->sponsored_details);
            echo $id." ".$fname." ".$mname." ".$lname." ".$attached." ".$common." ".$dormitory." ".$cottage." ".$sponsor;
            echo "\n";
        }
        exit();
    }

    if(isset($_POST['event-arr-download'])) 
    {
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=Event_Register_Arrival.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo "ID First_Name Middle_Name Last_Name Arrival_Date Arrival_Time Mode_of_travel Pickup Pickup_Location";
        echo "\n";
        $results = $wpdb->get_results(
                        "SELECT * FROM wp_event_register 
                         as r, wp_event_reg_arrival as a 
                         WHERE r.arrival_id = a.arrival_id
                        ");
        foreach ($results as $value) 
        {
            $id = $value->id;
            $fname = str_replace(" ",".",$value->first_name);
            $mname = str_replace(" ",".",$value->middle_name);
            $lname = str_replace(" ",".",$value->last_name);
            $arrdate = $value->arrival_date;
            $arrtime = $value->arrival_time;
            $mode = $value->mode_of_arrival;
            $pickup = $value->need_pickup;
            $location = str_replace(" ",".",$value->location_of_pickup);
            echo $id." ".$fname." ".$mname." ".$lname." ".$arrdate." ".$arrtime." ".$mode." ".$pickup." ".$location;
            echo "\n";
        }
        exit();
    }

    if(isset($_POST['event-dep-download'])) 
    {
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=Event_Register_Departure.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo "ID First_Name Middle_Name Last_Name Departure_Date Departure_Time Mode_of_travel Dropoff Dropoff_Location";
        echo "\n";
        $results = $wpdb->get_results(
                        "SELECT * FROM wp_event_register 
                         as r, wp_event_reg_departure as a 
                         WHERE r.departure_id = a.departure_id
                        ");
        foreach ($results as $value) 
        {
            $id = $value->id;
            $fname = str_replace(" ",".",$value->first_name);
            $mname = str_replace(" ",".",$value->middle_name);
            $lname = str_replace(" ",".",$value->last_name);
            $depdate = $value->departure_date;
            $deptime = $value->departure_time;
            $mode = $value->mode_of_departure;
            $dropoff = $value->need_dropoff;
            $location = str_replace(" ",".",$value->location_of_dropoff);
            echo $id." ".$fname." ".$mname." ".$lname." ".$depdate." ".$deptime." ".$mode." ".$dropoff." ".$location;
            echo "\n";
        }
        exit();
    }

    if(isset($_POST['event-vip-download'])) 
    {
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=Event_Register_Vip.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo "ID First_Name Middle_Name Last_Name Hotel Location Room Booking_From Booking_To Arrival_Time Departure_Time";
        echo "\n";
        $results = $wpdb->get_results(
                        "SELECT * FROM wp_event_register 
                         as r, wp_event_reg_vipbooking as a 
                         WHERE r.vipbooking_id = a.vipbooking_id
                        ");
        foreach ($results as $value) 
        {
            $id = $value->id;
            $fname = str_replace(" ",".",$value->first_name);
            $mname = str_replace(" ",".",$value->middle_name);
            $lname = str_replace(" ",".",$value->last_name);
            $hotel_name = str_replace(" ",".",$value->hotel_name);
            $location = str_replace(" ",".",$value->location);
            $types_of_room = str_replace(" ",".",$value->types_of_room);
            $booking_from = $value->ooking_from;
            $booking_to = $value->booking_to;
            $time_of_arrival = $value->time_of_arrival;
            $time_of_departure = $value->time_of_departure;
            $location = str_replace(" ",".",$value->location_of_dropoff);
            echo $id." ".$fname." ".$mname." ".$lname." ".$hotel_name." ".$location." ".$types_of_room." ".$booking_from." ".$booking_to." ".$time_of_arrival." ".$time_of_departure;
            echo "\n";
        }
        exit();
    }

    if(isset($_POST['event-don-download'])) 
    {
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=Event_Register_Donation.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo "ID First_Name Middle_Name Last_Name Option Bank_Name Branch Date Currency Event Breakfast Lunch Dinner Donation_1 Amount_1 Donation_2 Amount_2 Donation_3 Amount_3 Total";
        echo "\n";
        $results = $wpdb->get_results(
                    "SELECT * FROM wp_event_register 
                     as r, wp_event_reg_donation as d, wp_event_reg_donationoption as o 
                     WHERE r.donation_id = d.donation_id 
                     and r.donationoption_id = o.donationoption_id
                    ");
        foreach ($results as $value) 
        {
            $id = $value->id;
            $fname = str_replace(" ",".",$value->first_name);
            $mname = str_replace(" ",".",$value->middle_name);
            $lname = str_replace(" ",".",$value->last_name);
            $option = str_replace(" ",".",$value->option);
            $bank_name = str_replace(" ",".",$value->bank_name);
            $branch = str_replace(" ",".",$value->branch);
            $dated = $value->dated;
            $currency = str_replace(" ",".",$value->currency_for_donation);
            $event = $value->event_donation;
            $breakfast = $value->breakfast_bhiksa;
            $lunch = $value->lunch_bhiksa;
            $dinner = $value->dinner_bhiksa;
            $don1 = $value->donationtype_1;
            $amnt1 = $value->amount_1;
            $don2 = $value->donationtype_2;
            $amnt2 = $value->amount_2;
            $don3 = $value->donationtype_3;
            $amnt3 = $value->amount_3;
            $total = $value->total_amount;
            echo $id." ".$fname." ".$mname." ".$lname." ".$option." ".$bank_name." ".$branch." ".$dated." ".$currency." ".$event." ".$breakfast." ".$lunch." ".$dinner." ".$don1." ".$amnt1." ".$don2." ".$amnt2." ".$don3." ".$amnt3." ".$total;
            echo "\n";
        }
        exit();
    }
?>