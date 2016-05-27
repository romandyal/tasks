<?php

    if(file_exists("date.txt")) {

        $data = file_get_contents("date.txt");

        preg_match_all("/\d+/", $data, $dataArr);

    } else {
        
        $data = date('Y/m/j/G/i');

        preg_match_all("/\d+/", $data, $dataArr);
    }

?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Задание 3</title>
        <style>
            input
            {
                width:50px;
            }
        </style>
    </head>
    <body>
        <form action="handler.php" method="post">
            <label>Год <input name="year" type="text" maxlength="4" required value="<?php echo $dataArr[0][0]; ?>"></label>
            <label>Месяц <input name="mounth" type="number" max="12" min="1" required value="<?php echo $dataArr[0][1]; ?>"></label>
            <label>Число <input name="date" type="number" max="31" min="1" required value="<?php echo $dataArr[0][2]; ?>"></label>
            <label>Часы <input name="hour" type="number" max="23" min="0" required value="<?php echo $dataArr[0][3]; ?>"></label>
            <label>Минуты <input name="min" type="number" max="59" min="0" required value="<?php echo $dataArr[0][4]; ?>"></label>
            <button type="submit">Отправить!</button>
        </form>
    </body>
</html>


