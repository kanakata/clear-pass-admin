<?php
$page_title = "adimin-dashboard";

use App\Controllers\view_controller;

$site_metrics = view_controller::Display_site_metrics();
$admin_profile = view_controller::Display_admin_profile_data()['admin_data'];
$notification_count = view_controller::Display_notifications()['notification_count'];
require_once ROOT . "/require/header.php";
?>

<aside class="sidebar">
    <div class="nav">
        <div class="logo">
            <img src="./assets/icons/dashboard.png" alt="Logo">
            <span>Admin Portal</span>
            <img src="./assets/icons/x.svg" alt="" class="logo-close">
        </div>
        <div class="nav-group">

            <?php if ($admin_profile['position'] == "admin"): ?>

                <a href="/admin_actions?action=update"><img src="./assets/icons/update.png" alt="">Update Student</a>

                <a href="/admin_actions?action=manually_sign_in"><img src="./assets/icons/add.png" alt="">Add Student</a>

                <hr>

                <a href="/check?inquiry=view_shipment_details&status=general"><img src="./assets/icons/shipment-tracking.png" alt=""> View shipment requests</a>

                <a href="/check?inquiry=view_students&status=general"><img src="./assets/icons/view-students.png" alt=""> View Student List</a>

                <a href="/check?inquiry=cleared&status=general"><img src="./assets/icons/cleared.png" alt=""> View cleared Student</a>

                <a href="/check?inquiry=uncleared&status=general"><img src="./assets/icons/uncleared.png" alt=""> View uncleared Student</a>

                <a href="/notification"><img src="./assets/icons/notification.png" alt=""> Notifications <div class="badge"><?= $notification_count ?></div></a>

                <a href="/admin_actions?action=manually_sign_in"><img src="./assets/icons/update.png" alt="">Update Department Head</a>

                <a href="/admin_actions?action=manually_sign_in"><img src="./assets/icons/add.png" alt="">Add Department Head</a>

            <?php endif; ?>

            <hr>

            <a href="/admin_actions"><img src="./assets/icons/add-student-data.png" alt="">Add Student data</a>

        </div>
    </div>
</aside>

<main class="main-content">

    <header class="top-bar">
        <div class="welcome-text">
            <h1>Welcome back, <span class="highlight"><?= htmlspecialchars($_SESSION['username']) ?></span></h1>
            <?php if ($admin_profile['position'] == "admin"): ?>
                <p>Here is what's happening with your site metrics today.</p>
            <?php endif; ?>
        </div>
        <div class="top-actions">

            <div class="admin-profile">
                <div class="profile-info">
                    <strong>Admin User</strong>
                    <span><?= $admin_profile['position'] ?></span>
                </div>
            </div>

            <div class="links">
                <div class="mode">
                    <div class="mode_set"></div>
                </div>
                <div class="sun_moon">
                    <img src="./assets/icons/sun.png" alt="" class="weather">
                </div>
                <a href="/login"><img src="./assets/icons/logout.png" alt="">log out</a>
            </div>

        </div>
    </header>

    <?php if ($admin_profile['position'] == "admin"): ?>
        <section class="metrics-grid">
            <div class="card success">
                <small><img src="./assets/icons/total-students.png" alt="">Total Students</small>
                <h3><?= $site_metrics['total_students'] ?> students</h3>
                <div class="progress-bar">
                    <div style="width: 100%"></div>
                </div>
            </div>

            <div class="card success">
                <small><img src="./assets/icons/signed-up.png" alt="">Signed Up</small>
                <h3><?= $site_metrics['total_signed_up_students'] ?> students <span class="percent"><?= ($site_metrics['total_signed_up_students'] / $site_metrics['total_students']) * 100 ?>%</span></h3>
                <div class="progress-bar">
                    <div style="width: <?= ($site_metrics['total_signed_up_students'] / $site_metrics['total_students']) * 100 ?>%"></div>
                </div>
            </div>
            <div class="card danger">
                <small><img src="./assets/icons/unsigned.png" alt="">Unsigned Up</small>
                <h3><?= ($site_metrics['total_students'] - $site_metrics['total_signed_up_students']) ?> students<span class="percent"><?= (($site_metrics['total_students'] - $site_metrics['total_signed_up_students']) / $site_metrics['total_students']) * 100 ?>%</span></h3>
                <div class="progress-bar">
                    <div style="width: <?= (($site_metrics['total_students'] - $site_metrics['total_signed_up_students']) / $site_metrics['total_students']) * 100 ?>%"></div>
                </div>
            </div>
            <div class="card success">
                <small><img src="./assets/icons/daily-login.png" alt="">Daily Logins</small>
                <h3><?= $site_metrics['login_count'] . $site_metrics['login_count'] == 1 ?  $site_metrics['login_count'] . " User" :  $site_metrics['login_count'] . " Users" ?> </h3>
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

            <?php if ($admin_profile['position'] !== "admin"): ?>
                <div class="action-card">
                    <h4><?= $admin_profile['position'] ?></h4>
                    <div class="link-list">
                        <a href="/check?inquiry=cleared&department=<?= $admin_profile['position'] ?>"><img src="./assets/icons/cleared.png" alt="">Cleared Students</a>
                        <a href="/check?inquiry=uncleared&department=<?= $admin_profile['position'] ?>"><img src="./assets/icons/uncleared.png" alt="">Uncleared Students</a>
                        <a href="/check?inquiry=pending_physical_payment&department=<?= $admin_profile['position'] ?>"><img src="./assets/icons/physical.png" alt="">Physical Payments</a>
                        <a href="/check?inquiry=online&department=<?= $admin_profile['position'] ?>"><img src="./assets/icons/online.png" alt="">Online</a>
                    </div>
                </div>
            <?php else: ?>

                <div class="action-card">
                    <h4><img src="./assets/icons/accessories.png" alt="">accessories</h4>
                    <div class="link-list">
                        <a href="/check?inquiry=cleared&department=accessories"><img src="./assets/icons/cleared.png" alt="">Cleared Students</a>
                        <a href="/check?inquiry=uncleared&department=accessories"><img src="./assets/icons/uncleared.png" alt="">Uncleared Students</a>
                        <a href="/check?inquiry=online&department=accessories"><img src="./assets/icons/online.png" alt="">Online</a>
                        <a href="/check?inquiry=pending_physical_payment&department=accessories"><img src="./assets/icons/physical.png" alt="">Physical Payments</a>
                    </div>
                </div>


                <div class="action-card">
                    <h4> <img src="./assets/icons/laboratory.png" alt=""> laboratory</h4>
                    <div class="link-list">
                        <a href="/check?inquiry=cleared&department=laboratory"><img src="./assets/icons/cleared.png" alt="">Cleared Students</a>
                        <a href="/check?inquiry=uncleared&department=laboratory"><img src="./assets/icons/uncleared.png" alt="">Uncleared Students</a>
                        <a href="/check?inquiry=online&department=laboratory"><img src="./assets/icons/online.png" alt="">Online</a>
                        <a href="/check?inquiry=pending_physical_payment&department=laboratory"><img src="./assets/icons/physical.png" alt="">Physical Payments</a>
                    </div>
                </div>


                <div class="action-card">
                    <h4><img src="./assets/icons/finance.png" alt="">finance</h4>
                    <div class="link-list">
                        <a href="/check?inquiry=cleared&department=finance"><img src="./assets/icons/cleared.png" alt="">Cleared Students</a>
                        <a href="/check?inquiry=uncleared&department=finance"><img src="./assets/icons/uncleared.png" alt="">Uncleared Students</a>
                        <a href="/check?inquiry=online&department=finance"><img src="./assets/icons/online.png" alt="">Online</a>
                        <a href="/check?inquiry=pending_physical_payment&department=finance"><img src="./assets/icons/physical.png" alt="">Physical Payments</a>
                    </div>
                </div>


                <div class="action-card">
                    <h4><img src="./assets/icons/games.png" alt="">games</h4>
                    <div class="link-list">
                        <a href="/check?inquiry=cleared&department=finance"><img src="./assets/icons/cleared.png" alt="">Cleared Students</a>
                        <a href="/check?inquiry=uncleared&department=games"><img src="./assets/icons/uncleared.png" alt="">Uncleared Students</a>
                        <a href="/check?inquiry=online&department=games"><img src="./assets/icons/online.png" alt="">Online</a>
                        <a href="/check?inquiry=pending_physical_payment&department=games"><img src="./assets/icons/physical.png" alt="">Physical Payments</a>
                    </div>
                </div>


                <div class="action-card">
                    <h4><img src="./assets/icons/boarding.png" alt="">boarding</h4>
                    <div class="link-list">
                        <a href="/check?inquiry=cleared&department=boarding"><img src="./assets/icons/cleared.png" alt="">Cleared Students</a>
                        <a href="/check?inquiry=uncleared&department=boarding"><img src="./assets/icons/uncleared.png" alt="">Uncleared Students</a>
                        <a href="/check?inquiry=online&department=boarding"><img src="./assets/icons/online.png" alt="">Online</a>
                        <a href="/check?inquiry=pending_physical_payment&department=boarding"><img src="./assets/icons/physical.png" alt="">Physical Payments</a>
                    </div>
                </div>


                <div class="action-card">
                    <h4><img src="./assets/icons/library.png" alt="">library</h4>
                    <div class="link-list">
                        <a href="/check?inquiry=cleared&department=library"><img src="./assets/icons/cleared.png" alt="">Cleared Students</a>
                        <a href="/check?inquiry=uncleared&department=library"><img src="./assets/icons/uncleared.png" alt="">Uncleared Students</a>
                        <a href="/check?inquiry=online&department=library"><img src="./assets/icons/online.png" alt="">Online</a>
                        <a href="/check?inquiry=pending_physical_payment&department=library"><img src="./assets/icons/physical.png" alt="">Physical Payments</a>
                    </div>
                </div>

            <?php endif; ?>

        </div>

    </section>

</main>

<!-- display dialogues -->
<?php if (isset($_SESSION['message'])): ?>
    <div class="alert" style="display: <?php echo "block" ?>;">
        <div class="alert_title">🥳🥳 alert!!</div>
        <div class="close">close<img src="./assets/icons/x.svg" alt=""></div>
        <div class="alert_message"><?= $_SESSION['message'] ?></div>
    </div>
<?php endif; ?>
<?php unset($_SESSION['message']) ?>

<!-- load footer -->
<?php require_once ROOT . "/require/footer.php" ?>