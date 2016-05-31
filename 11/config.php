<?php
// Cейчас выставлен сервер локальной машины
$dblocation = "localhost";
// Имя базы данных, на хостинге или локальной машине
$dbname = "bd";
// Имя пользователя базы данных
$dbuser = "root";
// и его пароль
$dbpasswd = "";

// Устанавливаем соединение с базой данных
$dbcnx = mysqli_connect($dblocation, $dbuser, $dbpasswd, $dbname);
if (!$dbcnx) {
    exit( "<P>В настоящий момент сервер базы данных не доступен, поэтому корректное отображение страницы невозможно.</P>" );
}


    mysqli_query ($dbcnx, "set character_set_client='cp1251'");
    mysqli_query ($dbcnx, "set character_set_results='cp1251'");
    mysqli_query ($dbcnx, "set collation_connection='cp1251_general_ci'");

?>