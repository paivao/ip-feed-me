<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
<?= esc($title) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $this->include('nav') ?>
<h1 class="text-center w-100"><?= esc($title) ?></h1>
<main class="container">
<?= validation_list_errors() ?>
    <div class="row">
        <div class="col-6">
            <?= view_cell('PanelCell', ['title' => lang('Basic.manageEntries'), 'options' => $lists]) ?>
        </div>
        <div class="col-6">
            <div class="card">
                <h5 class="card-header">Menu</h5>
                <div class="card-body">
                    <?= form_open('/list/new') ?>
                        <label class="form-label" for="input-name">Nome da lista</label>
                        <input id="input-name" class="form-control" type="text" required maxlength="64" name="name" value="<?= set_value('name') ?>">
                        <div id="emailHelp" class="form-text">Apenas letras, underline ou traco</div>

                        <label class="form-label" for="input-description">Descrição</label>
                        <input id="input-description" class="form-control" type="text" maxlength="255" name="description" value="<?= set_value('description') ?>">

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_public" value="true" id="input-is-public" checked>
                            <label class="form-check-label" for="input-is-public">Public</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_public" value="false" id="input-is-private">
                            <label class="form-check-label" for="input-is-private">Private</label>
                        </div>
                        <button class="btn btn-primary" name="action" value="new">Criar Lista</button>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>