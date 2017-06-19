<?php

        $form1 .= "<h3>Add New Ashram</h3>";
        $form1 .= "<form name='ashram' id='ashram' method='post' action=''>";

        if(isset($ashram) && $ashram == true) 
        {
            echo "New Ashram Added";
        }
        $form1 .= "<div class='l-left'>Name:</div>";
        $form1 .= "<div class='l-right'>";
        $form1 .= "<input type='text' name='ashram-name' />";
        $form1 .= "</div>";

        $form1 .= "<div class='l-left'>Description:</div>";
        $form1 .= "<div class='l-right'>";
        $form1 .= "<textarea name='ashram-description' rows='10' cols='20'></textarea>";
        $form1 .= "</div>";

        $form1 .= "<div class='l-left'>Url:</div>";
        $form1 .= "<div class='l-right'>";
        $form1 .= "<input type='text' name='ashram-url' />";
        $form1 .= "</div>";

        $form1 .= "<div class='l-left'>Phone:</div>";
        $form1 .= "<div class='l-right'>";
        $form1 .= "<input type='text' name='ashram-phone' />";
        $form1 .= "</div>";

        $form1 .= "<div class='l-left'>Fax:</div>";
        $form1 .= "<div class='l-right'>";
        $form1 .= "<input type='text' name='ashram-fax' />";
        $form1 .= "</div>";

        $form1 .= "<div class='l-left'>Email:</div>";
        $form1 .= "<div class='l-right'>";
        $form1 .= "<input type='text' name='ashram-email' />";
        $form1 .= "</div>";

        $form1 .= "<div class='l-left'>Acharya:</div>";
        $form1 .= "<div class='l-right'>";
        
        $form1 .= "<select name = 'ashram-acharya'>";
        $form1 .= "<option value=''>Select Acharya Here</option>";

        global $wpdb;
        foreach($wpdb->get_results("SELECT id,profile_id,salutation,last_name FROM `wp_acharya` ORDER BY salutation,last_name ASC") as $key => $row)
        {
           $form1 .= "<option value='" . $row->profile_id ."'>" . $row->profile_id . "::" .$row->salutation." ". $row->last_name ."</option>";
        }
        $form1 .= "</select>";
        $form1 .= "</div>";

        $form1 .= "<div class='l-left'>President:</div>";
        $form1 .= "<div class='l-right'>";
        $form1 .= "<input type='text' name='ashram-president' />";
        $form1 .= "</div>";

        $form1 .= "<div class='l-left'>Secretary:</div>";
        $form1 .= "<div class='l-right'>";
        $form1 .= "<input type='text' name='ashram-secretary' />";
        $form1 .= "</div>";

        $form1 .= "<div class='l-left'>Treasurer:</div>";
        $form1 .= "<div class='l-right'>";
        $form1 .= "<input type='text' name='ashram-treasurer' />";
        $form1 .= "</div>";

        $form1 .= "<div class='l-left'>Address 1:</div>";
        $form1 .= "<div class='l-right'>";
        $form1 .= "<textarea name='ashram-address1' rows='10' cols='20'></textarea>";
        $form1 .= "</div>";

        $form1 .= "<div class='l-left'>Country:</div>";
        $form1 .= "<div class='l-right'>";
        $form1 .= "<!--select onchange='astate(this.selectedIndex);' id='country1' name='ashram-country' -->";
        $form1 .= "<select onchange='print_state(\"ashram-state\",this.selectedIndex);' id='ashram-country' name='ashram-country' >";
        $form1 .= "</select>";
        $form1 .= "</div>";

        $form1 .= "<div class='l-left'>State:</div>";
        $form1 .= "<div class='l-right'>";// ashram-country
        $form1 .= "<!-- select type='text' name='ashram-state' id='state1' -->";
        $form1 .= "<select type='text' name='ashram-state' id='ashram-state'>";
        $form1 .= "</select>";
        $form1 .= "<!-- script language='javascript'>print_country('country1');</script -->";
        $form1 .= "<script language='javascript'>print_country('ashram-country');</script>";
        $form1 .= "</div>";

        $form1 .= "<div class='l-left'>City:</div>";
        $form1 .= "<div class='l-right'>";
        $form1 .= "<input type='text' name='ashram-city' />";
        $form1 .= "</div>";

        $form1 .= "<div class='l-left'>Zip:</div>";
        $form1 .= "<div class='l-right'>";
        $form1 .= "<input type='text' name='ashram-zip' />";
        $form1 .= "</div>";

        $form1 .= "<div class='l-left'>Continent:</div>";
        $form1 .= "<div class='l-right'>";
        $form1 .= "<select name='location-continent' >";
        $form1 .= "<option value='Asia'>Asia</option>";
        $form1 .= "<option value='Africa'>Africa</option>";
        $form1 .= "<option value='North America'>North America</option>";
        $form1 .= "<option value='South America'>South America</option>";
        $form1 .= "<option value='Antarctica'>Antarctica</option>";
        $form1 .= "<option value='Europe'>Europe</option>";
        $form1 .= "<option value='Australia'>Australia</option>";
        $form1 .= "</select>";
        $form1 .= "</div>";
        $form1 .= "<div class='l-left'>Trust:</div>";
        $form1 .= "<div class='l-right'>";
        $form1 .= "<select name='location-trust' >";
        $form1 .= "<option value='trusts' selected> Select Trusts</option>";
        global $wpdb;
        foreach($wpdb->get_results("SELECT distinct name FROM `wp_location` where `location_type` like 'trust'") as $key => $row)
        {
            $form1 .= "<option value='" . $row->name ."'>" . $row->name ."</option>";
        }

        $form1 .= "</select>";
        $form1 .= "</div>";

        $form1 .= "<div class='l-left'>Latitude:</div>";
        $form1 .= "<div class='l-right'>";
        $form1 .= "<input type='text' name='ashram-latitude' />";
        $form1 .= "</div>";

        $form1 .= "<div class='l-left'>Longitude:</div>";
        $form1 .= "<div class='l-right'>";
        $form1 .= "<input type='text' name='ashram-longitude' />";
        $form1 .= "</div>";

        $form1 .= "<div class='l-left'>Contact:</div>";
        $form1 .= "<div class='l-right'>";
        $form1 .= "<input type='text' name='ashram-contact' />";
        $form1 .= "</div>";

        $form1 .="<input type='hidden' name='submitted-ashram' id='submitted-ashram' value='ashram' />";
        $form1 .="<input type='submit' value='Add ashram' name='add-ashram' />";

        $form1 .= "</form>";
        echo "<div id='l-ashram'>".$form1."</div>";  

?>