<?php
    function display_region() 
    {
          
        global $wpdb;
        echo "<h2>Region</h2>";
        if($_GET['delete-region']) 
        {

            $cd = $_GET['delete-region'];

            $wpdb->query(
                $wpdb->prepare(
                        "
                         DELETE FROM wp_region
                            WHERE id = %d
                        ",
                        $cd
                )
            );
           echo "Record Deleted for ID ".$cd;
        }
        if ($_GET['update-region']) 
        {
            $wid = $_GET['update-region'];
            echo "Update Region";
            $ws = $wpdb->get_results("SELECT * FROM `wp_region` WHERE `id` = $wid");
            //print_r($ws);

            $uregion ='';
            $uregion .="<form method='post' action=''>";
            $uregion .= "<div class='l-left'>Region:</div>";
            $uregion .= "<div class='l-right'>";
            $uregion .= "<input type='text' name='uregion-name' value='".$ws[0]->region."' />";
            $uregion .= "</div>";
            $uregion .="<input type='hidden' name='update-region' id='update-region' value='region' />";
            $uregion .="<input type='submit' value='Update Region' />";

            $uregion .="</form>";

            echo "<div id='u-region' style='width:800px;'>".$uregion."</div>";

            if($_POST['update-region'])     
            {
                $uid = $_GET['update-region'];
                $uregion_name = $_POST['uregion-name'];
                $wpdb->update(
                        'wp_region',
                        array(
                            'region' => $uregion_name,
                        ),
                        array( 'ID' => $uid ),
                        array(
                            '%s',
                        ),
                        array( '%d' )
                 );
            }
        }
        //pagination
        $num_region = $wpdb->get_results("SELECT count(*) as total_nr FROM `wp_region`");
        $n_group = $num_region[0]->total_nr;
        $n_x_group = 49;
        $n_pages = (($n_group / $n_x_group) < 1 ? 1 : ($n_group / $n_x_group));
        $p=0;

        if( isset($_REQUEST['p'])) 
        {
                $p=$_REQUEST['p'];
        }

        $ws_details = $wpdb->get_results("SELECT * FROM `wp_region` LIMIT $p , $n_x_group");

        echo "<div class='loc-table-div'>";
        echo "<table class='loc-table'>";
            echo "<th>ID</th>";
            echo "<th>Region</th>";
            echo "<th></th>";
            echo "<th></th>";

            foreach ($ws_details as $data) 
            {
                $i++;
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td>".$data->region."</td>";
                echo "<td><a href='/wp-admin/admin.php?page=region&update-region=".$data->id."'>Edit</a></td>";
                echo "<td><a href='/wp-admin/admin.php?page=region&delete-region=".$data->id."'>Delete</a></td>";
                echo "</tr>";

            }
        echo "</table>";
        echo "</div>";
    }//function display region ends
?>