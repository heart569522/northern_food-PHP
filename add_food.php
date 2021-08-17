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
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="">ชื่อ</label>
                                <input type="text" class="form-control" name="food-name">
                            </div>
                            <div class="form-group">
                                <label for="">ส่วนผสม</label>
                                <textarea type="text" class="form-control" rows="5" name="ingredients"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">เครื่องเคียง/เครื่องแกง</label>
                                <textarea type="text" class="form-control" rows="5" name="spices"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">รูป</label>
                                <input type="file" class="form-control" id="formFile" name="food-img">
                            </div>
                        </form>
                    </div>
                    <div class="col-6">

                    </div>
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
