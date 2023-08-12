<?php

$str = "ffprobe -loglevel 0 -print_format json -show_format -show_streams .\kell.mp4 > second.json";
echo $str;
shell_exec($str);

?>