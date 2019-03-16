<?php
require '../../db.php';
?>
<html>
<head>
    <title>Не принятые вопросы</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
</head>
<body>
<header>
    <h1>Не принятые вопросы</h1>
    <nav class="top-menu">
        <ul class="menu-main">
            <li class="right-item"><a href="/admin/question.php">Назад</a></li>
        </ul>
    </nav>
</header>
<table cellpadding="10">
    <tr>
        <th>Вопрос</th>
        <th>Время</th>
        <th>Принять</th>

    </tr>
    <?php
    $status = 'Не принято';
    $question_base = R::findAll('questions', 'status = ?', array($status));
    foreach ($question_base as $item) {

        if ($item['type'] == "question") {
            if ($item['status'] == "Не принято") {
                echo '
        <tr>
            <td>' . $item['body'] . '</td>
            <td>' . $item['time_create'] . '</td>
            <td><form action="question_notaccept.php" method="POST"><button name="go_to_question" type="submit" value="' . $item['id'] . '">Принять</button></form></td>
         </tr>
                
';
            }


        }


    }
    $data = $_POST;
    if (isset($data['go_to_question'])) {

        $up = R::load('questions', $data['go_to_question']);
        $up['status'] = 'Принято';
        $up['name_accepter'] = $_SESSION['login'];
        R::store($up);
    }


    ?>
</table>


</body>

</html>
