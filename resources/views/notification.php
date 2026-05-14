<?php loadHeader("notifications") ?>
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
    🔔🔔🔔 You have <?= $notificationData['notificationCount'] == 1 ? e($notificationData['notificationCount'] . " notification") : e($notificationData['notificationCount'] . " notifications.") ?>
</h2>
<div class="notifications">

    <!-- notifications -->
    <?php if (!empty($notificationData['notifications'])): ?>
        <?php foreach ($notificationData['notifications'] as $info): ?>
            <div class="notification_holder">
                <div class="notification">
                    <div class="icon">🔔</div>
                    <div class="message"><?= e($info['notification']) ?></div>
                    <div class="time" style="color: green;">Date: <?= e($info['time']) ?></div>
                </div>
                <a href="/notification?delete_notification=true&id=<?= e($info['id']) ?>" class="delete" ><img src="./assets/icons/x.svg" alt=""></a>
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

    <?php loadFooter() ?>
