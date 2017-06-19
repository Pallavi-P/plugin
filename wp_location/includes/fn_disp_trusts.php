<?php
	function display_trust() 
    {

            global $wpdb;

            if($_GET['delete-trust']) {

            $ad = $_GET['delete-trust'];

            $del=$wpdb->query(
                    $wpdb->prepare(
                            "DELETE FROM wp_location
                             WHERE id = %d
                            ",
                            $ad
                    )
            );

            if (false===$del)
                {
                    echo'<div style="color:red">Record deleting failed. Error: '.$wpdb->last_error.'</div>';
                }
                else
                {   
                   echo '<div style="color:green">Record Deleted for Trust - ID '.$cd;
                }

            }

            if ($_GET['update-trust']) {
                    //update trust - value from edit record link
                    $trid = $_GET['update-trust'];
                    echo "Update Trust";
                    $wt = $wpdb->get_results(
                                "SELECT * FROM `wp_location` 
                                 WHERE `id` = $trid
                                 AND `location_type` LIKE 'trust'
                                 ");
                     if (false==$wt)
                      {
                        echo'<div style="color:red">Record failed query. Error: '.$wpdb->last_error.'</div>';
                      }   
                                $utrust ='';
                                $utrust .="<form method='post' action=''>";

                                $utrust .= "<div class='l-left'>Name:</div>";
                                $utrust .= "<div class='l-right'>";
                                $utrust .= "<input type='text' name='utrust-name' value='".$wt[0]->name."' />";
                                $utrust .= "</div>";

                                $utrust .= "<div class='l-left'>Email:</div>";
                                $utrust .= "<div class='l-right'>";
                                $utrust .= "<input type='text' name='utrust-email' value='".$wt[0]->email."' />";
                                $utrust .= "</div>";

                                $utrust .= "<div class='l-left'>Phone:</div>";
                                $utrust .= "<div class='l-right'>";
                                $utrust .= "<input type='text' name='utrust-phone' value='".$wt[0]->phone."' />";
                                $utrust .= "</div>";

                                $utrust .= "<div class='l-left'>Fax:</div>";
                                $utrust .= "<div class='l-right'>";
                                $utrust .= "<input type='text' name='utrust-fax' value='".$wt[0]->fax."' />";
                                $utrust .= "</div>";

                                $utrust .= "<div class='l-left'>Description:</div>";
                                $utrust .= "<div class='l-right'>";
                                $utrust .= "<textarea name='utrust-description' rows='10' cols='20'>".$wt[0]->description."</textarea>";
                                $utrust .= "</div>";

                                $utrust .= "<div class='l-left'>Activities:</div>";
                                $utrust .= "<div class='l-right'>";
                                $utrust .= "<input type='text' name='utrust-activities' value='".$wt[0]->activities."'/>";
                                $utrust .= "</div>";

                                $utrust .= "<div class='l-left'>Url:</div>";
                                $utrust .= "<div class='l-right'>";
                                $utrust .= "<input type='text' name='utrust-url' value='".$wt[0]->url."' />";
                                $utrust .= "</div>";

                                $utrust .= "<div class='l-left'>Address 1:</div>";
                                $utrust .= "<div class='l-right'>";
                                $utrust .= "<input type='text' name='utrust-address1' value='".$wt[0]->address1."' />";
                                $utrust .= "</div>";

                                $utrust .= "<div class='l-left'>Address 2:</div>";
                                $utrust .= "<div class='l-right'>";
                                $utrust .= "<input type='text' name='utrust-address2' value='".$wt[0]->address2."' />";
                                $utrust .= "</div>";

                                $utrust .= "<div class='l-left'>Address 3:</div>";
                                $utrust .= "<div class='l-right'>";
                                $utrust .= "<input type='text' name='utrust-address3' value='".$wt[0]->address3."' />";
                                $utrust .= "</div>";

                                $utrust .= "<div class='l-left'>Country:</div>";
                                $utrust .= "<div class='l-right'>";
                                $utrust .= "<input type='text' name='utrust-country' value='".$wt[0]->country."' />";
                                $utrust .= "</div>";

                                $utrust .= "<div class='l-left'>State:</div>";
                                $utrust .= "<div class='l-right'>";
                                $utrust .= "<input type='text' name='utrust-state' value='".$wt[0]->state."' />";
                                $utrust .= "</div>";

                                $utrust .= "<div class='l-left'>City:</div>";
                                $utrust .= "<div class='l-right'>";
                                $utrust .= "<input type='text' name='utrust-city' value='".$wt[0]->city."' />";
                                $utrust .= "</div>";

                                $utrust .= "<div class='l-left'>Pincode:</div>";
                                $utrust .= "<div class='l-right'>";
                                $utrust .= "<input type='text' name='utrust-zip' value='".$wt[0]->zip."' />";
                                $utrust .= "</div>";

                                $utrust .= "<div class='l-left'>Continent:</div>";
                                $utrust .= "<div class='l-right'>";
                                $utrust .= "<input type='text' name='utrust-continent' value='".$wt[0]->continent."' />";
                                $utrust .= "</div>";

                                $utrust .= "<div class='l-left'>Latitude:</div>";
                                $utrust .= "<div class='l-right'>";
                                $utrust .= "<input type='text' name='utrust-latitude' value='".$wt[0]->latitude."'  />";
                                $utrust .= "</div>";

                                $utrust .= "<div class='l-left'>Longitude:</div>";
                                $utrust .= "<div class='l-right'>";
                                $utrust .= "<input type='text' name='utrust-longitude' value='".$wt[0]->longitude."' />";
                                $utrust .= "</div>";

                                $utrust .="<input type='hidden' name='update-trust' id='update-trust' value='trust' />";
                                $utrust .="<input type='submit' value='Update Trust' />";

                                $utrust .="</form>";

                                echo "<div id='u-trust' style='width:800px;'>".$utrust."</div>";

                                        if($_POST['update-trust'])     
                                        {
                                             echo "Update to trust initiated. Result below for location Id: ";
                                                $trid = $_GET['update-trust'];
                                                $aname = $_POST['utrust-name'];
                                                $aemail = $_POST['utrust-email'];
                                                $aphone = $_POST['utrust-phone'];
                                                $afax = $_POST['utrust-fax'];
                                                $adesc = $_POST['utrust-description'];
                                                $aurl = $_POST['utrust-url'];
                                                $aadd1 = $_POST['utrust-address1'];
                                                $aadd2 = $_POST['utrust-address2'];
                                                $aadd3 = $_POST['utrust-address3'];
                                                $acountry = $_POST['utrust-country'];
                                                $azip = $_POST['utrust-zip'];
                                                $astate = $_POST['utrust-state'];
                                                $acity = $_POST['utrust-city'];
                                                $acon = $_POST['utrust-continent'];
                                                $alat = $_POST['utrust-latitude'];
                                                $along = $_POST['utrust-longitude'];
                                                $a_up = date('Y-m-d H:i:s');
                                                $aact = $_POST['utrust-activities'];
                                                print_r($trid);
                                                $updated = $wpdb->update(
                                                    'wp_location',
                                                    array(
                                                            'name' => $aname,       // string
                                                            'email' => $aemail,
                                                            'phone' => $aphone,
                                                            'fax' => $afax,
                                                            'description' => $adesc,
                                                            'url' => $aurl,
                                                            'address1' => $aadd1,
                                                            'address2' => $aadd2,
                                                            'address3' => $aadd3,
                                                            'city' => $acity,
                                                            'state' => $astate,
                                                            'country' => $acountry,
                                                            'zip' => $azip,
                                                            'continent' => $acon,
                                                            'latitude' => $alat,
                                                            'longitude' => $along,
                                                            'updated_on' => $a_up,
                                                            'activities' => $aact
                                                    ),
                                                    array( 'ID' => $trid ),
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
                                                            '%f',
                                                            '%f',
                                                            '%s',
                                                            '%s'
                                                    ),
                                                    array( '%d' )
                                                    );
                                        
                                            if ( false === $updated ) 
                                            {
                                                    echo '<div style="color:red">Record failed to update. Error: '.$wpdb->last_error.'</div>';
                                            } 
                                            else 
                                            {
                                                    echo "<div style='color:green'>Record updated successfully</div>";
                                            }
                                        }
                                        else
                                        {
                                             echo "No update to trust record yet ";
                                        }

            }

            //pagination
            $num_trust = $wpdb->get_results("SELECT count(*) as total_nr FROM `wp_location` WHERE `location_type` LIKE 'trust'  ");
            $n_group = $num_trust[0]->total_nr;
            $n_x_group = 49;
            $n_pages = (($n_group / $n_x_group) < 1 ? 1 : ($n_group / $n_x_group));
            $p=0;

            if( isset($_REQUEST['p'])) {
                    $p=$_REQUEST['p'];
            }

            function get_page2_scrolling ($n_group,$p,$n_pages)
            {
                    $base_url ='/wp-admin/admin.php?page=trust';
                    $scroll='';

                    if ($n_pages > 1)
                    {
                            if ($p >= 1)
                            {
                                    $scroll ='<div id="prev_btn" style="float:left;"><a style="padding-right:30px;" href="'.$base_url.'&p='.($p - 49).'">Previous</a></div>';
                            }
                            if ($p < ($n_pages - 1)) {
                                    $scroll .= '<div id="next_btn" style="float:right;margin-right: 21px;"><a style="padding-right:43px;" href="'.$base_url.'&p='.($p + 49).'">Next</a></div>';
                            }

                            if (trim($scroll) != "1")
                            {
                                    return $scroll;
                            }
                    }
                    return $scroll;
            }
            $scrolling2 = get_page2_scrolling($n_group,$p,$n_pages);

            echo "<h2>Trust</h2>";
            echo "<div class='l-pagination'>".$scrolling2."</div>";
            $ws_details = $wpdb->get_results(
                                        "SELECT * FROM `wp_location` 
                                         WHERE `location_type` 
                                         LIKE 'trust' 
                                         LIMIT $p , $n_x_group"
                                        );
            //print_r($ws_details);

            echo "<div class='loc-table-div' >";
            echo "<table class='loc-table'style='empty-cells:show;'>";
                    echo "<th>ID</th>";
    		        echo "<th>Location ID</th>";
                    echo "<th>Name</th>";
                    echo "<th>Email</th>";
                    echo "<th>Phone</th>";
                    echo "<th>Fax</th>";
                    echo "<th>Decription</th>";
                    echo "<th>Url</th>";
                    echo "<th>Activities</th>";
                    echo "<th>Adress 1</th>";
                    echo "<th>Address 2</th>";
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
                            echo "<td>".$data->email."</td>";
                            echo "<td>".$data->phone."</td>";
                            echo "<td>".$data->fax."</td>";
                            echo "<td>".$data->description."</td>";
                            echo "<td>".$data->url."</td>";
                            echo "<td>".$data->activities."</td>";
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
                            echo "<td><a href='/wp-admin/admin.php?page=trust&update-trust=".$data->id."'>Edit</a></td>";
                            echo "<td><a href='/wp-admin/admin.php?page=trust&delete-trust=".$data->id."'>Delete</a></td>";
                            echo "</tr>";

                    }
            echo "</table>";
            echo "</div>";
    }//function display_trust ends
?>