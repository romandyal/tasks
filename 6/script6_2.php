<?php

$arr = file("data.txt", FILE_IGNORE_NEW_LINES);

$radioArr = [];
$checkArr = [];
$textArr = [];
$textareaArr = [];

for ($i = 0; $i < sizeof($arr); $i++ ) {

    if ( preg_match( "/radio_\w+/u", $arr[$i]) ) {

        preg_match( "/(radio_.+)\s=\s(.+)/u", $arr[$i], $data);
        $radioArr[$data[1]] = $data[2];

    } elseif( preg_match( "/check_\w+/u", $arr[$i]) ) {

        preg_match( "/(check_.+)\s=\s(.+)/u", $arr[$i], $data);
        $checkArr[$data[1]] = $data[2];

    } elseif( preg_match( "/text_\w+/u", $arr[$i]) ) {

        preg_match( "/(text_.+)\s=\s(.+)/u", $arr[$i], $data);
        $textArr[$data[1]] = $data[2];

    } elseif( preg_match( "/textarea_\w+/u", $arr[$i]) ) {

        preg_match( "/(textarea_.+)\s=\s(.+)/u", $arr[$i], $data);
        $textareaArr[$data[1]] = $data[2];

    }
}
?>

<!doctype html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Document</title>
        </head>
        <body>
            <form action="script6_1.php" method="get">
                <?php foreach($radioArr as $ind => $val): ?>
                    <input type="radio" name="<?=$ind?>" value="<?=$val?>"><?=$val?><br>
                <?php  endforeach; ?>
                <?php foreach($checkArr as $ind => $val): ?>
                    <input type="checkbox" name="<?=$ind?>" value="<?=$val?>"><?=$val?><br>
                <?php  endforeach; ?>
                <?php foreach($textArr as $ind => $val): ?>
                    <input type="text" name="<?=$ind?>" value="<?=$val?>"><br>
                <?php  endforeach; ?>
                <?php foreach($textareaArr as $ind => $val): ?>
                    <textarea name="<?=$ind?>" cols="10" rows="1"><?=$val?></textarea><br>
                <?php  endforeach; ?>
                <button type="submit">Отправить!</button>
            </form>
        </body>
    </html>
