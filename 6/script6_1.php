<?php

if($_SERVER['REQUEST_METHOD'] == "GET") {
    $arr = $_GET;
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    $arr = $_POST;
};

$file = fopen( "data.txt", "w+");

foreach ($arr as $index => $value) {

    $rec = $index. " = " .$value."\n";
    fwrite($file, $rec);
}

fclose($file);

$host = $_SERVER['HTTP_HOST'];

header("Location: http://$host/6/script6_2.php");


