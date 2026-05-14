<div class="forms">
    <form action="" method="post">
        <h2>Add student general data</h2>

        <label for="username">
            <img src="./assets/icons/user.png" alt="">
            <input type="text" placeholder="username" name="username">
        </label>
        <label for="admission">
            <img src="./assets/icons/admission.png" alt="">
            <input type="text" name="admission" placeholder="admission" required>
        </label>
        <label for="index">
            <img src="./assets/icons/index.png" alt="">
            <input type="text" name="index" placeholder="index" required>
        </label>

        <?php if ($adminProfile['position'] == "admin"): ?>

            <?php foreach ($departments as $department): ?>

                <h2><img src="./assets/icons/<?= e($department) ?>.png" alt=""><?= e($department) ?> dept</h2>

                <label for="">
                    <img src="./assets/icons/debt.png" alt="">
                    <input type="text" name="<?= e($department) ?>debt" placeholder="<?= e($department) ?> debt" value="none" required>
                </label>

                <label for="">
                    <img src="./assets/icons/debt.png" alt="">
                    <input type="text" name="<?= e($department) ?>value" placeholder="<?= e($department) ?> value" value="0" required>
                </label>

            <?php endforeach; ?>

            <input type="submit" value="Upload student data" name="upload">

        <?php else: ?>

            <h2><?= e($adminProfile['position']) ?> dept</h2>

            <label for="">
                <img src="./assets/icons/debt.png" alt="">
                <input type="text" name="<?= e($adminProfile['position']) ?>debt" placeholder="<?= e($adminProfile['position']) ?> debt" required>
            </label>

            <label for="">
                <img src="./assets/icons/debt.png" alt="">
                <input type="text" name="<?= e($adminProfile['position']) ?>value" placeholder="<?= e($adminProfile['position']) ?> value" required>
            </label>

            <input type="submit" value="Upload student data" name="upload">

        <?php endif ?>

    </form>

</div>
