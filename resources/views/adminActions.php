<?php loadHeader("admin-actions") ?>
<nav>
    <h2><img src="./assets/icons/dashboard.png" alt="">Admin actions</h2>
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

<div class="actions">
    <?php require_once ROOT . $adminActionsPage[$action] ?>
</div>

<?php if (!empty($action_status)): ?>
    <div class="alert" style="display: <?php echo "block" ?>;">
        <div class="alert_title">🔔🔔🔔 alert</div>
        <div class="close">close<img src="./assets/icons/x.svg" alt=""></div>
        <div class="alert_message"><?= $action_status ?></div>
    </div>
<?php endif; ?>

<?php loadFooter() ?>
