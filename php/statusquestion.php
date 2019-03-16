<?php require '../db.php';
require 'online.php';
?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <title>Статус ваших вопросов</title>
</head>
<body>
<h1>Статус ваших вопросов</h1>
<header>
    <nav class="top-menu">
        <ul class="menu-main">
            <li class="right-item"><a href="support.php">Служба поддержки</a></li>

        </ul>

    </nav>
</header>
<div>

    <table cellpadding="10">
        <tr>
            <th>Статус</th>
            <th>Вопрос</th>
            <th>Ответ</th>
            <th>Агент Поддержки</th>

        </tr>

        <?php
        online();
        $status = array();
        $status['not_accept'] = 'Не принято';
        $status['accept'] = 'Принято';
        $status['worked'] = 'Отвечено';
        $base_question = R::findAll('questions', 'name_creator = ?', array($_SESSION['login']));

        foreach ($base_question as $item) {

            if ($item['status'] == $status['not_accept']) {
                echo '
          <tr>
           <td id="not_accept">' . $item['status'] . '</td>  
             <td>' . $item['body'] . '</td>
                <td>' . $item['answer'] . '</td>
                <td>' . $item['name_accepter'] . '</td>
           </tr>';

            }
            if ($item['status'] == $status['accept']) {
                echo '
          <tr>
           <td id="accept">' . $item['status'] . '</td>  
             <td>' . $item['body'] . '</td>
                <td>' . $item['answer'] . '</td>
                <td>' . $item['name_accepter'] . '</td>
           </tr>';


            }
            if ($item['status'] == $status['worked']) {

                echo '
          <tr>
           <td id="worked_question">' . $item['status'] . '</td>  
             <td>' . $item['body'] . '</td>
                <td>' . $item['answer'] . '</td>
                <td>' . $item['name_accepter'] . '</td>
           </tr>';


            }


        }


        ?>
    </table>
</div>
</body>

</html>
