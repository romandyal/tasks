<?php
// Устанавливаем соединение с базой данных
require_once("db.php");
// Запрашиваем список всех пользователей
$query = "SELECT name, description FROM name ORDER BY name";
$usr = mysqli_query($dbcnx, $query);
$usrArr = [];
if(!$usr) exit("Ошибка - ".mysqli_error());
while($user = mysqli_fetch_array($usr))
{
    $usrArr[$user[0]] = $user[1];
}
//print_r($usrArr);

$str = "абвгдеёжзийклмнопрстуфхцчшщъыьэюя";
$arr = preg_split('//u',$str , -1 ,PREG_SPLIT_NO_EMPTY);
//print_r($arr);

/**
 * @param $char буква для сравнения
 * @param $usrArr массив пользователей
 * @return int если первая буква имени элемента массива совпадает с буквой, возвращаем 1
 */
function characterSet ($char , $usrArr) {

    foreach ($usrArr as $item => $value) {
        if(mb_strtolower(mb_substr($item, 0, 1)) == $char) {
            return 1;
        }
    }
    return 0;
}
$arrView = [];
if (isset($_GET['char'])) {

    $char = $_GET['char'];
    $b = 0;

    foreach ($usrArr as $item => $value) {

        if (mb_strtolower(mb_substr($item, 0, 1)) == $char) {
            $arrView[$b][] = $item;
            $arrView[$b][] = $value;
            $b++;
        }
    }
//    print_r($arrView);
}
if(isset($_GET['pos'])) {

    if ($_GET['pos'] % 3 == 0) {
        $pos = $_GET['pos'];
    } else {
        $pos = 0;
    }
} else { $pos = 0;}
if (isset($_GET['name'])) {
    $name = $_GET['name'];
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Задание 14</title>
    <style>
        a
        {
            text-decoration: none;
        }
        b
        {
            font-size: 20px;
        }
    </style>
</head>
<body>

<?php for($i = 0; $i < sizeof($arr); $i++): ?>

<?php if(characterSet($arr[$i], $usrArr)): ?>
<b>
<a href="index.php?char=<?=$arr[$i]?>">
    <?php endif;?>
<?=$arr[$i];?>
    <?php if(characterSet($arr[$i], $usrArr)): ?>
    </a>
</b>
    <?php endif;?>
<?php endfor;?>

<table>
    <tbody>
    <tr>
        <?php if($arrView):?>
            <?php for($j = $pos; $j < sizeof($arrView); $j++): ?>
                <td>
                    <a href="index.php?char=<?=$char?>&pos=<?=$pos?>&name=<?=$j?>">
                        <?=$arrView[$j][0]?>
                    </a>
                </td>
                <?php $pos++; if($pos % 3 == 0) break; ?>
            <?php endfor; ?>
            <?php if ($pos < sizeof($arrView)) {
                echo "<td>";
                    echo "<a href='index.php?char=$char&pos=$pos'>";
                        echo "&gt;&gt;";
                    echo "</a>";
                echo "</td>";
            }
            ?>
        <?php endif;?>
    </tr>
    </tbody>
</table><br>
<table>
    <tbody>
        <tr>
            <?php if(isset($_GET['name'])): ?>
                <td>

                    <?= $arrView[$name][0]?>
                </td>
                <td>
                    <?= $arrView[$name][1] ?>
                </td>
            <?php endif;?>
        </tr>
    </tbody>
</table>
</body>
</html>
