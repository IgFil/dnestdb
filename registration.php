<?php
require 'db.php';
$data = $_POST;
if (isset($data['submit'])) {

    $errors = array();

    if ($data['name'] == '') {
        $errors[] = 'Введите имя';
    }
    if ($data['login'] == '') {
        $errors[] = 'Введите логин!';
    }

    if ($data['password'] == '') {
        $errors[] = 'Введите пароль!';
    }

    if ($data['email'] == '') {
        $errors[] = 'Введите email!';
    }

    if ($data ['password'] == '') {
        $errors[] = 'Введите пароль!';
    }

    if ($data ['password_2'] != $data['password']) {
        $errors[] = 'Повторный пароль неверен!';
    }
    if (R::count('users', "login = ?", array($data['login'])) > 0) {
        $errors[] = "Пользователь с таким логином уже существует";

    }
    if (R::count('users', "mail = ?", array($data['mail'])) > 0) {
        $errors[] = "Пользователь с таким email уже существует";

    }
    if ($data['pravila_true'] != "prav_true") {
        $errors[] = 'Согласитесь с правилами';
    }

    if (empty($errors)) {
        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->reg_time = date("H:i:s d/m/Y");
        $user->ip = $_SERVER['REMOTE_ADDR'];
        $user->nowip = $_SERVER['REMOTE_ADDR'];

        R::store($user);
        echo '<div id = true_reg>Вы успешно зарегистрировались <a href = />Главная страница</a> </div>';

    } else {


        echo '<div id = errors >' . array_shift($errors) . '</div>';

    }

}

?>
<html>
<head>
    <title>Регистрация</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <style>
        #errors {

            color: red;
            text-align: center;
        }

        #true_reg {

            color: white;
            text-align: center;


        }

        #regform {

            margin-left: 44%;
            width: 11%;

            border: 1px solid black;
            border-radius: 5px;
            padding: 0.1%;
            color: white;
            font-family: 'Arimo', sans-serif;
            font-weight: bold;
            font-size: 18px;


            background: limegreen;


        }

        #prav {
            color: white;

        }

        h1 {
            text-align: center;
            color: limegreen;


        }
    </style>

</head>

<body>
<nav class="reg-nav1">
    <h1>Регистрация</h1>

</nav>
<form action="/registration.php" id=regform method="POST">

    <input type="text" name="login" placeholder="Логин" value="<?php echo @$data['login']; ?>">
    <input type="test" placeholder="ФИО" name="name">
    <input type="password" name="password" placeholder="Пароль" value="<?php echo @$data['password']; ?>">
    <input type="password" name="password_2" placeholder="Повторно пароль">
    <input type="email" name="email" placeholder="Электроная почта" value< <?php echo @$data['email']; ?>">
    <input type="checkbox" name="pravila_true" value="prav_true">Согласны ли вы с <a target="_blank"
                                                                                     href="/html/pravila.html"
                                                                                     id="prav">Правилами сайта</a>

    <button type="submit" name="submit">Зарегистрироваться</button>
</form>
</body>
<html>
