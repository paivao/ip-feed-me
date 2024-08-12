<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <script src="<?= base_url('js/htmx.min.js') ?>"></script>
    <title>IP Feed ME</title>
</head>

<body>
    <?= $this->renderSection('content') ?>
    <footer class="d-flex flex-wrap justify-content-between align items-center">
        <p class="text-center">
            <strong>IP Feed Management Engine</strong> <?= lang("Basic.by") ?> paivao. <a href="https://github.com/paivao/simple-ip-list-management"><?= lang("Basic.seeMeOnGithub") ?></a>.
            &copy; 2024
        </p>
    </footer>

</body>

<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>

</html>