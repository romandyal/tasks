<?php

$srcReport = file("data.txt");
//foreach ($srcReport as $key => $value) {
//    echo $value.'<br>';
//}

$arReport = array();
$sum = 0;
foreach ($srcReport as $item) {
    $ar = explode(' ', $item);
    $arReport[] = $ar;
    $sum += $ar[1];


}

$canvas = imagecreate(300,500);
$white = imagecolorallocate($canvas,255,255,255);
$black = imagecolorallocate($canvas,0,0,0);
$font_file = './arial.ttf';
imagefttext($canvas, 13, 0, 105, 55, $black, $font_file, 'PHP Manual');
imagefilledrectangle($canvas,0,0,300,300,$white);

imagefilledrectangle($canvas,40,0,40,200,$black);
imagefilledrectangle($canvas,40,200,290,200,$black);

for ($i=0,$j=1; $i <=250 ; $i+=50) {

    imagefttext($canvas, 9, 0, 19, 212-$i , $black, $font_file, "$i");
    imagefttext($canvas, 9, 0, 80+$i, 215 , $black, $font_file, "$j");
    imageline($canvas,40+$i,197,40+$i,203 ,$black);
    imageline($canvas,37,200-$i,43,200-$i ,$black);
    $j += 1;
};

$x = 40;
$y = $arReport[0][1];

for($i=1,$j = 200 - $y; $i < sizeof($arReport); $i++) {
    imageline($canvas,$x,$j,$x+50,200 - $arReport[$i][1],$black);
    $x += 50;
    $j = 200 - $arReport[$i][1];
}
$k = 0;
$i = 0;
foreach ($arReport as $item) {
    imagefttext($canvas, 13, 0, 50, 300+$k, $black, $font_file, "$i)  $item[0] $item[1]");
    $k += 20;
    $i += 1;
}

imagepng($canvas, "chart.png");
ImageDestroy($canvas);

?>

<img src="chart.png" alt=":)">

