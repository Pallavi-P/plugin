<?php

if(!isset($form0)) {  $form0 = ""; }

            if(isset($school) && $school == true)
            {
                    echo "New School Added";
            }

        $form0 .= "<h3>Add New School</h3>
        <form name='school' id='school' method='post' action=''>
        <div class='l-left'>Name:</div>
        <div class='l-right'>
        <input type='text' name='school-name' />
        </div><br/>

        <div class='l-left'>Description:</div>
        <div class='l-right'>
        <textarea name='school-description' rows='10' cols='20'></textarea>
        </div><br/>

        <div class='l-left'>Url:</div>
        <div class='l-right'>
        <input type='text' name='school-url' />
        </div><br/>

        <div class='l-left'>Address:</div>
        <div class='l-right'>
        <textarea name='school-address1' rows='10' cols='20'></textarea>
        </div><br/>

        <div class='l-left'>Country:</div>
        <div class='l-right'>
        <!-- select onchange='sstate(this.selectedIndex);' id='country0' name='school-country' -->
        <select onchange='print_state(\"school-state\",this.selectedIndex);' id='school-country' name='school-country' >
        </select>
        </div><br/>

        <div class='l-left'>State:</div>
        <div class='l-right'>
        <!-- select type='text' name='state0' id='school-state' -->
        <select type='text' name='school-state' id='school-state' >
        </select>
        <!-- script language='javascript'>print_country('country0');</script -->
        <script language='javascript'>print_country('school-country');</script>
        </div><br/>

        <div class='l-left'>City:</div>
        <div class='l-right'>
        <input type='text' name='school-city' />
        </div><br/>

        <div class='l-left'>Pincode:</div>
        <div class='l-right'>
        <input type='text' name='school-pincode' />
        </div><br/>

        <div class='l-left'>Continent:</div>
        <div class='l-right'>
        <select name='school-continent' >
        <option value='Asia'>Asia</option>
        <option value='Africa'>Africa</option>
        <option value='North America'>North America</option>
        <option value='South America'>South America</option>
        <option value='Antarctica'>Antarctica</option>
        <option value='Europe'>Europe</option>
        <option value='Australia'>Australia</option>
        </select>
        </div><br/>

        <div class='l-left'>phone:</div>
        <div class='l-right'>
        <input type='text' name='school-phone' />
        </div><br/>

        <div class='l-left'>Email:</div>
        <div class='l-right'>
        <input type='text' name='school-email' />
        </div><br/>

        <div class='l-left'>Affiliation:</div>
        <div class='l-right'>
        <input type='text' name='school-affiliation' />
        </div><br/>

        <input type='hidden' name='submitted-school' id='submitted-school' value='school' />
        <input type='submit' value='Add School' name='add-school' />
        </form>" ;

        echo "<div id='l-school'>".$form0."</div>";
	
?>