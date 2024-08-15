<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<?= $this->include('nav') ?>
<h1 class="text-center w-100">IP Feed Me - List Management</h1>
<main class="container">
    <div id="message"></div>
    <div class="row text-center">
        <div class="card col-md-8">
            <div class="card-header" id="list-title"></div>
            <ul class="card-body">
                <table class="table">
                    <thead id="ip-table">
                        <tr>
                            <th scope="col">Habilitado?</th>
                            <th scope="col">Endereço IP</th>
                            <th scope="col">Descrição</th>
                        </tr>
                    </thead>
                    <tbody hx-get="/data/list/<?= $segments[0] ?>" hx-trigger="load">
                    </tbody>
                    <tfoot id="pager" hx-swap-oob="true">
                    </tfoot>
                </table>
            </ul>
        </div>
        <div class="col-md-8">

        </div>
        <div class="col-md-4">
            <form action="/list/edit/<?= $segments[0] ?>/manage-ip" id="add-ip-form" class="row" method="post" hx-boost="true">
                <div class="col-md-4">
                    <label for="input-ip" class="form-label">Endereços IP</label>
                    <textarea class="form-control" rows=4 id="input-ip" name="ip_address" required></textarea>
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
</main>
<?= $this->endSection() ?>