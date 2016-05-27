<?php

$arr = file("words", FILE_IGNORE_NEW_LINES);

$protArr[] = "fb28e9240e83a5264566de844cc45523";
$protArr[] = "437233c74e25fe505293cd2e8ecc2696";
$protArr[] = "06b2d4b91b5c9eaa8c20a1c270f95b3c";
$protArr[] = "e206a54e97690cce50cc872dd70ee896";
$protArr[] = "fbfa6902f089e5a0fa2424bd460ecfd0";

for ($i = 0; $i < sizeof($protArr); $i++) {

    for ($j = 0; $j < sizeof($arr); $j++) {

        $temp = md5(mb_strtolower($arr[$j]));

        if ($temp == $protArr[$i]) {

            $res[$i] = $arr[$j];
            break;
        }
    }
}
echo "<pre>";
for ($g = 0; $g < sizeof($protArr); $g++) {

    echo $res[$g]." => ".$protArr[$g]."<br>";

}

