<?php
session_start();
include_once('./admin_page/model/connection.php');

if ($_SESSION['admin_login'] == "") {
    header("location: signin.php");
} else {

    require_once 'template_admin/head_template.php';
    require_once 'template_admin/slidebar_template.php';
    require_once 'template_admin/topbar_template.php';

    if (isset($_REQUEST['update_id'])) {
        try {
            $id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare('SELECT * FROM nf_food WHERE food_id = :id');
            $select_stmt->bindParam(":id", $id);
            $select_stmt->execute();
            $data = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($data);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    if (isset($_REQUEST['update_food'])) {
        try {
            $f_name = $_REQUEST['food-name'];
            $f_type = $_REQUEST['food-type'];
            $f_ingredients = $_REQUEST['food_ingredients'];
            $f_spices = $_REQUEST['food-spices'];
            $f_desc = $_REQUEST['food-desc'];

            $img_file = $_FILES['food-img']['name'];
            $img_type = $_FILES['food-img']['type'];
            $img_size = $_FILES['food-img']['size'];
            $img_temp = $_FILES['food-img']['tmp_name'];
            $img_path = "upload/food/img/" . $img_file;
            $img_directory = "upload/food/img/";

            $bg_file = $_FILES['food-bg']['name'];
            $bg_type = $_FILES['food-bg']['type'];
            $bg_size = $_FILES['food-bg']['size'];
            $bg_temp = $_FILES['food-bg']['tmp_name'];
            $bg_path = "upload/food/bg/" . $bg_file;
            $bg_directory = "upload/food/bg/";

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
                            unlink($img_directory . $data['food_img']);
                            unlink($bg_directory . $data['food_bg']);
                            move_uploaded_file($img_temp, 'upload/food/img/' . $img_file); // move upload file temperory directory to your upload folder
                            move_uploaded_file($bg_temp, 'upload/food/bg/' . $bg_file);
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
                $img_file = $data['food_img']; // if you not select new image than previos image same it is it.
                $bg_file = $data['food_bg']; // if you not select new image than previos image same it is it.
            }

            if (!isset($errorMsg)) {
                $update_stmt = $db->prepare("UPDATE nf_food SET food_name = :f_name, food_desc = :f_desc, food_img = :f_img, food_ingredients = :f_ingredients, food_spices = :f_spices, food_bg = :f_bg, type_id = :f_type WHERE food_id = :id");
                $update_stmt->bindParam(':f_name', $f_name);
                $update_stmt->bindParam(':f_desc', $f_desc);
                $update_stmt->bindParam(':f_img', $img_file);
                $update_stmt->bindParam(':f_ingredients', $f_ingredients);
                $update_stmt->bindParam(':f_spices', $f_spices);
                $update_stmt->bindParam(':f_bg', $bg_file);
                $update_stmt->bindParam(':f_type', $f_type);
                $update_stmt->bindParam(':id', $id);

                if ($update_stmt->execute()) {
                    $updateMsg = "แก้ไขข้อมูลสำเร็จ...";
                    // header('refresh:1; food.php');
                    echo "<script>";
                    echo "alert('แก้ไขข้อมูลสำเร็จ..');";
                    echo "window.location.href='food.php'";
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
                <h1 class="h3 mb-2 text-gray">แก้ไขเมนู</h1>
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
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="">ชื่อ</label>
                                <input type="text" class="form-control" name="food-name" value="<?php echo $data["food_name"]; ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="">ประเภท</label>
                                <select class="form-select" name="food-type" required>
                                    <option disabled>ประเภทอาหาร</option>
                                    <?php
                                    $type = $db->prepare('SELECT * from nf_type');
                                    $type->execute();
                                    while ($type_row = $type->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <option value="<?php echo $type_row['type_id']; ?>" <?php if ($type_row['type_id'] == $data['type_id']) { ?> selected="selected" <?php } ?>>
                                            <?php echo $type_row['type_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">รูปอาหาร</label>
                                <p>
                                    <img src="upload/food/img/<?php echo $data["food_img"]; ?>" height="100" width="150" alt="">
                                </p>
                                <input class="form-control" type="file" name="food-img" value="<?php echo $data["food_img"]; ?>" accept="image/png, image/jpeg, image/jpg, image/gif">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">รูปพื้นหลัง</label>
                                <p>
                                    <img src="upload/food/bg/<?php echo $data["food_bg"]; ?>" height="100" width="150" alt="">
                                </p>
                                <input class="form-control" type="file" name="food-bg" value="<?php echo $data["food_bg"]; ?>" accept="image/png, image/jpeg, image/jpg, image/gif">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <label for="">ส่วนผสม</label>
                                <textarea type="text" class="form-control" rows="6" name="food_ingredients" required><?php echo $data["food_ingredients"]; ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <label for="">เครื่องเคียง/เครื่องแกง</label>
                                <textarea type="text" class="form-control" rows="6" name="food-spices" required><?php echo $data["food_spices"]; ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <label for="">คำบรรยาย</label>
                                <textarea type="text" class="form-control" rows="6" name="food-desc" required><?php echo $data["food_desc"]; ?></textarea>
                            </div>
                        </div>
                    </div>
                        <!-- <div class="col-md-6 col-sm-12">
                            <h4 style="padding-top: 10px;">ชื่อร้านอาหาร</h4>
                            <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr style="text-align: center;">
                                        <th width="5%">ลำดับ</th>
                                        <th width="10%">รูปภาพ</th>
                                        <th width="65%">ชื่อร้าน</th>
                                        <th width="20%">จัดการ</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                    <?php
                                    $row = 1;
                                    $res = $db->prepare('SELECT * from nf_res');
                                    $res->execute();
                                    while ($data = $res->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr height="75px" style="text-align: center;">
                                            <td class="align-middle"><?php echo $row; ?></td>
                                            <td class="align-middle"><img src="upload/res/img/<?php echo $data['res_img']; ?>" width="100%" height="100%" alt=""></td>
                                            <td class="align-middle"><?php echo $data["res_name"]; ?></td>
                                            <td class="align-middle"><a href="edit.php?update_id=<?php echo $row['id']; ?>" class="btn btn-warning">แก้ไข<a></td>
                                        </tr>
                                    <?php
                                        $row++;
                                    }

                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> -->
                        <div class="col-12">
                            <center>
                                <div class="form-group" style="padding-top: 10px;">
                                    <button type="submit" name="update_food" class="btn btn-success">บันทึก</button>
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