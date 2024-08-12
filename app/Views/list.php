<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<?= $this->include('nav') ?>
<h1 class="text-center w-100">IP Feed Me - List Management</h1>
<main class="container">
    <div id="message" hx-swap-oob="true"></div>
    <div class="grid text-center">
        <div class="g-col-md-8">
            <table class="table">
                <thead id="ip-table">
                    <tr>
                        <th scope="col">Habilitado?</th>
                        <th scope="col">Endereço IP</th>
                        <th scope="col">Descrição</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot id="pager" hx-swap-oob="true">
                </tfoot>
            </table>
        </div>
        <div class="g-col-md-4">
            <form  id="add-ip-form" class="grid" method="post" hx-boost="true">
            <div class="g-col-md-4">
                <label for="input-ip" class="form-label">Endereços IP</label>
                <textarea class="form-control" rows=4 id="input-ip" name="ip_address" required></textarea>
            </div>
            <div class="g-col-md-4">
                <label for="input-description" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="input-description" name="description">
            </div>
            <div class="g-col-md-4">
                <button type="submit" name="action" value="new-ip">Adicionar IP</button>
            </div>
            </form>
        </div>
    </div>
</main>
<script src="<?= base_url('/js/list.js') ?>"></script>
<?= $this->endSection() ?>
