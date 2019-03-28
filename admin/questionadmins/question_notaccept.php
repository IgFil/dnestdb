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
<h1>Не принятые жалобы</h1>
<script type="text/javascript">
    window.onload = function () {
        var btn_set = document.querySelector('button[name=go_to_question]');
        document.querySelector('#go_to_question').onclick = function () {
            var params = 'go_to_question=' + btn_set.value;

            ajaxPOST(params);
        }
    }

    function ajaxPOST(params) {
        var request = new XMLHttpRequest();


        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {

                document.querySelector('#result').innerHTML = request.responseText;

            }

        }

        request.open('POST', 'ajax_worker.php');
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.send(params);
    }


</script>
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
            <td><form><button name="go_to_question" id="go_to_question" type="button" value="' . $item['id'] . '">Принять</button></form></td>
         </tr>
                
';
            }


        }


    }



    ?>
</table>

<div id="result"></div>
</body>

</html>
