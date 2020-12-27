<?php

use App\Classes\Modules\User;
use App\Classes\Config\Redirect;

require_once($_SERVER['DOCUMENT_ROOT'] . '/ooplr/init.php');
$user = new User();
if (!$user->isLoggedIn()) {
    Redirect::to(getLoginURL());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lava Material - Web Application and Website Multipurpose Admin Panel Template</title>
    <!--== META TAGS ==-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--== FAV ICON ==-->
    <link rel="shortcut icon" href="<?php echo $ASSETS_URL; ?>images/fav.ico">

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600|Quicksand:300,400,500" rel="stylesheet">

    <!-- FONT-AWESOME ICON CSS -->
    <link rel="stylesheet" href="<?php echo $ASSETS_URL; ?>css/font-awesome.min.css">

    <!--== ALL CSS FILES ==-->
    <link rel="stylesheet" href="<?php echo $ASSETS_URL; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo $ASSETS_URL; ?>css/mob.css">
    <link rel="stylesheet" href="<?php echo $ASSETS_URL; ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $ASSETS_URL; ?>css/materialize.css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo $ASSETS_URL; ?>js/html5shiv.js"></script>
    <script src="<?php echo $ASSETS_URL; ?>js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!--== MAIN CONTRAINER ==-->
<div class="container-fluid sb1">
    <div class="row">
        <!--== LOGO ==-->
        <div class="col-md-2 col-sm-3 col-xs-6 sb1-1">
            <a href="#" class="btn-close-menu"><i class="fa fa-times" aria-hidden="true"></i></a>
            <a href="#" class="atab-menu"><i class="fa fa-bars tab-menu" aria-hidden="true"></i></a>
            <a href="index.html" class="logo"><img src="<?php echo $ASSETS_URL; ?>images/logo1.png" alt=""/>
            </a>
        </div>
        <!--== SEARCH ==-->
        <div class="col-md-6 col-sm-6 mob-hide">
            <form class="app-search">
                <input type="text" placeholder="Search..." class="form-control">
                <a href="#"><i class="fa fa-search"></i></a>
            </form>
        </div>
        <!--== NOTIFICATION ==-->
        <div class="col-md-2 tab-hide">
            <div class="top-not-cen">
                <a class='waves-effect btn-noti' href='#'><i class="fa fa-commenting-o"
                                                             aria-hidden="true"></i><span>5</span></a>
                <a class='waves-effect btn-noti' href='#'><i class="fa fa-envelope-o"
                                                             aria-hidden="true"></i><span>5</span></a>
                <a class='waves-effect btn-noti' href='#'><i class="fa fa-tag" aria-hidden="true"></i><span>5</span></a>
            </div>
        </div>
        <!--== MY ACCCOUNT ==-->
        <div class="col-md-2 col-sm-3 col-xs-6">
            <!-- Dropdown Trigger -->
            <a class='waves-effect dropdown-button top-user-pro' href='#' data-activates='top-menu'><img
                        src="<?php echo $ASSETS_URL; ?>images/user/6.png" alt=""/>My Account <i class="fa fa-angle-down"
                                                                                                aria-hidden="true"></i>
            </a>

            <!-- Dropdown Structure -->
            <ul id='top-menu' class='dropdown-content top-menu-sty'>
                <li><a href="setting.html" class="waves-effect"><i class="fa fa-cogs" aria-hidden="true"></i>Admin
                        Setting</a>
                </li>
                <li><a href="listing-all.html" class="waves-effect"><i class="fa fa-list-ul" aria-hidden="true"></i>
                        Listings</a>
                </li>
                <li><a href="hotel-all.html" class="waves-effect"><i class="fa fa-building-o" aria-hidden="true"></i>
                        Hotels</a>
                </li>
                <li><a href="package-all.html" class="waves-effect"><i class="fa fa-umbrella" aria-hidden="true"></i>
                        Tour Packages</a>
                </li>
                <li><a href="event-all.html" class="waves-effect"><i class="fa fa-flag-checkered"
                                                                     aria-hidden="true"></i> Events</a>
                </li>
                <li><a href="offers.html" class="waves-effect"><i class="fa fa-tags" aria-hidden="true"></i> Offers</a>
                </li>
                <li><a href="user-add.html" class="waves-effect"><i class="fa fa-user-plus" aria-hidden="true"></i> Add
                        New User</a>
                </li>
                <li><a href="#" class="waves-effect"><i class="fa fa-undo" aria-hidden="true"></i> Backup Data</a>
                </li>
                <li class="divider"></li>
                <li><a href="<?php getURL('logout');?>" class="ho-dr-con-last waves-effect"><i class="fa fa-sign-in" aria-hidden="true"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!--== BODY CONTNAINER ==-->
<div class="container-fluid sb2">
    <div class="row">
        <div class="sb2-1">
            <!--== USER INFO ==-->
            <div class="sb2-12">
                <ul>
                    <li><img src="<?php echo $ASSETS_URL; ?>images/placeholder.jpg" alt="">
                    </li>
                    <li>
                        <h5><?php echo $user->data()->username; ?><span> Santa Ana, CA</span></h5>
                    </li>
                    <li></li>
                </ul>
            </div>
            <!--== LEFT MENU ==-->
            <div class="sb2-13">
                <ul class="collapsible" data-collapsible="accordion">
                    <li><a href="index.html" class="menu-active"><i class="fa fa-bar-chart" aria-hidden="true"></i>
                            Dashboard</a>
                    </li>
                    <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-list-ul"
                                                                                   aria-hidden="true"></i> Listing</a>
                        <div class="collapsible-body left-sub-menu">
                            <ul>
                                <li><a href="listing-all.html">All listing</a>
                                </li>
                                <li><a href="listing-add.html">Add New listing</a>
                                </li>
                                <li><a href="listing-cat-all.html">All listing Categories</a>
                                </li>
                                <li><a href="listing-cat-add.html">Add listing Categories</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!--== BODY INNER CONTAINER ==-->
        <div class="sb2-2">
