<?php 

    define('DB_SERVER', 'localhost'); // Your hostname
    define('DB_USER', 'root'); // Database Username
    define('DB_PASS', ''); // Database Password
    define('DB_NAME', 'northern_food'); // Database Name

    class DB_con {
        function __construct() {
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
            $this->dbcon = $conn;

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
        }

        public function username_available($uname) {
            $checkuser = mysqli_query($this->dbcon, "SELECT username FROM nf_admin WHERE username = '$uname'");
            return $checkuser;
        }

        public function registration($uname, $email, $password) {
            $reg = mysqli_query($this->dbcon, "INSERT INTO nf_admin(username, email, password) VALUES('$uname', '$email', '$password')");
            return $reg;
        }

        public function signin($uname, $password) {
            $signinquery = mysqli_query($this->dbcon, "SELECT id FROM nf_admin WHERE username = '$uname' AND password = '$password'");
            return $signinquery;
        }

        public function insert_res($r_name, $r_status, $r_img, $r_map, $r_bg) {
            $result = mysqli_query($this->dbcon, "INSERT INTO nf_res(res_name, res_img, res_map, res_bg, res_status) VALUES('$r_name', '$r_img', '$r_map', '$r_bg', '$r_status')");
            return $result;
        }

        public function fetchdata_res() {
            $result = mysqli_query($this->dbcon, "SELECT * FROM nf_res");
            return $result;
        }

        public function fetchonerecord($userid) {
            $result = mysqli_query($this->dbcon, "SELECT * FROM tblusers WHERE id = '$userid'");
            return $result;
        }

        public function update($firstname, $lastname, $email, $phonenumber,	$address, $userid) {
            $result = mysqli_query($this->dbcon, "UPDATE tblusers SET 
                firstname = '$firstname',
                lastname = '$lastname',
                email = '$email',
                phonenumber = '$phonenumber',
                address = '$address'
                WHERE id = '$userid'
            ");
            return $result;
        }

        public function delete($userid) {
            $deleterecord = mysqli_query($this->dbcon, "DELETE FROM tblusers WHERE id = '$userid'");
            return $deleterecord;
        }
    }

?>