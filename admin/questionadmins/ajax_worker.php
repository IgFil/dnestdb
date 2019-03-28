<?php
require '../../db.php';
$data = $_POST;
if (isset($data['go_to_question'])) {

    $up = R::load('questions', $data['go_to_question']);
    $up['status'] = 'Принято';
    $up['name_accepter'] = $_SESSION['login'];
    R::store($up);
}

?>

