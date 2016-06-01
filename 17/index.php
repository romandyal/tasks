<?php
exec("du -h --max-depth=1 /opt ", $arr);
echo "<pre>";
print_r($arr);
?>

