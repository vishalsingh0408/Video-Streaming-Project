<?php

    include('../config.php');

    echo pathinfo($_FILES['vid']['name'],PATHINFO_EXTENSION);

    $sql = "insert into datavideos (name, videoname, coverimg, chid) values ('".$_POST['name']."','video.mp4','".$_FILES['pic']['name']."',".$_SESSION['chidval'].")";

    $sqlGetID = "select last_insert_id()";

    mysqli_query($conn, $sql);
    $resultID = mysqli_query($conn, $sqlGetID);
    $rowID = mysqli_fetch_assoc($resultID);

    shell_exec('mkdir '.$rowID['last_insert_id()']);


    $sql2 = "SELECT id FROM datavideos WHERE chid = ".$_SESSION['chidval']." and id = (select max(id) from datavideos)";
    $res = mysqli_query($conn, $sql2);
    $row = mysqli_fetch_assoc($res);
    $sql3 = "create table vid_".$row['id']."(comment varchar(255), commentBy integer(20),reaction integer(20))";
    mysqli_query($conn, $sql3);
    move_uploaded_file($_FILES['vid']['tmp_name'],$rowID['last_insert_id()']."/video.".pathinfo($_FILES['vid']['name'],PATHINFO_EXTENSION));
    move_uploaded_file($_FILES['pic']['tmp_name'],$rowID['last_insert_id()']."/".$_FILES['pic']['name']);
    
    #echo 'ffprobe -loglevel 0 -print_format json -show_format -show_streams '.$rowID['last_insert_id()']."/".str_replace("/",".",$_FILES['vid']['type']).' > second.json';
    shell_exec('ffprobe -loglevel 0 -print_format json -show_format -show_streams '.$rowID['last_insert_id()']."/video.".pathinfo($_FILES['vid']['name'],PATHINFO_EXTENSION).' > '.$rowID['last_insert_id()'].'/second.json');
    shell_exec('ffmpeg -i '.$rowID['last_insert_id()'].'/video.mkv -codec copy '.$rowID['last_insert_id()'].'/video.mp4');


    $data = file_get_contents($rowID['last_insert_id()'].'/second.json');
    $json_data = json_decode($data, true);


    $i = 0;
    for($i;$i<$json_data['format']['nb_streams'];$i++)
    {
        if($json_data['streams'][$i]['codec_type'] == 'audio')
        {
            $temp = $i - 1;
            //echo 'ffmpeg -i '.$rowID['last_insert_id()']."/".str_replace("/",".",$_FILES['vid']['type']).' -map 0:a:'.$temp.' -c copy '.$rowID['last_insert_id()']."/".$json_data['streams'][$i]['tags']['language'].'.m4a';
            shell_exec('ffmpeg -i '.$rowID['last_insert_id()']."/video.".pathinfo($_FILES['vid']['name'],PATHINFO_EXTENSION).' -map 0:a:'.$temp.' '.$rowID['last_insert_id()']."/".$json_data['streams'][$i]['tags']['language'].'.mp3');
        }
    }
    
    header('Location: ../');

?>
