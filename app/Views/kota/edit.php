<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="card shadow mb-4">
        <div class="card-body">

            <form action="/kota/update/<?= $dataKota['id']; ?>" method="post">
                <div class="col-md-12">
                    <label class="form-label">Nama Kota</label>
                    <input type="text" name="nama" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>" placeholder="Nama Kota" autofocus value="<?= (old('nama')) ? old('nama') : $dataKota['nama'] ?>">
                    <div class="invalid-feedback">
                        <?= validation_show_error('nama') ?>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <label class="form-label">Provinsi</label>
                    <input type="text" class="form-control <?= (validation_show_error('provinsi')) ? 'is-invalid' : ''; ?>" name="provinsi" placeholder="Provinsi" value="<?= (old('provinsi')) ? old('provinsi') : $dataKota['provinsi'] ?>">
                    <div class="invalid-feedback">
                        <?= validation_show_error('provinsi') ?>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <label class="form-label">Pulau</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control <?= (validation_show_error('pulau')) ? 'is-invalid' : ''; ?>" id="pulau" name="pulau" placeholder="Pulau" value="<?= (old('pulau')) ? old('pulau') : $dataKota['pulau'] ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('pulau') ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <label class="form-label">Latitude</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control <?= (validation_show_error('latitude')) ? 'is-invalid' : ''; ?>" id="latitude" name="latitude" placeholder="Latitude" value="<?= (old('latitude')) ? old('latitude') : $dataKota['latitude'] ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('latitude') ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <label class="form-label">Longitude</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control <?= (validation_show_error('longitude')) ? 'is-invalid' : ''; ?>" id="longitude" name="longitude" placeholder="Longitude" value="<?= (old('longitude')) ? old('longitude') : $dataKota['longitude'] ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('longitude') ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="custom-control custom-checkbox col-md-12 mt-3">
                        <input type="checkbox" class="custom-control-input" id="luar" name="luar" value="1" <?= ($dataKota['luar'] || old('luar') == 1) ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="luar">Centang apabila luar negeri</label>
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