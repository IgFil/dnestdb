<?php
require '../../db.php';
?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/main.css" type="text/css">
    <title>Принятые Жалобы</title>
</head>
<body>
<header>
    <h1>Мои вопросы</h1>
    <nav class="top-menu">
        <ul class="menu-main">
            <li class="left-item"><a href="/admin/question.php">Назад</a></li>

        </ul>
    </nav>
</header>
<table>
    <tr>
        <th>Вопрос</th>
        <th>Отправитель</th>
        <th>Время</th>
        <th>Ответить</th>
    </tr>
    <?php
    $status = "Принято";
    $report_base = R::findAll('questions', 'status = ?', array($status));

    foreach ($report_base as $item) {
        settype($item['id'], 'integer');
        if ($item['type'] == 'report') {


            if ($item['answer'] == 'Нет ответа') {
                if ($item['name_accepter'] == $_SESSION['login']) {

                    echo '
             <tr>
             <td>' . $item['body'] . '</td>
             <td>' . $item['name_creator'] . '</td>
             <td>' . $item['time_create'] . '</td>
             <td><form action="reports_work.php" method="POST"> <button type="submit" name="go_to_answer" value="' . $item['id'] . '">Ответить</button></form></td>
             </tr>

                         

';
                }

            }


        }


    }
    ?>

</table>

</body>
</html>