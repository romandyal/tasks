<?php

//$path = "/opt/lampp/htdocs/site.my/www";
if (isset($_GET['path'])) {

    $path = $_GET['path'];
    /**
     * @param $path путь до папки размер которой вычисляем
     * @return int размер папки
     */
    function getFilesSize($path)
    {
        $fileSize = 0;
        $dir = scandir($path);

        foreach ($dir as $file) {
            if (($file != '.') && ($file != '..'))
                if (is_dir($path . '/' . $file))
                    $fileSize += getFilesSize($path . '/' . $file);
                else
                    $fileSize += filesize($path . '/' . $file);
        }

        return $fileSize;
    }

    $treeArr = scandir($path);

    $totalSize = 0;
    $dirData = [];

    foreach ($treeArr as $item) {

        if (($item == '.') || ($item == '..')) {

            continue;

        } elseif (is_dir($path . '/' . $item)) {

            $temp = getFilesSize($path . '/' . $item);
            $dirData[$item] = $temp;
            $totalSize += $temp;
        }
    }

}



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Задание 8</title>
</head>
<body>


    <form action="index.php" method="get">
        Путь: <input type="text" name="path">
        <button type="submit">Посчитать</button>
    </form>
    <?php if(isset($_GET['path'])): ?>
    <table>
        <tbody>
        <tr>
            <td><b>Каталог</b></td>
            <td>Размер</td>
        </tr>
        <tr><td><?php echo $path?></td><td><?php echo round($totalSize / 1024 / 1024, 2)?> Mb</td></tr>
        <tr>
            <td><b>Подкаталоги</b></td>
            <td>Размер</td>
        </tr>
    <?php foreach ($dirData as $item => $value): ?>
        <tr><td><?=$item?></td><td><?=round($value/1024/1024,4)?> Mb</td></tr>
    <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</body>
</html>
