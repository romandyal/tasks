<?php
// передаваемые данные
$name = "Login";
$pass = "Password";

$hostname = "localhost";
$fp = fsockopen($hostname,80);

// формируем строку с отправляемымы данными
$data = 'name='.urlencode($name)."&pass=".urlencode($pass)."\r\n\r\n";
$headers = "POST /15/handler.php HTTP/1.1\r\n"
    ."Host: $hostname\r\n"
    ."Content-type: application/x-www-form-urlencoded\r\n"
    ."Content-Length: ".strlen($data)."\r\n\r\n";
echo $headers;
echo $data;
// отправляем
//fwrite($fp,$headers.$data);
//
//// на этом впринципе отправка закончена,
//// для уверенности можно прочитать один
//// байт или все содержимое:
//while(!feof($fp))
//    echo fread($fp,200);

fclose($fp);
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Задание 15</title>
</head>
<body>
<form method=post action="handler.php">
    Имя : <input type=text name=name>
    Пароль : <input type=text name=pass>
    <input type=submit name=send value=Отправить>
</form>
</body>
</html>