<?php
require 'db.php';
?>
<html>

<head>
    <title>Личный кабинет</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
<?php if (!isset($_SESSION['admin'])) {
    echo '<meta http-equiv="refresh" content="0;URL=/index.php">';

} ?>
<nav class="top-menu">
    <ul class="menu-main">
        <?

        if (isset($_SESSION['id'])) {
            echo '<li class="right-item"> <a href="php/information.php">Информация</a> </li>
        <li class="right-item"> <a href="logout.php">Выйти</a>
        </li>
        <li class="left-item"> <a href="/">Главная</a>
        </li>
      
       ';

        } else {

            echo '<li class="left-item"> <a href="login.php">Авторизация</a> </li>
<li class="left-item"> <a href="registration.php">Регистрация</a> </li>';
        }


        ?>

    </ul>
</nav>


<form action="/cabinet.php" id="cabinet_1" method="POST">
    <label id=changepassword>Изменение пароля
    </label>
    <input type="password" name="new_password" placeholder="Новый пароль">
    <button type="submit" name="gochangepassword">Изменить пароль</button>
</form>

<label id="formlabel_cab1">Задания</label>
<table id="form_cab1">
    <tr>
        <th>Тема задания</th>
        <th>Описание задания</th>
        <th>Принять или отклонить здание</th>

    </tr>


    <?php
    $data = $_POST;
    if (isset($data['gochangepassword'])) {

        $user = R::load('users', $_SESSION['id']);
        $user->password = $data['new_password'];

        R::store($user);
    }

    $work = R::getAll('SELECT * FROM `work`');
    foreach ($work as $item) {
        if ($item['nameworker'] == $_SESSION['name']) {
            if ($item['status'] == 'Принято') {
            } else {
                echo '<tr> <td>' . $item['title'] . '</td>
      <td>' . $item['body'] . '</td>
      <td><form action="cabinet.php" method="POST">
      <input type="hidden" name=accept value="' . $item['id'] . '"></input>
      <button value = true name = gotowork type=submit>Принять</button></form>
      <form action="cabinet.php" method="POST"><input type="hidden" name="refused_1" value="' . $item['id'] . '"> <button type= submit name="refused" value=refused>Отклонить</button></form></td>
      </tr>
      </table>
      ';

            }
        }


        echo ' 
  <lable>Ваши задания</lable>
  <table>
  <tr>
  <th>Тема задания</th>
  <th>Описание задания</th>
  <th>Кому отправленно задание</th>
  <th>Статус</th>
  </tr>
  <tr>
  
  
  
  
  ';


        if ($item['namecreator'] == $_SESSION['login']) {
            echo ' 
    <tr>
    <td>' . $item['title'] . '</td>
    <td>' . $item['body'] . '</td>
    <td>' . $item['nameworker'] . '</td>
    <td>' . $item['status'] . '</td>
    </tr>
    
    ';
        }
    }
    if (isset($data['gotowork'])) {
        $status = 'Принято';
        $accept = R::findOne('work', 'id = ?', array($data['accept']));
        $accept->status = $status;
        R::store($accept);

    }
    if (isset($data['refused'])) {
        $status = 'Отклонено';
        $refused = R::findAll('work', 'id = ?', array($data['refused_1']));
        $refused->status = $status;
        R::store($refused);
    }

    echo ' 

</table>';
    ?>

</body>

</html>