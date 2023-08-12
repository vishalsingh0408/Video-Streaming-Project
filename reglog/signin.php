<?php
    include('../config.php');

    $sql = "SELECT * from persons";
    mysqli_query($conn, $sql);

?>