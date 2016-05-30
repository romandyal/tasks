<?php

$arr = file("data.txt", FILE_IGNORE_NEW_LINES);

$arrRev = [];

foreach ($arr as $value) {

    preg_match("/(\d+)\s(.+)/u", $value, $temp);

    $arrRev[] = $temp[2]." ".$temp[1];

}

asort($arrRev);

$arrRes = [];

foreach ($arrRev as $value) {

    preg_match("/(.+)\s(\d+)/u", $value, $temp);

    $arrRes[] = $temp[2]." ".$temp[1];

}

$file = fopen( "data.txt", "w+");

foreach ($arrRes as $index) {

    $rec = $index."\n";
    fwrite($file, $rec);
}
fclose($file);

$host = $_SERVER['HTTP_HOST'];
header("Location: http://$host/7/index.php");