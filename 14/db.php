<?php
// Cейчас выставлен сервер локальной машины
$dblocation = "localhost";
// Имя базы данных, на хостинге или локальной машине
$dbname = "task_14";
// Имя пользователя базы данных
$dbuser = "root";
// и его пароль
$dbpasswd = "";

// Устанавливаем соединение с базой данных
$dbcnx = mysqli_connect($dblocation, $dbuser, $dbpasswd, $dbname);

if (!$dbcnx) {
    exit( "<P>В настоящий момент сервер базы данных не доступен, поэтому корректное отображение страницы невозможно.</P>" );
}


mysqli_query ($dbcnx, "set character_set_client='utf8'");
mysqli_query ($dbcnx, "set character_set_results='utf8'");
mysqli_query ($dbcnx, "set collation_connection='utf8_general_ci'");

?>