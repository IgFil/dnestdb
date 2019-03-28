<?php
require '../../db.php';
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Создать новость</title>
    <link rel="stylesheet" href="/css/main.css" type="text/css">
</head>
<body>
<h1>Создание новости</h1>
<div class="container">
    <form action="news_create.php" method="POST">
<input name="title" placeholder="Название новости">
 <textarea name="body" placeholder="Суть новости"></textarea>
    <button name="go_to_news">Отправить</button>
</form>
    <?php
    if (isset($_POST['go_to_news'])) {
        $errors = array();
        if ($_POST['title'] == '') {
            $errors[] = "Введите название новости";

        }
        if ($_POST['body'] == '') {
            $errors[''] = "Введите суть новости";
        }
        if (empty($errors)) {
            $news = R::dispense('news');
            $news->title = $_POST['title'];
            $news->body = $_POST['body'];
            $news->time_create = date("H:i:s d/m/Y");
            R::store($news);
            echo '<div id="complete">Новость успешно добавленна</div>';
        } else {
            echo '<div id="errors">' . array_shift($errors) . '</div>';
        }

    }

    ?>
</div>
</body>
</html>

