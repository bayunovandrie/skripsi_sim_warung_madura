<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<div class="bg-pattern" aria-hidden="true"></div>

<main class="wrap" role="main">
    <section class="card" role="region" aria-label="Halaman Login">
        <div class="hero" aria-hidden="false">
            <div class="brand">
                <img src="<?= base_url('assets/img/favicon.ico') ?>" alt="">
                <div>
                    <h1>Warung Madura</h1>
                </div>
            </div>

            <h2>Selamat datang kembali 👋</h2>
            <p class="lead">Masuk ke akunmu untuk mengelola stok, dan laporan. Aman, cepat, dan mudah digunakan.
            </p>

            <div class="features" aria-hidden="true">
                <div class="chip">Realtime</div>
                <div class="chip">Laporan Harian</div>

            </div>
        </div>

        <div class="login-box">
            <div>
                <h3>Masuk</h3>
                <p class="desc">Gunakan username & password kamu.</p>
            </div>

            <?= view('App\Views\Auth\_message_block') ?>

            <form action="<?= url_to('login') ?>" method="post">
                <?= csrf_field() ?>
                <div class="field">
                    <label for="username">Username</label>
                    <input type="text"
                        class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
                        name="login" placeholder="Username">
                    <div class="invalid-feedback">
                        <?= session('errors.login') ?>
                    </div>
                </div>

                <div class="field password-wrap">
                    <label for="password">Password</label>
                    <input type="password" name="password"
                        class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
                        placeholder="<?=lang('Auth.password')?>">
                    <div class="invalid-feedback">
                        <?= session('errors.password') ?>
                    </div>
                </div>

                <div style="margin-top:12px; display: flex; justify-content: center;">
                    <button type="submit" class="btn btn-primary btn-block"><?=lang('Auth.loginAction')?></button>
                </div>

                <p id="msg" style="color:#ffb3b3; font-size:13px; margin-top:8px; display:none;"></p>
            </form>

            <footer class="small" style="margin-top:auto;">© <span id="year"></span> Warung Madura</footer>
        </div>
    </section>
</main>

<?= $this->endSection() ?>