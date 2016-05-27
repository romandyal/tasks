<?php
if ( isset( $_POST['text'] ) && isset( $_POST['textarea'] ) ) {

    $text = $_POST['text'];
    $textarea = $_POST['textarea'];

    $rec = $text. "=" .$textarea."\n";

    $file = fopen( "data.txt", "a+");

    fwrite($file, $rec);

    fclose($file);

}
$host = $_SERVER['HTTP_HOST'];

header("Location: http://$host/2/index.php");
