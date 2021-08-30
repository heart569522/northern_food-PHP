<?php
require_once('./admin_page/model/connection.php');
session_start();

if (isset($_SESSION['admin_login'])) {
    header("location: admin.php");
}

if (isset($_REQUEST['btn_login'])) {
    $username = strip_tags($_REQUEST['username']);
    $password = strip_tags($_REQUEST['password']);

    if (empty($username)) {
        $errorMsg[] = "Please enter usernames";
    } else if (empty($password)) {
        $errorMsg[] = "Please enter password";
    } else {
        try {
            $select_stmt = $db->prepare("SELECT * FROM nf_admin WHERE username = :username");
            $select_stmt->execute(array(':username' => $username));
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

            if ($select_stmt->rowCount() > 0) {
                if ($username == $row['username']) {
                    //if (password_verify($password, $row['password'])) {
                    if ($password == $row['password']) {
                        $_SESSION['admin_login'] = $row['id'];
                        $loginMsg = "Successfully Login...";
                        header("refresh:2;admin.php");
                    } else {
                        $errorMsg[] = "Wrong password!";
                    }
                } else {
                    $errorMsg[] = "Wrong username";
                }
            } else {
                $errorMsg[] = "Wrong username";
            }
        } catch (PDOException $e) {
           $e->getMessage();
        }
    }
}

?>

<body style="background: url(img/sign-in_bg.jpg); 
             height: 100vh; 
             background-position: center;
             background-repeat: no-repeat;
             background-size: cover;">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-md-9 col-lg-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-md-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4 font-weight-bold">Sign in</h1>
                                    </div>
                                    <form class="user" method="POST">
                                    <?php 
                                        if (isset($errorMsg)) {
                                            foreach($errorMsg as $error) {
                                    ?>
                                        <div class="alert alert-danger">
                                            <strong><?php echo $error; ?></strong>
                                        </div>
                                    <?php 
                                            }
                                        }
                                    ?>

                                    <?php 
                                        if (isset($loginMsg)) {
                                    ?>
                                        <div class="alert alert-success">
                                            <strong><?php echo $loginMsg; ?></strong>
                                        </div>
                                    <?php 
                                        }
                                    ?>
                                        <div class="form-group">
                                            <input type="text" name="username" id="username" class="form-control" placeholder="Username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Password...">
                                        </div>
                                        <button type="submit" name="btn_login" class="btn-h btn-blue-dark btn-block">
                                            Submit
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Sign Up!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>