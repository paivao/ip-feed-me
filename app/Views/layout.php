<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <title>SIML - <?= esc($title) ?></title>
</head>

<body>
    <?= $this->renderSection('content') ?>
    <footer class="d-flex flex-wrap justify-content-between align items-center">
        <p class="text-center">
            <strong>Simple IP List Management</strong> <?= lang("Basic.by") ?> paivao. <a href="https://github.com/paivao/simple-ip-list-management"><?= lang("Basic.seeMeOnGithub") ?></a>.
            &copy; 2024
        </p>
    </footer>

</body>

</html>