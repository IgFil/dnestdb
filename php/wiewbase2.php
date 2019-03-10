<?php
require '../db.php';
?>
<html>
<head>
    <title>База №2</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
</head>
<body>
<script type="text/javascript">
    function redirect() {
        window.location.replace('/php/create_work.php');
    }
</script>
<h1>База №2</h1>
<h2>Здесь находяться люди зарегистрированные на сайте</h2>
<table>
    <tr>
        <th>Имя</th>
        <th>Информация</th>
        <th>Возрост</th>
        <th>Работа</th>
        <th>Телефон</th>
    </tr>
    <?
    $base2 = R::getAll('SELECT * FROM `humans`');
    $base_users = R::getAll('SELECT * FROM `users`');

    foreach ($base2 as $item) {
        foreach ($base_users as $item2) {
            if ($item ['name'] == $item2['name']) {
                echo '<tr>
<td>' . $item['name'] . '</td>
<td>' . $item['info'] . '</td>
<td>' . $item['vozrost'] . '</td>
<td>' . $item['work'] . '</td>
<td>' . $item['phone'] . '</td>
<td><form action = create_work.php method = POST><button type = submit value="' . $item['name'] . '" name = gotowork  >Сделать заказ</button></form></td>

	<tr>';
            }


        }


    }


    ?>
</table>
</body>
</html>