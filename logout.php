<?php 

    session_start();
    
    header("location: refresh.php");
    session_destroy();

?>