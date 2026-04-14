<div class="forms">
    <form action="" method="post">
        <h2>Add student general data</h2>

        <?php if ($admin_profile['position'] == "admin"): ?>
            <!-- student personal info -->
            <h2>Student info</h2>
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
            <label for="year">
                <img src="./assets/icons/year.png" alt="">
                <input type="text" name="year" placeholder="year" required>
            </label>


            <!-- departments -->

            <!-- finace -->
            <h2>Finance dept</h2>
            <label for="">
                <img src="./assets/icons/finance.png" alt="">
                <input type="text" value="uncleared" name="feestatus" required>
            </label>
            <label for="">
                <img src="./assets/icons/debt.png" alt="">
                <input type="text" name="feedebt" placeholder="finance debt" required>
            </label>
            <label for="">
                <img src="./assets/icons/debt.png" alt="">
                <input type="text" name="financevalue" placeholder="finance value" required>
            </label>

            <!-- laboratory -->
            <h2>Laboratory dept</h2>
            <label for="">
                <img src="./assets/icons/laboratory.png" alt="">
                <input type="text" value="uncleared" name="labstatus" required>
            </label>
            <label for="">
                <img src="./assets/icons/laboratory.png" alt="">
                <input type="text" name="labitemsdamaged" placeholder="lab item(s) damaged" required>
            </label>
            <label for="">
                <img src="./assets/icons/laboratory.png" alt="">
                <input type="text" name="labitemsdamagedvalue" placeholder="lab item(s) damaged value" required>
            </label>

            <!-- library -->
            <h2>Library dept</h2>
            <label for="">
                <img src="./assets/icons/library.png" alt="">
                <input type="text" value="uncleared" name="librarystatus" required>
            </label>
            <label for="">
                <img src="./assets/icons/library.png" alt="">
                <input type="text" name="bookslost" placeholder="book(s) lost" required>
            </label>
            <label for="">
                <img src="./assets/icons/library.png" alt="">
                <input type="text" name="bookvalue" placeholder="book(s) market value" required>
            </label>

            <!-- accessories -->
            <h2>accessories dept</h2>
            <label for="">
                <img src="./assets/icons/accessories.png" alt="">
                <input type="text" value="uncleared" name="accessoriesstatus" required>
            </label>
            <label for="">
                <img src="./assets/icons/accessories.png" alt="">
                <input type="text" name="accessoriesdebt" placeholder="unpaid accessorie(s)" required>
            </label>
            <label for="">
                <img src="./assets/icons/accessories.png" alt="">
                <input type="text" name="accessoriesvalue" placeholder="unpaid accessorie(s) market value" required>
            </label>

            <!-- boarding -->
            <h2>Boarding dept</h2>
            <label for="">
                <img src="./assets/icons/boarding.png" alt="">
                <input type="text" value="uncleared" name="boardingstatus" required>
            </label>
            <label for="">
                <img src="./assets/icons/boarding.png" alt="">
                <input type="text" name="boardingitemsdamged" placeholder="boarding item(s) damaged" required>
            </label>
            <label for="">
                <img src="./assets/icons/boarding.png" alt="">
                <input type="text" name="boardingitemsdamagedmarketvalue" placeholder="boarding item(s) damaged market value" required>
            </label>

            <!-- games -->
            <h2>Games dept</h2>
            <label for="">
                <img src="./assets/icons/games.png" alt="">
                <input type="text" value="uncleared" name="gamesstatus" required>
            </label>
            <label for="">
                <img src="./assets/icons/games.png" alt="">
                <input type="text" name="gamesitemlost" placeholder="games item(s) lost" required>
            </label>
            <label for="">
                <img src="./assets/icons/games.png" alt="">
                <input type="text" name="gamesitemlostmarketvalue" placeholder="games item(s) lost market value" required>
            </label>

            <input type="submit" value="Upload student data" name="uploaddata">

        <?php else: ?>
            <h2>Student info</h2>
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
            <label for="year">
                <img src="./assets/icons/year.png" alt="">
                <input type="text" name="year" placeholder="year" required>
            </label>


            <!-- departments -->

            <!-- finace -->
            <h2><?= $admin_profile['position'] ?> dept</h2>
            <label for="">
                <img src="./assets/icons/<?= $admin_profile['position'] ?>.png" alt="">
                <input type="text" value="uncleared" name="<?= $admin_profile['position'] ?>status" required>
            </label>
            <label for="">
                <img src="./assets/icons/debt.png" alt="">
                <input type="text" name="<?= $admin_profile['position'] ?>debt" placeholder="<?= $admin_profile['position'] ?> debt" required>
            </label>
            <label for="">
                <img src="./assets/icons/debt.png" alt="">
                <input type="text" name="<?= $admin_profile['position'] ?>value" placeholder="<?= $admin_profile['position'] ?> value" required>
            </label>

            <input type="submit" value="Upload student data" name="uploaddata">

        <?php endif ?>
    </form>
</div>