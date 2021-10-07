<!--Navbar blue-->
<?php
    include_once('./admin_page/model/connection.php');

    $type = $db->prepare('SELECT * from nf_type');
    $type->execute();
    $type_row = $type->fetchAll();
?>

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
                <a class="nav-link" aria-current="page" href="./index">หน้าแรก</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="./type_user">ประเภทอาหาร</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="./res_user">ร้านอาหาร</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="./food_user">เมนูอาหาร</a>
            </li>
        </ul>
        <form class="d-flex" method="post" action="./search_data">
            <input class="form-control mr-2" type="search" name="search" placeholder="ค้นหา..." aria-label="Search" required>
            <button class="btn btn-outline-warning" type="submit">ค้นหา</button>
        </form>
        </div>
    </div>
    </nav>
    
<!--/.Navbar blue-->