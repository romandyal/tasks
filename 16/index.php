<?php
$arr = file('data.dat');
$count = 0;

$img = imagecreate(100, 100);
$white = imagecolorallocate($img, 255, 255, 255);

foreach ($arr as $key => $str) {
    $arr[$key] = $str = explode(' ', $str);
    $count+= $arr[$key][0];
    $a = rand(0, 255);
    $b = rand(0, 255);
    $c = rand(0, 255);
    $color[] = imagecolorallocate($img, $a, $b, $c);
    $arr[$key][2] = $a;
    $arr[$key][3] = $b;
    $arr[$key][4] = $c;
}

$angle = 0;


foreach ($arr as $num => $list) {
    $end = (360 * $list[0] / $count) + $angle;
    imagefilledarc($img, 49, 49, 100, 100, $angle, $end, $color[$num], IMG_ARC_PIE);
    $angle+= 360 * $list[0] / $count;
}

imagepng($img, "chart.png");
imagedestroy($img);

//print_r($arr);


echo "<br>";
echo '<img src="chart.png" alt=":)">';
echo "<table>";
echo "<tbody>";
foreach ($arr as $item => $value) {
    echo "<tr>";
        echo "<td>";
            echo "<div style=width:15px;"."height:15px;"."background-color:rgb(".$value[2].",".$value[3].",".$value[4]."); > </div>";
        echo "</td>";
        echo "<td>";
            echo $value[0];
        echo "</td>";
        echo "<td>";
            echo round(($value[0]/$count)*100, 1)."% ";
        echo "</td>";
        echo "<td>";
            echo $value[1];
        echo "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
?>



