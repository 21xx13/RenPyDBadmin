<?php
$dir    = './game_scores';
$files1 = scandir($dir);

for($i=2; $i < count($files1); $i++)
    echo $files1[$i]."<br>";
