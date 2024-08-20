<?= $this->extend('layouts/page') ?>

<?= $this->section('title') ?>
<?= esc($title) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $this->include('layouts/nav') ?>
<h1 class="text-center w-100"><?= esc($title) ?></h1>
<main class="container">
    <div id="message"></div>
    <div class="row">
        <div class="col-6" id="list-card">
            <?= view_cell('PanelCell', ['title' => lang('Basic.manageEntries'), 'options' => $lists]) ?>
        </div>
        <div class="col-6">
            <div class="card">
                <h5 class="card-header">Menu</h5>
                <div class="card-body">
                    <form hx-post="<?= site_url('/list/new') ?>" id="add-list-form" hx-target="list-card" hx-boost="true">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>