<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lava Material - Web Application and Website Multipurpose Admin Panel Template</title>
    <!--== META TAGS ==-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--== FAV ICON ==-->
    <link rel="shortcut icon" href="images/fav.ico">

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,600,700" rel="stylesheet">

    <!-- FONT-AWESOME ICON CSS -->
    <link rel="stylesheet" href="<?php use App\Classes\Config\Input;
    use App\Classes\Config\Validation;
    use App\functions;

    echo $ASSETS_URL; ?>css/font-awesome.min.css">

    <!--== ALL CSS FILES ==-->
    <link rel="stylesheet" href="<?php echo $ASSETS_URL; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo $ASSETS_URL; ?>css/mob.css">
    <link rel="stylesheet" href="<?php echo $ASSETS_URL; ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $ASSETS_URL; ?>css/materialize.css"/>
    <link rel="stylesheet" href="<?php echo $ASSETS_URL; ?>css/custom.style.css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo $ASSETS_URL;?>js/html5shiv.js"></script>
    <script src="<?php echo $ASSETS_URL;?>js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="blog-login">
    <div class="blog-login-in">
        <img src="<?php echo $ASSETS_URL;?>images/logo.png" alt="" class="login-logo" />
        <?php

        if (Input::exists()) {
            if (\App\Classes\Config\Token::checck(Input::get('token'))) {

                $validation = new Validation();
                $validate = $validation->check($_POST, array(
                    'username' => array(
                        'required' => true,
                        'min' => 3,
                        'max' => 60,
                        'unique' => 'users'
                    ),
                    'email' => array(
                        'required' => true,
                        'min' => 8,
                        'max' => 90,
                        'unique' => 'users'
                    ),
                    'password' => array(
                        'required' => true,
                        'min' => 6
                    ),
                    'confirmed_password' => array(
                        'required' => true,
                        'min' => 6,
                        'matches' => 'password'
                    )
                ));

                if ($validate->passed()) {
                    $user = new \App\Classes\Modules\User();

                   $salt = \App\Classes\Config\Hash::salt(32);

                    try {
                        $user->create(array(
                            'username' => Input::get('username'),
                            'email' => Input::get('email'),
                            'password' => \App\Classes\Config\Hash::make(Input::get('password'),$salt),
                            'salt_password' => $salt
                        ));

                        \App\Classes\Config\Session::flash('success', 'Your registration has been successfully completed.');
                        \App\Classes\Config\Redirect::to('accounts/profile');
                    } catch (Exception $ex) {
                        die($ex->getMessage());
                    }
                }
            }
        }
        ?>
        <form action="" method="post" autocomplete="off">
            <input type="hidden" name="token" value="<?php echo \App\Classes\Config\Token::generate() ?>">
            <div class="row">
                <div class="input-field col s12">
                    <input id="username" name="username" value="<?php echo functions\escape(Input::get('username')) ?>"
                           type="text" class="validate" autocomplete="off">
                    <label for="username">User Name</label>
                    <?php $validation->hasError('username'); ?>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="email" type="email" name="email"
                           value="<?php echo functions\escape(Input::get('email')) ?>" class="validate"
                           autocomplete="off">
                    <label for="email">Email</label>
                    <?php $validation->hasError('email'); ?>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="password" type="password" name="password"
                           value="<?php echo functions\escape(Input::get('password')) ?>" class="validate"
                           autocomplete="off">
                    <label for="password">Password</label>
                    <?php $validation->hasError('password'); ?>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="confirmed_password" type="password" name="confirmed_password"
                           value="<?php echo functions\escape(Input::get('confirmed_password')) ?>" class="validate"
                           autocomplete="off">
                    <label for="password">Password</label>
                    <?php $validation->hasError('confirmed_password'); ?>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <button type="submit" class="waves-effect waves-light btn-large btn-log-in col-md-12"
                            href="index.html">SignUp
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="" class="for-pass pull-right">Forgot Password?</a>
                    <a href="<?php getURL('login');?>" class="for-pass pull-left">Go to Login</a>
                </div>
            </div>
        </form>
    </div>
</div>

<!--======== SCRIPT FILES =========-->
<script src="<?php echo $ASSETS_URL; ?>js/jquery.min.js"></script>
<script src="<?php echo $ASSETS_URL; ?>js/bootstrap.min.js"></script>
<script src="<?php echo $ASSETS_URL; ?>js/materialize.min.js"></script>
<script src="<?php echo $ASSETS_URL; ?>js/custom.js"></script>
</body>


<!-- Mirrored from rn53themes.net/themes/demo/lava-admin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 18 Dec 2020 15:45:16 GMT -->
</html>