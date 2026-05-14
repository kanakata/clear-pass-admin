<?php if (parse_url($_SERVER['REQUEST_URI'])['path'] != "/dashboard"): ?>
    <div class="scroll-top">&#8593</div>
<?php endif; ?>

<?php if (parse_url($_SERVER['REQUEST_URI'])['path'] == "/check"): ?>
    <script src="./js/ajax.js"></script>
    <script src="./js/check.js"></script>
    <script src="./js/scroll.js"></script>
<?php else: ?>
    <script src="./js/file.js" type="text/javascript"></script>
    <script src="./js/alert.js" type="text/javascript"></script>
    <script src="./js/usertype.js" type="text/javascript"></script>
    <script src="./js/payout.js" type="text/javascript"></script>
    <script src="./js/scroll.js" type="text/javascript"></script>
<?php endif; ?>
</body>

</html>
