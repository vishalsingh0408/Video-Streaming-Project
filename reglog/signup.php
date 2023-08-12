<?php
    include('../config.php');

    $sql = "INSERT INTO persons (lastname, firstname, email, password, profilephoto) values('".$_POST['lastname']."','".$_POST['firstname']."','".$_POST['email']."','".$_POST['pass']."','')";
    
    mysqli_query($conn, $sql);
    
    header("Location: /");

?>