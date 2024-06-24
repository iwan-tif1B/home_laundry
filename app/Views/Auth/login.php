<?= $this->extend('auth/template'); ?>

<?= $this->section('content'); ?>
<div class="page page-center">
  <div class="container container-normal py-4">
    <div class="row align-items-center g-4">
      <div class="col-lg">
        <div class="container-tight">
          <div class="text-center mb-4">
            <text name="htmlaundry" id="htmlaundry" class="h1">HTM Laundry</text>
          </div>
          <div class="card card-md">
            <div class="card-body">

              <!-- alert -->
              <?= view('Myth\Auth\Views\_message_block') ?>

              <form action="<?= url_to('login') ?>" method="post">
                <?= csrf_field() ?>
                <?php if ($config->validFields === ['email']) : ?>
                  <div class="mb-3">
                    <label class="form-label"><?= lang('Auth.email') ?></label>
                    <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
                    <div class="invalid-feedback">
                      <?= session('errors.login') ?>
                    </div>
                  </div>
                <?php else : ?>
                  <div class="mb-3">
                    <label class="form-label"><?= lang('Auth.emailOrUsername') ?></label>
                    <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                    <div class="invalid-feedback">
                      <?= session('errors.login') ?>
                    </div>
                  </div>
                <?php endif; ?>

                <div class="mb-3">
                  <label class="form-label"><?= lang('Auth.password') ?></label>
                  <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="<?= lang('Auth.password') ?>">
                  <div class="invalid-feedback">
                    <?= session('errors.password') ?>
                  </div>
                </div>

                <?php if ($config->allowRemembering) : ?>
                  <div class="mb-2">
                    <label class="form-check">
                      <input type="checkbox" class="form-check-input <?php if (old('remember')) : ?> checked <?php endif ?>" name="remember" />
                      <span class="form-check-label"><?= lang('Auth.rememberMe') ?></span>
                    </label>
                  </div>
                <?php endif; ?>

                <div class="form-footer">
                  <button type="submit" class="btn btn-primary w-100"><?= lang('Auth.loginAction') ?></button>
                </div>
                <br>
                <?php if ($config->activeResetter) : ?>
                  <p><a href="<?= url_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a></p>
                <?php endif; ?>
              </form>
            </div>
          </div>
          <div class="text-center text-secondary mt-3">
            <?php if ($config->allowRegistration) : ?>
              <p><a href="<?= url_to('register') ?>"><?= lang('Auth.needAnAccount') ?></a></p>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-lg d-none d-lg-block">
        <img src="<?= base_url('static/photos/laundry_cleaning.png') ?>" height="600" class="d-block mx-auto" alt="">
      </div>
    </div>
  </div>
</div>
<?= $this->endSection('content'); ?>