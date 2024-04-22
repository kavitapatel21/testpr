<?php

if ( !is_user_logged_in() ) {

    echo 'Restricted Access';

    exit;

}



?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" prefix="" lang="en-US">

<head>

    <link rel="profile" href="https://gmpg.org/xfn/11" />

    <link rel="pingback" href="" />

    <link rel="shortcut icon" type="image/x-icon" href="https://www.2sonsplumbing.com/wp-content/uploads/2020/03/favicon.png">

    <link rel="apple-touch-icon" href="https://www.2sonsplumbing.com/wp-content/uploads/2020/03/favicon.png" />

    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">

    <title>Joe&#039;s 2 Sons Plumbing | Warehouse</title>

    <meta name="robots" content="noindex" />

    <link rel="icon" href="https://www.2sonsplumbing.com/wp-content/uploads/2020/03/favicon.png" sizes="32x32" />

    <link rel="icon" href="https://www.2sonsplumbing.com/wp-content/uploads/2020/03/favicon.png" sizes="192x192" />

    <link rel="apple-touch-icon" href="https://www.2sonsplumbing.com/wp-content/uploads/2020/03/favicon.png" />

    <meta name="msapplication-TileImage" content="https://www.2sonsplumbing.com/wp-content/uploads/2020/03/favicon.png" />



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>



    <link href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous">

    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>



    <link href='https://use.fontawesome.com/releases/v5.11.0/css/all.css?ver=5.9.3' rel="stylesheet" />



    <link href="<?php echo plugins_url(); ?>/warehouse/css/warehouse.css?ver=<?php echo time(); ?>" rel="stylesheet" crossorigin="anonymous">

</head>

<body>

<div id="page" class="site">



    <?php if (current_user_can('administrator') || current_user_can('wh-admin')) { ?>

    <div class="left-navigation">

        <ul>

            <li><a class="<?php echo $whtab == 'home' ? 'active' : ''; ?>" href="<?php echo WH_URL; ?>"><i class="fas fa-home"></i>Home</a></li>

            <li><a class="<?php echo $whtab == 'order' ? 'active' : ''; ?>" href="<?php echo WH_URL; ?>?whtab=order"><i class="fas fa-clipboard-list"></i>Order</a></li>

            <li><a class="<?php echo $whtab == 'inventory' ? 'active' : ''; ?>" href="<?php echo WH_URL; ?>?whtab=inventory"><i class="fas fa-database"></i>Inventory</a></li>

        </ul>

    </div>

    <?php } else { ?>

        <style>

            #content.site-content {

                margin-left: 0 !important;

            }

        </style>

    <?php } ?>



    <header id="masthead" class="site-header">

        <div class="row">

            <div class="col-sm-3 mobile-hidden">

                <div class="navbar-brand">

                    <img src="https://www.2sonsplumbing.com/wp-content/uploads/2022/11/2-Sons-PlumbingHeating-Air-Logo_Web-Res.png" alt="2 Sons Plumbing">

                </div>

            </div>

            <div class="col-sm-9">

                <div class="header-userinfo text-right">

                    <a href="/warehouse/" class="logo-mobile"><img src="https://www.2sonsplumbing.com/wp-content/uploads/2020/03/favicon.png" style="float: left;"></a>

                    <?php echo current_time('m/d/Y h:ia'); ?><br />

                    <?php $user = wp_get_current_user();

                    echo $user->user_login; ?>,

                    <a href="<?php echo wp_logout_url( '/login' ); ?>"><i class="fas fa-sign-out-alt"></i>Logout</a>

                </div>

            </div>

        </div>

    </header>

    <div id="content" class="site-content">

        <div class="container-fluid">