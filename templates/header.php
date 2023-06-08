<?php
if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

require "../functions.php";

$id = $_SESSION['id'];
$user = query(
    "SELECT * FROM users
    INNER JOIN users_role ON users.role_id = users_role.id_role
    WHERE id_user = $id"
)[0];

ini_set('display_errors', 1); //Atau error_reporting(E_ALL && ~E_NOTICE);
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>SIPPA</title>

    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicon.png" />

    <link href="../assets/libs/flot/css/float-chart.css" rel="stylesheet" />

    <link href="../assets/libs/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
    <link href="../assets/extra-libs/calendar/calendar.css" rel="stylesheet" />

    <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" />
    <link href="../assets/css/style.min.css" rel="stylesheet" />

    <link href="../assets/css/style.min.css" rel="stylesheet" />
</head>

<body>
    <!-- <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div> -->

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <?php
        include "../templates/topbar.php";

        if ($user["role_id"] == 1) {
            include "../templates/sidebar.php";
        } else {
            include "../templates/sidebar_user.php";
        }
        ?>