<?php
	function display_chord() 
    {
        global $wpdb;
        if($_GET['delete-chord']) 
        {
            $ad = $_GET['delete-chord'];
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
                       echo '<div style="color:green">Record Deleted for CORD - ID '.$cd;
                    }
        }
        if ($_GET['update-chord']) 
        {

            $coid = $_GET['update-chord'];
            echo "Update Cord";
            global $wpdb;
            $wco = $wpdb->get_results(
                            "SELECT * FROM `wp_location` 
                            WHERE `id` = $coid 
                            AND `location_type`
                            LIKE 'chord'"
                            );
            if (false===$wco)
                      {
                        echo'<div style="color:red">Record failed query. Error: '.$wpdb->last_error.'</div>';
                      } 

            $uchord ='';
            $uchord .="<form method='post' action=''>";

            $uchord .= "<div class='l-left'>Name:</div>";
            $uchord .= "<div class='l-right'>";
            $uchord .= "<input type='text' name='uchord-name' value='".$wco[0]->name."' />";
            $uchord .= "</div>";

            $uchord .= "<div class='l-left'>Location:</div>";
            $uchord .= "<div class='l-right'>";
            $uchord .= "<input type='text' name='uchord-location' value='".$wco[0]->location."' />";
            $uchord .= "</div>";

            $uchord .= "<div class='l-left'>Address 1:</div>";
            $uchord .= "<div class='l-right'>";
            $uchord .= "<input type='text' name='uchord-address1' value='".$wco[0]->address1."' />";
            $uchord .= "</div>";

            $uchord .= "<div class='l-left'>Address 2:</div>";
            $uchord .= "<div class='l-right'>";
            $uchord .= "<input type='text' name='uchord-address2' value='".$wco[0]->address2."' />";
            $uchord .= "</div>";

            $uchord .= "<div class='l-left'>Postal Code:</div>";
            $uchord .= "<div class='l-right'>";
            $uchord .= "<input type='text' name='uchord-address3' value='".$wco[0]->address3."' />";
            $uchord .= "</div>";

            $uchord .= "<div class='l-left'>Country:</div>";
            $uchord .= "<div class='l-right'>";
            $uchord .= "<input type='text' name='uchord-country' value='".$wco[0]->country."' />";
            $uchord .= "</div>";

            $uchord .= "<div class='l-left'>State:</div>";
            $uchord .= "<div class='l-right'>";
            $uchord .= "<input type='text' name='uchord-state' value='".$wco[0]->state."' />";
            $uchord .= "</div>";

            $uchord .= "<div class='l-left'>City:</div>";
            $uchord .= "<div class='l-right'>";
            $uchord .= "<input type='text' name='uchord-city' value='".$wco[0]->city."' />";
            $uchord .= "</div>";

            $uchord .= "<div class='l-left'>Continent:</div>";
            $uchord .= "<div class='l-right'>";
            $uchord .= "<input type='text' name='uchord-continent' value='".$wco[0]->continent."' />";
            $uchord .= "</div>";

            $uchord .= "<div class='l-left'>Location Incharge:</div>";
            $uchord .= "<div class='l-right'>";
            $uchord .= "<input type='text' name='uchord-location_incharge' value='".$wco[0]->location_incharge."' />";
            $uchord .= "</div>";

            $uchord .= "<div class='l-left'>Phone:</div>";
            $uchord .= "<div class='l-right'>";
            $uchord .= "<input type='text' name='uchord-phone' value='".$wco[0]->phone."' />";
            $uchord .= "</div>";

            $uchord .= "<div class='l-left'>Email:</div>";
            $uchord .= "<div class='l-right'>";
            $uchord .= "<input type='text' name='uchord-email' value='".$wco[0]->email."' />";
            $uchord .= "</div>";



            $uchord .="<input type='hidden' name='update-chord' id='update-chord' value='chord' />";
            $uchord .="<input type='submit' value='Update cord' />";

            $uchord .="</form>";

            echo "<div id='u-chord' style='width:800px;'>".$uchord."</div>";

            if($_POST['update-chord'])     
            {
                echo "Update to CORD initiated. Result below for location Id: ";
                $coid = $_GET['update-chord'];
                $clocation = $_POST['uchord-location'];
                $cname = $_POST['uchord-name'];
                $cadd1 = $_POST['uchord-address1'];
                $cadd2 = $_POST['uchord-address2'];
                $cadd3 = $_POST['uchord-address3'];
                $ccountry = $_POST['uchord-country'];
                $cstate = $_POST['uchord-state'];
                $ccity = $_POST['uchord-city'];
                $ccon = $_POST['uchord-continent'];
                $clocation_incharge = $_POST['uchord-location_incharge'];
                $cphone = $_POST['uchord-phone'];
                $cemail = $_POST['uchord-email'];
                print_r($coid);
                $updated = $wpdb->update(
                                'wp_location',
                                array(
                                'location' => $clocation,
                                'name' => $cname,
                                'address1' => $cadd1,
                                'address2' => $cadd2,
                                'address3' => $cadd3,
                                'city' => $ccity,
                                'state' => $cstate,
                                'country' => $ccountry,
                                'continent' => $ccon,
                                'location_incharge' => $clocation_incharge,
                                'phone' => $cphone,
                                'email' => $cemail,
                                 ),
                                array( 'ID' => $coid ),
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
                echo "No update to CORD record yet ";
            }
        }
        //paginating the contents
        $num_chord = $wpdb->get_results("SELECT count(*) as total_nr FROM `wp_location` WHERE `location_type` LIKE 'chord '  ");
        $n_group = $num_chord[0]->total_nr;
        $n_x_group = 49;
        $n_pages = (($n_group / $n_x_group) < 1 ? 1 : ($n_group / $n_x_group));
        $p=0;
        if(isset($_REQUEST['p'])){
            $p=$_REQUEST['p'];
        }
        function get_page2_scrolling ($n_group,$p,$n_pages)
        {
            $base_url ='/wp-admin/admin.php?page=chord ';
            $scroll='';

            if ($n_pages > 1)
            {
                if ($p >= 1)
                {
                    $scroll ='<div id="prev_btn" style="float:left;"><a style="padding-right:30px;" href="'.$base_url.'&p='.($p - 49).'">Previous</a></div>';
                }
                if ($p < ($n_pages - 1)) 
                {
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
        echo "<h2>CORD </h2>";
        echo "<div class='l-pagination'>".$scrolling2."</div>";
        $ws_details = $wpdb->get_results(
                        "SELECT * FROM `wp_location` 
                        WHERE `location_type` LIKE 'chord'
                        ORDER BY 'name' ASC
                        LIMIT $p , $n_x_group"
                        );
        echo "<div class='loc-table-div'>";
        echo "<table class='loc-table' style='empty-cells:show;'>";
            echo "<th>ID</th>";
            echo "<th>Location Id</th>";
            echo "<th>Name</th>";
            echo "<th>Location</th>";
            echo "<th>Adress 1</th>";
            echo "<th>Address 2</th>";
            echo "<th>Postal Code</th>";
            echo "<th>City</th>";
            echo "<th>State</th>";
            echo "<th>Country</th>";
            echo "<th>Continent</th>";
            echo "<th>Location Incharge</th>";
            echo "<th>Phone</th>";
            echo "<th>Email</th>";
            echo "<th></th>";
            echo "<th></th>";
            foreach ($ws_details as $data) 
            {
                $i++;
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td>".$data->id."</td>";
                echo "<td>".$data->name."</td>";
                echo "<td>".$data->location."</td>";
                echo "<td>".$data->address1."</td>";
                echo "<td>".$data->address2."</td>";
                echo "<td>".$data->address3."</td>";
                echo "<td>".$data->city."</td>";
                echo "<td>".$data->state."</td>";
                echo "<td>".$data->country."</td>";
                echo "<td>".$data->continent."</td>";
                echo "<td>".$data->location_incharge."</td>";
                echo "<td>".$data->phone."</td>";
                echo "<td>".$data->email."</td>";
                echo "<td><a href='/wp-admin/admin.php?page=chord&update-chord=".$data->id."'>Edit</a></td>";
                echo "<td><a href='/wp-admin/admin.php?page=chord&delete-chord=".$data->id."'>Delete</a></td>";
                echo "</tr>";
            }
        echo "</table>";
        echo "</div>";
    }//function display_chord ends
?>