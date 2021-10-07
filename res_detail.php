<?php
require_once 'template_user/head_template.php';
require_once 'template_user/navbar_template.php';

include_once('./admin_page/model/connection.php');

if (isset($_REQUEST['res_id'])) {
    try {
        $id = $_REQUEST['res_id'];
        $select_stmt = $db->prepare("SELECT DISTINCT * FROM nf_food_res 
                                     JOIN nf_food ON nf_food_res.food_id = nf_food.food_id
                                     JOIN nf_res ON nf_food_res.res_id = nf_res.res_id
                                     WHERE nf_food_res.res_id = :id");
        $select_stmt->bindParam(":id", $id);
        $select_stmt->execute();
        $data = $select_stmt->fetch(PDO::FETCH_ASSOC);
        extract($data);
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

?>

<body style="background: url(upload/res/bg/<?php echo $data['res_bg']; ?>); 
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
                    <h1 class="display-5 fw-bold"><?php echo $data['res_name']; ?></h1>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7 col-sm-12">
                                <!-- <figure class="figure-detail"><img class="img-fluid" src="upload/food/img/<?php echo $data['res_img'] ?>" width="100%" height="450"></figure> -->
                                <img class="img-fluid" src="upload/res/img/<?php echo $data['res_img'] ?>" width="100%" height="440">
                            </div>
                            <div class="col-lg-5 col-sm-12 p-3">
                                <?php echo $data['res_map'] ?>
                                <p style="text-align: center; color: #000;" class="lead mb-4"><?php echo nl2br($data['res_desc']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div style="background-color: rgba(255, 255, 255, 0.9);" class="px-4 py-4 text-center">
                    <div class="container">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-3">
                            <?php 
                                $select_stmt->execute();
                                while ($data = $select_stmt->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <a href="food_detail?food_id=<?php echo $data['food_id']; ?>" class="card-hover">
                                    <div class="col">
                                        <div class="card shadow-sm hover-zoom">
                                            <figure class="figure-list"><img class="img-fluid " src="upload/food/img/<?php echo $data['food_img'] ?>" width="100%"></figure>
                                            <div class="card-body">
                                                <p class="card-text">
                                                <h2 style="text-align: center;"><?php echo $data['food_name'] ?></h2>
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



    <?php
    require_once 'template_user/script_template.php';
    require_once 'template_user/footer_template.php';
    ?>