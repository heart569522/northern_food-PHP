<?php
    require_once('./admin_page/model/connection.php');
    session_start();

    if ($_SESSION['admin_login'] == "") {
        header("location: signin");
    } else {

        require_once 'template_admin/head_template.php';
        require_once 'template_admin/slidebar_template.php';
        require_once 'template_admin/topbar_template.php';

        include 'admin_page/view/home_admin.php';
        
        require_once 'template_admin/script_template.php';
        require_once 'template_admin/footer_template.php';
    
    }
?>