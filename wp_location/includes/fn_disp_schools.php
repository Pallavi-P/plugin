<?php
	function display_school() {
        global $wpdb;      

        if($_GET['delete-school']) {

            $cd = $_GET['delete-school'];
                $del= $wpdb->query(
                        $wpdb->prepare(
                            "DELETE FROM wp_school
                            WHERE id = %d
                            ",
                            $cd
                            )
                        ); 
                if (false===$del)
                {
                    echo'<div style="color:red">Record deleting failed. Error: '.$wpdb->last_error.'</div>';
                }
                else
                {   
                   echo '<div style="color:green">Record Deleted for School - ID '.$cd;
                }

        }

        if ($_GET['update-school']) {
            $wid = $_GET['update-school'];
            echo "Update School";
            $ws = $wpdb->get_results(
                            "SELECT * FROM `wp_school` 
                            WHERE `id` = $wid 
                            AND `school_type` 
                            LIKE 'school'"
                            );
            if (false===$ws)
                      {
                        echo'<div style="color:red">Record failed query. Error: '.$wpdb->last_error.'</div>';
                      }   
                         
            
            $uschool ='';
            $uschool .="<form method='post' action=''>";
            $uschool .= "<div class='l-left'>Name:</div>";
            $uschool .= "<div class='l-right'>";
            $uschool .= "<input type='text' name='uschool-name' value='".$ws[0]->name."' />";
            $uschool .= "</div></br>";

            $uschool .= "<div class='l-left'>Description:</div>";
            $uschool .= "<div class='l-right'>";
            $uschool .= "<textarea name='uschool-description' rows='10' cols='20'>".$ws[0]->description."</textarea>";
            $uschool .= "</div></br>";

            $uschool .= "<div class='l-left'>Url:</div>";
            $uschool .= "<div class='l-right'>";
            $uschool .= "<input type='text' name='uschool-url' value='".$ws[0]->url."' />";
            $uschool .= "</div></br>";

            $uschool .= "<div class='l-left'>Address 1:</div>";
            $uschool .= "<div class='l-right'>";
            $uschool .= "<textarea name='uschool-address1' rows='10' cols='20'>".$ws[0]->address1."</textarea>";
            $uschool .= "</div></br>";

            $uschool .= "<div class='l-left'>Address 2:</div>";
            $uschool .= "<div class='l-right'>";
            $uschool .= "<textarea name='uschool-address2' rows='10' cols='20'>".$ws[0]->address2."</textarea>";
            $uschool .= "</div></br>";

            $uschool .= "<div class='l-left'>Address 3:</div>";
            $uschool .= "<div class='l-right'>";
            $uschool .= "<textarea name='uschool-address3' rows='10' cols='20'>".$ws[0]->address3."</textarea>";
            $uschool .= "</div></br>";

            $uschool .= "<div class='l-left'>Country:</div>";
            $uschool .= "<div class='l-right'>";
            $uschool .= "<input type='text' name='uschool-country' value='".$ws[0]->country."' />";
            $uschool .= "</div></br>";

            $uschool .= "<div class='l-left'>State:</div>";
            $uschool .= "<div class='l-right'>";
            $uschool .= "<input type='text' name='uschool-state' value='".$ws[0]->state."' />";
            $uschool .= "</div></br>";

            $uschool .= "<div class='l-left'>City:</div>";
            $uschool .= "<div class='l-right'>";
            $uschool .= "<input type='text' name='uschool-city' value='".$ws[0]->city."' />";
            $uschool .= "</div></br>";

            $uschool .= "<div class='l-left'>Pincode:</div>";
            $uschool .= "<div class='l-right'>";
            $uschool .= "<input type='text' name='uschool-zip' value='".$ws[0]->zip."' />";
            $uschool .= "</div></br>";

            $uschool .= "<div class='l-left'>Continent:</div>";
            $uschool .= "<div class='l-right'>";
            $uschool .= "<input type='text' name='uschool-continent'value='".$ws[0]->continent."' >";
            $uschool .= "</div></br>";

            $uschool .= "<div class='l-left'>Phone:</div>";
            $uschool .= "<div class='l-right'>";
            $uschool .= "<input type='text' name='uschool-phone' value='".$ws[0]->phone."'  />";
            $uschool .= "</div></br>";

            $uschool .= "<div class='l-left'>email:</div>";
            $uschool .= "<div class='l-right'>";
            $uschool .= "<input type='text' name='uschool-email' value='".$ws[0]->email."' />";
            $uschool .= "</div></br>";
            $uschool .= "<div class='l-left'>Affiliation:</div>";
            $uschool .= "<div class='l-right'>";
            $uschool .= "<input type='text' name='uschool-affiliation' value='".$ws[0]->affiliation."'/>";
            $uschool .= "</div></br>";

            $uschool .="<input type='hidden' name='update-school' id='update-school' value='school' />";
            $uschool .="<input type='submit' value='Update School' />";

            $uschool .="</form>";

            echo "<div id='u-school' style='width:800px;'>".$uschool."</div>";

            if($_POST['update-school']) 
            {
                echo "Update to school initiated. Result below for location Id: ";
                $uid = $_GET['update-school'];
                $uname = $_POST['uschool-name'];
                $udesc = $_POST['uschool-description'];
                $uurl = $_POST['uschool-url'];
                $uadd1 = $_POST['uschool-address1'];
                $uadd2 = $_POST['uschool-address2'];
                $uadd3 = $_POST['uschool-address3'];
                $uzip = $_POST['uschool-zip'];
                $ucountry = $_POST['uschool-country'];
                $ustate = $_POST['uschool-state'];
                $ucity = $_POST['uschool-city'];
                $ucont = $_POST['uschool-continent'];
                $uphone = $_POST['uschool-phone'];
                $uemail = $_POST['uschool-email'];
                $uaffiliation = $_POST['uschool-affiliation'];
                 print_r($uid);
                $updated = $wpdb->update(
                                    'wp_school',
                                    array(
                                            'name' => $uname,   // string
                                            'description' => $udesc,
                                            'url' => $uurl,
                                            'address1' => $uadd1,
                                            'address2' => $uadd2,
                                            'address3' => $uadd3,
                                            'zip' => $uzip,
                                            'city' => $ucity,
                                            'state' => $ustate,
                                            'country' => $ucountry,
                                            'continent' => $ucont,
                                            'phone' => $uphone,
                                            'email' => $uemail,
                                            'affiliation' => $uaffiliation,
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
                    echo "No update to school record yet ";
            }

        }
        //pagination
        $num_school = $wpdb->get_results("SELECT count(*) as total_nr FROM `wp_school` WHERE `lschool_type` LIKE 'school'");
        //$num_school = 4;
        $n_school = $num_school[0]->total_nr;
        $n_x_school = 49;
        $n_school = (($n_school / $n_x_school) < 1 ? 1 : ($n_school / $n_x_school));
        $pschool=0;
        if( isset($_REQUEST['pschool'])) {
            $pschool=$_REQUEST['pschool'];
        }
        function get_page1_scrolling ($n_school,$pschool,$n_school) {
            $base_url ='/wp-admin/admin.php?page=school';
            $scroll1 ='';

            if ($n_school> 1)
            {
                if ($pschool >= 1)
                {
                    $scroll1 ='<div id="prev_btn" style="float:left;"><a style="padding-right:30px;" href="'.$base_url.'&pschool='.($pschool - 49).'">Previous</a></div>';
                }
                if ($pschool < ($n_cschool- 1)) {
                    $scroll1 .= '<div id="next_btn" style="float:right;margin-right: 21px;"><a style="padding-right:43px;" href="'.$base_url.'&pcenter='.($pcenter + 49).'">Next</a></div>';
                }

                if (trim($scroll1) != "1")
                {
                    return $scroll1;
                }
            }
            return $scroll1;
        }
        $scrolling = get_page1_scrolling($n_school,$pschool,$n_cschool);
        echo "<h2>School</h2>";
        echo "<div class='l-pagination'>".$scrolling."</div>";
        $ws_details = $wpdb->get_results("SELECT * FROM `wp_school` WHERE `school_type` LIKE 'school' ORDER BY `name` ASC ");
        //print_r($ws_details);
        echo "<div class='loc-table-div'>";
        echo "<table class='loc-table'style='empty-cells:show;'>";
            echo "<th>ID</th>";
            echo "<th>Location ID</th>";
            echo "<th>Name</th>";
            echo "<th>Decription</th>";
            echo "<th>Url</th>";
            echo "<th>Adress 1</th>";
            echo "<th>Address 2</th>";
            echo "<th>Address 3</th>";
            echo "<th>City</th>";
            echo "<th>State</th>";
            echo "<th>Country</th>";
            echo "<th>Pincode</th>";
            echo "<th>Continent</th>";
            echo "<th>Phone</th>";
            echo "<th>Email</th>";
            echo "<th>Affiliation</th>";
            echo "<th></th>";
            echo "<th></th>";

            foreach ($ws_details as $data) {
                $i++;
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td>".$data->id."</td>";
                echo "<td>".$data->name."</td>";
                echo "<td>".$data->description."</td>";
                echo "<td>".$data->url."</td>";
                echo "<td>".$data->address1."</td>";
                echo "<td>".$data->address2."</td>";
                echo "<td>".$data->address3."</td>";
                echo "<td>".$data->city."</td>";
                echo "<td>".$data->state."</td>";
                echo "<td>".$data->country."</td>";
                echo "<td>".$data->zip."</td>";
                echo "<td>".$data->continent."</td>";
                echo "<td>".$data->phone."</td>";
                echo "<td>".$data->email."</td>";
                echo "<td>".$data->affiliation."</td>";
                echo "<td><a href='/wp-admin/admin.php?page=school&update-school=".$data->id."'>Edit</a></td>";
                echo "<td><a href='/wp-admin/admin.php?page=school&delete-school=".$data->id."'>Delete</a></td>";
                echo "</tr>";
            }
        echo "</table>";
        echo "</div>";
    }//function display school ends
?>