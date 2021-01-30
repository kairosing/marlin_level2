<?php
require_once '../init.php';
$delete_session = Session::get('user') == Input::get('id');

if ($delete_session){
    $user = new User();
    Db::getInstance()->delete('users',['id', '=', Session::get('user')]);
    $user->logout();
    Redirect::to('index');
} else {
    $user = new User(Input::get('id'));
    Db::getInstance()->delete('users',['id', '=', Input::get('id')]);
    Redirect::to('index.php');
}

