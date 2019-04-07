<?php
require '../../db.php';
$up = R::load('news', $_POST['edit']);
$up['title'] = $_POST['news_edit_title'];
$up['body'] = $_POST['news_edit_body'];
R::store($up);
echo 'Новость успешно отредактирована.'

?>

