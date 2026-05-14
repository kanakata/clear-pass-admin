<?php
$page = parse_url($_SERVER['REQUEST_URI'])['path'];
$allowed_page = [
    "/dashboard",
    "/pricing",
    "/payout",
]; ?>

<!DOCTYPE html>
<html lang="en">

<?php if (in_array($page, $allowed_page)): ?>


    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Welcome to school clearance site. Clearance simplified and tailored to meet your needs">
        <link rel="shortcut icon" href="./assets/school.png" type="image/x-icon">
        <title><?= $pageTitle ?? "" . " || clear pass" ?></title>
        <link rel="stylesheet" href="./css/admin.css" type="text/css">
        <link rel="stylesheet" href="" type="text/css">
        <script src="./js/sidebar-toggle.js" defer></script>
        <script src="./js/active.js" defer></script>
        <script src="./js/alert.js" defer></script>
        <script src="./js/scroll.js" defer></script>
        <script src="./js/pricing.js" defer></script>
        <script src="./js/theme.js" defer></script>
        <script src="./js/config.js" defer></script>
        <script src="./js/nav-group.js" defer></script>
        <link rel="shortcut icon" href="./assets/icons/favicon.svg" type="image/x-icon">
    </head>

    <body style="overflow: <?= (isset($_SESSION['message'])) ? "hidden" : "scroll" ?>;">

    <?php elseif (parse_url($_SERVER['REQUEST_URI'])['path'] == "/landing" || parse_url($_SERVER['REQUEST_URI'])['path'] == "/"): ?>


        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="Welcome to school clearance site. Clearance simplified and tailored to meet your needs">
            <link rel="shortcut icon" href="./assets/school.png" type="image/x-icon">
            <title><?= $pageTitle . " || clear pass" ?></title>
            <link rel="stylesheet" href="./css/app.css" type="text/css">
            <link rel="stylesheet" href="" type="text/css">
            <link rel="shortcut icon" href="./assets/icons/favicon.svg" type="image/x-icon">
        <?php else: ?>

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="description" content="Welcome to school clearance site. Clearance simplified and tailored to meet your needs">
                <link rel="shortcut icon" href="./assets/school.png" type="image/x-icon">
                <title><?= $pageTitle . " || clear pass" ?></title>
                <link rel="stylesheet" href="./css/style.css" type="text/css">
                <script src="./js/scroll.js" defer></script>
                <script src="./js/theme.js" defer></script>
                <script src="./js/config.js" defer></script>
                <link rel="shortcut icon" href="./assets/icons/favicon.svg" type="image/x-icon">
            </head>

        <body style="overflow: <?= (!empty($action_status)) ? "hidden" : "scroll" ?>;">

        <?php endif; ?>
