<?php
        
        include('config.php');
        
        $sql = "insert into datavideos (name, coverimg, chid) values ('".$_FILES['vid']['name']."','".$_FILES['pic']['name']."',".$_GET['chid'].")";
        mysqli_query($conn, $sql);

        
        move_uploaded_file($_FILES['vid']['tmp_name'],"videos/".$_FILES['vid']['name']);
        move_uploaded_file($_FILES['pic']['tmp_name'],"pics/".$_FILES['pic']['name']);
?>