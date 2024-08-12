<div class="card">
    <h5 class="card-header"><?= esc($title) ?></h5>
    <div class="card-body">
        <div class="list-group list-group-flush">
<?php foreach($options as $name => $link): ?>
    <a class="list-group-item" href="<?= $link ?>"><?= $name ?></a>
<?php endforeach; ?>
        </div>
    </div>
</div>