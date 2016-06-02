<?php

if(isset($_GET['dec'])) {

    $dec = $_GET['dec'];

    $res = "";
    $num = goBin($dec);

}

if (isset($_GET['dob'])) {

    $dob = $_GET['dob'];
    $res = "";
    $num = goDec($dob);

}

function goDec($num) {

$arr = str_split($num);

$arr = array_reverse($arr);
$res = 0;

foreach ($arr as $item => $value) {

    if ($item == 0) {
        $res += 0;
    } else {
        $res += pow($value * 2, $item) . "<br>";
    }
}
return $res;

}

function goBin($num)
{
    global $res;
    if ($num == 0) return strrev($res);

    if ($num % 2 == 0) {
        $res .= "0";
        $num = floor($num / 2);
        return goBin($num);
    } else {
        $res .= "1";
        $num = floor($num / 2);
        return goBin($num);
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Задание 20</title>
</head>
<body>
<form action="index.php">
    <p>
        Перевести в двоичную
    </p>
    <input type="text" name="dec">
    <input type="submit" value="Отправить">
</form><br>

<form action="index.php">
    <p>
        Перевести в десятичную
    </p>
    <input type="text" name="dob">
    <input type="submit" value="Отправить">
</form><br>
<?php if(isset($num)):?>
    <p>
        Результат: <?php echo $num;?>
    </p>
<?php endif;?>
</body>
</html>
