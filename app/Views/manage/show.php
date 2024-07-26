<?php
$table = new \CodeIgniter\View\Table();
?>

<h2><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<div>
<?= $table->generate($data) ?>
</div>

<div>
<form action=""
</div>
