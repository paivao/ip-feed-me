<?php foreach ($entries as $entry): ?>
    <tr>
        <td>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="enable-<?= $entry->id ?>" <?= ($entry->is_checked) ?: 'checked' ?>>
            </div>
        </td>
        <td><?= $entry->ip_address ?><?php if ($entry->netmask !== 32) { echo "/{$entry->netmask}"; } ?></td>
        <td><?= $entry->description ?></td>
    </tr>
<?php endforeach; ?>
<span id="list-title" hx-swap-oob="innerHTML"><?= $title ?></span>
<div id="pager" hx-swap-oob="true">
    <?= $pager->links() ?>
</div>