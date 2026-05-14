<?php loadHeader("register") ?>

<nav>
    <h2><img src="./assets/icons/favicon.svg" alt="">Sign up page</h2>
    <div class="links">
        <div class="mode">
            <div class="mode_set"></div>
        </div>
        <div class="sun_moon">
            <img src="./assets/icons/sun.png" alt="" class="weather">
        </div>
        <a href="/login"><img src="./assets/icons/login.png" alt="">log in</a>
        <a href="#footer"><img src="./assets/icons/customer-service.png" alt="">contact us</a>
        <a href="/landing"><img src="./assets/icons/back.png" alt="">back</a>
    </div>
</nav>

<h2 class="welcome">Hii👋there welcome to clear pass . Sign up for an account bellow ⬇️.</h2>

<header>
    <div class="ui_interface">
        <form action="#" method="post" enctype="multipart/form-data">

            <input type="hidden" name="csrf" value="<?= $csrf ?>">

            <div class="icon">
                <h2><img src="./assets/icons/favicon.svg" alt="">sign me up</h2>
            </div>
            <label for="name" class="name">
                <label class="f-name">
                    <img src="./assets/icons/name.png" alt="user" loading="lazy">
                    <input type="text" placeholder="first name" name="firstname">
                </label>
                <label class="l-name">
                    <img src="./assets/icons/name.png" alt="user">
                    <input type="text" placeholder="last name" name="lastname">
                </label>
            </label>
            <label for="school email">
                <img src="./assets/icons/user.png" alt="user">
                <input type="text" placeholder="school email" name="schoolemail">
            </label>
            <label for="school phone">
                <img src="./assets/icons/user.png" alt="user">
                <input type="text" placeholder="schoo phone" name="schoolphone">
            </label>
            <label for="school name">
                <img src="./assets/icons/admission.png" alt="admission">
                <input type="text" placeholder="school name" name="schoolname">
            </label>
            <label for="user id">
                <img src="./assets/icons/index.png" alt="index">
                <input type="text" placeholder="user id" name="userid">
            </label>
            <label for="security number">
                <img src="./assets/icons/index.png" alt="index">
                <input type="text" placeholder="security number" name="securitynumber">
            </label>
            <label for="password">
                <img src="./assets/icons/password.png" alt="password">
                <input type="password" placeholder="password (create a strong password & don't share it.)" name="password">
            </label>
            <label for="confirm password">
                <img src="./assets/icons/password.png" alt="confirm password">
                <input type="password" placeholder="confirm password" name="confirmpassword">
            </label>

            <input type="submit" value="register" name="register">

            <div class="icon">
                <h3>encountering any problems? contact us for help: <a href="tel:0793317819">0793317819</a></h3>
                <h3>already have an account log in: <a href="/login"> log in <img src="./assets/icons/login.png" alt=""></a></h3>
            </div>
        </form>
        <img src="./assets/icons/school.jpeg" alt="school pic" class="school_pic" loading="lazy">
    </div>
</header>



<!-- alert for different passwords -->
<?php if (!empty($action_status) || isset($_SESSION['action_status'])): ?>
    <div class="alert" style="display: <?php echo "block" ?>;">
        <div class="alert_title">alert</div>
        <div class="close">close<img src="./assets/icons/x.svg" alt=""></div>
        <div class="alert_message"><?= $action_status ?></div>
    </div>
<?php endif; ?>

<?php loadFooter() ?>
