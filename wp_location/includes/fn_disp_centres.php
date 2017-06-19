<?php

	function display_center() {
    // deleting centre record
        global $wpdb;

        echo "<h2>Center</h2>";

    	if($_GET['delete-center']) 
        {

        	$cd = $_GET['delete-center'];

        	$del = $wpdb->query(
        		$wpdb->prepare(
        			"DELETE FROM wp_location
        			WHERE id = %d",
    		        $cd
                	)
        	);
            if (false===$del)
            {
                echo'<div style="color:red">Record deleting failed. Error: '.$wpdb->last_error.'</div>';
            }
            else
            {   
	           echo '<div style="color:green">Record Deleted for Center - ID '.$cd;
            }
    	}


    	if ($_GET['update-center']) 
        {
            //Updating Centre - update-center parameter sent from edit link click

    	   $wid = $_GET['update-center'];

          echo "Update Center";

          $ws = $wpdb->get_results(
                        "SELECT * FROM `wp_location` 
                         WHERE `id` = $wid
                         AND `location_type` 
                         LIKE 'centre'
                         ");
          if (false===$ws)
          {
            echo'<div style="color:red">Record failed query. Error: '.$wpdb->last_error.'</div>';
          }

        	$ucenter ='';
        	$ucenter .="<form method='post' action=''>";
                $ucenter .= "<div class='l-left'>Name:</div>";
                $ucenter .= "<div class='l-right'>";
                    $ucenter .= "<input type='text' name='ucenter-name' value='".$ws[0]->name."' />";
                $ucenter .= "</div>";

        	    $ucenter .= "<div class='l-left'>Trust:</div>";
                $ucenter .= "<div class='l-right'>";
                 //$ucenter .= "<input type='text' name='ucenter-trust' value='".$ws[0]->trust."' />";
                    $ucenter .= "<select name = 'ucenter-trust'>";
                         $ucenter .= "<option value=''>Select Trust Here</option>";
                            foreach($wpdb->get_results
                            (
                                "SELECT id,name 
                                 FROM `wp_location` 
                                 WHERE location_type='trust'
                                 ORDER BY name ASC"
                                 ) 
                                 as $key => $row
                             )
                                {
                                    $ucenter .= "<option value= '" . $row->id . "'>" . $row->name . "</option>";
                                } 
                    $ucenter .= "</select>";                               
                $ucenter .= "</div>";

                $ucenter .= "<div class='l-left'>Description:</div>";
                $ucenter .= "<div class='l-right'>";
                    $ucenter .= "<textarea name='ucenter-description' rows='10' cols='20'>".$ws[0]->description."</textarea>";
                $ucenter .= "</div>";

                $ucenter .= "<div class='l-left'>Url:</div>";
                $ucenter .= "<div class='l-right'>";
                    $ucenter .= "<input type='text' name='ucenter-url' value='".$ws[0]->url."' />";
                $ucenter .= "</div>";

                $ucenter .= "<div class='l-left'>Phone:</div>";
                $ucenter .= "<div class='l-right'>";
                    $ucenter .= "<input type='text' name='ucenter-phone' value='".$ws[0]->phone."' />";
                $ucenter .= "</div>";

                $ucenter .= "<div class='l-left'>Fax:</div>";
                $ucenter .= "<div class='l-right'>";
                    $ucenter .= "<input type='text' name='ucenter-fax' value='".$ws[0]->fax."' />";
                $ucenter .= "</div>";

                $ucenter .= "<div class='l-left'>Email:</div>";
                $ucenter .= "<div class='l-right'>";
                $ucenter .= "<input type='text' name='ucenter-email' value='".$ws[0]->email."' />";
                $ucenter .= "</div>";

        	    $ucenter .= "<div class='l-left'>Acharya:</div>";
                $ucenter .= "<div class='l-right'>";

                $ucenter .= "<select name = 'ucenter-acharya'>";
                    $ucenter .= "<option value=''>Select Acharya Here</option>";

                     foreach($wpdb->get_results("SELECT id,profile_id,salutation,last_name FROM `wp_acharya` ORDER BY salutation,last_name ASC") as $key => $row){
                       $ucenter .= "<option value=" . $row->profile_id . ">" . $row->salutation . " " . $row->last_name . "</option>";
                     }
                $ucenter .= "</select>";
                $ucenter .= "</div>";
                
                $ucenter .= "<div class='l-left'>President:</div>";
                $ucenter .= "<div class='l-right'>";
                    $ucenter .= "<input type='text' name='ucenter-president' value='".$ws[0]->president."' />";
                $ucenter .= "</div>";

                $ucenter .= "<div class='l-left'>Secretary:</div>";
                $ucenter .= "<div class='l-right'>";
                    $ucenter .= "<input type='text' name='ucenter-secretary' value='".$ws[0]->secretary."' />";
                $ucenter .= "</div>";

                $ucenter .= "<div class='l-left'>Treasurer:</div>";
                $ucenter .= "<div class='l-right'>";
                    $ucenter .= "<input type='text' name='ucenter-treasurer' value='".$ws[0]->treasurer."' />";
                $ucenter .= "</div>";

        	    $ucenter .= "<div class='l-left'>address 1:</div>";
                $ucenter .= "<div class='l-right'>";
                    $ucenter .= "<textarea name='ucenter-address1' rows='10' cols='20'>".$ws[0]->address1."</textarea>";
                $ucenter .= "</div>";

                $ucenter .= "<div class='l-left'>Address 2:</div>";
                $ucenter .= "<div class='l-right'>";
                    $ucenter .= "<textarea name='ucenter-address2' rows='10' cols='20'>".$ws[0]->address2."</textarea>";
                $ucenter .= "</div>";

                $ucenter .= "<div class='l-left'>Address 3:</div>";
                $ucenter .= "<div class='l-right'>";
                    $ucenter .= "<textarea name='ucenter-address3' rows='10' cols='20'>".$ws[0]->address3."</textarea>";
                $ucenter .= "</div>";

                $ucenter .= "<div class='l-left'>Country:</div>";
                $ucenter .= "<div class='l-right'>";
        	       $ucenter .= "<input type='text' name='ucenter-country' value='".$ws[0]->country."' />";
                $ucenter .= "</div>";

                $ucenter .= "<div class='l-left'>State:</div>";
                $ucenter .= "<div class='l-right'>";
                $ucenter .= "<input type='text' name='ucenter-state' value='".$ws[0]->state."' />";
                $ucenter .= "</div>";

                $ucenter .= "<div class='l-left'>City:</div>";
                $ucenter .= "<div class='l-right'>";
                    $ucenter .= "<input type='text' name='ucenter-city' value='".$ws[0]->city."' />";
                $ucenter .= "</div>";

                $ucenter .= "<div class='l-left'>Pincode:</div>";
                $ucenter .= "<div class='l-right'>";
                $ucenter .= "<input type='text' name='ucenter-zip' value='".$ws[0]->zip."' />";
                $ucenter .= "</div>";

                $ucenter .= "<div class='l-left'>Continent:</div>";
                $ucenter .= "<div class='l-right'>";
                    $ucenter .= "<input type='text' name='ucenter-continent'value='".$ws[0]->continent."' >";
                $ucenter .= "</div>";

                $ucenter .= "<div class='l-left'>Latitude:</div>";
                $ucenter .= "<div class='l-right'>";
                    $ucenter .= "<input type='text' name='ucenter-latitude' value='".$ws[0]->latitude."'  />";
                $ucenter .= "</div>";

                $ucenter .= "<div class='l-left'>Longitude:</div>";
                $ucenter .= "<div class='l-right'>";
                    $ucenter .= "<input type='text' name='ucenter-longitude' value='".$ws[0]->longitude."' />";
                $ucenter .= "</div>";
                $ucenter .= "<div class='l-left'>Contact:</div>";
                $ucenter .= "<div class='l-right'>";
                    $ucenter .= "<input type='text' name='ucenter-contact' value='".$ws[0]->contact."'/>";
                $ucenter .= "</div>";

                $ucenter .="<input type='hidden' name='update-center' id='update-center' value='center' />";
                $ucenter .="<input type='submit' value='Update Center' />";
    	    $ucenter .="</form>";

    	    echo "<div id='u-center' style='width:800px;'>".$ucenter."</div>";

    		if($_POST['update-center'])	{
                echo "Update to centre initiated. Result below for location Id: ";
    			$uid = $_GET['update-center'];
    			$uname = $_POST['ucenter-name'];
    			$utrust = $_POST['ucenter-trust'];
    			$udesc = $_POST['ucenter-description'];
    			$uurl = $_POST['ucenter-url'];
    			$uphone = $_POST['ucenter-phone'];
    			$ufax = $_POST['ucenter-fax'];
    			$uemail = $_POST['ucenter-email'];
    			$uacharya = $_POST['ucenter-acharya'];
    			$upresident = $_POST['ucenter-president'];
    			$usecretary = $_POST['ucenter-secretary'];
    			$utreasurer = $_POST['ucenter-treasurer'];
                $uadd1 = $_POST['ucenter-address1'];
                $uadd2 = $_POST['ucenter-address2'];
    			$uadd3 = $_POST['ucenter-address3'];
    			$ucountry = $_POST['ucenter-country'];
    			$ustate = $_POST['ucenter-state'];
                $ucity = $_POST['ucenter-city'];
    			$uzip = $_POST['ucenter-zip'];
    			$ucont = $_POST['ucenter-continent'];
    			$ulat = $_POST['ucenter-latitude'];
    			$ulong = $_POST['ucenter-longitude'];
    			$u_up = date('Y-m-d H:i:s');
    			$ucon = $_POST['ucenter-contact'];
                print_r($uid);
            	$updated = $wpdb->update(
                    	   'wp_location',
                    	   array(
                        		'name' => $uname,
                        		'trust' => $utrust,
                        		'description' => $udesc,
                        		'url' => $uurl,
                        		'phone' => $uphone,
                        		'fax' => $ufax,
                        		'email' => $uemail,
                        		'acharya' => $uacharya,
                        		'president' => $upresident,
                        		'secretary' => $usecretary,
                        		'treasurer' => $utreasurer,
                                'address1' => $uadd1,
                                'address2' => $uadd2,
                        		'address3' => $uadd3,
                        		'city' => $ucity,
                        		'state' => $ustate,
                                'country' => $ucountry,
                        		'zip' => $uzip,
                        		'continent' => $ucont,
                        		'latitude' => $ulat,
                        		'longitude' => $ulong,
                        		'updated_on' => $u_up,
                        		'contact' => $ucon,
                        	),
                        	array( 'ID' => $uid ),
                        	array(
                        		'%s',
                        		'%s',
                        		'%s',
                        		'%s',
                        		'%s',
                        		'%s',
                                '%s',
                        		'%s',
                                '%s',
                                '%s',
                        		'%s',
                                '%s',
                        		'%s',
                        		'%s',
                        		'%s',
                        	    '%s',
                        		'%s',
                        		'%s',
                        		'%s',
                        		'%s',
                        		'%s',
                        		'%s',
                        		'%s',
                        		'%s',
                        	),
                        	array( '%d' )
                    	);
                if ( false === $updated ) 
                    {
                        echo '<div style="color:red"> Record failed to update. Error: '.$wpdb->last_error.'</div>';
                    } else 
                    {
                        echo "<div style='color:green'>Record updated successfully</div>";
                    }

    		}
            else{
                echo "No update to centre record yet ";
            }

    	}


    	//pagination
    	$num_center = $wpdb->get_results("SELECT count(*) as total_nr FROM `wp_location` WHERE `location_type` LIKE 'centre'");
    	//$num_center = 4;
    	$n_center = $num_center[0]->total_nr;
    	$n_x_center = 49;
    	$n_centers = (($n_center / $n_x_center) < 1 ? 1 : ($n_center / $n_x_center));
    	$pcenter=0;

    	if( isset($_REQUEST['pcenter'])) {
    		$pcenter=$_REQUEST['pcenter'];
    	}

    	function get_page1_scrolling ($n_center,$pcenter,$n_centers)
    	{
    		$base_url ='/wp-admin/admin.php?page=center';
    		$scroll1 ='';

    		if ($n_centers > 1)
    		{
    			if ($pcenter >= 1)
    			{
    				$scroll1 ='<div id="prev_btn" style="float:left;"><a style="padding-right:30px;" href="'.$base_url.'&pcenter='.($pcenter - 49).'">Previous</a></div>';
    			}
    			if ($pcenter < ($n_centers - 1)) {
    				$scroll1 .= '<div id="next_btn" style="float:right;margin-right: 21px;"><a style="padding-right:43px;" href="'.$base_url.'&pcenter='.($pcenter + 49).'">Next</a></div>';
    			}

    			if (trim($scroll1) != "1")
    			{
    				return $scroll1;
    			}
    		}
    		return $scroll1;
    	}
    	$scrolling = get_page1_scrolling($n_center,$pcenter,$n_centers);

    	echo "<div class='l-pagination'>".$scrolling."</div>";

    	$ws_details = $wpdb->get_results("SELECT * FROM `wp_location` WHERE `location_type` LIKE 'centre' ORDER BY `id` DESC ");
        //var_dump($ws_details);
        echo "<div class='loc-table-div'>";
        echo "<table class='loc-table' style='empty-cells:show;'>";
    		echo "<th>ID</th>";
    		echo "<th>Location ID</th>";
    		echo "<th>Name</th>";
    		echo "<th>Trust</th>";
    		echo "<th>Decription</th>";
    		echo "<th>Url</th>";
    		echo "<th>Phone</th>";
    		echo "<th>Fax</th>";
    		echo "<th>Email</th>";
    		echo "<th>Acharya</th>";
    		echo "<th>President</th>";
    		echo "<th>Secretary</th>";
    		echo "<th>Treasurer</th>";
            echo "<th>Adress 1</th>";
            echo "<th>Adress 2</th>";
    		echo "<th>Adress 3</th>";
    		echo "<th>City</th>";
            echo "<th>State</th>";
            echo "<th>Country</th>";
    		echo "<th>Pincode</th>";
    		echo "<th>Continent</th>";
    		echo "<th>Latitude</th>";
    		echo "<th>Longitude</th>";
    		echo "<th>Added On</th>";
    		echo "<th>Updated On</th>";
    		echo "<th>Contact</th>";
    		echo "<th></th>";
    		echo "<th></th>";

    		foreach ($ws_details as $data) {
              $ach_details = $wpdb->get_row("SELECT salutation,last_name FROM `wp_acharya` WHERE profile_id =" . $data->acharya );
              $i++;
    			echo "<tr>";
    			echo "<td>".$i."</td>";
    			echo "<td>".$data->id."</td>";
    			echo "<td>".$data->name."</td>";
    			echo "<td>".$data->trust."</td>";
    			echo "<td>".$data->description."</td>";
    			echo "<td>".$data->url."</td>";
    			echo "<td>".$data->phone."</td>";
    			echo "<td>".$data->fax."</td>";
    			echo "<td>".$data->email."</td>";
    			echo "<td>".$ach_details->salutation." ".$ach_details->last_name."</td>";
    			echo "<td>".$data->president."</td>";
    			echo "<td>".$data->secretary."</td>";
    			echo "<td>".$data->treasurer."</td>";
                echo "<td>".$data->address1."</td>";
                echo "<td>".$data->address2."</td>";
    			echo "<td>".$data->address3."</td>";
    			echo "<td>".$data->city."</td>";
    			echo "<td>".$data->state."</td>";
                echo "<td>".$data->country."</td>";
    			echo "<td>".$data->zip."</td>";
    			echo "<td>".$data->continent."</td>";
    			echo "<td>".$data->latitude."</td>";
    			echo "<td>".$data->longitude."</td>";
    			echo "<td>".$data->added_on."</td>";
    			echo "<td>".$data->updated_on."</td>";
    			echo "<td>".$data->contact."</td>";
    			echo "<td><a href='/wp-admin/admin.php?page=center&update-center=".$data->id."'>Edit</a></td>";
    			echo "<td><a href='/wp-admin/admin.php?page=center&delete-center=".$data->id."'>Delete</a></td>";
    			echo "</tr>";

    		}
    	echo "</table>";
        echo "</div>";
    }//function display center ends

?>