<?php
require '../../db.php';
?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <title>Жалоба</title>
</head>
<body>
<?php $question_base = R::load('questions', $_POST['go_to_answer']); ?>
<div id="work_report" class="container">
    <label>Жалоба от <? echo $question_base['name_creator']; ?></label>
    <br>
    <label>Жалоба:<? echo $question_base['body']; ?></label>
    <form action="reports_work.php" method="POST">
        <textarea name="answer" placeholder="Ответ на вопрос"></textarea>
        <button type="submit" value="<? echo $question_base['id']; ?>" name="go_to_work">Ответить</button>
    </form>
</div>
<?php
if (isset($_POST['go_to_work'])) {

    $up = R::load('questions', $_POST['go_to_work']);

    $up->answer = $_POST['answer'];
    $up->time_answer = date("H:i:s d/m/Y");
    $up->status = "Отвечено";

    R::store($up);
    echo '<div id=complete>Ответ успешно добавлен <a href="/admin/adminpanel.php">Админ Панель</a> </div>';
}
?>
</body>
</html>