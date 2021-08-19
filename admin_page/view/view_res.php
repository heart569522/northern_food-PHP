<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-6">
            <h1 class="h3 mb-2 text-gray-800">รายชื่อร้านค้า</h1>
        </div>
        <div class="col-6">
            <a style="float: right;" href="#" class="btn btn-danger">ลบร้านค้า</a>
            <a style="float: right;" href="./add_res.php" class="btn btn-success">เพิ่มร้านค้า</a>
        </div>
    </div>
    <br>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <!-- <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
    </div> -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="text-align: center;">
                            <th width="10%">ลำดับ</th>
                            <th width="25%">รูปภาพ</th>
                            <th width="30%">ชื่อร้าน</th>
                            <th width="30%">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="text-align: center;">
                            <td>1</td>
                            <td>123.jpg</td>
                            <td>ร้านอาหาร</td>
                            <td><a class="btn btn-warning">แก้ไข</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->