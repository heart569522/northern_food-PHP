<?php 
    session_start();

    if ($_SESSION['id'] == "") {
        header("location: signin.php");
    } else {

        require_once 'template_admin/head_template.php';
        require_once 'template_admin/slidebar_template.php';
        require_once 'template_admin/topbar_template.php';
    
        require_once 'admin_page/view/view_food.php';
        
        require_once 'template_admin/script_template.php';
        require_once 'template_admin/footer_template.php';
    
    }
?>