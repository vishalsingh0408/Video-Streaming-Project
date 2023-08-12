<?php

    include('../config.php');

    if(isset($_POST['submit'])){
        move_uploaded_file($_FILES['cover']['tmp_name'],"../channelPic/".$_FILES['cover']['name']);
        move_uploaded_file($_FILES['channelIcon']['tmp_name'],"../channelPic/".$_FILES['channelIcon']['name']);
        $sql = "insert into channels (chuserid, chname, icon, cover) values(".$_SESSION['userid'].",'".$_POST['name']."','".$_FILES['channelIcon']['name']."','".$_FILES['cover']['name']."')";
        echo $sql;
        mysqli_query($conn,$sql);
        header('Location: ../index.php');
    }



?>