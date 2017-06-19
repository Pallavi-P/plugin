<?php
    function display_ashram() {

        global $wpdb;

        if($_GET['delete-ashram']) {

            $ad = $_GET['delete-ashram'];

            $wpdb->query(
                    $wpdb->prepare(
                            "
                            DELETE FROM wp_location
                            WHERE id = %d
                            ",
                            $ad
                    )
            );

            echo "Record Deleted for Ashram - ID ".$ad;

            }

        if ($_GET['update-ashram'])
        {
            //updating ashram. update-ashram parameter sent from edit link click

            $aid = $_GET['update-ashram'];
            echo "Update Ashram";
            $wa = $wpdb->get_results("SELECT * FROM `wp_location` WHERE `id` = $aid AND `location_type` LIKE 'ashram'");
            $uashram ='';
            $uashram .="<form method='post' action=''>";
                $uashram .= "<div class='l-left'>Name:</div>";
                $uashram .= "<div class='l-right'>";
                    $uashram .= "<input type='text' name='uashram-name' value='".$wa[0]->name."' />";
                $uashram .= "</div>";

                $uashram .= "<div class='l-left'>Acharya:</div>";                
                $uashram .= "<div class='l-right'>";
                    $uashram .= "<select name = 'uashram-acharya'>";
                        $uashram .= "<option value=''>Select Acharya Here</option>";
                            foreach(
                                    $wpdb->get_results(
                                            "SELECT id,profile_id,salutation,last_name 
                                            FROM `wp_acharya` 
                                            ORDER BY salutation,last_name 
                                            ASC") 
                                    as $key => $row)
                                    {
                                        $uashram .= "<option value=" . $row->profile_id . ">" . $row->salutation . " " . $row->last_name . "</option>";
                                    }
                    $uashram .= "</select>";
                $uashram .= "</div>";
                $uashram .= "<div class='l-left'>Activities:</div>";
                $uashram .= "<div class='l-right'>";
                    $uashram .= "<textarea name='uashram-activities' rows='10' cols='20'>".$wa[0]->activities."</textarea>";
                $uashram .= "</div>";
                $uashram .= "<div class='l-left'>Phone:</div>";
                $uashram .= "<div class='l-right'>";
                    $uashram .= "<input type='text' name='uashram-phone' value='".$wa[0]->phone."' />";
                $uashram .= "</div>";
                $uashram .= "<div class='l-left'>email:</div>";
                $uashram .= "<div class='l-right'>";
                    $uashram .= "<input type='text' name='uashram-email' value='".$wa[0]->email."' />";
                $uashram .= "</div>";
                $uashram .= "<div class='l-left'>fax:</div>";
                $uashram .= "<div class='l-right'>";
                    $uashram .= "<input type='text' name='uashram-fax' value='".$wa[0]->fax."' />";
                $uashram .= "</div>";
                $uashram .= "<div class='l-left'>Description:</div>";
                $uashram .= "<div class='l-right'>";
                $uashram .= "<textarea name='uashram-description' rows='10' cols='20'>".$wa[0]->description."</textarea>";
                $uashram .= "</div>";
                $uashram .= "<div class='l-left'>address 1:</div>";
                $uashram .= "<div class='l-right'>";
                    $uashram .= "<textarea name='uashram-address1' rows='10' cols='20'>".$wa[0]->address1."</textarea>";
                $uashram .= "</div>";

                $uashram .= "<div class='l-left'>Address 2:</div>";
                $uashram .= "<div class='l-right'>";
                    $uashram .= "<textarea name='uashram-address2' rows='10' cols='20'>".$wa[0]->address2."</textarea>";
                $uashram .= "</div>";

                $uashram .= "<div class='l-left'>Address 3:</div>";
                $uashram .= "<div class='l-right'>";
                $uashram .= "<textarea name='uashram-address3' rows='10' cols='20'>".$wa[0]->address3."</textarea>";
                $uashram .= "</div>";

                $uashram .= "<div class='l-left'>Country:</div>";
                $uashram .= "<div class='l-right'>";
                    $uashram .= "<input type='text' name='uashram-country' value='".$wa[0]->country."' />";
                $uashram .= "</div>";

                $uashram .= "<div class='l-left'>State:</div>";
                $uashram .= "<div class='l-right'>";
                    $uashram .= "<input type='text' name='uashram-state' value='".$wa[0]->state."' />";
                $uashram .= "</div>";

                $uashram .= "<div class='l-left'>City:</div>";
                $uashram .= "<div class='l-right'>";
                    $uashram .= "<input type='text' name='uashram-city' value='".$wa[0]->city."' />";
                $uashram .= "</div>";

                $uashram .= "<div class='l-left'>Pincode:</div>";
                $uashram .= "<div class='l-right'>";
                    $uashram .= "<input type='text' name='uashram-zip' value='".$wa[0]->zip."' />";
                $uashram .= "</div>";

                $uashram .= "<div class='l-left'>Continent:</div>";
                $uashram .= "<div class='l-right'>";
                    $uashram .= "<input type='text' name='uashram-continent'value='".$wa[0]->continent."' >";
                $uashram .= "</div>";

                $uashram .= "<div class='l-left'>Latitude:</div>";
                $uashram .= "<div class='l-right'>";
                    $uashram .= "<input type='text' name='uashram-latitude' value='".$wa[0]->latitude."'  />";
                $uashram .= "</div>";

                $uashram .= "<div class='l-left'>Longitude:</div>";
                $uashram .= "<div class='l-right'>";
                    $uashram .= "<input type='text' name='uashram-longitude' value='".$wa[0]->longitude."' />";
                $uashram .= "</div>";
                $uashram .= "<div class='l-left'>Contact:</div>";
                $uashram .= "<div class='l-right'>";
                    $uashram .= "<input type='text' name='uashram-contact' value='".$wa[0]->contact."'/>";
                $uashram .= "</div>";
                $uashram .="<input type='hidden' name='update-ashram' id='update-ashram' value='ashram' />";
                $uashram .="<input type='submit' value='Update Ashram' />";
            $uashram .="</form>";

            echo "<div id='u-ashram' style='width:800px;'>".$uashram."</div>";
            if($_POST['update-ashram']){
                echo "Update to ashram initiated. Result below for location Id:";
                $aid = $_GET['update-ashram'];
                $aname = $_POST['uashram-name'];
                $aacharya = $_POST['uashram-acharya'];
                $aphone = $_POST['uashram-phone'];
                $aemail = $_POST['uashram-email'];
                $afax = $_POST['uashram-fax'];
                $adesc = $_POST['uashram-description'];
                $aurl = $_POST['uashram-url'];
                $aadd1 = $_POST['uashram-address1'];
                $aadd2 = $_POST['uashram-address2'];
                $aadd3 = $_POST['uashram-address3'];
                $acountry = $_POST['uashram-country'];
                $astate = $_POST['uashram-state'];
                $acity = $_POST['uashram-city'];
                $azip = $_POST['uashram-zip'];
                $acon = $_POST['uashram-continent'];
                $alat = $_POST['uashram-latitude'];
                $along = $_POST['uashram-longitude'];
                $a_up = date('Y-m-d H:i:s');
                $aact = $_POST['uashram-activities'];
                print_r($aid);
                $updated=$wpdb->update
                (
                    'wp_location',
                    array(
                        'name' => $aname,       // string
                        'acharya' => $aacharya,
                        'phone' => $aphone,
                        'email' => $aemail,
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
                    array( 'ID' => $aid ),
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
                        '%f',
                        '%f',
                        '%s',
                        '%s'
                    ),
                    array( '%d' )
                );
                if ( false === $updated ) {
                        echo "<div style='color:red'>Failed to update record.</div>";
                } else 
                {
                    echo "<div style='color:green'>Record updated successfully</div>";
                }
            }
        }
        else
        {
            echo "No update to ashram record yet ";

        }

        //pagination
        $num_ashram = $wpdb->get_results("SELECT count(*) as total_nr FROM `wp_location` WHERE `location_type` LIKE 'ashram'  ");
        $n_group = $num_ashram[0]->total_nr;
        $n_x_group = 49;
        $n_pages = (($n_group / $n_x_group) < 1 ? 1 : ($n_group / $n_x_group));
        $p=0;
        if( isset($_REQUEST['p'])) {
            $p=$_REQUEST['p'];
        }
        function get_page2_scrolling ($n_group,$p,$n_pages){
            $base_url ='/wp-admin/admin.php?page=ashram';
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
        echo "<h2>Ashram</h2>";
        echo "<div class='l-pagination'>".$scrolling2."</div>";
        $ws_details = $wpdb->get_results("SELECT * FROM `wp_location` WHERE `location_type` LIKE 'ashram' LIMIT $p , $n_x_group");
        echo "<div class='loc-table-div'>";
        echo "<table class='loc-table'style='empty-cells:show;'>";
            echo "<th>ID</th>";
            echo "<th>Location ID</th>";
            echo "<th>Name</th>";
            echo "<th>Acharya</th>";
            echo "<th>Phone</th>";
            echo "<th>Email</th>";
            echo "<th>Fax</th>";
            echo "<th>Decription</th>";
            echo "<th>Url</th>";
            echo "<th>Activities</th>";
            echo "<th>Address 1</th>";
            echo "<th>Address 2</th>";
            echo "<th>Address 3</th>";
            echo "<th>City</th>";
            echo "<th>State</th>";
            echo "<th>Country</th>";
            echo "<th>Pincode</th>";
            echo "<th>Contact</th>";
            echo "<th>Continent</th>";
            echo "<th>Latitude</th>";
            echo "<th>Longitude</th>";
            echo "<th>Added On</th>";
            echo "<th>Updated On</th>";
            echo "<th>Edit Ashram</th>";
            echo "<th>Delete Ashram</th>";

            foreach ($ws_details as $data) {
                $ach_details = $wpdb->get_row("SELECT salutation,last_name FROM `wp_acharya` WHERE profile_id =" .$data->acharya );
                //var_dump($ach_details);
                $i++;
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td>".$data->id."</td>";
                echo "<td>".$data->name."</td>";
                echo "<td>".$ach_details->salutation." ".$ach_details->last_name."</td>";
                echo "<td>".$data->phone."</td>";
                echo "<td>".$data->email."</td>";
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
                echo "<td>".$data->contact."</td>";
                echo "<td>".$data->continent."</td>";
                echo "<td>".$data->latitude."</td>";
                echo "<td>".$data->longitude."</td>";
                echo "<td>".$data->added_on."</td>";
                echo "<td>".$data->updated_on."</td>";
                echo "<td><a href='/wp-admin/admin.php?page=ashram&update-ashram=".$data->id."'>Edit</a></td>";
                echo "<td><a href='/wp-admin/admin.php?page=ashram&delete-ashram=".$data->id."'>Delete</a></td>";
                echo "</tr>";

            }
        echo "</table>";
        echo "</div>";
    }//function display ashram ends
?>