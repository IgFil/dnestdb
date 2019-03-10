<?php
require '../db.php';

?>
<html>
<head>
    <title>Добавить человека</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
</head>
<body>
<h1>Добавить человека</h1>
<nav class="top-menu">
    <ul class="menu-main">
        <?
        if (isset($_SESSION['id'])) {
            echo '<li class="right-item"> <a href="information.php">Информация</a> </li>
        <li class="right-item"> <a href="logout.php">Выйти</a>
        </li>
        <li class="left-item"> <a href="/cabinet.php">' . $_SESSION['login'] . '</a>
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


<?
if (isset($_SESSION['id'])) {
    echo '<form action="/php/addhuman.php" method="POST" id="create_humans">
    <label id="add-human">Добавление человека в базу данных</label>
    <br>
    <input type="text" id="name_human" name="name_human" placeholder="ФИО" >
    <br>

    <label id = "years">Укажите возраст человека</label>
     <select name="vozrost">
    <optionо value="12-14лет">от 12 до 14</option>
    <option value="14-16лет">от 14 до 16</option>
    <option value="16-18лет">от 16 до 18</option>
    <option value="18-24лет">от 18 до 24</option>
    <option value="24-30лет">от 24 до 30</option>
    <option value="30-40лет">от 30 до 40</option>


     </select> 
     <label id="worked">Кем работает человек:</label>
     <select name="work" id="worked" >
     <option value="false">Никем</option>
     <option value="Сантехник">Сантехник</option>
     <option value="Электрик">Электрик</option>
     <option value="Программист">Программист</option>
     <option value="IT">Натсройщик компьютера</option>

     </select>
     <br>
     <label id="info-human_1">Информация о человеке.</label>
     <textarea id="info-human" name="info-human"></textarea>
     <input type="text" name="nomer_telephone" id="phone" placeholder="Номер телефона">
     <button type="submit" id="add-human" name="go_add_human" >Добавить человека</button>
     </form>
     ';


    $data = $_POST;
    $errors = array();
    if (isset($data['go_add_human'])) {
        if (R::count('humans', 'name = ?', array($data['name_human'])) > 0) {
            $errors[] = "Данный человек уже есть в базе";
        }
        if (R::count('humans', 'phone = ?', array($data['nomer_telephone']))) {
            $errors[] = "Человек с таким номером уже есть в базе";
        }
        if ($data['name_human'] == '') {
            $errors[] = "Введите ФИО человека";
        }
        if ($data['info-human'] == '') {
            $errors[] = "Введите информацию о человеке";
        }
        if ($data['nomer_telephone'] == '') {
            $errors[] = "Введите номер телефона";
        }
        if (empty($errors)) {
            $human = R::dispense('humans');
            $human->name = $data['name_human'];
            $human->info = $data['info-human'];
            $human->vozrost = $data['vozrost'];
            $human->work = $data['work'];
            $human->phone = $data['nomer_telephone'];
            $human->useradder = $_SESSION['login'];

            $human->reg_time = date("H:i:s d/m/Y");
            R::store($human);
            echo '<div id=complete> Человек успешно добавлен </div>';
        } else {
            echo '<div id = errors >' . array_shift($errors) . '</div>';

        }
    }
}
?>
</body>
</html>
