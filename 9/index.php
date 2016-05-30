<?php

if (isset($_GET['path'])) {

    $path = $_GET['path'];
//$path = "/opt/lampp/htdocs/site.my";
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

    /**
     * @param $path путь для отрисовки
     * Рекурсивная отрисовка списков подпапок
     */
    function dirWriter($path)
    {

        $treeArr = scandir($path);

        foreach ($treeArr as $item) {

            if (($item == '.') || ($item == '..')) {

                continue;

            } elseif (is_dir($path . '/' . $item)) {
//            echo "<ul>";
//            echo "<li>";
                echo $item . " " . (int)(getFilesSize($path) / 1024) . "Kb";

                echo "<ul>";
//                        echo "<li>";
                echo dirWriter($path . '/' . $item);
//                        echo "</li>";
                echo "</ul>";

//            echo "</li>";
//            echo "</ul>";
            }
        }
    }

//echo dirWriter($path);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="get">
        Путь: <input type="text" name="path">
        <button type="submit">Построить дерево!</button>
    </form>
    <?php if(isset($_GET['path'])): ?>
        <?php dirWriter($path);?>
    <?php endif; ?>
</body>
</html>