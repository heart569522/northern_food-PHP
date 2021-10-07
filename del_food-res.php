<?php
session_start();
include_once('./admin_page/model/connection.php');

    if(isset($_REQUEST['delete_id'])){

        $id = $_REQUEST['delete_id'];
        $r_id = $_REQUEST['res_id'];

        $delete_stmt = $db->prepare('DELETE FROM nf_food_res WHERE food_res_id = :id');
        $delete_stmt->bindParam(':id', $id);
        if($delete_stmt->execute()) {
            echo "<script>alert('ลบข้อมูลสำเร็จ..');</script>";
            echo '<script>window.location.href="add_food-res?res_id='.$r_id.'";</script>';
        }
        
    } else {
        echo "Access Denide";
    }

?>