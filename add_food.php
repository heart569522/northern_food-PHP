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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">ชื่อ</label>
                                <input type="text" class="form-control" name="food-name">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">ประเภท</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option disabled>ประเภทอาหาร</option>
                                    <option value="1">ต้ม</option>
                                    <option value="2">ปิ้ง</option>
                                    <option value="3">นึ่ง</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">ส่วนผสม</label>
                                <textarea type="text" class="form-control" rows="4" name="ingredients"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">เครื่องเคียง/เครื่องแกง</label>
                                <textarea type="text" class="form-control" rows="4" name="spices"></textarea>
                            </div>
                            <label for="">รูป</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="" id="inputGroupFile01" accept="image/*">
                                <label class="custom-file-label" for="inputGroupFile01"></label>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="">คำบรรยาย</label>
                                <textarea type="text" class="form-control" rows="4" name="description"></textarea>
                            </div>
                            <label for="">รูปพื้นหลัง</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="" id="inputGroupFile01" accept="image/*">
                                <label class="custom-file-label" for="inputGroupFile01"></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
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
                        </div>
                        <div class="col-12">
                            <center>
                            <div class="form-group" style="padding-top: 10px;">
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