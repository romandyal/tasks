<?php

$arr = file("data.txt", FILE_IGNORE_NEW_LINES);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Задание 7</title>
</head>
<body>
    <?php foreach ($arr as $item): ?>
        <?=$item?><br>
    <?php endforeach;?>
    <br>
    <form action="mixture.php" type="post">
        <button type="submit">Случайно!</button>
    </form><br>
    <form action="ordernum.php" type="post">
        <button type="submit">По номеру!</button>
    </form><br>
    <form action="orderalph.php" type="post">
        <button type="submit">По алфавиту!</button>
    </form>
</body>
</html>
