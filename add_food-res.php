<?php
session_start();
include_once('./admin_page/model/connection.php');

if ($_SESSION['admin_login'] == "") {
    header("location: signin.php");
} else {

    require_once 'template_admin/head_template.php';
    require_once 'template_admin/slidebar_template.php';
    require_once 'template_admin/topbar_template.php';

    $food = $db->prepare('SELECT * from nf_food');
    $food->execute();
    $food_row = $food->fetchAll();

    if (isset($_REQUEST['res_id'])) {
        try {
            $r_id = $_REQUEST['res_id'];
            $select_stmt = $db->prepare('SELECT * FROM nf_res WHERE res_id = :id');
            $select_stmt->bindParam(":id", $r_id);
            $select_stmt->execute();
            $data = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($data);
        } catch(PDOException $e) {
            $e->getMessage();
        }
    }

    if (isset($_REQUEST['insert-res-food'])) {
        try {
            $f_id = $_REQUEST['food-id'];

            if (empty($f_id)) {
                $errorMsg = "เลือกเมนู";
            } 
            // else if (empty($f_type)) {
            //     $errorMsg = "เลือกประเภท";
            // } else if (empty($f_ingreedients)) {
            //     $errorMsg = "ใส่วัตถุดิบ/ส่วนผสม";
            // } else if (empty($f_spices)) {
            //     $errorMsg = "ใส่เครื่องเทศ/เครื่องแกง";
            // } else if (empty($f_desc)) {
            //     $errorMsg = "ใส่คำอธิบาย";
            // } 

            if (!isset($errorMsg)) {
                $insert_stmt = $db->prepare('INSERT INTO nf_food_res(res_id, food_id) VALUES (:r_id, :f_id)');
                $insert_stmt->bindParam(':f_id', $f_id);
                $insert_stmt->bindParam(':r_id', $r_id);

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
            <div class="col-6">
                <h1 class="h3 mb-2 text-gray">เพิ่มเมนูในร้านอาหาร</h1>
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
                <div class="row">
                    <div class="col-md-6 col-12">
                        <h1>ร้าน <?php echo $data["res_name"]; ?></h1>
                        <h3><?php echo $data["res_desc"]; ?></h3>
                        <p>
                            <img src="upload/res/img/<?php echo $data["res_img"]; ?>" height="100" width="150" alt="">
                            <img src="upload/res/bg/<?php echo $data["res_bg"]; ?>" height="100" width="150" alt="">
                        </p>
                        <div class="col-12">
                            <p style="width: 1000;"><?php echo $data["res_map"]; ?></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <form action="" method="post">
                            <div class="row">
                                <!-- <div class="col-xl-4 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="">เลือกเมนูอาหาร</label>
                                        <select class="form-select" name="food-type">
                                            <option disabled selected>เมนู</option>
                                            <?php foreach ($food_row as $row) { ?>
                                                <option value="<?php echo $row["food_id"]; ?>">
                                                    <?php echo $row["food_name"]; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="col-xl-4 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="">เลือกเมนูอาหาร</label>
                                        <select class="form-select" name="food-id">
                                            <option disabled selected>เมนู</option>
                                            <?php foreach ($food_row as $row) { ?>
                                                <option value="<?php echo $row["food_id"]; ?>">
                                                    <?php echo $row["food_name"]; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>     
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h4 style="padding-top: 10px;">รายการอาหาร</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="table_not_pagination" width="100%" cellspacing="0">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th width="5%">ลำดับ</th>
                                                    <th width="10%">รูปภาพ</th>
                                                    <th width="40%">ชื่ออาหาร</th>
                                                    <!-- <th width="15%">ประเภท</th> -->
                                                    <th width="30%">จัดการ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                    $row = 1;
                                                    $food = $db->prepare("SELECT * FROM nf_food_res 
                                                                            JOIN nf_food ON nf_food_res.food_id = nf_food.food_id
                                                                            JOIN nf_res ON nf_food_res.res_id = nf_res.res_id
                                                                            WHERE nf_food_res.res_id = '$r_id'");
                                                    $food->execute();
                                                    while ($data = $food->fetch(PDO::FETCH_ASSOC)){
                                                ?>
                                                    <tr height="75px" style="text-align: center;">
                                                        <td class="align-middle"><?php echo $row; ?></td>
                                                        <td class="align-middle"><img src="upload/food/img/<?php echo $data['food_img']; ?>" width="100%" height="100%" alt=""></td>
                                                        <td class="align-middle"><?php echo $data["food_name"]; ?></td>
                                                        <!-- <td class="align-middle"><?php echo $data["type_name"]; ?></td> -->
                                                        <td class="align-middle"><a href="edit_food.php?update_id=<?php echo $data['food_id']; ?>" class="btn btn-warning">แก้ไข<a></td>
                                                    </tr>
                                                <?php
                                                    $row++;
                                                    }
                                                
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <center>
                                        <div class="form-group" style="padding-top: 20px;">
                                            <button type="submit" name="insert-res-food" class="btn btn-success">บันทึก</button>
                                            <button type="reset" class="btn btn-danger">ยกเลิก</button>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </form>
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