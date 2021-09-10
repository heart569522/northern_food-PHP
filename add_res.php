<?php
session_start();
include_once('./admin_page/model/connection.php');

if ($_SESSION['admin_login'] == "") {
    header("location: signin.php");
} else {
    require_once 'template_admin/head_template.php';
    require_once 'template_admin/slidebar_template.php';
    require_once 'template_admin/topbar_template.php';

    if (isset($_REQUEST['insert_res'])) {
        try {
            $r_name = $_REQUEST['res-name'];
            $r_desc = $_REQUEST['res-desc'];
            $r_map = $_REQUEST['res-map'];

            $img_file = $_FILES['res-img']['name'];
            $img_type = $_FILES['res-img']['type'];
            $img_size = $_FILES['res-img']['size'];
            $img_temp = $_FILES['res-img']['tmp_name'];
            $img_path = "upload/res/img" . $img_file;

            $bg_file = $_FILES['res-bg']['name'];
            $bg_type = $_FILES['res-bg']['type'];
            $bg_size = $_FILES['res-bg']['size'];
            $bg_temp = $_FILES['res-bg']['tmp_name'];
            $bg_path = "upload/res/bg" . $bg_file;

            if (empty($r_name)) {
                $errorMsg = "ใส่ชื่อร้านอาหาร";
            } else if (empty($r_map)) {
                $errorMsg = "ใส่แผนที่";
            } else if (empty($img_file)) {
                $errorMsg = "เลือกรูปร้านอาหาร";
            } else if (empty($bg_file)) {
                $errorMsg = "เลือกรูปพื้นหลัง";
            } else if ($img_type == "image/jpg" || $img_type == 'image/jpeg' || $img_type == "image/png" || $img_type == "image/gif" && $bg_type == "image/jpg" || $bg_type == 'image/jpeg' || $bg_type == "image/png" || $bg_type == "image/gif") {
                if (!file_exists($img_path && $bg_path)) { // check file not exist in your upload folder path
                    if ($img_size && $bg_size < 5000000) { // check file size 5MB
                        move_uploaded_file($img_temp, 'upload/res/img/' . $img_file); // move upload file temperory directory to your upload folder
                        move_uploaded_file($bg_temp, 'upload/res/bg/' . $bg_file);
                    } else {
                        $errorMsg = "โปรดอัปโหลดไฟล์ที่มีขนาดไม่เกิน 5MB"; // error message file size larger than 5mb
                    }
                } else {
                    $errorMsg = "มีไฟล์นี้อยู่แล้ว โปรดตรวจสอบในโฟลเดอร์ Upload"; // error message file not exists your upload folder path
                }
            }

            if (!isset($errorMsg)) {
                $insert_stmt = $db->prepare('INSERT INTO nf_res(res_name, res_img, res_map, res_bg, res_desc) VALUES (:r_name, :r_img, :r_map, :r_bg, :r_desc)');
                $insert_stmt->bindParam(':r_name', $r_name);
                $insert_stmt->bindParam(':r_img', $img_file);
                $insert_stmt->bindParam(':r_map', $r_map);
                $insert_stmt->bindParam(':r_bg', $bg_file);
                $insert_stmt->bindParam(':r_desc', $r_desc);

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
        <!-- <div class="row">
            <div class="col-6">
                <h1 class="h3 mb-2 text-gray-800">เพิ่มเมนู</h1>
            </div>
        </div> -->
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
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="form-group">
                                <label for="">ชื่อร้านค้า</label>
                                <input type="text" class="form-control" name="res-name">
                            </div>
                            <div class="form-group">
                                <label for="">คำอธิบายร้านค้า</label>
                                <input type="text" class="form-control" name="res-desc">
                            </div>
                            <div class="form-group">
                                <label class="form-label">รูปร้านอาหาร</label>
                                <input class="form-control" type="file" name="res-img">
                            </div>
                        </div>
                        <div class="col-12">
                            <h4 style="padding-top: 10px;">รายการอาหาร</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_not_pagination" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th width="10%">ลำดับ</th>
                                            <th width="15%">รูปภาพ</th>
                                            <th width="10%">ประเภท</th>
                                            <th width="25%">ชื่ออาหาร</th>
                                            <th width="10%">สถานะ</th>
                                            <th width="30%">จัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="text-align: center;">
                                            <td>1</td>
                                            <td>123.jpg</td>
                                            <td>ปิ้ง</td>
                                            <td>ไส้อั่ว</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="">แผนที่</label>
                                <input type="text" class="form-control" name="res-map">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">รูปพื้นหลัง</label>
                                <input class="form-control" type="file" name="res-bg">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <div class="form-group" style="padding-top: 20px;">
                                    <button type="submit" name="insert_res" class="btn btn-success">บันทึก</button>
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