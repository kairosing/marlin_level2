<?php

session_start();
require_once 'classes/Session.php';


echo Session::flash('success');