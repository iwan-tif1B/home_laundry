<?= $this->extend('auth/template'); ?>

<?= $this->section('content'); ?>
<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark">
                <img src="./static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
        </div>
        <div class="card card-md">
            <div class="card-body">
                <?= view('Myth\Auth\Views\_message_block') ?>

                <form action="<?= url_to('forgot') ?>" method="post">
                    <?= csrf_field() ?>

                    <h2 class="card-title text-center mb-4">Forgot password</h2>
                    <p class="text-secondary mb-4">
                        <?= lang('Auth.enterEmailForInstructions') ?></p>
                    <div class="mb-3">
                        <label class="form-label"><?= lang('Auth.emailAddress') ?></label>
                        <input type="email" class="form-control  <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>">

                        <div class="invalid-feedback">
                            <?= session('errors.email') ?>
                        </div>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100"><?= lang('Auth.sendInstructions') ?></button>
                    </div>
                    <div class="text-center text-secondary mt-3">
                        Forget it, <a href="<?= base_url('login'); ?>">send me back</a> to the sign in screen.
                    </div>
            </div>
        </div>
    </div>
    </form>

</div>
<?= $this->endSection('content'); ?>