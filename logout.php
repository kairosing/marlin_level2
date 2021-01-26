<?php

require_once 'includes/init.php';

$user = new User;
$user->logout();

Redirect::to('index.php');