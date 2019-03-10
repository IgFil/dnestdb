<?php
require '../db.php';
?>

<html>
<head>
    <title>Администраторы</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <?php
    if (!isset($_SESSION['id'])) {
        echo '<meta http-equiv="refresh" content="0;URL=/index.php">';
    }
    ?>
</head>
<body>

<h1>Днестровск БД</h1>
<h2>Управление Администраторами</h2>

<label id="id_1">Добавить Администратора</label>
<div id="addadmin_div">

    <form method="POST" action="/admin/adminbd.php" id="form_addadm">

        <input type="text" name="name" placeholder="Логин">
        <label>Ранг администратора</label>
        <select name="rang">
            <option value="Модератор">Модератор</option>
            <option value="Администратор">Администратор</option>
            <option value="СуперАдминистратор">Супер Администратор</option>
            <option value="Создатель">Создатель</option>

        </select>
        <button type="submit" name="go_add_admin">Добавить администратора</button>


    </form>

</div>
<?php
$data = $_POST;
$errors = array();
if (isset($data['go_add_admin'])) {
    if ($data['name'] == '') {
        $errors[] = 'Введите логин пользователя';
    }
    if (empty($errors)) {


        if (R::count('users', 'login = ?', array($data['name']))) {

        } else {
            $errors[] = 'Данного пользователя не существует';

        }
        if (R::count('admins', 'login = ?', array($data['name'])) > 0) {
            $errors[] = 'Администратор с таким логином уже есть';
        }

    }
    if (empty($errors)) {
        $iptest = R::findOne('users', 'login = ?', array($data['name']));


    }
    if (empty($iptest)) {
        $errors[] = 'Ошибка в поиске ip адресса';
    } else {
        $ip = $iptest['ip'];

    }

    if (empty($errors)) {
        $admin = R::dispense('admins');
        $admin->login = $data['name'];
        $admin->rang = $data['rang'];
        $admin->ipadder = $_SERVER['REMOTE_ADDR'];
        $admin->ip = $ip;
        $admin->name = $iptest['name'];
        $admin->reg_time = date("H:i:s d/m/Y");
        $admin->nowip = $_SERVER['REMOTE_ADDR'];
        R::store($admin);
        echo "<div id=complete>Администратор добавлен</div>";
    } else {

        echo '<div id = errors >' . array_shift($errors) . '</div>';

    }

}

?>


<div id="deladmin_div">


</div>
</body>
</html>