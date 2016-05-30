<?php

$descriptArr = file("descript.ion", FILE_IGNORE_NEW_LINES);

//print_r($descriptArr);

$imgArr = [];
foreach ($descriptArr as $item) {

    preg_match("/(.+)\s/uU", $item, $temp);
    preg_match("/\s(.+)/u", $item, $descript);
    $imgArr["$temp[1]"] = $descript[1];
}
//print_r($imgArr);
$i = 0;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Задание 10</title>
    <style>
        p
        {
            text-align: center;
        }
        img
        {
            width: 150px;
            height: 150px;
            border-radius: 3px;
        }
        td
        {
            border:1px solid grey;
            border-radius: 5px;
            text-align: center;
        }

    </style>
</head>
<body>
<table>
    <tbody>
    <?php foreach ($imgArr as $imgName => $desc): ?>
       <?php if($i % 3 == 0) echo"<tr>"; $i++;?>
            <td>
                <img src="./pic/<?=$imgName?>" alt="<?=$desc?>">
                <p><?=$desc?></p>
            </td>
        <?php if($i % 3 == 0) echo"</tr>";  ?>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>