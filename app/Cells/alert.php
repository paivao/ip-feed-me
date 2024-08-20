<div id="message" hx-swap-oob="true">
    <div class="alert alert-<?= esc($type, 'attr') ?> alert-dismissible" role="alert">
        <?php foreach ($messages as $msg): ?>
            <p><?= esc($msg) ?></p>
        <?php endforeach ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>