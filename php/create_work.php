<?php require '../db.php';
if (isset($_POST['gotowork'])) {
    $_SESSION['worker'] = $_POST['gotowork'];
} ?>
<html>
<head>
    <title>Создать задание</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
</head>
<body>
<header>
    <h1>Создать задание</h1>
</header>
<form id="zad_1" action='create_work.php' method='POST'>
    <input id="title" name='title' placeholder="Тема задания">
    <textarea id="body" name="body" placeholder="Описание задания"></textarea>
    <button id="gotozadan" type="submit" name="gotozadan">Отправить задание</button>
</form>
<?php
$errors = array();
$data = $_POST;
if (isset($data['gotozadan'])) {
    if ($data['title'] == '') {
        $errors[] = 'Введите тему задания';

    }
    if ($data['body'] == '') {
        $errors[] = 'Введите описания задания';
    }
    if (empty($errors)) {
        $status = 'Не приянто';
        $work = R::dispense('work');
        $work->title = $data['title'];
        $work->body = $data['body'];
        $work->namecreator = $_SESSION['login'];
        $work->nameworker = $_SESSION['worker'];
        $work->ipcreator = $_SERVER['REMOTE_ADDR'];
        $work->timecreate = date("H:i:s d/m/Y");
        $work->status = $status;
        R::store($work);
        echo '<div id = complete>Вы успешно создали задание <a href=/>На главную</a> </div>';
    } else {
        echo '<div id = errors >' . array_shift($errors) . '</div>';

    }
}


?>
</body>
</html>