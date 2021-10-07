<?php

require_once('./admin_page/model/connection.php');
session_start();

if ($_SESSION['admin_login'] == "") {
    header("location: signin");
} else {

    require_once 'template_admin/head_template.php';
    require_once 'template_admin/slidebar_template.php';
    require_once 'template_admin/topbar_template.php';

    if (isset($_POST['id'])) {
        try {
            $id = $_POST['id'];
            $select_stmt = $db->prepare('SELECT * FROM nf_admin WHERE id = :id');
            $select_stmt->bindParam(":id", $id);
            $select_stmt->execute();
            $data = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($data);
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
                <h1 class="h3 mb-2 text-gray">ผู้ดูแลระบบ : <?php echo $data['username'] ?></h1>
            </div>
            <!-- <div class="col-6">
        <a style="float: right;" href="./add_type.php" class="btn btn-primary" >เพิ่มประเภท</a>
        <a style="float: right;" href="./add_food.php" class="btn btn-success" >เพิ่มเมนู</a>
    </div> -->
        </div>

        <br>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <!-- <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
    </div> -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr style="text-align: center;">
                                <th width="10%">ลำดับ</th>
                                <th width="25%">ชื่อผู้ใช้</th>
                                <th width="45%">Email</th>
                                <th width="20%">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if ($id == 14) {
                                $row = 1;

                                $admin = $db->prepare('SELECT * from nf_admin');
                                $admin->execute();

                                while ($datas = $admin->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                    <tr height="60px" style="text-align: center;">
                                        <td class="align-middle"><?php echo $row; ?></td>
                                        <td class="align-middle"><?php echo $datas["username"]; ?></td>
                                        <td class="align-middle"><?php echo $datas["email"]; ?></td>
                                        <td class="align-middle">
                                            <div class="btn-group" role="group">
                                                <a href="edit_admin?update_id=<?php echo $id; ?>" class="btn btn-warning">แก้ไข</a>
                                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal">ลบ</button>
                                            </div>
                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <!-- <h6 class="modal-title">Modal Header</h6> -->
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h4>ยืนยันการลบข้อมูล...</h4>
                                                            <p>เมื่อลบข้อมูลแล้วจะทำการออกจากระบบ</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="del_admin?delete_id=<?php echo $id ?>" class="btn btn-danger">ลบ</a>
                                                            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button> -->
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    $row++;
                                }
                            } else {
                                $row = 1;

                                $admin = $db->prepare('SELECT * from nf_admin');
                                $admin->execute();

                                while ($datas = $admin->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr height="60px" style="text-align: center;">
                                        <td class="align-middle"><?php echo $row; ?></td>
                                        <td class="align-middle"><?php echo $datas["username"]; ?></td>
                                        <td class="align-middle"><?php echo $datas["email"]; ?></td>
                                        <td class="align-middle">
                                            <div class="btn-group" role="group">
                                                <?php if ($id === $datas['id']) { ?>
                                                    <a href="edit_admin?update_id=<?php echo $id; ?>" class="btn btn-warning">แก้ไข</a>
                                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal">ลบ</button>
                                                <?php } else { ?>
                                                    <button type="button" class="btn btn-secondary" disabled><i class="fas fa-lock"></i></button>
                                                <?php } ?>
                                            </div>
                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <!-- <h6 class="modal-title">Modal Header</h6> -->
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h4>ยืนยันการลบข้อมูล...</h4>
                                                            <p>เมื่อลบข้อมูลแล้วจะทำการออกจากระบบ</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="del_admin?delete_id=<?php echo $id ?>" class="btn btn-danger">ลบ</a>
                                                            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button> -->
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                            <?php
                                    $row++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
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