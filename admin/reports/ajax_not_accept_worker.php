<?php
require '../../db.php';

$up = R::load('questions', $_POST['go_to_delete']);
$up['status'] = "Отколнено";
$up['answer'] = $_POST['not_accepted_body'];
$up['name_accepter'] = $_SESSION['login'];
$up['time_answer'] = date("H:i:s d/m/Y");
R::store($up);
echo "Жалоба успешно отменена";