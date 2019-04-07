<?php
require '../../db.php';
$delete = R::load('news', $_POST['id']);
R::trash($delete);
echo 'Новость успешно удалена';
?>