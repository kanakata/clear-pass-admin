<?php
$bodyClass = '';
loadHeader('Digital School Clearance Platform');
?>

<nav class="navbar">
    <div class="container navbar-inner">
        <a href="/" class="nav-logo">
            <div class="nav-logo-mark">C</div>
            Clear<span>Pass</span>
        </a>
        <ul class="nav-links">
            <li><a href="/#features">Features</a></li>
            <li><a href="/pricing">Pricing</a></li>
            <li><a href="/#how-it-works">How it works</a></li>
        </ul>
        <div class="nav-actions">

            <a href="/login" class="btn btn-primary btn-sm">School Login</a>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <div class="hero-content animate-fadeup">
            <div class="hero-badge">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                </svg>
                Trusted by 200+ Kenyan institutions
            </div>
            <h1>School Clearance,<br><span>Reimagined</span> for Africa</h1>
            <p>ClearPass digitises the entire student clearance process — from library returns to finance sign-offs — saving your institution weeks of paperwork.</p>
            <div class="hero-actions">
                <a href="/register" class="btn btn-primary btn-lg">Partner With Us</a>

            </div>
            <div class="hero-stats">
                <div>
                    <div class="hero-stat-value">200+</div>
                    <div class="hero-stat-label">Partner Schools</div>
                </div>
                <div>
                    <div class="hero-stat-value">50k+</div>
                    <div class="hero-stat-label">Students Cleared</div>
                </div>
                <div>
                    <div class="hero-stat-value">98%</div>
                    <div class="hero-stat-label">Satisfaction Rate</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="section" id="how-it-works" style="background:var(--navy-light)">
    <div class="container">
        <div class="text-center mb-32">
            <div class="section-tag">Process</div>
            <h2 class="section-title" style="color:var(--white)">How ClearPass Works</h2>
            <p style="color:rgba(255,255,255,0.55);margin:0 auto">Three simple steps from application to certificate</p>
        </div>
        <div class="grid-3" style="gap:32px">
            <?php $steps = [
                ['num' => '01', 'icon' => '🏫', 'title' => 'School Registers', 'desc' => 'Your institution signs up, sets up departments, and configures clearance requirements in minutes.'],
                ['num' => '02', 'icon' => '📋', 'title' => 'Student Applies', 'desc' => 'Students log in, submit a clearance request. Each department reviews and approves digitally.'],
                ['num' => '03', 'icon' => '🎓', 'title' => 'Certificate Issued', 'desc' => 'Once all departments clear the student, a tamper-proof digital certificate is generated instantly.'],
            ];
            foreach ($steps as $s): ?>
                <div class="card-glass animate-fadeup" style="padding:36px;border-radius:20px">
                    <div style="font-size:2.5rem;margin-bottom:16px"><?= $s['icon'] ?></div>
                    <div style="font-family:var(--font-mono);color:var(--amber);font-size:13px;font-weight:600;margin-bottom:8px"><?= $s['num'] ?></div>
                    <h3 style="color:var(--white);margin-bottom:10px"><?= $s['title'] ?></h3>
                    <p style="color:rgba(255,255,255,0.55);font-size:14px"><?= $s['desc'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="section" id="features" style="background:var(--off-white)">
    <div class="container">
        <div class="mb-32">
            <div class="section-tag">Features</div>
            <h2 class="section-title">Everything your institution needs</h2>
            <p class="section-sub">Built specifically for Kenyan and African educational institutions</p>
        </div>
        <div class="grid-3">
            <?php $features = [
                ['icon' => '💳', 'title' => 'M-Pesa Payments', 'desc' => 'Accept payments via M-Pesa STK Push. International students pay with M-Pesa Global from anywhere in the world.'],
                ['icon' => '🏢', 'title' => 'Department Management', 'desc' => 'Configure unlimited departments (based on plan). Each department gets its own approval queue and dashboard.'],
                ['icon' => '📊', 'title' => 'Real-Time Analytics', 'desc' => 'Track clearance rates, bottlenecks, and payment flows with live dashboards and exportable reports.'],
                ['icon' => '📱', 'title' => 'Mobile Ready', 'desc' => 'Students and staff access ClearPass from any device. No app download needed — it\'s fully responsive.'],
                ['icon' => '🔒', 'title' => 'Secure & Compliant', 'desc' => 'Bank-level encryption, audit trails for every action, and data residency in Kenya.'],
                ['icon' => '🎓', 'title' => 'Digital Certificates', 'desc' => 'Auto-generated, verifiable clearance certificates with QR codes. No more paper stampings.'],
            ];
            foreach ($features as $f): ?>
                <div class="card animate-fadeup">
                    <div style="font-size:2rem;margin-bottom:14px"><?= $f['icon'] ?></div>
                    <h4 style="margin-bottom:8px"><?= $f['title'] ?></h4>
                    <p style="font-size:14px"><?= $f['desc'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<section style="background:var(--amber);padding:80px 0">
    <div class="container text-center">
        <h2 style="color:var(--navy)">Ready to modernise your clearance process?</h2>
        <p style="color:rgba(10,22,40,0.65);margin:12px 0 32px;font-size:1.1rem">Start your 14-day free trial. No credit card required.</p>
        <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap">
            <a href="/school/register" class="btn btn-dark btn-lg">Get Started Free</a>
            <a href="/pricing" class="btn btn-lg" style="background:transparent;border:2px solid var(--navy);color:var(--navy)">View Pricing</a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <div class="footer-logo">ClearPass</div>
                <p class="footer-desc">Kenya's leading digital school clearance platform. Paperless, fast, and M-Pesa powered.</p>
            </div>
            <div>
                <div class="footer-col-title">Platform</div>
                <ul class="footer-links">
                    <li><a href="/pricing">Pricing</a></li>
                    <li><a href="/#features">Features</a></li>
                    <li><a href="/#how-it-works">How it works</a></li>
                </ul>
            </div>
            <div>
                <div class="footer-col-title">Schools</div>
                <ul class="footer-links">
                    <li><a href="/school/register">Register School</a></li>
                    <li><a href="/school/login">School Login</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© <?= date('Y') ?> ClearPass. Built in Kenya 🇰🇪</span>
            <span>Powered by Safaricom M-Pesa</span>
        </div>
    </div>
</footer>
</body>

</html>
