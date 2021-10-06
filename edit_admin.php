<?php
session_start();
include_once('./admin_page/model/connection.php');

if ($_SESSION['admin_login'] == "") {
    header("location: signin.php");
} else {

    require_once 'template_admin/head_template.php';
    require_once 'template_admin/slidebar_template.php';
    require_once 'template_admin/topbar_template.php';

    // $type = $db->prepare('SELECT * from nf_type');
    // $type->execute();
    // $type_row = $type->fetchAll();

    if (isset($_POST['update_id'])) {
        try {
            $id = $_POST['update_id'];
            $select_stmt = $db->prepare('SELECT * FROM nf_admin WHERE id = :id');
            $select_stmt->bindParam(":id", $id);
            $select_stmt->execute();
            $data = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($data);
        } catch(PDOException $e) {
            $e->getMessage();
        }
    }

    if (isset($_REQUEST['update_admin'])) {
        try {
            $username = $_REQUEST['username'];
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];
            $con_pass = $_REQUEST['con-pass'];

            if($password === $con_pass) {
                if (!isset($errorMsg)) {
                    $update_stmt = $db->prepare("UPDATE nf_admin SET username = :username, email = :email, password = :password WHERE id = :id");
                    $update_stmt->bindParam(':username', $username);
                    $update_stmt->bindParam(':email', $email);
                    $update_stmt->bindParam(':password', $password);
                    $update_stmt->bindParam(':id', $id);
    
                    if ($update_stmt->execute()) {
                        $updateMsg = "แก้ไขข้อมูลสำเร็จ...";
                        // header('refresh:1; food.php');
                        echo "<script>";
                        echo "alert('แก้ไขข้อมูลสำเร็จ..');";
                        echo "window.location.href='view_admin.php'";
                        echo "</script>";
                    } else {
                        $errorMsg = "ERORR";
                    }
                } else {
                    $errorMsg = "ERORR";
                }
            } else {
                $errorMsg = "รหัสผ่านไม่ตรงกัน!";
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
                <h1 class="h3 mb-2 text-gray">แก้ไขข้อมูลส่วนตัว</h1>
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
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="">ชื่อผู้ใช้</label>
                                <input type="text" class="form-control" name="username" value="<?php echo $data["username"]; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" value="<?php echo $data["email"]; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">รหัสผ่าน</label>
                                <input class="form-control" type="text" name="password" value="<?php echo $data["password"]; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label">ยืนยันรหัสผ่าน</label>
                                <input class="form-control" type="text" name="con-pass" value="" required>
                            </div>
                        </div>
                    </div>                  
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <div class="form-group" style="padding-top: 20px;">
                                    <button type="submit" name="update_admin" class="btn btn-success">บันทึก</button>
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