<?php
	if(!isset($form2)) {  $form2 = ""; }

        $form2 .= "<h3>Add New Center</h3>";
        $form2 .= "<form enctype='multipart/form-data' name='center' id='center' method='post' action=''>";   	

    	if(isset($center) && $center == true) 
        {
    		echo "New Center Added";
    	}

    	$form2 .= "<div class='l-left'>Name:</div>";
    	$form2 .= "<div class='l-right'>";
    	$form2 .= "<input type='text' name='location-name' />";
    	$form2 .= "</div>";

    	$form2 .= "<div class='l-left'>Description:</div>";
    	$form2 .= "<div class='l-right'>";
    	$form2 .= "<textarea name='location-description' rows='10' cols='20'></textarea>";
    	$form2 .= "</div>";

    	$form2 .= "<div class='l-left'>Url:</div>";
    	$form2 .= "<div class='l-right'>";
    	$form2 .= "<input type='text' name='location-url' />";
    	$form2 .= "</div>";

    	$form2 .= "<div class='l-left'>Phone:</div>";
    	$form2 .= "<div class='l-right'>";
    	$form2 .= "<input type='text' name='location-phone' />";
    	$form2 .= "</div>";

    	$form2 .= "<div class='l-left'>Fax:</div>";
    	$form2 .= "<div class='l-right'>";
    	$form2 .= "<input type='text' name='location-fax' />";
    	$form2 .= "</div>";

    	$form2 .= "<div class='l-left'>Email:</div>";
    	$form2 .= "<div class='l-right'>";
    	$form2 .= "<input type='text' name='location-email' />";
    	$form2 .= "</div>";

    	$form2 .= "<div class='l-left'>Acharya:</div>";
    	$form2 .= "<div class='l-right'>";
       
    	$form2 .= "<select name = 'location-acharya'>";
        $form2 .= "<option value=''>Select Acharya Here</option>";

        global $wpdb;
        foreach($wpdb->get_results("SELECT id,profile_id,salutation,last_name FROM `wp_acharya` ORDER BY salutation,last_name ASC") as $key => $row)
        {
           $form2 .= "<option value='" . $row->profile_id ."'>" . $row->profile_id . "::" .$row->salutation." ". $row->last_name ."</option>";
        }
        $form2 .= "</select>";
    	$form2 .= "</div>";

    	$form2 .= "<div class='l-left'>President:</div>";
    	$form2 .= "<div class='l-right'>";
    	$form2 .= "<input type='text' name='location-president' />";
    	$form2 .= "</div>";

    	$form2 .= "<div class='l-left'>Secretary:</div>";
    	$form2 .= "<div class='l-right'>";
    	$form2 .= "<input type='text' name='location-secretary' />";
    	$form2 .= "</div>";

    	$form2 .= "<div class='l-left'>Treasurer:</div>";
    	$form2 .= "<div class='l-right'>";
    	$form2 .= "<input type='text' name='location-treasurer' />";
    	$form2 .= "</div>";

    	$form2 .= "<div class='l-left'>Address 1:</div>";
    	$form2 .= "<div class='l-right'>";
        $form2 .= "<textarea name='location-address1' rows='10' cols='20'></textarea>";
    	$form2 .= "</div>";

        $form2 .= "<div class='l-left'>Address 2:</div>";
        $form2 .= "<div class='l-right'>";
        $form2 .= "<textarea name='location-address2' rows='10' cols='20'></textarea>";
        $form2 .= "</div>";

        $form2 .= "<div class='l-left'>Address 3:</div>";
        $form2 .= "<div class='l-right'>";
        $form2 .= "<textarea name='location-address3' rows='10' cols='20'></textarea>";
        $form2 .= "</div>";

    	$form2 .= "<div class='l-left'>Country:</div>";
    	$form2 .= "<div class='l-right'>";
        $form2 .= "<!-- select onchange='lstate(this.selectedIndex);' id='country11' name='location-country' -->";
        $form2 .= "<select onchange='print_state(\"location-state\",this.selectedIndex);' id='location-country' name='location-country' >";     
                       
        $form2 .= "</select>";
    	$form2 .= "</div>";

    	$form2 .= "<div class='l-left'>State:</div>";
    	$form2 .= "<div class='l-right'>";
        $form2 .= "<!-- select type='text' name='location-state' id='state11' -->";
        $form2 .= "<select type='text' name='location-state' id='location-state'>";
        $form2 .= "</select>";
        $form2 .= "<!-- script language='javascript'>print_country('country11');</script -->";
        $form2 .= "<script language='javascript'>print_country('location-country');</script>";
    	$form2 .= "</div>";

    	$form2 .= "<div class='l-left'>City:</div>";
    	$form2 .= "<div class='l-right'>";
    	$form2 .= "<input type='text' name='location-city' />";
    	$form2 .= "</div>";

    	$form2 .= "<div class='l-left'>Continent:</div>";
    	$form2 .= "<div class='l-right'>";
    	$form2 .= "<select name='location-continent' >";
    	$form2 .= "<option value='Asia'>Asia</option>";
    	$form2 .= "<option value='Africa'>Africa</option>";
    	$form2 .= "<option value='North America'>North America</option>";
    	$form2 .= "<option value='South America'>South America</option>";
    	$form2 .= "<option value='Antarctica'>Antarctica</option>";
    	$form2 .= "<option value='Europe'>Europe</option>";
    	$form2 .= "<option value='Australia'>Australia</option>";
    	$form2 .= "</select>";
    	$form2 .= "</div>";
    	$form2 .= "<div class='l-left'>Trust:</div>";
    	$form2 .= "<div class='l-right'>";
    	$form2 .= "<select name='location-trust' >";
        $form2 .= "<option value='trusts' selected> Select Trusts</option>";
        global $wpdb;
    	foreach($wpdb->get_results("SELECT distinct name FROM `wp_location` where `location_type` like 'trust'") as $key => $row)
        {
            $form2 .= "<option value='" . $row->name ."'>" . $row->name ."</option>";
        }

    	$form2 .= "</select>";
    	$form2 .= "</div>";

    	$form2 .= "<div class='l-left'>Latitude:</div>";
    	$form2 .= "<div class='l-right'>";
    	$form2 .= "<input type='text' name='location-latitude' />";
    	$form2 .= "</div>";

    	$form2 .= "<div class='l-left'>Longitude:</div>";
    	$form2 .= "<div class='l-right'>";
    	$form2 .= "<input type='text' name='location-longitude' />";
    	$form2 .= "</div>";

    	$form2 .= "<div class='l-left'>Contact:</div>";
    	$form2 .= "<div class='l-right'>";
    	$form2 .= "<input type='text' name='location-contact' />";
    	$form2 .= "</div>";

    	$form2 .="<input type='hidden' name='submitted-center' id='submitted-center' value='centre' />";
    	$form2 .="<input type='submit' value='Add Center' name='add-center' />";

        $form2 .= "</form>";

        echo "<div id='l-center'>".$form2."</div>";


?>