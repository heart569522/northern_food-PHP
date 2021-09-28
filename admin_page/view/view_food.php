<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-6">
        <h1 class="h3 mb-2 text-gray">รายการอาหาร</h1>
    </div>
    <div class="col-6">
        <a style="float: right;" href="./add_type.php" class="btn btn-primary" >เพิ่มประเภท</a>
        <a style="float: right;" href="./add_food.php" class="btn btn-success" >เพิ่มเมนู</a>
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
            <table class="table table-hover table-bordered" id="table_pagination_search_order" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr style="text-align: center;">
                        <th width="5%">ลำดับ</th>
                        <th width="10%">รูปภาพ</th>
                        <th width="60%">ชื่ออาหาร</th>
                        <th width="10%">ประเภท</th>
                        <th width="20%">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // include_once('./admin_page/model/connection.php');

                        $row = 1;
                        $food = $db->prepare('SELECT * from nf_food JOIN nf_type ON nf_food.type_id = nf_type.type_id');
                        $food->execute();
                        while ($data = $food->fetch(PDO::FETCH_ASSOC)){
                    ?>
                            <tr height="150px" style="text-align: center;">
                                <td class="align-middle"><?php echo $row; ?></td>
                                <td class="align-middle"><img src="upload/food/img/<?php echo $data['food_img']; ?>" width="100%" height="100%" alt=""></td>
                                <td class="align-middle"><?php echo $data["food_name"]; ?></td>
                                <td class="align-middle"><?php echo $data["type_name"]; ?></td>
                                <td class="align-middle">
                                    <div class="btn-group" role="group">
                                        <a href="edit_food.php?update_id=<?php echo $data['food_id']; ?>" class="btn btn-warning">แก้ไข</a>
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal">ลบเมนู</button>
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
                                            </div>
                                            <div class="modal-footer">
                                                <a href="del_food.php?delete_id=<?php echo $data['food_id']; ?>" class="btn btn-danger">ลบ</a>
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
                        
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->