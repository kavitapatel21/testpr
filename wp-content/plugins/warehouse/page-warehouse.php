<?php

if (!is_user_logged_in()) {
    include 'loginpage.php';
    return;
}

$whtab = isset($_GET['whtab']) ? $_GET['whtab'] : 'home';

switch ($whtab) {

    case 'order':
        include "header-warehouse.php";
        include 'whtab-order.php';
        include "footer-warehouse.php";
        break;

    case 'adminorder':
        include "header-warehouse.php";
        include 'whtab-order-admin.php';
        include "footer-warehouse.php";
        break;

    case 'inventory':
        include "header-warehouse.php";
        include 'whtab-inventory.php';
        include "footer-warehouse.php";
        break;

    case 'adminprint':
        include 'whtab-print-admin.php';
        break;

    default:
        include "header-warehouse.php";
        include "whtab-home.php";
        include "footer-warehouse.php";
}