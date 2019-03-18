<?php
require 'db.php';
require 'php/online.php';
$data = $_POST;
$errors = array();
if (isset($data['gologin'])) {

    $user = R::findOne('users', 'login = ?', array($data['login']));
    if ($user) {
        $password = R::findOne('users', 'password = ?', array($data['password']));
        if ($password) {

            $admin = R::findOne('admins', 'login = ?', array($data['login']));

            $_SESSION['login'] = $user->login;
            $_SESSION['id'] = $user->id;
            $_SESSION['password'] = $user->password;
            $_SESSION['admin'] = $admin->login;
            $_SESSION['name'] = $user->name;
            $up = R::findOne('users', 'login = ?', array($user['login']));
            $up->nowip = $_SERVER['REMOTE_ADDR'];
            R::store($up);
            if (isset($admin['id'])) {
                $up2 = R::findOne('admins', 'login = ?', array($user['login']));
                $up2->nowip = $_SERVER['REMOTE_ADDR'];
                R::store($up2);
            }
            online($data);


            echo '<div id = true_reg>Вы успешно авторизовались<a href = />Главная страница</a> </div>';


        } else {

            $errors[] = 'Неверный пароль';
        }

    } else {
        $errors[] = 'Неверный логин';

    }
}


if (!empty($errors)) {
    echo '<div id = errors >' . array_shift($errors) . '</div>';
}


?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title>Авторизация</title>
    <style type="text/css">

        #errors {

            color: red;
            text-align: center;
        }

        #true_reg {

            color: green;
            text-align: center;

        }

        #login_form {

            margin-left: 44%;
            width: 11%;
            border: 1px solid black;
            padding: 0.1%;
            background: limegreen;
            border-radius: 5px;


        }

        h1 {
            text-align: center;
            color: limegreen;


        }


    </style>

</head>
<body>
<h1>Авторизация</h1>
<form form action="/login.php" id=login_form method="POST">
    <input type="text" name="login" placeholder="Логин">
    <input type="password" name="password" placeholder="Пароль">
    <button type="submit" name="gologin">Авторизироваться</button>
</form>
</body>
</html>