<?php

$arr = file("data.txt", FILE_IGNORE_NEW_LINES);

asort($arr, SORT_NUMERIC);

print_r($arr);

$file = fopen( "data.txt", "w+");

foreach ($arr as $index) {

    $rec = $index."\n";
    fwrite($file, $rec);
}

fclose($file);

$host = $_SERVER['HTTP_HOST'];

header("Location: http://$host/7/index.php");