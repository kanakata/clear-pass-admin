<?php loadHeader("admin-dashboard") ?>

<aside class="sidebar">

    <div class="nav">
        <div class="logo">
            <img src="./assets/icons/dashboard.png" alt="Logo">
            <span>Admin Portal</span>
            <img src="./assets/icons/back.png" alt="" class="logo-close">
        </div>
        <div class="nav-group">

            <a href="/admin_actions?action=add_student_data"><img src="./assets/icons/add-student-data.png" alt="">Add Student data</a>


            <?php if ($adminProfile['position'] == "admin"): ?>

                <a href="/admin_actions?action=manually_sign_in"><img src="./assets/icons/add.png" alt="" data="100%">Add User</a>

                <a href="/admin_actions?action=update"><img src="./assets/icons/update.png" alt="">Update Student</a>

                <hr>

                <a href="/check?inquiry=view_shipment_details&status=general"><img src="./assets/icons/shipment-tracking.png" alt=""> View shipment requests</a>

                <a href="/check?inquiry=view_students&status=general"><img src="./assets/icons/view-students.png" alt=""> View Student List</a>

                <a href="/check?inquiry=cleared_general"><img src="./assets/icons/cleared.png" alt=""> View cleared Student</a>

                <a href="/check?inquiry=uncleared_general"><img src="./assets/icons/uncleared.png" alt=""> View uncleared Student</a>

                <hr>

                <a href="/notification"><img src="./assets/icons/notification.png" alt=""> Notifications <div class="badge"><?= e($notificationCount) ?></div></a>

            <?php endif; ?>

        </div>
    </div>
</aside>

<main class="main-content">

    <header class="top-bar">
        <div class="welcome-text">
            <h1>🥳🥳🥳 Welcome back, <span class="highlight"><?= htmlspecialchars($_SESSION['username']) . ". You are on : " . $subscriptionPlan . "   plan" ?></span></h1>
            <?php if ($adminProfile['position'] == "admin"): ?>
                <p>Here is what's happening with your site metrics today.</p>
            <?php endif; ?>
        </div>
        <div class="top-actions">

            <div class="links">
                <div class="mode">
                    <div class="mode_set"></div>
                </div>
                <div class="sun_moon">
                    <img src="./assets/icons/sun.png" alt="" class="weather">
                </div>
                <a href="/login"><img src="./assets/icons/logout.png" alt="">log out</a>
            </div>

            <div class="admin-profile">
                <div class="profile-info">
                    <strong>User</strong>
                    <span><?= $adminProfile['position'] ?></span>
                </div>
            </div>

        </div>
    </header>

    <?php if ($adminProfile['position'] == "admin"): ?>
        <section class="metrics-grid">

            <div class="card success">
                <small><img src="./assets/icons/total-students.png" alt="">Total Students</small>
                <h3><?= $siteMetrics['totalStudents'] ?> student(s)</h3>
                <div class="progress-bar">
                    <div style="width: 100%"></div>
                </div>
            </div>

            <div class="card success">
                <small><img src="./assets/icons/signed-up.png" alt="">Signed Up</small>
                <h3><?= $siteMetrics['totalSignedUpStudents'] ?> student(s) <span class="percent"><?= ($siteMetrics['totalSignedUpStudents'] == 0 || $siteMetrics['totalStudents'] == 0) ? "" : ($siteMetrics['totalSignedUpStudents'] / $siteMetrics['totalStudents']) * 100 . "%" ?></span></h3>
                <div class="progress-bar">
                    <div style="width: <?= ($siteMetrics['totalSignedUpStudents'] == 0 || $siteMetrics['totalStudents'] == 0) ? 0 * 100 : ($siteMetrics['totalSignedUpStudents'] / $siteMetrics['totalStudents']) * 100  ?>%"></div>
                </div>
            </div>

            <div class="card danger">

                <small><img src="./assets/icons/unsigned.png" alt="">Unsigned Up</small>
                <h3><?= (($siteMetrics['totalStudents'] - $siteMetrics['totalSignedUpStudents']) <= 0) ? 0 : ($siteMetrics['totalStudents'] - $siteMetrics['totalSignedUpStudents']) ?> student(s)<span class="percent"><?= ($siteMetrics['totalSignedUpStudents'] == 0 || $siteMetrics['totalStudents'] == 0) ? "" : (($siteMetrics['totalStudents'] - $siteMetrics['totalSignedUpStudents']) / $siteMetrics['totalStudents']) * 100 . "%" ?></span></h3>
                <div class="progress-bar">
                    <div style="width: <?= ($siteMetrics['totalSignedUpStudents'] == 0 || $siteMetrics['totalStudents'] == 0) ? 0 * 100 : (($siteMetrics['totalStudents'] - $siteMetrics['totalSignedUpStudents']) / $siteMetrics['totalStudents']) * 100 ?>%"></div>
                </div>

            </div>

            <div class="card success">
                <small><img src="./assets/icons/daily-login.png" alt="">Daily Logins</small>
                <h3><?= $siteMetrics['loginCount'] . $siteMetrics['loginCount'] == 1 ?  $siteMetrics['loginCount'] . " User" :  $siteMetrics['loginCount'] . " Users" ?> </h3>
                <div class="progress-bar">
                    <div style="width: 100%"></div>
                </div>
            </div>

        </section>
    <?php endif; ?>

    <section class="content-section">

        <div class="section-header">
            <h2>Departmental Actions</h2>
            <p>Manage clearances and payments across sectors</p>
        </div>

        <div class="action-grid">

            <?php if ($adminProfile['position'] !== "admin"): ?>
                <div class="action-card">
                    <h4><?= $adminProfile['position'] ?></h4>
                    <div class="link-list">
                        <a href="/check?inquiry=cleared&department=<?= $adminProfile['position'] ?>"><img src="./assets/icons/cleared.png" alt="">Cleared Students</a>
                        <a href="/check?inquiry=uncleared&department=<?= $adminProfile['position'] ?>"><img src="./assets/icons/uncleared.png" alt="">Uncleared Students</a>
                        <a href="/check?inquiry=pending_physical_payment&department=<?= $adminProfile['position'] ?>"><img src="./assets/icons/physical.png" alt="">Physical Payments</a>
                        <a href="/check?inquiry=online&department=<?= $adminProfile['position'] ?>"><img src="./assets/icons/online.png" alt="">Online</a>
                    </div>
                </div>
            <?php else: ?>

                <?php foreach ($departments as $department): ?>
                    <div class="action-card">
                        <h4><img src="./assets/icons/<?= e($department) ?>.png" alt=""><?= e($department) ?></h4>
                        <div class="link-list">
                            <a href="/check?inquiry=cleared&department=<?= e($department) ?>"><img src="./assets/icons/cleared.png" alt="">Cleared Students</a>
                            <a href="/check?inquiry=uncleared&department=<?= e($department) ?>"><img src="./assets/icons/uncleared.png" alt="">Uncleared Students</a>
                            <a href="/check?inquiry=online&department=<?= e($department) ?>"><img src="./assets/icons/online.png" alt="">Online</a>
                            <a href="/check?inquiry=pending_physical_payment&department=<?= e($department) ?>"><img src="./assets/icons/physical.png" alt="">Physical Payments</a>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php endif; ?>

        </div>

    </section>

</main>

<?php if (isset($_SESSION['message'])): ?>
    <div class="alert" style="display: <?php echo "block" ?>;">
        <div class="alert_title">🥳🥳 alert!!</div>
        <div class="close">close<img src="./assets/icons/x.svg" alt=""></div>
        <div class="alert_message"><?= $_SESSION['message'] ?></div>
    </div>
    <?php unset($_SESSION['message']) ?>
<?php endif; ?>

<?php loadFooter() ?>
