<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
<?= esc($title) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $this->include('nav') ?>
<h1 class="text-center w-100"><?= esc($title) ?></h1>
<main class="container">
    <?= validation_list_errors() ?>
    <div class="row g-3 align-items-center">
        <?= form_open("/list/edit/{$list['id']}/manage-ip") ?>
        <div class="col-auto">
            <label for="input-ip" class="form-label">Endereço IP</label>
            <input type="text" class="form-control" id="input-ip" name="ip_address" required>
        </div>
        <div class="col-auto">
            <label for="input-description" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="input-description" name="description">
        </div>
        <div class="col-auto">
            <button type="submit" name="action" value="new-ip">Adicionar IP</button>
        </div>
        <?= form_close(); ?>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Habilitado?</th>
                <th scope="col">Endereço IP</th>
                <th scope="col">Descrição</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($entries as $entry): ?>
            <tr>
                <th><input type="checkbox"></th>
                <td><?= $entry->ip_address ?></td>
                <td><?= $entry->description ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $pager->links(); ?>
</main>
<?= $this->endSection() ?>