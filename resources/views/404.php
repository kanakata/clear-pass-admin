<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>oops could not find the page you were looking for!!</h1>
</body>

</html>

<?php if ($page > 1): ?>
    <a href="<?= $get_link($page - 1) ?>" class="pag">previous</a>
<?php endif; ?>

<?php if ($page < $pages): ?>
    <a href="<?= $get_link($page + 1) ?>" class="pag">next</a>
<?php endif; ?>