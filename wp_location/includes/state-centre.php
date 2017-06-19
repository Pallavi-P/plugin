<?php

	if  (!isset($form7)) {  $form7 = ""; }

            $form7 .= "<h3>Add New State-Center</h3>";
            $form7 .= "<form name='state-center' id='state-center' method='post' action=''>";

            if(isset($state_center) && $state_center == true) {
                    echo "New State-Center Added";
            }

            $form7 .= "<div class='l-left'>State:</div>";
            $form7 .= "<div class='l-right'>";
            $form7 .= "<select type='text' class='center_state' name='center_state' id='state3'>";
            $form7 .= "</select>";
            $form7 .= "</div>";
    		$form7 .= "<div class='l-left'>Expand into :</div>";
            $form7 .= "<div class='l-right'>";
            $form7 .= "City <input type='radio' class='expand'  name='expand' value='1'> ";
            $form7 .= "Center <input type='radio' name='expand' value='0' checked='checked'>";
            $form7 .= "</div>";
    		$form7 .="<input type='hidden' name='submitted-state-center' id='submitted-state-center' value='state-center' />";
            $form7 .="<input type='submit' value='Add State-Cener' name='add-state-center' />";
            $form7 .= "</form>";
            echo "<div id='expand2' style='float:right; position:relative; width:500px;display:none;'>". $form7."</div>" ;
	
?>