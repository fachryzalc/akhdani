<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="card shadow mb-4">
        <div class="card-body">

            <form action="/user/simpan" method="post">
                <div class="col-md-12">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>" placeholder="Nama Lengkap" autofocus value="<?= old('nama'); ?>">
                    <div class="invalid-feedback">
                        <?= validation_show_error('nama') ?>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control <?= (validation_show_error('username')) ? 'is-invalid' : ''; ?>" name="username" placeholder="Username" value="<?= old('username'); ?>">
                    <div class="invalid-feedback">
                        <?= validation_show_error('username') ?>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <label class="form-label">Password</label>
                    <div class="input-group has-validation">
                        <input type="password" class="form-control <?= (validation_show_error('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password">
                        <div class="invalid-feedback">
                            <?= validation_show_error('password') ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <div class="input-group has-validation">
                        <input type="password" class="form-control <?= (validation_show_error('passwordv')) ? 'is-invalid' : ''; ?>" id="passwordv" name="passwordv" placeholder="Konfirmasi Password">
                        <div class="invalid-feedback">
                            <?= validation_show_error('passwordv') ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>