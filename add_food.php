<?php
session_start();
include_once('./admin_page/model/connection.php');

if ($_SESSION['admin_login'] == "") {
    header("location: signin.php");
} else {

    require_once 'template_admin/head_template.php';
    require_once 'template_admin/slidebar_template.php';
    require_once 'template_admin/topbar_template.php';

    $type = $db->prepare('SELECT * from nf_type');
    $type->execute();
    $data = $type->fetchAll();

    if (isset($_REQUEST['insert_food'])) {
        try {
            $f_name = $_REQUEST['food-name'];
            $f_type = $_REQUEST['food-type'];
            $f_ingreedients = $_REQUEST['food-ingredients'];
            $f_spices = $_REQUEST['food-spices'];
            $f_desc = $_REQUEST['food-desc'];
            
            $img_file = $_FILES['food-img']['name'];
            $img_type = $_FILES['food-img']['type'];
            $img_size = $_FILES['food-img']['size'];
            $img_temp = $_FILES['food-img']['tmp_name'];
            $img_path = "upload/food/img" . $img_file;

            $bg_file = $_FILES['food-bg']['name'];
            $bg_type = $_FILES['food-bg']['type'];
            $bg_size = $_FILES['food-bg']['size'];
            $bg_temp = $_FILES['food-bg']['tmp_name'];
            $bg_path = "upload/food/bg" . $bg_file;

            if (empty($f_name)) {
                $errorMsg = "ใส่ชื่ออาหาร";
            } else if (empty($f_type)) {
                $errorMsg = "เลือกประเภท";
            } else if (empty($f_ingreedients)) {
                $errorMsg = "ใส่วัตถุดิบ/ส่วนผสม";
            } else if (empty($f_spices)) {
                $errorMsg = "ใส่เครื่องเทศ/เครื่องแกง";
            } else if (empty($f_desc)) {
                $errorMsg = "ใส่คำอธิบาย";
            } else if (empty($img_file)) {
                $errorMsg = "เลือกรูปร้านอาหาร";
            } else if (empty($bg_file)) {
                $errorMsg = "เลือกรูปพื้นหลัง";
            } else if ($img_type == "image/jpg" || $img_type == 'image/jpeg' || $img_type == "image/png" || $img_type == "image/gif" && $bg_type == "image/jpg" || $bg_type == 'image/jpeg' || $bg_type == "image/png" || $bg_type == "image/gif") {
                if (!file_exists($img_path && $bg_path)) { // check file not exist in your upload folder path
                    if ($img_size && $bg_size < 5000000) { // check file size 5MB
                        move_uploaded_file($img_temp, 'upload/food/img/' . $img_file); // move upload file temperory directory to your upload folder
                        move_uploaded_file($bg_temp, 'upload/food/bg/' . $bg_file);
                    } else {
                        $errorMsg = "โปรดอัปโหลดไฟล์ที่มีขนาดไม่เกิน 5MB"; // error message file size larger than 5mb
                    }
                } else {
                    $errorMsg = "มีไฟล์นี้อยู่แล้ว โปรดตรวจสอบในโฟลเดอร์ Upload"; // error message file not exists your upload folder path
                }
            }

            if (!isset($errorMsg)) {
                $insert_stmt = $db->prepare('INSERT INTO nf_food(food_name, food_desc, food_img, food_ingredients, food_spices, food_bg) VALUES (:f_name, :f_desc, :f_img, :f_ingredients, :f_spices, :f_bg)');
                $insert_stmt->bindParam(':f_name', $f_name);
                $insert_stmt->bindParam(':f_desc', $f_desc);
                $insert_stmt->bindParam(':f_img', $img_file);
                $insert_stmt->bindParam(':f_ingredients', $f_ingreedients);
                $insert_stmt->bindParam(':f_spices', $f_spices);
                $insert_stmt->bindParam(':f_bg', $bg_file);

                // $insert_stmt = $db->prepare('INSERT INTO nf_food_type(food_id, type_id) VALUES ((SELECT food_id FROM nf_food WHERE food_id), :f_type)');
                // $insert_stmt->bindParam(':f_type', $f_type);
                $last_id = $db->lastInsertId();

                if ($insert_stmt->execute()) {
                    $insertMsg = "เพิ่มข้อมูลสำเร็จ... food ".$db->lastInsertId();
                    //header('refresh:1; restaurant.php');
                }

                $insert_stmt2 = $db->prepare("INSERT INTO nf_food_type(type_id) VALUES (:f_type)");
                $insert_stmt2->bindParam(':f_type', $f_type);
                
                if ($insert_stmt2->execute()) {
                    $insertMsg = "เพิ่มข้อมูลสำเร็จ... type";
                    //header('refresh:1; restaurant.php');
                }
            }
            // if (!isset($errorMsg)) {
                
            // }


        } catch (PDOException $e) {
            $e->getMessage();
        }
        $db = null;
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">ชื่อ</label>
                                <input type="text" class="form-control" name="food-name">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">ประเภท</label>
                                <select class="form-select" name="food-type">
                                    <option disabled>ประเภทอาหาร</option>
                                    <?php foreach ($data as $row) { ?>
                                        <option value="<?php echo $row["type_id"]; ?>">
                                            <?php echo $row["type_name"]; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">ส่วนผสม</label>
                                <textarea type="text" class="form-control" rows="4" name="food-ingredients"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">เครื่องเคียง/เครื่องแกง</label>
                                <textarea type="text" class="form-control" rows="4" name="food-spices"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">รูปอาหาร</label>
                                <input class="form-control" type="file" name="food-img">
                            </div>
                            <div class="form-group">
                                <label for="">คำบรรยาย</label>
                                <textarea type="text" class="form-control" rows="4" name="food-desc"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">รูปพื้นหลัง</label>
                                <input class="form-control" type="file" name="food-bg">
                            </div>
                        </div>
                        <!-- <div class="col-md-6 col-sm-12">
                            <h4 style="padding-top: 10px;">ชื่อร้านอาหาร</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_not_pagination" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th width="10%">ลำดับ</th>
                                            <th width="20%">รูปภาพ</th>
                                            <th width="25%">ร้านค้า</th>
                                            <th width="15%">สถานะ</th>
                                            <th width="30%">จัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="text-align: center;">
                                            <td>1</td>
                                            <td>123.jpg</td>
                                            <td>ร้านอร่อย</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> -->
                        <div class="col-12">
                            <center>
                                <div class="form-group" style="padding-top: 10px;">
                                    <button type="submit" name="insert_food" class="btn btn-success">บันทึก</button>
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