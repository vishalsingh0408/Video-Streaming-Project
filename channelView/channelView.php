<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&display=swap" rel="stylesheet">
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
                <a href="../index.php" target="page">Followed Channels</a>
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
        <?php 
        include('../config.php');
        $sql = "select * from channels where chid = ".$_GET['chid'];
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    ?>
    
        
        <div id="chData" style="background-image:linear-gradient(0deg, black, transparent),url('../channelPic/<?php echo $row['cover']; ?>')"></div>
        <span id="chPN">
                <img src="../channelPic/<?php echo $row['icon']; ?>" alt="icon" id="icon">
                <h2 id="heading"><?php echo $row['chname']; ?></h2>
        </span>
        
        <span id="follow" onclick="addFollow()">
        <i class="fa-solid fa-map-pin"></i>
            Follow Channel
        </span>

        <h2 class="videosTitle">Videos</h2>
        <div id="videos">
            <?php
                $sql = "select * from datavideos where chid = ".$_GET['chid'];
                $_SESSION['chidval'] = $_GET['chid'];
                $result = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_assoc($result)){

                
            ?>
            <div class="container">
                <a href="../view/view.php?query=<?php echo  $row['id'] ?>">
                    <div id="box">
                        <img src="../userDashboard/<?php echo $row['id']."/".$row['coverimg']; ?>" class="cover">
                        <span id="link"><?php echo $row['name']; ?></span>
                    </div> 
                </a>
            </div>
            <?php } ?>
        </div>
        
        </section>
    </section>


</body>
<script src="../jquery.js"></script>
<script>
/*
    $(document).ready(function(e){
        $('form').on('submit', function(e){
            e.preventDefault();

            var formData = new FormData(this);
            formData.append('chid', '<?php echo $_GET['chid']; ?>');

            $.ajax({
                url : "action.php",
                type : "POST",
                data : formData,
                contentType : false,
                processData : false,
                cache: false,
                timeout: 800000,
                success : function(res){
                    console.log(res);
                }
            })
        })
    })*/


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

    function logout(){
        $.ajax({
            type: "post",
            url: "logout.php",
            success: function (response) {
                
            }
        });
    }

    function addFollow(){
        $.ajax({
            type: "post",
            url: "follow.php",
            success: function (response) {
                 console.log(response);;
            }
        });
    }
    function searchRes(){
        document.querySelector('#querySearch').href = '../searchresult/index.php?querySearch='+document.querySelector('#text').value
    }

</script>
</html>