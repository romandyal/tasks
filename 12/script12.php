<?php

if (isset($_GET['s']) && isset($_GET['n'])) {

    $str = $_GET['s'];
    $block = $_GET['n'];

    $sum = $str * $block;

    $arr = file("data.txt", FILE_IGNORE_NEW_LINES);

//    print_r($arr);
}
if (isset($_GET['pos'])) {
    $pos = $_GET['pos'];
} else {
    $pos = 0;
}
$strSum = $pos * $sum;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Задание 12</title>
    <style>
        a
        {
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>

<?php
echo "<table>";
   echo "<tbody>";
        echo "<tr>";

            for($i = 0; $i < $block; $i++) {
                echo "<td>";
                 for($j = 1; $j <= $str; $j++){
                        if($strSum == sizeof($arr)) continue;
                     echo $arr[$strSum]."<br>";
                     $strSum++;
                 }

                echo "</td>";
            }
        echo "</tr>";
   echo "</tbody>";
echo "</table>";
            echo "<br>";
?>

           <?php for ($i = 0; $i < ceil(sizeof($arr)/$sum); $i++): ?>
               <?php if($i == $pos) echo "<b>";?>
                <a href="script12.php?n=<?=$block?>&s=<?=$str?>&pos=<?=$i?>">
                <?=($i+1)." ";?>
                </a>
               <?php if($i == $pos) echo "</b>";?>
            <?php endfor; ?>


</body>
</html>
