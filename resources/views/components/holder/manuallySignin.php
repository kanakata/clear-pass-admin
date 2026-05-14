<div class="forms">
    <form action="" method="post">
        <h2>Mannually Sign up user</h2>
        <label for="first name">
            <img src="./assets/icons/name.png" alt="">
            <input type="text" placeholder="first name" name="firstname" required>
        </label>
        <label for="last name">
            <img src="./assets/icons/name.png" alt="">
            <input type="text" placeholder="last name" name="lastname" required>
        </label>
        <label for="sir name">
            <img src="./assets/icons/user.png" alt="">
            <input type="text" placeholder="sirname (leave blank if none)" name="sirname">
        </label>
        <label for="admission">
            <img src="./assets/icons/admission.png" alt="">
            <input type="text" name="admission" placeholder="admission / security number if admin" required>
        </label>
        <label for="userid">
            <img src="./assets/icons/index.png" alt="">
            <input type="text" name="index" placeholder="index number / userid if admin" required>
        </label>

        <label for="year">
            <img src="./assets/icons/year.png" alt="">
            <!-- <input type="text" name="usertype" placeholder="usertype" required> -->
            <select name="usertype" id="usertype" required>
                <option value="student">usertype</option>
                <option value="student">student</option>
                <option value="admin">admin</option>
            </select>
        </label>

        <label for="position">
            <img src="./assets/icons/password.png" alt="">

            <select name="position" id="position" style="display: none" required>
                <option value="position">position</option>
                <option value="finance">finance</option>
                <option value="library">library</option>
                <option value="games">games</option>
            </select>
        </label>

        <label for="security number">
            <img src="./assets/icons/password.png" alt="">
            <input type="text" name="security_number" placeholder="securitynumber" required class="admin_pos"  style="display: none;">
        </label>

        <label for="password">
            <img src="./assets/icons/password.png" alt="">
            <input type="password" name="password" placeholder="password" required>
        </label>
        <label for="confirm password">
            <img src="./assets/icons/password.png" alt="">
            <input type="password" name="confirmpassword" placeholder="confirm password" required>
        </label>
        <input type="submit" value="Sign up" name="upload">
    </form>
</div>