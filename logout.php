<?
require 'db.php';
R::exec('DELETE FROM `online` WHERE `login` = ?', array($_SESSION['login']));
unset($_SESSION['login']);
unset($_SESSION['id']);
unset($_SESSION['password']);
unset($_SESSION['admin']);
header('Location:  /');
?>
