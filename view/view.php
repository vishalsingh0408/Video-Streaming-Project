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
        <?php

            include('../config.php');
            $sql = "select * from datavideos where id = ".$_GET['query'];
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

        ?>





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
        <div id="main">
        <video type="video/mp4" muted id="vid" src="../userDashboard/<?php echo $_GET['query']."/".$row['videoname'] ?>"></video>
        <div class="videoControls">
          <span class="seekCon">
            <h3 class="start">0 : 0 : 0</h3>
                  <div id="seek" onchange="videoChange()"></div>
            <h3 class="end"></h3>
          </span>
          <span class="mainControls">
            <div>
              <span id="pl">
                  <i class="fa-solid fa-play" onclick="pl()"></i>
                  <i class="fa-solid fa-pause" onclick="ps()"></i>
              </span>
              <div>
                <span id="backw">
                <i class="fa-solid fa-backward" onclick="bcvd()"></i>
                </span>
                <span id="forw">
                <i class="fa-solid fa-forward" onclick="fwvd()"></i>
                </span>
              </div>
              
              <span id="vol">
              <i class="fa-solid fa-volume-high"></i>
              <input type="range" name="vol" id="volume" min="0" max="1" step="0.1" onchange="document.querySelector('audio').volume = this.value">
              </span>
            </div>
            
            <div>
                <span id="languages">
                <i class="fa-solid fa-language"></i>
                  <select name="lang" id="lang" onchange="langCh()">
                    <?php

                        $data = file_get_contents("../userDashboard/".$_GET['query']."/second.json");
                        $json_data = json_decode($data, true);


                        $i = 0;
                        for($i;$i<$json_data['format']['nb_streams'];$i++)
                        {
                            if($json_data['streams'][$i]['codec_type'] == 'audio')
                            {
                                $temp = $i - 1;
                                echo "<option value=".$json_data['streams'][$i]['tags']['language'].">".$json_data['streams'][$i]['tags']['language']."</option>";
                            }
                        }

                    ?>
                  </select>
                </span>
                <span id="full">
                  <i class="fa-solid fa-arrows-up-down-left-right" onclick="fullSc()"></i>
                </span>
            </div>
          </span>
        </div>
        <audio type="audio/mpeg" src="../userDashboard/<?php echo $_GET['query']."/eng.mp3" ?>"></audio>
      </div>

    <div id="container">
      <span id="conVideo">
        <h3><?php echo $row['name']; ?></h3>
          <?php 
            $sqlQuery = "select * from channels where chid = ".$row['chid'];
            $resQuery = mysqli_query($conn, $sqlQuery);
            $rowQuery = mysqli_fetch_assoc($resQuery);
          ?>
          <a href="../channelView/channelView.php?chid=<?php echo $row['chid'] ?>">
            <span>
              <img src="../channelPic/<?php echo $rowQuery['icon'] ?>" alt="icon">
              <h4><?php echo $rowQuery['chname'] ?></h4>
            </span>
          </a>
          
      </span>
        
        <div id="emoji_container">
            <img src="./1-Grinning-Face-unscreen.gif" alt="" class="em1" onclick="em1() ">
            <img src="./3-Face-With-Tears-unscreen.gif" alt="" class="em2" onclick="em2()">
            <img src="./100-Flexed-Biceps-unscreen.gif" alt="" class="em3" onclick="em3()">
            <img src="./61-Exploding-Head-unscreen.gif" alt="" class="em4" onclick="em4()">
            <img src="./132-1-unscreen.gif" alt="" class="em5" onclick="em5()">
        </div>

    </div>

    <div class="comments">
      <h3>Comments</h3>
      <?php
        if(isset($_SESSION['name'])){?>
          <input id="comment" type="text" name="comment" value="" placeholder="Type your comment here" required>
          <input id="sub" type="submit" name="submit" value="Submit" onclick="addComm()">
        <?php }
        
      ?>
      <span id="othersComments">


      <?php
        $sql = "SELECT vid_".$_GET['query'].".comment, vid_".$_GET['query'].".commentBy, persons.firstname, persons.lastname, persons.profilephoto from vid_".$_GET['query']." inner join persons
        where vid_".$_GET['query'].".commentBy = persons.userid";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){?>
          <span class="comm">
            <span class="by">
              <h3><?php echo $row['firstname']." ".$row['lastname']; ?></h3> commented
            </span>
            <p><?php echo $row['comment']; ?></p>
          </span>
      <?php } ?>
      </span>
    </div>
        </section>
        
    </section>


    
   <!--<video controls autoplay src="videos/<?php //echo $row['videoname'] ?>"></video>-->
    
</body>

<script src="../jquery.js" charset="utf-8"></script>
<script>

function bcvd(){
  document.querySelector('video').currentTime = Math.abs(document.querySelector('video').currentTime-5);
  document.querySelector('audio').currentTime = document.querySelector('video').currentTime;
}

function fwvd(){
  document.querySelector('video').currentTime = Math.abs(document.querySelector('video').currentTime+5);
  document.querySelector('audio').currentTime = document.querySelector('video').currentTime;
}

  
document.querySelector('video').onloadedmetadata = function (){chec()}
document.querySelector('video').ontimeupdate = function (){seekUp()}

let drhr=0;
let drmn=0;
let drsc=0;


function chec(){
  document.querySelector('audio').src = "../userDashboard/"+<?php echo $_GET['query']; ?>+'/'+document.querySelector('#lang').value+".mp3";

  if(Math.floor(document.querySelector('video').duration) >= 3600)
    drhr = Math.floor(Math.floor(document.querySelector('video').duration)/3600);

  if((Math.floor(document.querySelector('video').duration)-(3600*drhr)) >= 60){
    drmn = Math.floor((Math.floor(document.querySelector('video').duration)-(3600*drhr))/60);
  }
    drsc = Math.floor(Math.floor(document.querySelector('video').duration) - Math.floor(3600*drhr + 60*drmn))

  document.querySelector('.end').innerHTML =drhr+' : '+drmn+' : '+drsc;
}

let crhr = 0;
let crmn = 0;
let crsc = 0;

function seekUp(){
  
  if(Math.floor(document.querySelector('video').currentTime) >= 3600){
    crhr = Math.floor(Math.floor(document.querySelector('video').currentTime)/3600);
  } 
  if((Math.floor(document.querySelector('video').currentTime)-(3600*crhr)) >= 60){
    crmn = Math.floor((Math.floor(document.querySelector('video').currentTime)-(3600*crhr))/60);
  }
  
  crsc = Math.floor(Math.floor(document.querySelector('video').currentTime) - Math.floor(3600*crhr + 60*crmn))
  

  document.querySelector('.start').innerHTML =crhr+' : '+crmn+' : '+crsc;
  console.log(document.querySelector('video').currentTime+" | "+document.querySelector('audio').currentTime);
  document.documentElement.style.setProperty('--seekVal', (document.querySelector('video').currentTime/document.querySelector('video').duration)*100+'%');
}



function pl(){
  document.querySelector('.fa-play').style.display = 'none';
  document.querySelector('.fa-pause').style.display = 'block';
  document.querySelector('audio').currentTime = document.querySelector('video').currentTime
  document.querySelector('audio').play()
  document.querySelector('video').play()
}

function ps(){
  document.querySelector('.fa-play').style.display = 'block';
  document.querySelector('.fa-pause').style.display = 'none';
  document.querySelector('audio').pause()
  document.querySelector('video').pause()
}

function videoChange(){
  document.querySelector('video').currentTime = document.querySelector('#seek').value;
  document.querySelector('audio').currentTime = document.querySelector('video').currentTime
}


function langCh(){
  document.querySelector('audio').src = "../userDashboard/"+<?php echo $_GET['query']; ?>+'/'+document.querySelector('#lang').value+".mp3";
  ps()
}


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

    
  function addComm(){
    console.log('check');
    $.ajax({
      url: "addComment.php",
      type: "POST",
      data : {comm: $('#comment').val(), qy: <?php echo $_GET['query']; ?>},
      success: ((res)=>{


        console.log(res);
      })
    })
  }



  function em1(){
    
    $.ajax({
      type: "post",
      url: "reaction.php",
      data: { data : "1", qy: <?php echo $_GET['query']; ?>},
      success: function (response) {
        console.log(response);
      }
    });
    document.querySelector('.em1').style.boxShadow = "inset 0px 0px 10px yellow";
  }

  function em2(){
    
    $.ajax({
      type: "post",
      url: "reaction.php",
      data: { data : "2", qy: <?php echo $_GET['query']; ?>},
      success: function (response) {
        
      }
    });
    document.querySelector('.em2').style.boxShadow = "inset 0px 0px 10px yellow";
  }
  function em3(){
    
    $.ajax({
      type: "post",
      url: "reaction.php",
      data: { data : "3", qy: <?php echo $_GET['query']; ?>},
      success: function (response) {
        
      }
    });
    document.querySelector('.em3').style.boxShadow = "inset 0px 0px 10px yellow";
  }
  function em4(){
    
    $.ajax({
      type: "post",
      url: "reaction.php",
      data: { data : "4", qy: <?php echo $_GET['query']; ?>},
      success: function (response) {
        
      }
    });
    document.querySelector('.em4').style.boxShadow = "inset 0px 0px 10px yellow";
  }
  function em5(){
    
    $.ajax({
      type: "post",
      url: "reaction.php",
      data: { data : "5", qy: <?php echo $_GET['query']; ?>},
      success: function (response) {
        
      }
    });
    document.querySelector('.em5').style.boxShadow = "inset 0px 0px 10px yellow";
  }



  function searchRes(){
        document.querySelector('#querySearch').href = '../searchresult/index.php?querySearch='+document.querySelector('#text').value
    }

  document.querySelector('#seek').addEventListener('click', (e)=>{
    document.documentElement.style.setProperty('--seekVal',((e.layerX/document.querySelector('#seek').getBoundingClientRect().width)*100)+'%');
    document.querySelector('video').currentTime = (document.querySelector('video').duration*((e.layerX/document.querySelector('#seek').getBoundingClientRect().width)*100))/100
    document.querySelector('audio').currentTime = document.querySelector('video').currentTime;
  })

  <?php 
  $sqlEm = "select reaction from vid_".$_GET['query'];
  $sqlEmRes = mysqli_query($conn, $sqlEm);
  $sqlEmRow = mysqli_fetch_assoc($sqlEmRes);
  ?>
  document.querySelector('.em<?php echo $sqlEmRow['reaction']?>').style.boxShadow = "inset 0px 0px 10px yellow";

  let el = document.querySelector('#main');
  function fullSc(){
    if (el.requestFullscreen) {
      el.requestFullscreen();
  } else if (el.webkitRequestFullscreen) { /* Safari */
    el.webkitRequestFullscreen();
  } else if (el.msRequestFullscreen) { /* IE11 */
    el.msRequestFullscreen();
  }
  }
</script>
</html>
