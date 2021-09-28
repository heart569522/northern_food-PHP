<?php
require_once 'template_user/head_template.php';
require_once 'template_user/navbar_template.php';

include_once('./admin_page/model/connection.php');

if (isset($_REQUEST['food_id'])) {
    try {
        $id = $_REQUEST['food_id'];
        // $select_stmt = $db->prepare('SELECT * FROM nf_food WHERE food_id = :id');
        $select_stmt = $db->prepare("SELECT * FROM nf_food_res 
                                     INNER JOIN nf_food ON nf_food_res.food_id = nf_food.food_id
                                     INNER JOIN nf_res ON nf_food_res.res_id = nf_res.res_id
                                     WHERE nf_food_res.food_id = :id");
        $select_stmt->bindParam(":id", $id);
        $select_stmt->execute();
        $data = $select_stmt->fetch(PDO::FETCH_ASSOC);
        // extract($data);
        // $food_res = $db->prepare("SELECT * FROM nf_food_res 
        //                         JOIN nf_food ON nf_food_res.food_id = nf_food.food_id
        //                         JOIN nf_res ON nf_food_res.res_id = nf_res.res_id
        //                         WHERE (nf_food_res.food_id = '$id')");
        // $food_res->execute();
        // $data= $food_res->fetch(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

    

    $food = $db->prepare('SELECT * from nf_food ORDER BY RAND() LIMIT 2');
    $food->execute();
    $food_row = $food->fetchAll();

?>

<body style="background: url(upload/food/bg/<?php echo $data['food_bg']; ?>); 
             height: 100vh; 
             background-position: center;
             background-repeat: no-repeat;
             background-size: cover;
             background-attachment: fixed;">

    <!-- <div class="container">
        <div class="col">
            <div class="row">
                <h1 class="text-center p-4" style="color: #fff;">asdasd</h1>
            </div>
        </div>
    </div> -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div style="background-color: rgba(255, 255, 255, 0.6);" class="px-4 py-4 text-center">
                    <h1 class="display-5 fw-bold"><?php echo $data['food_name']; ?></h1>
                    <div class="container">
                        <div class="row">
                            <div class="col-7">
                                <!-- <figure class="figure-detail"><img class="img-fluid" src="upload/food/img/<?php echo $data['food_img'] ?>" width="100%" height="450"></figure> -->
                                <img class="img-fluid" src="upload/food/img/<?php echo $data['food_img'] ?>" width="100%" height="440">
                            </div>
                            <div class="col-5">
                                <?php foreach($food_row as $row) { ?>
                                    <!-- <figure class="figure-detail-list"><img class="img-fluid" src="upload/food/img/<?php echo $row['food_img'] ?>" width="50%" height="110"></figure> -->
                                    
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row">
                            <!-- <div class="col-12">
                                <h3 style="text-align: left; color: #000; padding-top: 15px;">คำบรรยาย</h3>
                            </div> -->
                            <div class="col-12" style="padding-top: 10px; color:#000;">
                                <h3 class="mb-4" style="text-align: left;"><b>คำบรรยาย</b><br><?php echo $data['food_desc']; ?></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6" style="padding-top: 10px; color:#000;">
                                <h3 class="mb-4" style="text-align: left;"><b>วัตถุดิบ/ส่วนผสม</b><br><?php echo $data['food_ingredients']; ?></h3>
                            </div>
                            <div class="col-6" style="padding-top: 10px; color:#000;">
                                <h3 class="mb-4" style="text-align: right;"><b>แผนที่</b><br><?php echo $data['res_map']; ?></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6" style="padding-top: 10px; color:#000;">
                                <h3 class="mb-4" style="text-align: left;"><b>เครื่องเคียง/เครื่องแกง</b><br><?php echo $data['food_spices']; ?></h3>
                            </div>
                            <div class="col-6" style="padding-top: 10px; color:#000;">
                                <h3 class="mb-4" style="text-align: right;"><b>รายชื่อร้านอาหารในเชียงใหม่</b><br>
                                    <?php echo $data['res_name']; ?>
                                    
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
    

    <?php
    require_once 'template_user/script_template.php';
    require_once 'template_user/footer_template.php';
    ?>