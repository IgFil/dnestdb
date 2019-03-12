<?php
require '../db.php';
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <title>Статистика пользователей</title>

</head>
<body>
<div class="container" id="table_online">

    Таблица пользователей онлайн:
    <table cellpadding="10">
        <tr>
            <th>Ник</th>
            <th>IP</th>
            <th>Ранг</th>
            <th>Последний вход</th>
        </tr>
        <?php
        $online_base = R::getAll('SELECT * FROM `online`');

        foreach ($online_base as $item) {
            echo '<tr>
<td>' . $item['login'] . '</td>
<td>' . $item['ip'] . '</td>
<td>' . $item['rang'] . '</td>
<td>' . $item['time'] . '</td>

	</tr>';
        }
        ?>

    </table>

</div>
<div class="container" id="work-stat">Задания пользователей
    <table cellpadding="10">
        <tr>
            <th>Тема задания</th>
            <th>Описания задания</th>
            <th>Создатель задания</th>
        </tr>
        <?php
        $work_base_adm = R::getAll('SELECT * FROM `work`');
        foreach ($work_base_adm as $item) {
            echo '<tr>
       <td>' . $item['title'] . '</td>
       <td>' . $item['body'] . '</td> 
       <td>' . $item['namecreator'] . '</td>             
       </tr>
       ';
        }

        ?>

    </table>
</div>

</body>
</html>
