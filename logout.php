<?php
use App\Classes\Modules\User;
use App\Classes\Config\Redirect;
require_once($_SERVER['DOCUMENT_ROOT'].'/ooplr/init.php');

$user = new User();
$user->logout();
Redirect::to('login');