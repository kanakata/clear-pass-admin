<?php loadHeader($_GET['department']  ?? "view students" . "-" . $_GET['inquiry']) ?>

<nav>
    <h2><img src="./assets/icons/<?= $_GET['department'] ?? "dashboard" ?>.png" alt=""><?php echo $_GET['department']  ?? "" . "-" . $_GET['inquiry'] ?></h2>
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

<h2 class="welcome">Search for a specific student.</h2>

<?php require_once ROOT . $checkPage["search"] ?>

<?php if ($pageData == null): ?>
    <div class="pages-to-display">
        <form action="" method="post">
            <label for="pages">
                ------ Type rows to display.
                <!-- display the number of rows from the cookie. If missing default to 10 -->
                <input type="number" placeholder="" value="<?= isset($_COOKIE['rows']) ? $_COOKIE['rows'] : 10 ?>" name="rows" disabled style="cursor:not-allowed">
            </label>
        </form>
    </div>
<?php else: ?>
    <div class="pages-to-display">
        <form action="" method="post">
            <label for="pages">
                ------ Type rows to display.
                <!-- display the number of rows from the cookie. If missing default to 10 -->
                <input type="number" placeholder="" value="<?= isset($_COOKIE['rows']) ? $_COOKIE['rows'] : 10 ?>" name="rows">
            </label>
        </form>
    </div>
<?php endif; ?>

<?php require_once ROOT . $checkPage[$inquiry] ?>

<!-- pagination -->
<?php if ($pageData != null): ?>
    <?php

    $current_path = strtok($_SERVER['REQUEST_URI'], '?');


    $params = $_GET;

    $get_link = function ($target_page) use ($current_path, $params) {
        $params['page'] = $target_page; // Set or overwrite the page

        return htmlspecialchars($current_path . '?' . http_build_query($params));
    };

    ?>

    <div class="pagination">


        <?php if ($page > 1): ?>
            <a href="<?= $get_link($page - 1) ?>" class="prev move">prev</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <div class="numbers <?= ($i == $page) ? 'active' : '' ?>">
                <a href="<?= $get_link($i) ?>" class="pag"><?= "" . $i ?></a>
            </div>
        <?php endfor; ?>


        <?php if ($page >= 1): ?>
            <a href="<?= $get_link($page + 1) ?>" class="next move">next</a>
        <?php endif; ?>


    </div>
<?php endif; ?>

<?php loadFooter() ?>
