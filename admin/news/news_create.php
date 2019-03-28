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
<form action="news_create.php" method="POST">
<input name="title" placeholder="Название новости">
 <textarea name="body" placeholder="Суть новости"></textarea>
    <button name="go_to_news">Отправить</button>
</form>
</body>
</html>

