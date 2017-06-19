<?php
		$form8 .= "<h3>Add New Trust</h3>";
        $form8 .= "<form name='trust' id='trust' method='post' action=''>";

        if(isset($trust) && $trust == true) 
        {
                echo "New Trust Added";
        }

        $form8 .= "<div class='l-left'>Name:</div>";
        $form8 .= "<div class='l-right'>";
        $form8 .= "<input type='text' name='trust-name' />";
        $form8 .= "</div><br/>";

        $form8 .= "<div class='l-left'>Email:</div>";
        $form8 .= "<div class='l-right'>";
        $form8 .= "<input type='text' name='trust-email' />";
        $form8 .= "</div><br/>";

        $form8 .= "<div class='l-left'>Phone:</div>";
        $form8 .= "<div class='l-right'>";
        $form8 .= "<input type='text' name='trust-phone' />";
        $form8 .= "</div><br/>";

        $form8 .= "<div class='l-left'>Fax:</div>";
        $form8 .= "<div class='l-right'>";
        $form8 .= "<input type='text' name='trust-fax' />";
        $form8 .= "</div><br/>";

        $form8 .= "<div class='l-left'>Description:</div>";
        $form8 .= "<div class='l-right'>";
        $form8 .= "<textarea name='trust-description' rows='10' cols='20'></textarea>";
        $form8 .= "</div><br/>";

        $form8 .= "<div class='l-left'>Activities:</div>";
        $form8 .= "<div class='l-right'>";
        $form8 .= "<input type='text' name='trust-activities' />";
        $form8 .= "</div><br/>";

        $form8 .= "<div class='l-left'>Url:</div>";
        $form8 .= "<div class='l-right'>";
        $form8 .= "<input type='text' name='trust-url' />";
        $form8 .= "</div><br/>";

        $form8 .= "<div class='l-left'>Address 1:</div>";
        $form8 .= "<div class='l-right'>";
        $form8 .= "<input type='text' name='trust-address1' />";
        $form8 .= "</div><br/>";

        $form8 .= "<div class='l-left'>Address 2:</div>";
        $form8 .= "<div class='l-right'>";
        $form8 .= "<input type='text' name='trust-address2' />";
        $form8 .= "</div><br/>";

        $form8 .= "<div class='l-left'>Address 3:</div>";
        $form8 .= "<div class='l-right'>";
        $form8 .= "<input type='text' name='trust-address3' />";
        $form8 .= "</div><br/>";

        $form8 .= "<div class='l-left'>Country:</div>";
        $form8 .= "<div class='l-right'>";    
        $form8 .= "<!-- select onchange='ustate(this.selectedIndex);' id='country8' name='trust-country' -->";
        $form8 .= "<select onchange='print_state(\"trust-state\",this.selectedIndex);' id='trust-country' name='trust-country' >";
        $form8 .= "</select>";
        $form8 .= "</div><br/>";

        $form8 .= "<div class='l-left'>State:</div>";
        $form8 .= "<div class='l-right'>";
        $form8 .= "<!-- select type='text' name='trust-state' id='state8'-->";
        $form8 .= "<select type='text' name='trust-state' id='trust-state'>";
        $form8 .= "</select>";
        $form8 .= "<!-- script language='javascript'>print_country('country8');</script -->";
        $form8 .= "<script language='javascript'>print_country('trust-country');</script>";
        $form8 .= "</div><br/>";

        $form8 .= "<div class='l-left'>City:</div>";
        $form8 .= "<div class='l-right'>";
        $form8 .= "<input type='text' name='trust-city' />";
        $form8 .= "</div><br/>";

        $form8 .= "<div class='l-left'>Continent:</div>";
        $form8 .= "<div class='l-right'>";
        $form8 .= "<select name='trust-continent' >";
        $form8 .= "<option value='Asia'>Asia</option>";
        $form8 .= "<option value='Africa'>Africa</option>";
        $form8 .= "<option value='North America'>North America</option>";
        $form8 .= "<option value='South America'>South America</option>";
        $form8 .= "<option value='Antarctica'>Antarctica</option>";
        $form8 .= "<option value='Europe'>Europe</option>";
        $form8 .= "<option value='Australia'>Australia</option>";
        $form8 .= "</select>";
        $form8 .= "</div><br/>";

        $form8 .= "<div class='l-left'>Longitude:</div>";
        $form8 .= "<div class='l-right'>";
        $form8 .= "<input type='text' name='trust-longitude' />";
        $form8 .= "</div><br/>";

        $form8 .= "<div class='l-left'>Latitude:</div>";
        $form8 .= "<div class='l-right'>";
        $form8 .= "<input type='text' name='trust-latitude' />";
        $form8 .= "</div><br/>";

        $form8 .="<input type='hidden' name='submitted-trust' id='submitted-trust' value='trust' />";
        $form8 .="<input type='submit' value='Add Trust' name='add-trust' />";

        $form8 .= "</form>";

        echo "<div id='l-trust'>".$form8."</div>";

        if (!isset($form1)) { $form1 = ""; }

?>