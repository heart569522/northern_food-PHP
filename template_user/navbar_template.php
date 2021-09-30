<!--Navbar blue-->
<?php
    include_once('./admin_page/model/connection.php');

    $type = $db->prepare('SELECT * from nf_type');
    $type->execute();
    $type_row = $type->fetchAll();
?>
<!-- <body style="background: url(upload/food/bg/<?php echo $data['food_bg']; ?>); 
             height: 100vh; 
             background-position: center;
             background-repeat: no-repeat;
             background-size: cover;"> -->
<!-- <body style="background: url(img/user_bg.jpg); 
             height: 100vh; 
             background-position: center;
             background-repeat: no-repeat;
             background-size: cover;
             z-index: -10;"> -->
<body>
    <nav id="page-top" class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php"><b>Northern Food</b></a>
        <button class="navbar-toggler p-0 border-0" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false"
                aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
            <li class="nav-item active">
                <a class="nav-link" aria-current="page" href="./index.php">หน้าแรก</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown_type" data-flip="false"
                    data-toggle="dropdown" aria-expanded="false">ประเภทอาหาร</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown_type">
                    <?php foreach ($type_row as $row) { ?>
                        <li><a href="type_food.php?type_id=<?php echo $row['type_id']; ?>" class="dropdown-item"><?php echo $row['type_name']; ?></a></li>
                    <?php } ?>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown_type" data-flip="false"
                    data-toggle="dropdown" aria-expanded="false">รายการ</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown_type">
                    <li><a href="res_user.php" class="dropdown-item">ร้านอาหาร</a></li>
                    <li><a href="food_user.php" class="dropdown-item">เมนูอาหาร</a></li>
                </ul>
            </li>
        </ul>
        <form class="d-flex">
            <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        </div>
    </div>
    </nav>
    
<!--/.Navbar blue-->