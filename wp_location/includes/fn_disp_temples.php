<?php
	function display_temple() {
    	global $wpdb;
        
        //delete temple

    	if($_GET['delete-temple']) {
            $td = $_GET['delete-temple'];
            $del= $wpdb->query(
                    $wpdb->prepare(
                            "
                            DELETE FROM wp_location
                            WHERE id = %d
                            ",
                            $td
                    )
            );

            if (false===$del)
            {
                echo'<div style="color:red">Record deleting failed. Error: '.$wpdb->last_error.'</div>';
            }
            else
            {   
               echo '<div style="color:green">Record Deleted for Temple - ID '.$cd;
            }
        }

        //update temple
    	if ($_GET['update-temple']) {
    	   echo "Update Temple";
    	   $tid = $_GET['update-temple'];
    	   $wt = $wpdb->get_results(
                        "SELECT * FROM `wp_location` 
                        WHERE `id` = $tid 
                        AND `location_type` 
                        LIKE 'temple'"
                        );
           if (false===$wt)
          {
            echo'<div style="color:red">Record failed query. Error: '.$wpdb->last_error.'</div>';
          }

    	    $utemple ='';
            $utemple .="<form method='post' action=''>";
                $utemple .= "<div class='l-left'>Name:</div>";
                $utemple .= "<div class='l-right'>";
                $utemple .= "<input type='text' name='utemple-name' value='".$wt[0]->name."' />";
                $utemple .= "</div>";

                $utemple .= "<div class='l-left'>Description:</div>";
                $utemple .= "<div class='l-right'>";
                $utemple .= "<textarea name='utemple-description' rows='10' cols='20'>".$wt[0]->description."</textarea>";
                $utemple .= "</div>";

                $utemple .= "<div class='l-left'>Url:</div>";
                $utemple .= "<div class='l-right'>";
         	    $utemple .= "<input type='text' name='utemple-url' value='".$wt[0]->url."' />";
                $utemple .= "</div>";

        	    $utemple .= "<div class='l-left'>Deity:</div>";
                $utemple .= "<div class='l-right'>";
                $utemple .= "<input type='text' name='utemple-deity' value='".$wt[0]->deity."'  />";
                $utemple .= "</div>";

        	    $utemple .= "<div class='l-left'>Consecrated On:</div>";
                $utemple .= "<div class='l-right'>";
                $utemple .= "<input type='text' name='utemple-consecrated' value='".$wt[0]->consecrated."' id='datepicker'  />";
                $utemple .= "</div>";


                $utemple .= "<div class='l-left'>Address 1:</div>";
                $utemple .= "<div class='l-right'>";
                $utemple .= "<textarea name='utemple-address1' rows='10' cols='20'>".$wt[0]->address1."</textarea>";
                $utemple .= "</div>";

                $utemple .= "<div class='l-left'>Address 2:</div>";
                $utemple .= "<div class='l-right'>";
                $utemple .= "<textarea name='utemple-address2' rows='10' cols='20'>".$wt[0]->address2."</textarea>";
                $utemple .= "</div>";

                $utemple .= "<div class='l-left'>Address 3:</div>";
                $utemple .= "<div class='l-right'>";
                $utemple .= "<textarea name='utemple-address3' rows='10' cols='20'>".$wt[0]->address3."</textarea>";
                $utemple .= "</div>";

                $utemple .= "<div class='l-left'>Country:</div>";
                $utemple .= "<div class='l-right'>";
                $utemple .= "<input type='text' name='utemple-country' value='".$wt[0]->country."' />";
                $utemple .= "</div>";

                $utemple .= "<div class='l-left'>State:</div>";
                $utemple .= "<div class='l-right'>";
                $utemple .= "<input type='text' name='utemple-state' value='".$wt[0]->state."' />";
                $utemple .= "</div>";

                $utemple .= "<div class='l-left'>City:</div>";
                $utemple .= "<div class='l-right'>";
                $utemple .= "<input type='text' name='utemple-city' value='".$wt[0]->city."' />";
                $utemple .= "</div>";

                $utemple .= "<div class='l-left'>Pincode:</div>";
                $utemple .= "<div class='l-right'>";
                $utemple .= "<input type='text' name='utemple-zip' value='".$wt[0]->zip."' />";
                $utemple .= "</div>";

        	    $utemple .= "<div class='l-left'>Continent:</div>";
                $utemple .= "<div class='l-right'>";
                $utemple .= "<input type='text' name='utemple-continent' value='".$wt[0]->continent."'  />";
                $utemple .= "</div>";

        	    $utemple .= "<div class='l-left'>Latitude:</div>";
                $utemple .= "<div class='l-right'>";
                $utemple .= "<input type='text' name='utemple-latitude' value='".$wt[0]->latitude."'  />";
                $utemple .= "</div>";

                $utemple .= "<div class='l-left'>Longitude:</div>";
                $utemple .= "<div class='l-right'>";
                $utemple .= "<input type='text' name='utemple-longitude' value='".$wt[0]->longitude."' />";
                $utemple .= "</div>";

                $utemple .="<input type='hidden' name='update-temple' id='update-temple' value='temple' />";
                $utemple .="<input type='submit' value='Update Temple' />";
            $utemple .="</form>";

            echo "<div id='u-temple' style='width:800px;'>".$utemple."</div>";

                    if($_POST['update-temple'])  
                    {
                         echo "Update to centre initiated. Result below for location Id: ";
                            $tid = $_GET['update-temple'];
                            $uname = $_POST['utemple-name'];
                            $udesc = $_POST['utemple-description'];
                            $uurl = $_POST['utemple-url'];
                            $udeity = $_POST['utemple-deity'];
                            $ucon = $_POST['utemple-consecrated'];
                            $uadd1 = $_POST['utemple-address1'];
                            $uadd2 = $_POST['utemple-address2'];
                            $uadd3 = $_POST['utemple-address3'];
                            $ucountry = $_POST['utemple-country'];
                            $ustate = $_POST['utemple-state'];
                            $ucity = $_POST['utemple-city'];
                            $uzip = $_POST['utemple-zip'];
                            $ucontinent = $_POST['utemple-continent'];
                            $ulat = $_POST['utemple-latitude'];
                            $ulong = $_POST['utemple-longitude'];
                            $u_up = date('Y-m-d H:i:s');
                            print_r($tid);
                            $updated = $wpdb->update
                                (
                                    'wp_location',
                                    array(
                                            'name' => $uname,       // string
                                            'description' => $udesc,
                                            'url' => $uurl,
                                            'address1' => $uadd1,
                                            'address2' => $uadd2,
                                            'address3' => $uadd3,
                                            'city' => $ucity,
                                            'state' => $ustate,
                                            'country' => $ucountry,
                                            'zip' => $uzip,
                                            'continent' => $ucontinent,
                                            'latitude' => $ulat,
                                            'longitude' => $ulong,
                                            'deity' => $udeity,
                                            'consecrated' => $ucon,
                                            'updated_on' => $u_up
                                        ),
                                    array( 'ID' => $tid ),
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
                                            '%f',
                                            '%f',
                                            '%s',
                                            '%s',
                                            '%s'
                                        ),
                                    array( '%d' )
                	           );
                            
                        if ( false === $updated ) 
                        {
                                echo '<div style="color:red">Record failed to update. Error:'.$wpdb->last_error.'</div>';
                        } else 
                        {
                                echo "<div style='color:green'>Record updated successfully</div>";
                        }
                    }
                    else
                    {
                        echo "No update to temple record yet ";
                    }

	    }

    	//pagination
    	$num_temple = $wpdb->get_results(
                                "SELECT count(*) 
                                    AS total_nr 
                                    FROM `wp_location` 
                                    WHERE `location_type` 
                                    LIKE 'temple'  
                                ");
    	$n_group = $num_temple[0]->total_nr;
    	$n_x_group = 49;
    	$n_pages = (($n_group / $n_x_group) < 1 ? 1 : ($n_group / $n_x_group));
    	$p=0;
    	if( isset($_REQUEST['p'])) {
    		$p=$_REQUEST['p'];
    	}
    	function get_page3_scrolling ($n_group,$p,$n_pages){
    		$base_url ='/wp-admin/admin.php?page=temple';
    		$scroll='';
    		if ($n_pages > 1)
    		{
    			if ($p >= 1)
    			{
    				//$scroll ='<div id="prev_btn" style="float:left;"><a style="padding-right:30px;" href="'.$base_url.'&p='.($p - 49).'">Previous</a></div>';
    			}
    			if ($p < ($n_pages - 1)) 
                {
    				//$scroll .= '<div id="next_btn" style="float:right;margin-right: 21px;"><a style="padding-right:43px;" href="'.$base_url.'&p='.($p + 49).'">Next</a></div>';
    			}
    			if (trim($scroll) != "1")
    			{
    				return $scroll;
    			}
    		}
    		return $scroll;
    	}
    	$scrolling3 = get_page3_scrolling($n_group,$p,$n_pages);
    	echo "<h2>Temple</h2>";
    	echo "<div class='l-pagination'>".$scrolling3."</div>";
    	$ws_details = $wpdb->get_results(
                            "SELECT * FROM `wp_location` 
                            WHERE `location_type` 
                            LIKE 'temple'"
                            );
        
    	echo "<div class='loc-table-div'>";
        echo "<table class='loc-table' style='empty-cells:show;'>";
    		echo "<th>ID</th>";
            echo "<th>Location ID</th>";
    		echo "<th>Name</th>";
    		echo "<th>Decription</th>";
    		echo "<th>Deity</th>";
    		echo "<th>Consecrated On</th>";
    		echo "<th>Url</th>";
            echo "<th>Adress 1</th>";
            echo "<th>Adress 2</th>";
    		echo "<th>Address 3</th>";
    		echo "<th>City</th>";
    		echo "<th>State</th>";
            echo "<th>Country</th>";
    		echo "<th>Pincode</th>";
    		echo "<th>Continent</th>";
    		echo "<th>Latitude</th>";
    		echo "<th>Longitude</th>";
    		echo "<th>Added On</th>";
    		echo "<th>Updated On</th>";
    		echo "<th></th>";
    		echo "<th></th>";
    		foreach ($ws_details as $data) {
    			$i++;
    			echo "<tr>";
    			echo "<td>".$i."</td>";
    			echo "<td>".$data->id."</td>";
    			echo "<td>".$data->name."</td>";
    			echo "<td>".$data->description."</td>";
    			echo "<td>".$data->deity."</td>";
    			echo "<td>".$data->consecrated."</td>";
    			echo "<td>".$data->url."</td>";
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
    			echo "<td><a href='/wp-admin/admin.php?page=temple&update-temple=".$data->id."'>Edit</a></td>";
    			echo "<td><a href='/wp-admin/admin.php?page=temple&delete-temple=".$data->id."'>Delete</a></td>";
    			echo "</tr>";
            }//for each loop  ends
        echo "</table>";
        echo "</div>";
   } //function display temple ends   
?>