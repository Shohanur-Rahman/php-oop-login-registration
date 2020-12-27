
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/ooplr/init.php');
use App\Classes\Modules\User;
use App\Classes\Config\Input;
use App\Classes\Config\Redirect;

?>
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
    <link rel="stylesheet" href="<?php echo $ASSETS_URL; ?>css/font-awesome.min.css">

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
        <img src="<?php echo $ASSETS_URL; ?>images/logo.png" alt="" class="login-logo"/>
        <?php
        if (Input::exists()) {
            $validation = new \App\Classes\Config\Validation();
            $validate = $validation->check($_POST, array(
                'email' => array('required' => true),
                'password' => array('required' => true),
            ));

            if ($validate->passed()) {
                $user = new User();
                $remember = (Input::get('remember') === 'on') ? true : false;
                $login = $user->login(Input::get('email'), Input::get('password'),$remember);
                if ($login) {
                    Redirect::to('accounts/profile');
                } else {
                    echo "<strong class='has-error'> Invalid Email or Password! </strong>";
                }
            }
        }
        ?>
        <form action="" method="post" autocomplete="off">
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" type="email" name="email" class="validate">
                    <label for="email">User Name</label>
                    <?php $validation->hasError('email'); ?>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="password" name="password" type="password" class="validate">
                    <label for="password">Password</label>
                    <?php $validation->hasError('password'); ?>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12" style="padding-left: 0;">
                    <input type="checkbox" class="filled-in" name="remember" id="filled-in-box">
                    <label for="filled-in-box">Filled in</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <button type="submit" class="waves-effect waves-light btn-large btn-log-in">Login</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="" class="for-pass pull-right">Forgot Password?</a>
                    <a href="<?php getURL('register');?>" class="for-pass pull-left">Go to Register</a>
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
