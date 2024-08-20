<?= $this->extend('layouts/page') ?>

<?= $this->section('content') ?>
<?= $this->include('layouts/nav') ?>
<h1 class="text-center w-100">IP Feed Me - List Management</h1>
<main class="container">
    <div id="message"></div>
    <div class="row text-center">
        <div class="col-md-8">
            <div class="card">
                <h5 class="card-header" id="list-title"></h5>
                <div class="card-body">
                    <table class="table">
                        <thead id="ip-table">
                            <tr>
                                <th scope="col">Habilitado?</th>
                                <th scope="col">Endereço IP</th>
                                <th scope="col">Descrição</th>
                            </tr>
                        </thead>
                        <tbody hx-get="/data/list/<?= $segments[0] ?>" hx-trigger="load" id="list-content">
                            <tr id="list-content"></tr>
                        </tbody>
                    </table>
                    <div id="pager"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">Adicionar IPs</h5>
                <div class="card-body">
                    <form hx-post="<?= site_url("/list/edit/{$segments[0]}/manage-ip") ?>" id="add-ip-form" hx-target="#list-content" class="row" hx-boost="true">
                        <div class="col-md-4" id="ip-group">
                            <label for="input-ip" class="form-label">Endereços IP</label>
                            <input type="text" class="form-control" id="input-ip" name="ip_address" required>
                        </div>
                        <div class="col-md-4">
                            <label for="input-description" class="form-label">Descrição</label>
                            <input type="text" class="form-control" id="input-description" name="description">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" name="action" value="new-ip">Adicionar IP</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>