<?php if (parse_url($_SERVER['REQUEST_URI'])['path'] == "/dashboard"): ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Welcome to school clearance site. Clearance simplified and tailored to meet your needs">
        <link rel="shortcut icon" href="./assets/school.png" type="image/x-icon">
        <title><?= $page_title . "-pegpem" ?></title>
        <link rel="stylesheet" href="./css/admin.css" type="text/css">
        <script src="./js/sidebar-toggle.js" defer></script>
        <script src="./js/active.js" defer></script>
        <script src="./js/alert.js" defer></script>
        <script src="./js/theme.js" defer></script>
    </head>

    <body style="overflow: <?= (isset($_SESSION['message'])) ? "hidden" : "scroll" ?>;">

    <?php else: ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="Welcome to school clearance site. Clearance simplified and tailored to meet your needs">
            <link rel="shortcut icon" href="./assets/school.png" type="image/x-icon">
            <title><?= $page_title . "-pegpem" ?></title>
            <link rel="stylesheet" href="./css/style.css" type="text/css">
            <script src="./js/scroll.js" defer></script>
            <script src="./js/theme.js" defer></script>
        </head>

        <body style="overflow: <?= (!empty($action_status)) ? "hidden" : "scroll" ?>;">

        <?php endif; ?>