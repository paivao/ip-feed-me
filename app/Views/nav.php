<nav class="navbar navbar-expand-lg bg-body-tertiary" role="navigation" aria-label="main navigation">
    <div class="container-fluid">
        <div class="navbar-brand">
            SIML
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php
                $navlinks = [
                    lang('Basic.menu.home') => site_url("/"),
                    lang('Basic.menu.manageLists') => site_url("/list/"),
                    lang('Basic.menu.manageUsers') => site_url("/user/"),
                ];
                foreach ($navlinks as $name => $link) :
                    $tag_class = 'nav-link' . ((str_starts_with(current_url(), $link)) ? ' active' : '');
                    $aria_addon = (str_starts_with(current_url(), $link)) ? 'aria-current="page"' : '';
                ?>
                    <li class="nav-item">
                        <a class="<?= $tag_class ?>" <?= $aria_addon ?> href="<?= $link ?>">
                            <?= $name ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <ul class="d-flex navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span hx-get="/user/whoami" hx-trigger="load" hx-swap="textContent" hx-boost="true"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= site_url("/user/profile") ?>"><?= lang('Basic.menu.profile') ?></a></li>
                        <li><a class="dropdown-item" href="<?= site_url("/logout") ?>"><?= lang('Basic.menu.logout') ?></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>