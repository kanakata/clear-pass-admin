<?php
$page_title = "notifications";
use App\Controllers\view_controller;

$notification_data = view_controller::Display_notifications(); 
require_once ROOT . "/require/header.php";
?>
<nav>
    <h2><img src="./assets/icons/dashboard.png" alt="">Notifications🔔</h2>
    <div class="links">
        <div class="mode">
            <div class="mode_set"></div>
        </div>
        <div class="sun_moon">
            <img src="./assets/icons/sun.png" alt="" class="weather">
        </div>
        <a href="/dashboard"><img src="./assets/icons/back.png" alt="">Back</a>
    </div>
</nav>
<h2 class="welcome">
    You have <?= $notification_data['notification_count'] == 1 ? $notification_data['notification_count'] . " notification" : $notification_data['notification_count'] . " notifications" ?>
</h2>
<div class="notifications">

    <!-- notifications -->
    <?php if (!empty($notification_data['notification(s)'])): ?>
        <?php foreach ($notification_data['notification(s)'] as $info): ?>
            <div class="notification_holder">
                <div class="notification">
                    <div class="icon">🔔</div>
                    <div class="message"><?php echo $info['message'] ?></div>
                    <div class="time" style="color: green;">Date: <?php echo $info['date'] ?></div>
                </div>
                <a href="/notification?delete_notification=true&id=<?php echo $info['id'] ?>" class="delete" style="color: red; font-size: 10px;"><img src="./assets/icons/x.svg" alt="" style="height: 18px;">DELETE NOTIFICATION</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="notification_holder">
            <div class="notification">
                <div class="icon">🔔</div>
                <div class="message">You have no notification(s).</div>
            </div>
        </div>
    <?php endif; ?>

    <?php require_once ROOT . "/require/footer.php" ?>