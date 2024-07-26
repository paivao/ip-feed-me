<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <?= $this->include('nav') ?>
    <main class="section">
        <div class="container">
            <h1 class="title"><?= esc($title) ?></h1>
            <div class="columns">
                <div class="column">
                    <?= view_cell('PanelCell', ['title' => 'Ação Rápida', 'options' => [
                        lang('Basic.options.newUser') => site_url('/users/new'),
                        lang('Basic.options.newList') => site_url('/lists/new'),
                        lang('Basic.options.newEntry') => site_url('/entries/new'),
                    ] ]) ?>
                </div>
                <div class="column">
                    <?= view_cell('PanelCell', ['title' => lang('Basic.manageEntries'), 'options' => $lists]) ?>
                </div>
            </div>
        </div>
    </main>
<?= $this->endSection() ?>