<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/be1b1b95c6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

    <section>
        <video autoplay loop muted src="Basianer-Alle-Retouche.mp4"></video>
        <?php
            session_start();
            error_reporting(0);
            if(isset($_SESSION['err'])){
                echo "<h5>".$_SESSION['err']."</h5>";
            }
        ?>
        <div>
            <form id="signup" method="post" action="signup.php">
                <h3>Sign Up</h3>
                <label for="firstname">First Name</label>
                <input type="text" name="firstname" required="required" placeholder="John">
    
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" required="required" placeholder="Doe">
    
                <label for="email">Email-ID</label>
                <input type="email" name="email" required="required" placeholder="john@example.com">
    
                <label for="pass">Password</label>
                <input type="password" name="pass" required="required">
    
                <input type="submit" value="Submit" id="submit" required="required">
    
                <span onclick="ch()">
                    <h4>Sign In</h4>
                    <i class="fa-solid fa-right-to-bracket"></i>
                </span>
            </form>
            
            <form id="signin" action="login.php" method="post">
                <h3>Sign In</h3>
                <label for="email">Email-ID</label>
                <input type="email" name="email" placeholder="john@example.com">
    
                <label for="pass">Password</label>
                <input type="password" name="pass">
    
                <input type="submit" value="Submit" id="submit">
    
                <span onclick="ch2()">
                    <h4>Sign Up</h4>
                    <i class="fa-solid fa-right-to-bracket"></i>
                </span>

            </form>
        </div>


    </section>
</body>
<script>
    window.addEventListener('mousemove',(e)=>{
        document.querySelector('video').style.top = -e.clientY/20+'px';
        document.querySelector('video').style.left = -e.clientX/20+'px';
    })

    function ch(){
        document.querySelector('#signup').style.left = '-100%';
        document.querySelector('#signin').style.left = '0';

    }
    function ch2(){
        document.querySelector('#signup').style.left = '0';
        document.querySelector('#signin').style.left = '100%';

    }
</script>
</html>