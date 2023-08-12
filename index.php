<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
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
                <?php error_reporting(0); session_start();?>
                <h3 id="userName"><?php if(isset($_SESSION['name'])){echo $_SESSION['name'];}else echo "Guest" ?></h3>
            </span>
            <hr>

            <span id="home" class="links">
                <i class="fa-solid fa-house"></i>
                <a href="http://localhost/Youtube%20Project/">Home</a>
            </span>

            <span id="home" class="links">
                <i class="fa-solid fa-chalkboard-user"></i>
                <a href="userSection">Followed Channels</a>
            </span>

            <span id="home" class="links">
                <i class="fa-solid fa-compact-disc"></i>
                <a href="channel" target="page">Your Channels</a>
            </span>

            <span id="home" class="links">
                <i class="fa-solid fa-circle-plus"></i>
                <a href="channelCreate/index.php" target="page">Add Channel</a>
            </span>
            <?php
                if($_SESSION['name']){
                    ?>
                        <span id="home" class="links">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <a href="logout.php" target="page">Logout</a>
                        </span>
                <?php }else{?>
                        <span id="home" class="links">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <a href="reglog" target="page">Login</a>
                        </span>
                <?php } ?>
            
        </div>
    </nav>

    <section id="con">
        <span id="searchBar">
          <span id="searchBack">
            <input type="text" id="text" placeholder="Type something here" onchange="searchRes()">
            <a href="searchresult/index.php?querySearch=" id="querySearch">
                <i class="fa-solid fa-magnifying-glass"></i>
            </a>
          </span>

        </span>


        <section id="videosCon">
        <?php
        error_reporting(0);
        include('config.php');

        $sql = "SELECT datavideos.id, datavideos.name, datavideos.coverimg, datavideos.chid, channels.chid, channels.chname, channels.icon from datavideos inner join channels on channels.chid = datavideos.chid;
        ";
        //echo $sql;
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result))
        {
            echo $row['profilephoto'];
            $s = 'pics/';
            ?>
            <div class="container">
                <a href="view/view.php?query=<?php echo  $row['id'] ?>">
                    <div id="box">
                        <img src="userDashboard/<?php echo $row['id']."/".$row['coverimg'] ?>" class="cover">
                        <span id="link"><?php echo $row['name'] ?></span>
                    </div>
                </a>
                <a href="channelView/channelView.php?chid= <?php echo $row['chid'] ?>">
                    <span id="uploader">
                        <img src="channelPic/<?php echo $row['icon'] ?>" class="profilePic">
                        <span id="userlink"><?php echo $row['chname'] ?></span>
                    </span>
                </a>
            </div>
            <?php } ?>
    </section>
    </section>

</body>
<script>
    function bar() {
        if(document.querySelector('.fa-arrow-right').style.display == 'block'){
            document.querySelector('.fa-arrow-right').style.display = 'none';
            document.querySelector('.fa-arrow-left').style.display = 'block';

            document.querySelector('nav').style.width = '20vw';

            for(let i=0;i<4;i++)
            {
                document.querySelectorAll('#home')[i].classList.remove("hideText");
                document.querySelectorAll('#home')[i].classList.add("links");
            }
            document.querySelector('#userName').style.display = 'block';

        }else{
            document.querySelector('.fa-arrow-right').style.display = 'block';
            document.querySelector('.fa-arrow-left').style.display = 'none';

            document.querySelector('nav').style.width = '5vw';

            for(let i=0;i<4;i++)
            {
                document.querySelectorAll('#home')[i].classList.remove("links");
                document.querySelectorAll('#home')[i].classList.add("hideText");
            }
            document.querySelector('#userName').style.display = 'none';

        }



    }

    function searchRes(){
        document.querySelector('#querySearch').href = 'searchresult/index.php?querySearch='+document.querySelector('#text').value
    }
</script>
</html>
