<?php
require '../db.php';
?>
<html>
<head>
    <title>База №1</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
</head>
<body>
<h1>База данных №1</h1>
<h2>Здесь находятся все люди в базе данных(зарегистрированные на сайте и не зарегистрированные.</h2>
<?php

$base1 = R::getAll('SELECT * FROM `humans`');

?>

<table id="base_1">
    <tr>
        <th>Имя</th>
        <th>Информация</th>
        <th>Возрост</th>
        <th>Работа</th>
        <th>Телефон</th>
    </tr>

    <?php
    foreach ($base1 as $item) {
        echo '<tr>
<td>' . $item['name'] . '</td>
<td>' . $item['info'] . '</td>
<td>' . $item['vozrost'] . '</td>
<td>' . $item['work'] . '</td>
<td>' . $item['phone'] . '</td>

	<tr>';
    }
    ?>


</table>

</body>
</html>