<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

$dbcnx = mysqli_connect("localhost", "root", "", "task_21");

if (!$dbcnx) {
    exit( "<P>В настоящий момент сервер базы данных не доступен, поэтому корректное отображение страницы невозможно.</P>" );
}



/**
 * Редирект на гравную страницу
 */
function task21_redirect() {
    header("Location: http://".$_SERVER['HTTP_HOST']."/".$_SERVER['PHP_SELF']."");
    exit;
}
/**
 * Проверка правильного ввода имени
 *
 * @param string $name Проверяемое имя
 * @return string Текст сообщения
 */
function task2_check_name($name) {
    $error = '';
    if ($name > 255)
        $error =  "Длина имени не должна превышать 255 символов";
    if (!task21_check_exists_user($name))
        $error = "Такое имя уже существует, введите другое";
    return $error;
}
/**
 * Проверяет существование пользователя
 *
 * @param string $name Проверяемое имя
 * @return boolean true если пользователь не существует
 */
function task21_check_exists_user($name) {
    global $dbcnx;
    $name   = mysqli_real_escape_string($dbcnx, $name);
    $sql    = "SELECT id FROM guests WHERE guestname = '$name'";
    $result = mysqli_query($dbcnx, $sql);
    $row    = mysqli_fetch_row($result);
    return empty($row);
}
/**
 * Возвращает всех пользователей в таблице
 *
 * @return array
 */
function task21_get_users() {
    global $dbcnx;
    $guest  = array();
    $sql    = "SELECT * FROM guests";
    $result = mysqli_query($dbcnx, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $row['questname'] = htmlspecialchars($row['guestname']);
        $guest[] = $row;
    }
    return $guest;
}
/**
 * Добавляет пользователя в базу
 *
 * @param string $name Имя добавляемого пользователя
 */
function task21_add_user($name) {
    global $dbcnx;
    $visits = intval($_SESSION['counter']);
    $dbname = mysqli_real_escape_string($dbcnx,$name);
    $sql  = "INSERT INTO guests (id, guestname, visits) VALUES (NULL, '$dbname', $visits)";
    mysqli_query($dbcnx,$sql);
    $_SESSION['user_id']   = mysqli_insert_id($dbcnx);
    $_SESSION['user_name'] = $name;
    task21_redirect();
}
/**
 * Удаляет пользователя из базы
 *
 * @param integer $id Индификатор пользователя
 */
function task21_del_user($id) {
    global $dbcnx;
    $id  = (int)$_REQUEST['id'];
    $sql = "DELETE FROM guests WHERE id = $id";
    mysqli_query($dbcnx,$sql);
    session_destroy();
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    task21_redirect();
}
/**
 * Поиск пользователя
 *
 * @param string $name Имя пользователя в параметрах поиска
 */
function task21_search_user($name) {
    global $dbcnx;
    $name   = mysqli_real_escape_string($dbcnx,$name);
    $guest  = array();
    $sql    = "SELECT * FROM guests WHERE guestname = '$name'";
    $result = mysqli_query($dbcnx, $sql);
    $row    = mysqli_fetch_assoc($result);
    if (empty($row)) {
        echo "Не найдено ни одного пользователя&nbsp;";
        echo "<a href='javascript:history.back()'>Вернутся</a>";
        exit;
    }
    $row['questname'] = htmlspecialchars($row['guestname']);
    $guest[] = $row;

    task21_display($guest, false);
    exit;
}
/**
 * Обработка действий скрипта
 *
 */
function task21_actions() {
    if ($_REQUEST['act'] == "add_user") {
        // Проверяем имя
        $error = task2_check_name($_REQUEST['name']);
        if (!empty($error)) {
            task21_display(task21_get_users(), $error);
            exit;
        }
        // Добавляем пользователя
        task21_add_user($_REQUEST['name']);
    }
    else if ($_REQUEST['act'] == "del_user")
        task21_del_user($_REQUEST['id']);
    else if ($_REQUEST['act'] == "search_user")
        task21_search_user($_REQUEST['name']);
    echo "Команда не известна";
    exit;
}
/**
 * Вывод таблицы на экран
 *
 * @param array $guest Двумерный массив с информацией о пользователях
 * @param string $error Возможная ошибка
 */
function task21_display($guest, $error) {
    $rowcounter = 1; // счетчик строк
    ?>
    <html>
    <head>
        <title>Задача №21</title>
    </head>
    <body>
    <?php if (!isset($_SESSION['user_id'])) :?>
        <form method="post" action="task21.php">
            <label for="user_name"><input id="user_name" name="name" /></label>
            <input type="hidden" name="act" value="add_user" />
            <input type="submit" value="Добавить себя" />
        </form>
    <?php else:?>
        Привет, <?php echo $_SESSION['user_name'] ?>! Вы знаете, что в Вашем имени <?php echo strlen($_SESSION['user_name']) ?> символов?
    <?php endif; ?>
    <?php echo ($error) ?>
    <table border="1">
        <tr>
            <th>№</th>
            <th>Гость</th>
            <th>визит</th>
            <th>x</th>
        </tr>
        <?php   foreach($guest as $questinfo): ?>
            <tr>
                <td><?php echo $rowcounter++ ?></td>
                <td><?php echo $questinfo['guestname']?></td>
                <td><?php echo $questinfo['visits']?></td>
                <td><a href="?act=del_user&id=<?php echo $questinfo['id']?>">del</a></td>
            </tr>
        <?php   endforeach; ?>
        <?php   if (empty($guest)) : ?>
            <tr><td colspan="4">В таблице нет данных</td></tr>
        <?php   endif;?>
    </table>
    <?php if (!(isset($_REQUEST['act']) && $_REQUEST['act'] == "search_user")) : ?>
        <form method="get" action="task21.php">
            <label for="user_name_search"><input id="user_name_search" name="name" /></label>
            <input type="hidden" name="act" value="search_user" />
            <input type="submit" value="Найти" />
        </form>
    <?php else: ?>
        Пользователь найден!&nbsp;<a href='javascript:history.back()'>Вернутся</a>
    <?php endif; ?>
    </body>
    </html>
    <?php
}

error_reporting(E_ALL);
ini_set("display_errors", 1);

$dbcnx = mysqli_connect("localhost", "root", "", "task_21");

if (!$dbcnx) {
    exit( "<P>В настоящий момент сервер базы данных не доступен, поэтому корректное отображение страницы невозможно.</P>" );
}

session_start();

if (isset($_REQUEST['act'])) {
    task21_actions();
}

if (!isset($_SESSION['user_id'])) {
    if (!isset($_SESSION['counter']))
        $_SESSION['counter'] = 0;
} else {
    $id     = $_SESSION['user_id'];
    $sql    = "UPDATE guests SET visits = visits+1 WHERE id = $id";
    $name   = $_SESSION['user_name'];
    $result = mysqli_query($dbcnx, $sql);
}
$_SESSION['counter']++;

task21_display(task21_get_users(), false);


?>
