<?php
    require_once 'template_user/head_template.php';
    require_once 'template_user/navbar_template.php';

    include_once('./admin_page/model/connection.php');

    $name =  $_POST['search'];

    $select_stmt_food = $db->prepare("SELECT * FROM nf_food
                                        WHERE food_name
                                        LIKE '%$name%' ORDER BY food_name ASC");
    $select_stmt_food->execute();
    $data_food = $select_stmt_food->fetch(PDO::FETCH_ASSOC);

    $select_stmt_res = $db->prepare("SELECT * FROM nf_res
                                        WHERE res_name
                                        LIKE '%$name%' ORDER BY res_name ASC");
    $select_stmt_res->execute();
    $data_res = $select_stmt_res->fetch(PDO::FETCH_ASSOC);
?>
<main>
    <div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./img/cover-1.jpg">
                <rect width="100%" height="100%" fill="#777" />

                <div class="container">
                    <div class="carousel-caption">
                        <h1 class="title-center">ค้นหา</h1>
                        <!-- <p>อาหารเหนือเชียงใหม่ที่คุณควรลิ้มลองชิมแล้วจะติดใจ</p> -->
                        <!-- <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p> -->
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./img/cover-2.jpg">
                <rect width="100%" height="100%" fill="#777" />

                <div class="container">
                    <div class="carousel-caption">
                        <h1 class="title-center">ค้นหา</h1>
                        <!-- <p>อาหารเหนือเชียงใหม่ที่คุณควรลิ้มลองชิมแล้วจะติดใจ</p> -->
                        <!-- <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p> -->
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./img/cover-3.jpg">
                <rect width="100%" height="100%" fill="#777" />

                <div class="container">
                    <div class="carousel-caption">
                        <h1 class="title-center">ค้นหา</h1>
                        <!-- <p>อาหารเหนือเชียงใหม่ที่คุณควรลิ้มลองชิมแล้วจะติดใจ</p> -->
                        <!-- <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p> -->
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Album example</h1>
                <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
                <p>
                    <a href="#" class="btn btn-primary my-2">Main call to action</a>
                    <a href="#" class="btn btn-secondary my-2">Secondary action</a>
                </p>
            </div>
        </div>
    </section> -->

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 g-3">

                <?php 
                    $select_stmt_food->execute();
                    while ($data_food = $select_stmt_food->fetch(PDO::FETCH_ASSOC)){ 
                ?>
                    <a href="food_detail?food_id=<?php echo $data_food['food_id']; ?>" class="card-hover">
                        <div class="col">
                            <div class="card shadow-sm hover-zoom">
                                <figure class="figure-list"><img class="img-fluid " src="upload/food/img/<?php echo $data_food['food_img'] ?>" width="100%"></figure>
                                <div class="card-body">
                                    <p class="card-text">
                                    <h2 style="text-align: center;"><?php echo $data_food['food_name'] ?></h2>
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php } ?>

                <?php 
                    $select_stmt_res->execute();
                    while ($data_res = $select_stmt_res->fetch(PDO::FETCH_ASSOC)){ 
                ?>
                    <a href="res_detail?res_id=<?php echo $data_res['res_id']; ?>" class="card-hover">
                        <div class="col">
                            <div class="card shadow-sm hover-zoom">
                                <figure class="figure-list"><img class="img-fluid " src="upload/res/img/<?php echo $data_res['res_img'] ?>" width="100%"></figure>
                                <div class="card-body">
                                    <p class="card-text">
                                    <h2 style="text-align: center;"><?php echo $data_res['res_name'] ?></h2>
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

</main>