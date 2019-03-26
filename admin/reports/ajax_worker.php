<?php
require '../../db.php';

if ($_POST['accept'] != 0) {

    $report_id = array();
    $_POST['accept'] = (int)$_POST['accept'];


    $up = R::load('questions', $_POST['accept']);
    $up['status'] = "Принято";
    $up['name_accepter'] = $_SESSION['login'];
    R::store($up);


}
