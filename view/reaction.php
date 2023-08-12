<?php

  include('../config.php');

    $sqlChk = "SELECT commentBy from vid_".$_POST['qy']." where commentBy = ".$_SESSION['userid'];
    $resultChk = mysqli_query($conn, $sqlChk);
    if(mysqli_num_rows($resultChk) == "1"){
        $sqlUp = "update vid_".$_POST['qy']." set reaction = ".$_POST['data'];
        mysqli_query($conn, $sqlUp);
    }else{
        $sql = "insert into vid_".$_POST['qy']."(comment, commentBy, reaction) values('',".$_SESSION['userid'].",".$_POST['data'].")";
        mysqli_query($conn, $sql);
    }
  
  echo $sql;
?>
