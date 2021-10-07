<?php
session_start();
include_once('./admin_page/model/connection.php');

if ($_SESSION['admin_login'] == "") {
    header("location: signin");
} else {

    require_once 'template_admin/head_template.php';
    require_once 'template_admin/slidebar_template.php';
    require_once 'template_admin/topbar_template.php';

    // $type = $db->prepare('SELECT * from nf_type');
    // $type->execute();
    // $type_row = $type->fetchAll();

    if (isset($_REQUEST['update_id'])) {
        try {
            $id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare('SELECT * FROM nf_res WHERE res_id = :id');
            $select_stmt->bindParam(":id", $id);
            $select_stmt->execute();
            $data = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($data);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    if (isset($_REQUEST['update_res'])) {
        try {
            $r_name = $_REQUEST['res-name'];
            $r_map = $_REQUEST['res-map'];
            $r_desc = $_REQUEST['res-desc'];

            $img_file = $_FILES['res-img']['name'];
            $img_type = $_FILES['res-img']['type'];
            $img_size = $_FILES['res-img']['size'];
            $img_temp = $_FILES['res-img']['tmp_name'];
            $img_path = "upload/res/img/" . $img_file;
            $img_directory = "upload/res/img/";

            $bg_file = $_FILES['res-bg']['name'];
            $bg_type = $_FILES['res-bg']['type'];
            $bg_size = $_FILES['res-bg']['size'];
            $bg_temp = $_FILES['res-bg']['tmp_name'];
            $bg_path = "upload/res/bg/" . $bg_file;
            $bg_directory = "upload/res/bg/";

            // if (empty($f_name)) {
            //     $errorMsg = "ใส่ชื่ออาหาร";
            // } else if (empty($f_type)) {
            //     $errorMsg = "เลือกประเภท";
            // } else if (empty($f_ingreedients)) {
            //     $errorMsg = "ใส่วัตถุดิบ/ส่วนผสม";
            // } else if (empty($f_spices)) {
            //     $errorMsg = "ใส่เครื่องเทศ/เครื่องแกง";
            // } else if (empty($f_desc)) {
            //     $errorMsg = "ใส่คำอธิบาย";
            // } 

            if ($img_file && $bg_file) {
                if ($img_type == "image/jpg" || $img_type == 'image/jpeg' || $img_type == "image/png" || $img_type == "image/gif" && $bg_type == "image/jpg" || $bg_type == 'image/jpeg' || $bg_type == "image/png" || $bg_type == "image/gif") {
                    if (!file_exists($img_path && $bg_path)) { // check file not exist in your upload folder path
                        if ($img_size && $bg_size < 5000000) { // check file size 5MB
                            unlink($img_directory . $data['res_img']);
                            unlink($bg_directory . $data['res_bg']);
                            move_uploaded_file($img_temp, 'upload/res/img/' . $img_file); // move upload file temperory directory to your upload folder
                            move_uploaded_file($bg_temp, 'upload/res/bg/' . $bg_file);
                        } else {
                            $errorMsg = "โปรดอัปโหลดไฟล์ที่มีขนาดไม่เกิน 5MB"; // error message file size larger than 5mb
                        }
                    } else {
                        $errorMsg = "มีไฟล์นี้อยู่แล้ว โปรดตรวจสอบในโฟลเดอร์ Upload"; // error message file not exists your upload folder path
                    }
                } else {
                    $errorMsg = "Upload JPG, JPEG, PNG & GIF formats...";
                }
            } else {
                $img_file = $data['res_img']; // if you not select new image than previos image same it is it.
                $bg_file = $data['res_bg']; // if you not select new image than previos image same it is it.
            }

            if (!isset($errorMsg)) {
                $update_stmt = $db->prepare("UPDATE nf_res SET res_name = :r_name, res_desc = :r_desc, res_img = :r_img, res_bg = :r_bg, res_map = :r_map WHERE res_id = :id");
                $update_stmt->bindParam(':r_name', $r_name);
                $update_stmt->bindParam(':r_desc', $r_desc);
                $update_stmt->bindParam(':r_map', $r_map);
                $update_stmt->bindParam(':r_img', $img_file);
                $update_stmt->bindParam(':r_bg', $bg_file);
                $update_stmt->bindParam(':id', $id);

                if ($update_stmt->execute()) {
                    $updateMsg = "แก้ไขข้อมูลสำเร็จ...";
                    // header('refresh:1; food.php');
                    echo "<script>";
                    echo "alert('แก้ไขข้อมูลสำเร็จ..');";
                    echo "window.location.href='restaurant'";
                    echo "</script>";
                } else {
                    $errorMsg = "ERORR";
                }
            } else {
                $errorMsg = "ERORR";
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
            <div class="col-6">
                <h1 class="h3 mb-2 text-gray">แก้ไขร้านค้า</h1>
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
        if (isset($updateMsg)) {
        ?>
            <div class="alert alert-success alert-dismissible fade show">
                <strong><?php echo $updateMsg; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="">ชื่อร้านค้า</label>
                                <input type="text" class="form-control" name="res-name" value="<?php echo $data["res_name"]; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="">คำอธิบายร้านค้า</label>
                                <textarea type="text" class="form-control" rows="4" name="res-desc" required><?php echo $data["res_desc"]; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">รูปร้านอาหาร</label>
                                <p>
                                    <img src="upload/res/img/<?php echo $data["res_img"]; ?>" height="100" width="150" alt="">
                                </p>
                                <input class="form-control" type="file" name="res-img" value="<?php echo $data["res_img"]; ?>" accept="image/png, image/jpeg, image/jpg, image/gif">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">รูปพื้นหลัง</label>
                                <p>
                                    <img src="upload/res/bg/<?php echo $data["res_bg"]; ?>" height="100" width="150" alt="">
                                </p>
                                <input class="form-control" type="file" name="res-bg" value="<?php echo $data["res_bg"]; ?>" accept="image/png, image/jpeg, image/jpg, image/gif">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">แผนที่</label>
                                <p class="small">(เลือกสถานที่ใน Google Map -> กดแชร์ -> ฝังแผนที่ -> เลือกแผนที่ขนาดเล็กหรือปานกลาง -> คัดลอก HTML)</p>
                                <textarea type="text" class="form-control" rows="4" name="res-map" required><?php echo $data["res_map"]; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-12">
                            <h4 style="padding-top: 10px;">รายการอาหาร</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_not_pagination" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th width="5%">ลำดับ</th>
                                            <th width="10%">รูปภาพ</th>
                                            <th width="40%">ชื่ออาหาร</th>
                                            <th width="15%">ประเภท</th>
                                            <th width="30%">จัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $row = 1;
                                        $food = $db->prepare(
                                            'SELECT * from nf_food_res 
                                                  JOIN nf_food ON nf_food_res.food_res_id = nf_food.food_id
                                                  JOIN nf_res ON nf_food_res.food_res_id = nf_res.res_id'
                                        );
                                        $food->execute();
                                        while ($data = $food->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                             <tr height="75px" style="text-align: center;">
                                                <td class="align-middle"><?php echo $row; ?></td>
                                                <td class="align-middle"><img src="upload/food/img/<?php echo $data['food_img']; ?>" width="100%" height="100%" alt=""></td>
                                                <td class="align-middle"><?php echo $data["food_name"]; ?></td>
                                                <td class="align-middle"><?php echo $data["type_name"]; ?></td>
                                                <td class="align-middle"><a href="edit_food.php?update_id=<?php echo $data['food_id']; ?>" class="btn btn-warning">แก้ไข<a></td>
                                            </tr>
                                        <?php
                                            $row++;
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> -->
            </div>

            <div class="row">
                <div class="col-12">
                    <center>
                        <div class="form-group" style="padding-top: 20px;">
                            <button type="submit" name="update_res" class="btn btn-success">บันทึก</button>
                            <button type="reset" class="btn btn-danger" onclick="window.history.go(-1); return false;">ยกเลิก</button>
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