<?php 
    session_start();

    if ($_SESSION['id'] == "") {
        header("location: signin.php");
    } else {

        require_once 'template_admin/head_template.php';
        require_once 'template_admin/slidebar_template.php';
        require_once 'template_admin/topbar_template.php';
?>    
            
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-6">
                <h1 class="h3 mb-2 text-gray-800">เพิ่มเมนู</h1>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="row">
                <div class="col-6">

                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

<?php        
        require_once 'template_admin/script_template.php';
        require_once 'template_admin/footer_template.php';
    
    }
?>
