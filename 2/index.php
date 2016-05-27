<?php

$data = file_get_contents("data.txt");

preg_match_all("/(.+)=(.+)/u", $data, $dataArr);

unset($dataArr[0]);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Задание 2</title>
    <link rel="stylesheet" href="base.css">
</head>
<body>
<p>
    <form action="script2.php" method="post">
    <table>
        <tbody>
        <?php for ($i = 0; $i < sizeof($dataArr[1]); $i++): ?>
            <tr>
                <td><?=$dataArr[1][$i]?></td><td><?=$dataArr[2][$i]?></td>
            </tr>
        <?php endfor; ?>
            <tr>
                <td>
                    <input type="text" name="text"  required>
                </td>
                <td>
                    <textarea name="textarea" cols="10" rows="1" required></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p>
                        <button type="submit">Записать!</button>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    </form>
</p>
</body>
</html>