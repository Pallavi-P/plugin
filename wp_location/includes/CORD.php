<?php
	if (!isset($form10)) { $form10 = ""; }

        $form10 .= "<h3>Add CORD Contact</h3>";
        $form10 .= "<form name='chord' id='chord' method='post' action=''>";

        if(isset($chord) && $chord == true) 
        {
            echo "New CHORD Contact Added";
        }

        $form10 .= "<div class='l-left'>Location:</div>";
        $form10 .= "<div class='l-right'>";
        $form10 .= "<input type='text' name='chord-location' />";
        $form10 .= "</div><br/>";

        $form10 .= "<div class='l-left'>Address 1:</div>";
        $form10 .= "<div class='l-right'>";
        $form10 .= "<input type='text' name='chord-address1' />";
        $form10 .= "</div><br/>";

        $form10 .= "<div class='l-left'>Address 2:</div>";
        $form10 .= "<div class='l-right'>";
        $form10 .= "<input type='text' name='chord-address2' />";
        $form10 .= "</div><br/>";

        $form10 .= "<div class='l-left'>Address 3:</div>";
        $form10 .= "<div class='l-right'>";
        $form10 .= "<input type='text' name='chord-address3' />";
        $form10 .= "</div><br/>";

        $form10 .= "<div class='l-left'>Country:</div>";
        $form10 .= "<div class='l-right'>";
        $form10 .= "<!-- select onchange='cstate(this.selectedIndex);' id='country4' name='chord-country' -->";
        $form10 .= "<select onchange='print_state(\"chord-state\",this.selectedIndex);' id='chord-country' name='chord-country' >";
        $form10 .= "</select>";
        $form10 .= "</div><br/>";

        $form10 .= "<div class='l-left'>State:</div>";
        $form10 .= "<div class='l-right'>";
        $form10 .= "<!-- select type='text' name='chord-state' id='state4' -->";
        $form10 .= "<select type='text' name='chord-state' id='chord-state'>";
        $form10 .= "</select>";
        $form10 .= "<!-- script language='javascript'>print_country('country4');</script -->";
        $form10 .= "<script language='javascript'>print_country('chord-country');</script>";
        $form10 .= "</div><br/>";

        $form10 .= "<div class='l-left'>City:</div>";
        $form10 .= "<div class='l-right'>";
        $form10 .= "<input type='text' name='chord-city' />";
        $form10 .= "</div><br/>";

        $form10 .= "<div class='l-left'>Continent:</div>";
        $form10 .= "<div class='l-right'>";
        $form10 .= "<select name='chord-continent' >";
        $form10 .= "<option value='Asia'>Asia</option>";
        $form10 .= "<option value='Africa'>Africa</option>";
        $form10 .= "<option value='North America'>North America</option>";
        $form10 .= "<option value='South America'>South America</option>";
        $form10 .= "<option value='Antarctica'>Antarctica</option>";
        $form10 .= "<option value='Europe'>Europe</option>";
        $form10 .= "<option value='Australia'>Australia</option>";
        $form10 .= "</select>";
        $form10 .= "</div><br/>";

        $form10 .= "<div class='l-left'>Phone:</div>";
        $form10 .= "<div class='l-right'>";
        $form10 .= "<input type='text' name='chord-phone' />";
        $form10 .= "</div><br/>";

        $form10 .= "<div class='l-left'>Email:</div>";
        $form10 .= "<div class='l-right'>";
        $form10 .= "<input type='text' name='chord-email' />";
        $form10 .= "</div><br/>";

        $form10 .="<input type='hidden' name='submitted-chord' id='submitted-chord' value='chord' />";
        $form10 .="<input type='submit' value='Add Cord' name='add-chord' />";

        $form10 .= "</form>";
        echo "<div id='l-chord'>".$form10."</div>";
?>
