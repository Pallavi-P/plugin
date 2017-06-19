<?php
    if  (!isset($form4)) {  $form4 = ""; }
        $form4 .= "<h3>Add New Region</h3>";
        $form4 .= "<form name='region' id='region' method='post' action=''>";
        if(isset($region) && $region == true) 
        {
                echo "New Region Added";
        }

        $form4 .= "<div class='l-left'>Region:</div>";
        $form4 .= "<div class='l-right'>";
        $form4 .= "<input type='text' name='region-name' />";
        $form4 .= "</div>";

        $form4 .="<input type='hidden' name='submitted-region' id='submitted-region' value='region' />";
        $form4 .="<input type='submit' value='Add region' name='add-region' />";
        $form4 .= "</form>";
        echo "<div id='l-region'>".$form4."</div>";

        if  (!isset($form5)) {  $form5 = ""; }
        $form5 .= "<h3>Add New Country-Center</h3>";
        $form5 .= "<form name='country-center' id='country-center' method='post' action=''>";
        if(isset($country_center) && $country_center == true) 
        {
                echo "New Country-Region Added";
        }
        $form5 .= "<div class='l-left'>Country:</div>";
        $form5 .= "<div class='l-right'>";
        $form5 .= "<!-- select onchange='rstate(this.selectedIndex);' id='country3' name='center_country' -->";
        $form5 .= "<select onchange='print_state(\"temple-state\",this.selectedIndex);'  id='center_country' name='center_country' >";
        $form5 .= "</select>";
        $form5 .= "<!-- script language='javascript'>print_country('country3');</script -->";
        $form5 .= "<script language='javascript'>print_country('center_country');</script>";
        $form5 .= "</div>";
        $form5 .= "<div class='l-left'>Expand into :</div>";
        $form5 .= "<div class='l-right'>";
        $form5 .= "State <input type='radio' class='expand-state' name='expand' value='2'> ";
        $form5 .= "City <input type='radio' name='expand' value='1'> ";
        $form5 .= "Center <input type='radio' name='expand' value='0' checked='checked'>";
        $form5 .= "</div>";

        $form5 .="<input type='hidden' name='submitted-country-center' id='submitted-country-center' value='country-center' />";
        $form5 .="<input type='submit' value='Add Country-Cener' name='add-country-center' />";
        $form5 .= "</form>";
        echo "<div id='l-country-region'>".$form5."</div>";


        //displaying form for adding new region and country
        if  (!isset($form6)) {  $form6 = ""; }
        $form6 .= "<h3>Add New Region & Country</h3>";
        $form6 .= "<form name='region_country' id='reg_country' method='post' action=''>";
        if(isset($region_country) && $region_country == true) 
        {
                    echo "New Region-Country Added";
        }   

        $form6 .= "<div class='l-left'>Region:</div>";
        $form6 .= "<div class='l-right'>";
        $form6 .= "<select type='text' name='reg_country' id='reg_country'>";

        global $wpdb;
        foreach($wpdb->get_results("SELECT * FROM `wp_region`") as $key => $row)
        {
        $form6 .= "<option value='" . $row->id ."'>" . $row->region ."</option>";
        }
        $form6 .= "</select>";
        $form6 .= "</div>";
        $form6 .= "<div class='l-left'>Country:</div>";
        $form6 .= "<div class='l-right'>";
        $form6 .= "<select id='country7' name='region_country' >";
        $form6 .= "</select>";
        $form6 .= "<script language='javascript'>print_country('country7');</script>";
        $form6 .= "</div>";
        $form6 .="<input type='hidden' name='submitted-region-country' id='submitted-region-country' value='region-country' />";
        $form6 .="<input type='submit' value='Add Region-Country' name='add-country-center' />";
        $form6 .= "</form>";
        echo "<div id='l-region-country'>".$form6."</div>";

?>