<?php
require 'db.php';

include 'php/users_online.php';

?>
<html>
<head>
    <title>Днестровск БД</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>

</head>

<body>


<audio id="audio" src="/audio/filipp-kirkorov-cvet-nastroenija-sinijj-(megapesni.me).wav" autoplay></audio>
<script>
    myVid = document.getElementById("audio");
    myVid.volume = 0.1;
</script>

<header>
    <h1> Днестровск База Данных </h1>

    <nav class="top-menu">
        <ul class="menu-main">
            <?
            if (isset($_SESSION['id'])) {
                echo '<li class="right-item"> <a href="php/information.php">Информация</a> </li>
        <li class="right-item"> <a href="logout.php">Выйти</a>
        </li>
        <li class="left-item"> <a href="cabinet.php">' . $_SESSION['login'] . '</a>
        </li>
        <li class="left-item"> <a href="php/addhuman.php">Добавить человека</a>
        </li>
        <li class="left-item"><a href="php/wiewallbase.php">Базы данных</a>
        </li>
        <li class="left-item"><a href="php/support.php">Служба поддержки</a> </li>
       ';

            } else {

                echo '<li class="left-item"> <a href="login.php">Авторизация</a> </li>
<li class="left-item"> <a href="registration.php">Регистрация</a> </li>';
            }

            if (isset($_SESSION['admin'])) {
                echo '<li class="right-item"> <a href="admin/adminpanel.php">Админ панель</a> </li>
';
            }
            ?>

        </ul>
    </nav>
</header>

<?php
if (isset($_SESSION['id'])) {

    echo "<div id=users_online>
 <div id = online_users>Пользователи онлайн:" . $output['user'] . "</div>
<div id = online_moders>" . $output['moders'] . "</div>
<div id = online_admins>Администраторы онлайн:" . $output['admins'] . "</div>
<div id = online_superadmins>Страшая Администрация оналйн:" . $output['superadmins'] . "</div>
<div id = online_creators>Создатели оналйн:" . $output['creators'] . "</div>";

}
R::exec('DELETE FROM `online` WHERE `lastvisit` < ' . (time() - (3600)));

?>
</div>


</body>
</html>