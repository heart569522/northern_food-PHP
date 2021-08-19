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
                            <label for="">รูปร้านอาหาร</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="" id="inputGroupFile01" accept="image/*">
                                <label class="custom-file-label" for="inputGroupFile01"></label>
                                <br>
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
                            <label for="">รูปพื้นหลัง</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="" id="inputGroupFile01" accept="image/*">
                                <label class="custom-file-label" for="inputGroupFile01"></label>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <div class="form-group" style="padding-top: 20px;">
                                    <button type="submit" class="btn btn-success">บันทึก</button>
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