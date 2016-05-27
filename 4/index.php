<?php

$string = "qwertyuiopasdfghjklzxcvbnm";
$arr = str_split($string);

$protArr = [];
$protArr[] = "ee11cbb19052e40b07aac0ca060c23ee";
$protArr[] = "dd97813dd40be87559aaefed642c3fbb";
$protArr[] = "8dbc672497bdc46f88e864bb1121232c";
$protArr[] = "3e10f8c809242d3a0f94c18e7addb866";

$res = [];

for ($b = 0; $b < sizeof($protArr); $b++) {

    for ($i = 0; $i < sizeof($arr); $i++) {
        for ($j = 0; $j < sizeof($arr); $j++) {
            for ($k = 0; $k < sizeof($arr); $k++) {
                for ($l = 0; $l < sizeof($arr); $l++) {
                    $str = $arr[$i] . $arr[$j] . $arr[$k] . $arr[$l];
                    if (md5($str) == $protArr[$b]) {
                        $res[] = $str;
                        break(4);
                    }
                }
            }
        }
    }

}
echo "<br>";
for ($g = 0; $g < sizeof($protArr); $g++) {
    
    echo $res[$g]." => ".$protArr[$g]."<br>";

}

