<?php
$rangtest = array();
$rangtest['user'] = 'user';
$rangtest['moder'] = 'Модератор';
$rangtest['admin'] = 'Администратор';
$rangtest['superadmin'] = 'СуперАдминистратор';
$rangtest['creator'] = 'Создатель';


$output = array();

$output['user'] = R::count('online', 'rang = ?', array($rangtest['user']));
$output['moders'] = R::count('online', 'rang = ?', array($rangtest['moder']));
$output['admins'] = R::count('online', 'rang = ?', array($rangtest['admin']));
$output['superadmins'] = R::count('online', 'rang = ?', array($rangtest['superadmin']));
$output['creators'] = R::count('online', 'rang = ?', array($rangtest['creator']));

?>