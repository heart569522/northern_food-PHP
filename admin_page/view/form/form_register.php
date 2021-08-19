<?php 
    include_once('./admin_page/model/database.php'); 
    
    $userdata = new DB_con();

    if (isset($_POST['submit'])) {
        $uname = $_POST['username'];
        $email = $_POST['email'];
        // $password = md5($_POST['password']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];
        if($password == $confirm_password){
            $sql = $userdata->registration($uname, $email, $password);
            if ($sql) {
                echo "<script>alert('Registor Successful!');</script>";
                echo "<script>window.location.href='signin.php'</script>";
            } else {
                echo "<script>alert('Something went wrong! Please try again.');</script>";
                echo "<script>window.location.href='signin.php'</script>";
            }
        } else {
            echo "<script>alert('Passwords do not match!');</script>";
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
                    <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                    <div class="col-md-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4 font-weight-bold">Sign up</h1>
                            </div>
                            <form class="user" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" onblur="checkusername(this.value)" required>
                                    <span id="usernameavailable"></span>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                </div>     
                                <div class="form-group">    
                                    <input type="password" class="form-control" name="confirm-password" id="confirm-password" placeholder="Confirm Password" required>
                                </div>
                                <button type="submit" class="btn-h btn-blue-dark btn-block" name="submit" id="submit">
                                    Submit
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="signin.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        function checkusername(val) {
            $.ajax({
                type: 'POST',
                url: '../../model/checkuser_available.php',
                data: 'username='+val,
                success: function(data) {
                    $('#username_available').html(data);
                }
            });
        }
    </script>