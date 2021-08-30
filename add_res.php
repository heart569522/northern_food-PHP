<?php
session_start();
include_once('./admin_page/model/database.php');

if ($_SESSION['admin_login'] == "") {
    header("location: signin.php");
} else {

    require_once 'template_admin/head_template.php';
    require_once 'template_admin/slidebar_template.php';
    require_once 'template_admin/topbar_template.php';

    // $insertdata = new DB_con();

    // if (isset($_POST['insert_res'])) {
    //     $r_name = $_POST['res-name'];
    //     $r_status = $_POST['res-status'];
    //     $r_map = $_POST['res-map'];
        
    //     $r_img = $_POST['res-img'];

    //     $r_bg = $_POST['res-bg'];


    //     $sql = $insertdata->insert_res($r_name, $r_status, $r_img, $r_map, $r_bg);

    //     if ($sql) {
    //         echo "<script>alert('Record Inserted Successfully!');</script>";
    //         echo "<script>window.location.href='restaurant.php'</script>";
    //     } else {
    //         echo "<script>alert('Something went wrong! Please try again!');</script>";
    //         echo "<script>window.location.href='restaurant.php'</script>";
    //     }
    // }
    try {
        $r_name = $_REQUEST['res_name'];
        $r_status = $_REQUEST['res-status'];
        $r_map = $_REQUEST['res-map'];

        $img_file = $_FILES['res_img']['name'];
        $img_type = $_FILES['res_img']['type'];
        $img_size = $_FILES['res_img']['size'];
        $img_temp = $_FILES['res_img']['tmp_name'];
        $img_path = "upload/res/img" . $img_file;

        $bg_file = $_FILES['res_bg']['name'];
        $bg_type = $_FILES['res_bg']['type'];
        $bg_size = $_FILES['res_bg']['size'];
        $bg_temp = $_FILES['res_bg']['tmp_name'];
        $bg_path = "upload/res/bg" . $bg_file;


    } catch(PDOException $e) {
        $e->getMessage();
    }
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading
        <div class="row">
            <div class="col-6">
                <h1 class="h3 mb-2 text-gray-800">เพิ่มเมนู</h1>
            </div>
        </div> -->

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
                                <label for="">สถานะร้านค้า</label>
                                <select class="form-select" name="res-status">
                                    <option disabled>Choose Status</option>
                                    <option value="เปิด">เปิด</option>
                                    <option value="ปิด">ปิด</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">รูปร้านอาหาร</label>
                                <input class="form-control" type="file" name="res-img" accept="image/*" enctype="multipart/form-data">
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
                                <input class="form-control" type="file" name="res-bg" accept="image/*" enctype="multipart/form-data">
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