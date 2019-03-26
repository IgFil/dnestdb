<?php
function online($data = 0)
{
    $ip = $_SERVER['REMOTE_ADDR'];
    $online = R::findOne('online', 'ip = ?', array($ip));
    $test1 = R::findOne('users', 'login = ?', array($data['login']));
    $test2 = R::findOne('admins', 'login = ?', array($data['login']));
    if (!empty($test2)) {
        $rang = $test2['rang'];
    } else {
        $rang = 'user';

    }




        if ($online) {
            $online->lastvisit = time();
            R::store($online);
        }
    if ($data != 0) {
        if (!isset($online)) {
            $online = R::dispense('online');
            $online->login = $data['login'];
            $online->rang = $rang;
            $online->ip = $ip;
            $online->lastvisit = time();
            $online->time = date("H:i:s d/m/Y");
            R::store($online);

        }

    }
}
