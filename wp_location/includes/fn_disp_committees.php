<?php
    
    function display_committee() 
    {
        global $wpdb;
        if($_GET['delete-committee']) 
        {

            $ad = $_GET['delete-committee'];

            $wpdb->query(
                    $wpdb->prepare(
                            "
                                DELETE FROM wp_committee
                                WHERE id = %d
                            ",
                            $ad
                    )
            );
            echo "Record Deleted for ID ".$ad;
        }

        if($_GET['update-committee']) 
        {

            $cid = $_GET['update-committee'];
            echo "Update Committee";
            $wa = $wpdb->get_results("SELECT * FROM `wp_committee` WHERE `id` = $cid");
            $ucommittee ='';
            $ucommittee .="<form method='post' action=''>";
            $ucommittee .= "<div class='l-left'>User:</div>";
            $ucommittee .= "<div class='l-right'>";
            $ucommittee .= "<input type='text' name='ucommittee-user' value='".$wa[0]->user."' />";
            $ucommittee .= "</div>";

            $ucommittee .= "<div class='l-left'>Centre:</div>";
            $ucommittee .= "<div class='l-right'>";
            $ucommittee .= "<input type='text' name='ucommittee-centre' value='".$wa[0]->center."'/>";
            $ucommittee .= "</div>";

            $ucommittee .= "<div class='l-left'>Member Type:</div>";
            $ucommittee .= "<div class='l-right'>";
            $ucommittee .= "<input type='text' name='ucommittee-type' value='".$wa[0]->member_type."' />";
            $ucommittee .= "</div>";

            $ucommittee .= "<div class='l-left'>Name:</div>";
            $ucommittee .= "<div class='l-right'>";
            $ucommittee .= "<input type='text' name='ucommittee-name' value='".$wa[0]->name."' />";
            $ucommittee .= "</div>";

            $ucommittee .= "<div class='l-left'>Phone:</div>";
            $ucommittee .= "<div class='l-right'>";
            $ucommittee .= "<input type='text' name='ucommittee-phone' value='".$wa[0]->phone."' />";
            $ucommittee .= "</div>";

            $ucommittee .= "<div class='l-left'>Email:</div>";
            $ucommittee .= "<div class='l-right'>";
            $ucommittee .= "<input type='text' name='ucommittee-email' value='".$wa[0]->email."' />";
            $ucommittee .= "</div>";

            $ucommittee .="<input type='hidden' name='update-committee' id='update-committee' value='committee' />";
            $ucommittee .="<input type='submit' value='Update committee' />";

            $ucommittee .="</form>";

            echo "<div id='u-committee' style='width:800px;'>".$ucommittee."</div>";

            if($_POST['update-committee'])     
            {
                $cid = $_GET['update-committee'];
                $cuser = $_POST['ucommittee-user'];
                $ccentre = $_POST['ucommittee-centre'];
                $cmember = $_POST['ucommittee-type'];
                $cname = $_POST['ucommittee-name'];
                $cphone = $_POST['ucommittee-phone'];
                $cemail = $_POST['ucommittee-email'];

                $wpdb->update(
                            'wp_committee',
                            array(
                                'user' => $cuser,       // string
                                'center' => $ccentre,
                                'member_type' => $cmember,
                                'name' => $cname,
                                'phone' => $cphone,
                                'email' => $cemail,

                            ),
                            array( 'ID' => $cid ),
                            array(
                                '%s',
                                '%s',
                                '%s',
                                '%s',
                                '%s',
                                '%s'
                            ),
                            array( '%d' )
                        );
            }
        }

        //pagination
        $num_committee= $wpdb->get_results("SELECT count(*) as total_nr FROM `wp_committee`");
        $n_group = $num_committee[0]->total_nr;
        $n_x_group = 49;
        $n_pages = (($n_group / $n_x_group) < 1 ? 1 : ($n_group / $n_x_group));
        $p=0;

       if( isset($_REQUEST['p'])) 
        {
            $p=$_REQUEST['p'];
        }


        function get_page2_scrolling ($n_group,$p,$n_pages)
        {
            $base_url ='/wp-admin/admin.php?page=committee';
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
        }//function get_page2_scrolling ends
        
        $scrolling2 = get_page2_scrolling($n_group,$p,$n_pages);
        echo "<h2>Committee</h2>";
        echo "<div class='l-pagination'>".$scrolling2."</div>";
        $ws_details = $wpdb->get_results("SELECT * FROM `wp_committee`  LIMIT $p , $n_x_group");
        //print_r($ws_details);
        echo "<div class='loc-table-div' >";
        echo "<table class='loc-table'style='empty-cells:show;'>";
        echo "<th>ID</th>";
        echo "<th>User</th>";
        echo "<th>Centre</th>";
        echo "<th>Member Type</th>";
        echo "<th>Name</th>";
        echo "<th>Phone</th>";
        echo "<th>Email</th>";
        echo "<th></th>";
        echo "<th></th>";

        foreach ($ws_details as $data) 
        {
            $i++;
            echo "<tr>";
            echo "<td>".$i."</td>";
            echo "<td>".$data->user."</td>";
            echo "<td>".$data->center."</td>";
            echo "<td>".$data->member_type."</td>";
            echo "<td>".$data->name."</td>";
            echo "<td>".$data->phone."</td>";
            echo "<td>".$data->email."</td>";
            echo "<td>".$data->address3."</td>";
            echo "<td><a href='/wp-admin/admin.php?page=committee&update-committee=".$data->id."'>Edit</a></td>";
            echo "<td><a href='/wp-admin/admin.php?page=committee&delete-committee=".$data->id."'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>"; 
    }//function display committee ends
?>