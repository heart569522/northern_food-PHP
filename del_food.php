<?php
session_start();
include_once('./admin_page/model/connection.php');

    if(isset($_REQUEST['delete_id'])){

        $id = $_REQUEST['delete_id'];

        $delete_stmt = $db->prepare('DELETE FROM nf_food WHERE food_id = :id');
        $delete_stmt->bindParam(':id', $id);
        if($delete_stmt->execute()) {
            echo "<script>alert('ลบข้อมูลสำเร็จ..');</script>";
            echo "<script>window.location.href='food.php';</script>";
        }
        
    } else {
        echo "Access Denide";
    }
?>