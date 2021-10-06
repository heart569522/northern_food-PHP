<?php
require_once 'template_user/head_template.php';
require_once 'template_user/navbar_template.php';

include_once('./admin_page/model/connection.php');

if (isset($_REQUEST['food_id'])) {
    try {
        $id = $_REQUEST['food_id'];
        $select_stmt = $db->prepare("SELECT * FROM nf_food_res 
                                     INNER JOIN nf_food ON nf_food_res.food_id = nf_food.food_id
                                     INNER JOIN nf_res ON nf_food_res.res_id = nf_res.res_id
                                     WHERE nf_food.food_id = :id");
        $select_stmt->bindParam(":id", $id);
        $select_stmt->execute();
        $data = $select_stmt->fetch(PDO::FETCH_ASSOC);
        extract($data);
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

$food = $db->prepare('SELECT * from nf_food ORDER BY RAND() LIMIT 3');
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
                    <h1 style="color: #000;" class="display-5 fw-bold"><?php echo $data['food_name']; ?></h1>
                    <div class="container">
                        <div class="row">
                            <div class="col-7">
                                <!-- <figure class="figure-detail"><img class="img-fluid" src="upload/food/img/<?php echo $data['food_img'] ?>" width="100%" height="450"></figure> -->
                                <img class="img-fluid" src="upload/food/img/<?php echo $data['food_img'] ?>" width="100%" height="440">
                            </div>
                            <div class="col-5">
                                <h2 style="color: #000;">เมนูแนะนำ</h2>
                                <?php
                                // if ($id != $food_row['food_id']) {
                                foreach ($food_row as $row) {
                                ?>
                                    <a style="text-decoration: none; color: #000;" href="food_detail.php?food_id=<?php echo $row['food_id']; ?>">
                                        <div class="card mb-3" style="max-width: 540px;">
                                            <div class="row g-0">
                                                <div class="col-md-4">
                                                    <img src="upload/food/img/<?php echo $row['food_img'] ?>" class="img-fluid rounded-start" alt="...">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h4><?php echo $row['food_name'] ?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php
                                }
                                // }
                                ?>
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
                                <h3 class="mb-4" style="text-align: right;"><b>เครื่องเคียง/เครื่องแกง</b><br><?php echo $data['food_spices']; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div style="background-color: rgba(255, 255, 255, 0.9);" class="px-4 py-4 text-center">
                    <div class="container">
                        <div class="col-12" style="padding-top: 10px; color:#000;">
                            <h3 class="mb-4" style="text-align: left;"><b>ร้านอาหาร</b></h3>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-3">
                            <?php
                            $select_stmt->execute();
                            while ($data = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <a href="res_detail.php?res_id=<?php echo $data['res_id']; ?>" class="card-hover">
                                    <div class="col">
                                        <div class="card shadow-sm hover-zoom">
                                            <figure class="figure-list"><img class="img-fluid " src="upload/res/img/<?php echo $data['res_img'] ?>" width="100%"></figure>
                                            <div class="card-body">
                                                <p class="card-text">
                                                <h2 style="text-align: center;"><?php echo $data['res_name'] ?></h2>
                                                </p>
                                                <div class="d-flex justify-content-between align-items-center">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>
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