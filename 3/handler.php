<?php
if ( isset( $_POST['year'] ) && isset( $_POST['hour'] ) ) {

    $year = $_POST['year'];
    $mounth = $_POST['mounth'];
    $date = $_POST['date'];
    $hour = $_POST['hour'];
    $min = $_POST['min'];

    $rec = $year. "/" .$mounth."/".$date."/".$hour."/".$min;

    echo $rec;

    $file = fopen( "date.txt", "w+");

    fwrite($file, $rec);

    fclose($file);

}
$host = $_SERVER['HTTP_HOST'];

header("Location: http://$host/3/index.php");