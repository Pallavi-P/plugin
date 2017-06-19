<?php
		if (!isset($form9)) { $form9 = ""; }

        $form9 .= "<h3>Add Committee Member</h3>";
        $form9 .= "<form name='committee' id='committee' method='post' action=''>";
        if(isset($committee) && $committee == true) 
        {
    	  echo "New committee Added";
        }
    	$args1['role'] = 'ccmt_member';
        $blogusers = get_users($args1);
    	$form9 .= "<div class='l-left'>User:</div>";
    	$form9 .= "<div class='l-right'>";
    	$form9 .= "<select name='committee-user'>";
        foreach ($blogusers as $user) 
        {
            $form9 .= '<option value='.$user->display_name . '>' . $user->display_name . '</option>';
        }
        $form9 .="</select>";
    	$form9 .="<div style='text-align: right; padding-right: 225px; margin-top: -21px;'><a target='_blank' href='http://www.chinmayamission.com/wp-admin/user-new.php/'>Register for a user</a></div>";
        $form9 .= "</div><br/>";
        $form9 .= "<div class='l-left'>Centre:</div>";
        $form9 .= "<div class='l-right'>";

    	global $wpdb;
    	$form9 .= "<select name = 'committee-center'>";
        $form9 .= "<option value='centers' selected> Select Center</option>";
    	foreach($wpdb->get_results("select name,id from wp_location WHERE `location_type` LIKE 'centre'") as $key => $page)
        {
    	   $form9 .= "<option value='".$page->name ."'>" .$page->name ."</option>";
    	}

    	$form9 .= "</select>";
        $form9 .= "</div><br/>";

    	$form9 .= "<div class='l-left'>Member Type:</div>";
    	$form9 .= "<div class='l-right'>";
    	$form9 .= "<select name='committee-type' >";
    	$form9 .= "<option value='president'>President</option>";
    	$form9 .= "<option value='treasurer'>Treasurer</option>";
    	$form9 .= "<option value='secretary'>Secretary</option>";
    	$form9 .= "<option value='acharya'>Acharya</option>";
    	$form9 .= "</select>";
    	$form9 .= "</div><br/>";

    	$form9 .= "<div class='l-left'>Name:</div>";
    	$form9 .= "<div class='l-right'>";
    	$form9 .= "<input type='text' name='committee-name' />";
    	$form9 .= "</div><br/>";

    	$form9 .= "<div class='l-left'>Phone:</div>";
    	$form9 .= "<div class='l-right'>";
    	$form9 .= "<input type='text' name='committee-phone' />";
    	$form9 .= "</div><br/>";

    	$form9 .= "<div class='l-left'>Email</div>";
    	$form9 .= "<div class='l-right'>";
    	$form9 .= "<input type='text' name='committee-email' />";
    	$form9 .= "</div><br/>";

    	$form9 .="<input type='hidden' name='submitted-committee' id='submitted-committee' value='committee' />";
    	$form9 .="<input type='submit' value='Add Committee' name='add-committee' />";

    	$form9 .= "</form>";

        echo "<div id='l-committee'>".$form9."</div>";

        if (!isset($form8)) { $form8 = ""; }
?>