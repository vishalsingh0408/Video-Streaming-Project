<?php

    include('../config.php');



    $sql = "update channels set followersid = (select concat(followersid,'.".$_SESSION['userid']."') from channels where chid = ".$_SESSION['chidval'].") where chid = ".$_SESSION['chidval'];
    mysqli_query($conn, $sql);
    echo $sql;
    $sql2 = "update persons set followedch = (select concat(followedch,'.".$_SESSION['chidval']."') from persons where userid = ".$_SESSION['userid'].") where userid = ".$_SESSION['userid'];
    mysqli_query($conn, $sql2);
?>