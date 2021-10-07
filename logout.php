<?php 

    session_start();
    
    header("location: refresh");
    session_destroy();

?>