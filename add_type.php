<?php
session_start();
include_once('./admin_page/model/connection.php');

if ($_SESSION['admin_login'] == "") {
    header("location: signin.php");
} else {

    require_once 'template_admin/head_template.php';
    require_once 'template_admin/slidebar_template.php';
    require_once 'template_admin/topbar_template.php';

    if (isset($_REQUEST['insert_type'])) {
        try {
            $t_name = $_REQUEST['food-type-name'];

            if (empty($t_name)) {
                $errorMsg = "ใส่ประเภทอาหาร";
            }

            if (!isset($errorMsg)) {
                $insert_stmt = $db->prepare('INSERT INTO nf_type(type_name) VALUES (:t_name)');
                $insert_stmt->bindParam(':t_name', $t_name);

                if ($insert_stmt->execute()) {
                    $insertMsg = "เพิ่มข้อมูลสำเร็จ...";
                    //header('refresh:1; restaurant.php');
                }
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-2 text-gray-800">เพิ่มประเภทอาหาร</h1>
            </div>
        </div>
        <?php
        if (isset($errorMsg)) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <strong><?php echo $errorMsg; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <?php
        if (isset($insertMsg)) {
        ?>
            <div class="alert alert-success alert-dismissible fade show">
                <strong><?php echo $insertMsg; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">ประเภท</label>
                                <input type="text" class="form-control" name="food-type-name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <div class="form-group" style="padding-top: 10px;">
                                    <button type="submit" name="insert_type" class="btn btn-success">บันทึก</button>
                                    <button type="reset" class="btn btn-danger">ยกเลิก</button>
                                </div>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

<?php
    require_once 'template_admin/script_template.php';
    require_once 'template_admin/footer_template.php';
}
?>