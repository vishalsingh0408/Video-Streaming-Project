<?php
    session_start();
    if(!isset($_SESSION['name']))
    {header('Location: ../reglog');}
?>


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
<nav>
        <div id="background">
            <i class="fa-solid fa-arrow-left" onclick="bar()"></i>
            <i class="fa-solid fa-arrow-right" onclick="bar()"></i>
            <span id="user">
                <?php error_reporting(0); session_start(); ?>
                <h3 id="userName"><?php if(isset($_SESSION['name'])){echo $_SESSION['name'];}else echo "Guest" ?></h3>
            </span>
            <hr>

            <span id="home" class="links">
                <i class="fa-solid fa-house"></i>
                <a href="../index.php" target="page">Home</a>
            </span>

            <span id="home" class="links">
                <i class="fa-solid fa-chalkboard-user"></i>
                <a href="../userSection" target="page">Follwed Channels</a>
            </span>

            <span id="home" class="links">
                <i class="fa-solid fa-compact-disc"></i>
                <a href="../channel/index.php" target="page">Your Channels</a>
            </span>

            <span id="home" class="links">
                <i class="fa-solid fa-circle-plus"></i>
                <a href="../channelCreate/index.php" target="page">Add Channel</a>
            </span>
            <?php
                if($_SESSION['name']){
                    ?>
                        <span id="home" class="links">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <a href="../logout.php" target="page">Logout</a>
                        </span>
                <?php }else{?>
                        <span id="home" class="links">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <a href="../reglog" target="page">Login</a>
                        </span>
                <?php } ?>
        </div>
    </nav>

    <section id="con">
    <span id="searchBar">
          <span id="searchBack">
            <input type="text" id="text" placeholder="Type something here" onchange="searchRes()">
            <a href="../searchresult/index.php?querySearch=" id="querySearch">
                <i class="fa-solid fa-magnifying-glass"></i>
            </a>
          </span>

        </span>


        <section id="videosCon">
        
        <form action="action.php" method="POST" enctype="multipart/form-data">
            <span id="cover">
                <input type="file" name="cover" id="coverInput" onchange="document.querySelector('form').style.backgroundImage = 'url('+window.URL.createObjectURL(this.files[0])+')'">
            </span>
            <div>
                <span id="icon">
                    <input type="file" name="channelIcon" id="channelIcon"  onchange="document.querySelector('#icon').style.backgroundImage = 'url('+window.URL.createObjectURL(this.files[0])+')'">
                </span>
                <span id="name">
                    <input type="text" name="name" placeholder="Your Channel Name">
                </span>
            </div>
            
            <input type="submit" name="submit" value="Create Channel" id="cr">
        </form>
        <button onclick="document.querySelector('#cr').click()">Create Channel</button>
        </section>
    </section>

    
</body>

<script>
      function searchRes(){
        document.querySelector('#querySearch').href = '../searchresult/index.php?querySearch='+document.querySelector('#text').value
    }

</script>

</html>
