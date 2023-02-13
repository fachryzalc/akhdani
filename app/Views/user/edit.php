<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="card shadow mb-4">
        <div class="card-body">

            <form action="/user/update/<?= $dataUser['id']; ?>" method="post">
                <div class="col-md-12" <?= ($dataUser['akses'] != 1) ? 'hidden' : ''; ?>>
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>" placeholder="Nama Lengkap" autofocus value="<?= (old('nama')) ? old('nama') : $dataUser['nama'] ?>">
                    <div class="invalid-feedback">
                        <?= validation_show_error('nama') ?>
                    </div>
                </div>
                <div class="col-md-12 mt-3" <?= ($dataUser['akses'] != 1) ? 'hidden' : ''; ?>>
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control <?= (validation_show_error('username')) ? 'is-invalid' : ''; ?>" name="username" placeholder="Username" value="<?= (old('username')) ? old('username') : $dataUser['username'] ?>">
                    <div class="invalid-feedback">
                        <?= validation_show_error('username') ?>
                    </div>
                </div>
                <div class="col-md-12 mt-3" <?= ($dataUser['akses'] == 1) ? 'hidden' : ''; ?>>
                    <label class="form-label">Jabatan</label>
                    <select class="custom-select" name="akses" data-live-search="true">
                        <option disabled value="1" <?= ($dataUser['akses'] == 1) ? 'selected' : ''; ?>>- Pilih Jabatan -</option>
                        <option value="2" <?= ($dataUser['akses'] == 2) ? 'selected' : ''; ?>>Divisi SDM</option>
                        <option value="3" <?= ($dataUser['akses'] == 3) ? 'selected' : ''; ?>>Pegawai</option>
                    </select>
                </div>
                <div class="col-12 mt-3">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>