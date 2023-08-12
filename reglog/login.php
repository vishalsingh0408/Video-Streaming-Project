<?php

    include('../config.php');
    
  
    
        $sql = "select * from persons where email = '".$_POST['email']."' and password = '".$_POST['pass']."'";
        echo $sql;
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) == 1){

                $row = mysqli_fetch_assoc($result);
                $_SESSION['userid'] = $row['userid'];
                $_SESSION['name'] = $row['firstname']." ".$row['lastname'];
                $_SESSION['profilepic'] = $row['profilephoto'];
                header('Location: ../');
                }

        else{
            $_SESSION['err'] = "Invalid Email-ID or Password";
            header('Location: index.php');
        }
    


?>