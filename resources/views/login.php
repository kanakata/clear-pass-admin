<?php loadHeader("admin-login") ?>

<nav>
    <h2><img src="./assets/icons/favicon.svg" alt="">Log in page</h2>
    <div class="links">
        <div class="mode">
            <div class="mode_set"></div>
        </div>
        <div class="sun_moon">
            <img src="./assets/icons/sun.png" alt="" class="weather">
        </div>
        <a href="/register"><img src="./assets/icons/login.png" alt="">Sign up</a>
        <a href="#footer"><img src="./assets/icons/customer-service.png" alt="">contact us</a>
        <a href="/landing"><img src="./assets/icons/back.png" alt="">back</a>
    </div>
</nav>

<h2 class="welcome">Hii👋there welcome to clear pass. log into your account bellow ⬇️.</h2>

<header>
    <div class="ui_interface">
        <form action="" method="post" enctype="application/x-www-form-urlencoded">
            <input type="hidden" name="csrf" value="<?= csrf() ?>">
            <div class="icon">
                <h2><img src="./assets/icons/favicon.svg" alt="">log me in</h2>
            </div>
            <label for="name" class="name">
                <label class="f-name">
                    <img src="./assets/icons/user.png" alt="user">
                    <input type="text" placeholder="first name" name="firstname" value="patrick">
                </label>
                <label class="l-name">
                    <img src="./assets/icons/user.png" alt="user">
                    <input type="text" placeholder="last name" name="lastname" value="kiprop">
                </label>
            </label>
            <label for="school name">
                <img src="./assets/icons/user.png" alt="user">
                <input type="text" placeholder="school name" name="schoolname" value="chebisaas">
            </label>
            <label for="email">
                <img src="./assets/icons/user.png" alt="user">
                <input type="text" placeholder="email" name="schoolemail" value="patrick483@gmail.com">
            </label>
            <label for="user id">
                <img src="./assets/icons/admission.png" alt="admission">
                <input type="text" placeholder="user id" name="userid" value="1">
            </label>
            <label for="securitynumber">
                <img src="./assets/icons/index.png" alt="index">
                <input type="text" placeholder="security number" name="securitynumber" value="1">
            </label>
            <label for="password">
                <img src="./assets/icons/password.png" alt="password">
                <input type="password" placeholder="password" name="password" value="1">
            </label>
            <input type="submit" value="log me in" name="login">
            <div class="icon">
                <h3>encountering any problems? contact us for help: <a href="tel:0793317819">0793317819</a></h3>
                <h3>dont heve an account sign up: <a href="/register"> sign up <img src="./assets/icons/login.png" alt=""></a></h3>
            </div>
        </form>
        <img src="./assets/icons/school.jpeg" alt="school pic" class="school_pic" loading="lazy">
    </div>
</header>

<?php if (!empty($action_status)): ?>
    <div class="alert" style="display: <?php echo "block" ?>;">
        <div class="alert_title">alert</div>
        <div class="close">close<img src="./assets/icons/x.svg" alt=""></div>
        <div class="alert_message"><?= $action_status ?></div>
    </div>
<?php endif; ?>

<?php loadFooter() ?>
