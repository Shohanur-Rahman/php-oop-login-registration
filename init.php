<?php

session_start();
function getDomainURL(){
    return sprintf(
        "%s://%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME']
    );
}
function getBaseURL(){
return getDomainURL().'/ooplr/';
}

function getURL($path){
    echo getBaseURL().$path;
}
function getLoginURL(){
    return getBaseURL().'login';
}
$ASSETS_URL = getBaseURL().'public/assets/';
$PAGE_URL = getBaseURL();

$GLOBALS['APP_NAME'] = 'Company Listing';
$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'company_listing'
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )
);
require 'vendor/autoload.php'; // It must be called first

use App\Classes\Config\Cookie;
use App\Classes\Config\Config;
use App\Classes\Config\Session;
use \App\Classes\Config\DB;
use \App\Classes\Config\Validation;
use \App\Classes\Modules\User;

require_once('public/functions/sanitize.php');

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))){
    $hash = Cookie::get(Config::get('remember/cookie_name'));
    $hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

    if($hashCheck->count()){
        $user = new User($hashCheck->first()->user_id);
        $user->login();
    }
}

$validation = new Validation();
