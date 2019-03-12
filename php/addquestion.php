<?php
require '../db.php';

?>

<html>
<head>
    <title>Служба поддержки</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
</head>
<body>
<header><h1>Создание запроса в службу поддержки</h1></header>
<div id="addquestion" class="container">
    <form action="addquestion.php" method="POST">
        <label>Тема вопроса</label>
        <br>
        <select name="title">
            <option value="bag">Баг</option>
            <option value="report">Жалоба</option>
            <option value="question">Вопрос</option>
            <option value="update">Предложение по улучшению</option>
            <option value="other">Другая тема</option>
        </select>
        <textarea name="body" placeholder="Суть вопроса/жалобы/предложения"></textarea>
        <br>
        <input type="checkbox" name="prav_true" value="pravtrue">Нажимая на галочку вы соглашаетесь<a
                href="prav_question.html">с правилами подачи вопросов </a>
        <button name="go_to_question" type="submit">Отправить вопрос</button>

    </form>
</div>
<?php
$data = $_POST;
$errors = [];
if (isset($data['go_to_question'])) {
    if ($data['body'] == '') {
        $errors[] = "Введите суть вопроса/жалобы/предложения";
    }
    if ($data['prav_true'] != 'pravtrue') {
        $errors[] = "Вы не согласились с правилами";
    }
    if (empty($errors)) {
        $question = R::dispense('questions');
        $question['status'] = "Жалоба ещё не принята";
        $question['type'] = $data['title'];
        $question['body'] = $data['body'];
        $question['name_creator'] = $_SESSION['login'];
        $question['time_create'] = date("H:i:s d/m/Y");
        $question['ip'] = $_SERVER['REMOTE_ADDR'];
        R::store($question);
        echo '<div id=complete> Вопрос успешно добавлен </div>';
    } else {
        echo '<div id = errors >' . array_shift($errors) . '</div>';

    }
}
?>
<footer>
</footer>
</body>

</html>
