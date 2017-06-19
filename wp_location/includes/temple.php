<?php
	if  (!isset($form3)) {  $form3 = ""; }

        $form3 .= "<h3>Add New Temple</h3>";
        $form3 .= "<form name='temple' id='temple' method='post' action=''>";

        if(isset($temple) && $temple == true) 
        {
                echo "New temple Added";
        }

        $form3 .= "<div class='l-left'>Name:</div>";
        $form3 .= "<div class='l-right'>";
        $form3 .= "<input type='text' name='temple-name' />";
        $form3 .= "</div>";

        $form3 .= "<div class='l-left'>Description:</div>";
        $form3 .= "<div class='l-right'>";
        $form3 .= "<textarea name='temple-description' rows='10' cols='20'></textarea>";
        $form3 .= "</div>";

        $form3 .= "<div class='l-left'>Url:</div>";
        $form3 .= "<div class='l-right'>";
        $form3 .= "<input type='text' name='temple-url' />";
        $form3 .= "</div>";

        $form3 .= "<div class='l-left'>Deity:</div>";
        $form3 .= "<div class='l-right'>";
        $form3 .= "<input type='text' name='temple-deity' />";
        $form3 .= "</div>";

        $form3 .= "<div class='l-left'>Consecrated On:</div>";
        $form3 .= "<div class='l-right'>";
        $form3 .= "<input type='text' name='temple-date' id='datepicker' />";
        $form3 .= "</div>";

        $form3 .= "<div class='l-left'>Address 1:</div>";
        $form3 .= "<div class='l-right'>";
        $form3 .= "<textarea name='temple-address1' rows='10' cols='20'></textarea>";
        $form3 .= "</div>";

        $form3 .= "<div class='l-left'>Address 2:</div>";
        $form3 .= "<div class='l-right'>";
        $form3 .= "<textarea name='temple-address2' rows='10' cols='20'></textarea>";
        $form3 .= "</div>";

        $form3 .= "<div class='l-left'>Zip :</div>";
        $form3 .= "<div class='l-right'>";
        $form3 .= "<textarea name='temple-address3' rows='10' cols='20'></textarea>";
        $form3 .= "</div>";

        $form3 .= "<div class='l-left'>Country:</div>";
        $form3 .= "<div class='l-right'>";
        $form3 .= "<!-- select onchange='tstate(this.selectedIndex);' id='country2' name='temple-country' -->";
        $form3 .= "<select onchange='print_state(\"temple-state\",this.selectedIndex);' id='temple-country' name='temple-country'>";
        $form3 .= "</select>";
        $form3 .= "</div>";

        $form3 .= "<div class='l-left'>State:</div>";
        $form3 .= "<div class='l-right'>";
        $form3 .= "<!-- select name='temple-state' id='state2'-->";
        $form3 .= "<select name='temple-state' id='temple-state'>";
        $form3 .= "</select>";
        $form3 .= "<!-- script language='javascript'>print_country('country2');</script -->";
        $form3 .= "<script language='javascript'>print_country('temple-country');</script>";
        $form3 .= "</div>";

        $form3 .= "<div class='l-left'>City:</div>";
        $form3 .= "<div class='l-right'>";
        $form3 .= "<input type='text' name='temple-city' />";
        $form3 .= "</div>";

        $form3 .= "<div class='l-left'>Continent:</div>";
        $form3 .= "<div class='l-right'>";
        $form3 .= "<select name='temple-continent' >";
        $form3 .= "<option value='Asia'>Asia</option>";
        $form3 .= "<option value='Africa'>Africa</option>";
        $form3 .= "<option value='North America'>North America</option>";
        $form3 .= "<option value='South America'>South America</option>";
        $form3 .= "<option value='Antarctica'>Antarctica</option>";
        $form3 .= "<option value='Europe'>Europe</option>";
        $form3 .= "<option value='Australia'>Australia</option>";
        $form3 .= "</select>";
        $form3 .= "</div>";

        $form3 .= "<div class='l-left'>Latitude:</div>";
        $form3 .= "<div class='l-right'>";
        $form3 .= "<input type='text' name='temple-latitude' />";
        $form3 .= "</div>";
        $form3 .= "<div class='l-left'>Longitude:</div>";
        $form3 .= "<div class='l-right'>";
        $form3 .= "<input type='text' name='temple-longitude' />";
        $form3 .= "</div>";

        $form3 .="<input type='hidden' name='submitted-temple' id='submitted-temple' value='temple' />";
        $form3 .="<input type='submit' value='Add temple' name='add-temple' />";
        $form3 .= "</form>";
        echo "<div id='l-temple'>".$form3."</div>";
?>