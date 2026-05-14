<?php loadHeader("complete payment") ?>

<nav>
    <h2><img src="./assets/icons/favicon.svg" alt="">Complete Payment</h2>
    <div class="links">
        <div class="mode">
            <div class="mode_set"></div>
        </div>
        <div class="sun_moon">
            <img src="./assets/icons/sun.png" alt="" class="weather">
        </div>
        <a href="#footer"><img src="./assets/icons/customer-service.png" alt="">contact us</a>
        <a href="/pricing-back"><img src="./assets/icons/back.png" alt="">back</a>
    </div>
</nav>

<div class="cashout-container">

    <div class="cashout-form">

        <div class="balance-card">
            <span style="font-size: 18px; opacity: 0.8;"> <?= e($plan) ?> plan </span>
            <span class="balance-amount">KES <?= e(formatNumber($amount)) ?>/m </span>
        </div>

        <form method="post" action="">
            <div class="form-group">
                <label for="method">Payment Method</label>
                <select id="method" name="method" required>
                    <option value="mpesa">M-Pesa</option>
                    <option value="bank">Bank Transfer</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>

            <div class="form-group">
                <label for="amount">Amount Payable</label>
                <input type="text" readonly id="amount" placeholder="Enter amount" value="<?= e($amount) ?>">
            </div>

            <div class="form-group">
                <label for="account">Account Number / Phone</label>
                <input type="text" name="account" id="account" placeholder="e.g. 0712345678" required>
            </div>

            <div class="form-group">
                <label for="account">Your current departments are : </label>

                <?php foreach ($currentDepartments as $department): ?>
                    <h2 class="depts"><img src="./assets/icons/<?= e($department) ?>.png" alt=""><?= e($department) ?> department</h2>
                <?php endforeach; ?>

            </div>

            <button type="submit" name="complete_payment" class="withdraw-btn">Confirm Payment</button>
        </form>

        <!-- <p class="note">Processing may take up to 24 hours depending on the method.</p> -->
    </div>
</div>

<?php require_once ROOT . "/require/footer.php"; ?>
