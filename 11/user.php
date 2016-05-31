
<?php
  // Устанавливаем соединение с базой данных
  require_once("config.php");
if(!preg_match("|^[\d]+$|",$_GET['id_user'])) exit("Не верный формат вывода");

  // Запрашиваем список всех пользователей
  $query = "SELECT * FROM userslist WHERE id_user = $_GET[id_user]";
  $usr = mysqli_query($dbcnx ,$query);
  if(!$usr) exit("Ошибка - ".mysqli_error());
  $user = mysqli_fetch_array($usr);
  echo "Имя пользователя - $user[name]";
  if(!empty($user['email'])) echo "e-mail - $user[email]";
  if(!empty($user['url'])) echo "URL - $user[url]";
?>