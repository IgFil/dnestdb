<?php session_start();
require 'libs/rb.php';
R::setup('mysql:host=127.0.0.1;dbname=dnestrdb',
    'root', '');
if (!R::testConnection()) {
    echo "ОШИБКА";


}

?>