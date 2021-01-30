<?php
require_once '../init.php';
$user = new User(Input::get('id'));
$group_id = $user->data()->group_id == 1 ? 2 : 1;
$user->update(['group_id' => $group_id], Input::get('id'));
Redirect::to('index.php');