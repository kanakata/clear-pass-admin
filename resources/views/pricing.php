<?php loadHeader("pricing") ?>

<nav>
    <h2><img src="./assets/icons/favicon.svg" alt="">Clear pass subscription</h2>
    <div class="links">
        <div class="mode">
            <div class="mode_set"></div>
        </div>
        <div class="sun_moon">
            <img src="./assets/icons/sun.png" alt="" class="weather">
        </div>
        <a href="#footer"><img src="./assets/icons/customer-service.png" alt="">contact us</a>
        <a href="/landing"><img src="./assets/icons/back.png" alt="">back</a>
    </div>
</nav>


<div class="pricing-container">

    <h2 class="welcome">Hii👋there welcome to clear pass pricing page.</h2>

    <form method="post" action="" class="pricing-form">

        <input type="hidden" name="plan" value="" class="plan">
        <input type="hidden" name="value" value="" class="value">
        <input type="hidden" name="limit" value="" class="limit">

        <?php if (parse_url($_SERVER['HTTP_REFERER'])['path'] == "/landing" || parse_url($_SERVER['HTTP_REFERER'])['path'] == "/"): ?>



            <div class="plans-container">

                <div class="plan-card" data-limit="1" data-price="9500" data-name="test">
                    <h3>Basic</h3>
                    <span class="limit-tag">Up to 1 Depts</span>
                    <div class="price">KES 9,500<span>/mo</span></div>
                    <p>Best for primary schools.</p>
                </div>

                <div class="plan-card" data-limit="2" data-price="20000" data-name="Basic">
                    <h3>Basic</h3>
                    <span class="limit-tag">Up to 2 Depts</span>
                    <div class="price">KES 20,000<span>/mo</span></div>
                    <p>Best for primary schools.</p>
                </div>

                <div class="plan-card" data-limit="3" data-price="29500" data-name="Stater">
                    <h3>Stater</h3>
                    <span class="limit-tag">Up to 3 Depts</span>
                    <div class="price">KES 29,500<span>/mo</span></div>
                    <p>Most popular for high schools.</p>
                </div>

                <div class="plan-card" data-limit="5" data-price="42500" data-name="Premium">
                    <h3>Premium</h3>
                    <span class="limit-tag">Up to 5 Depts</span>
                    <div class="price">KES 42,500<span>/mo</span></div>
                    <p>Most popular for high schools.</p>
                </div>

                <div class="plan-card" data-limit="6" data-price="80000" data-name="Enterprise">
                    <h3>Enterprise</h3>
                    <span class="limit-tag">Up to 6 Depts</span>
                    <div class="price">KES 80,000<span>/mo</span></div>
                    <p>Full-scale University solution.</p>
                </div>

            </div>
            <h2 class="welcome">create an account to select plan</h2>
        <?php else: ?>

            <div class="pricing-header">
                <p>Select a plan and choose your active departments to proceed.</p>
                <?php if ($presentPlan !== null): ?>

                    <div class="continue">
                        <h2 class="welcome-plan">Your are currently on: <?= e($presentPlan) ?> plan</h2>
                        <a href="/payout?continue">continue with my plan</a>
                    </div>

                <?php endif; ?>
            </div>
            <div class="plans-container">

                <div class="plan-card active" data-limit="2" data-price="20000" data-name="Basic">
                    <h3>Basic</h3>
                    <span class="limit-tag">Up to 2 Depts</span>
                    <div class="price">KES 20,000<span>/mo</span></div>
                    <p>Best for primary schools.</p>
                </div>

                <div class="plan-card" data-limit="3" data-price="29500" data-name="Stater">
                    <h3>Stater</h3>
                    <span class="limit-tag">Up to 3 Depts</span>
                    <div class="price">KES 29,500<span>/mo</span></div>
                    <p>Most popular for high schools.</p>
                </div>

                <div class="plan-card" data-limit="5" data-price="42500" data-name="Premium">
                    <h3>Premium</h3>
                    <span class="limit-tag">Up to 5 Depts</span>
                    <div class="price">KES 42,500<span>/mo</span></div>
                    <p>Most popular for high schools.</p>
                </div>

                <div class="plan-card" data-limit="6" data-price="80000" data-name="Enterprise">
                    <h3>Enterprise</h3>
                    <span class="limit-tag">Up to 6 Depts</span>
                    <div class="price">KES 80,000<span>/mo</span></div>
                    <p>Full-scale University solution.</p>
                </div>

            </div>

            <div class="selection-box">
                <h3>Choose your Departments</h3>
                <p id="counter-status">Selected: <span class="numerator">0</span> <span>/</span> <span class="denominator">2</span></p>

                <div class="dept-grid" id="deptGrid">
                    <?php foreach ($departments as $department): ?>
                        <label class="dept-item" for=""><input type="checkbox" name="department[]" value="<?= $department ?>"> <?= $department ?></label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="checkout-bar">
                <div class="total-info">
                    <h4 id="summary-plan">Basic plan</h4>
                    <div class="total-price" id="summary-price">KES 20,000</div>
                </div>
                <button class="btn-checkout disabled" disabled id="checkoutBtn" name="proceed">Proceed to Checkout</button>
            </div>
        <?php endif; ?>


    </form>
</div>

<?php require_once ROOT . "/require/footer.php" ?>
