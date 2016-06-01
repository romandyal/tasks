<?php
exec("du -h --max-depth=1 /opt ", $arr);
echo "<pre>";

foreach ($arr as $item) {
    echo $item."<br>";
}
?>

