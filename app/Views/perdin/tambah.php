<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/perdin/simpan" method="post">
                <!-- Input Hidden -->
                <input type="text" hidden value="<?= session('id'); ?>" name="id_user">
                <input type="text" hidden value="" name="lama" id="lama">

                <div style="width: 100%;">
                    <label class="form-label">Kota</label>
                    <div class="row">
                        <div class="col">
                            <select class="custom-select <?= (validation_show_error('asal')) ? 'is-invalid' : ''; ?>" name="asal" data-live-search="true" autofocus>
                                <option disabled selected>- Pilih Kota Asal-</option>
                                <?php foreach ($dataKota as $v) {
                                ?>
                                    <option value="<?= $v['id']; ?>" <?= (old('asal') == $v['id']) ? 'selected' : ''; ?>><?= $v['nama']; ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= validation_show_error('asal') ?>
                            </div>
                        </div>
                        <div style="text-align:center;margin:auto">
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </div>
                        <div class="col">
                            <select class="custom-select <?= (validation_show_error('tujuan')) ? 'is-invalid' : ''; ?>" name="tujuan" data-live-search="true">
                                <option disabled selected>- Pilih Kota Tujuan-</option>
                                <?php foreach ($dataKota as $v) {
                                ?>
                                    <option value="<?= $v['id']; ?>" <?= (old('tujuan') == $v['id']) ? 'selected' : ''; ?>><?= $v['nama']; ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= validation_show_error('tujuan') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="width: 100%;">
                    <label class="form-label mt-3">Tanggal</label>
                    <div class="row">
                        <div class="col">
                            <input type="date" name="berangkat" id="berangkat" class="form-control <?= (validation_show_error('berangkat')) ? 'is-invalid' : ''; ?>" value="<?= old('berangkat'); ?>">
                            <div class="invalid-feedback">
                                <?= validation_show_error('berangkat') ?>
                            </div>
                        </div>
                        <div style="text-align:center;margin:auto">
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </div>
                        <div class="col">
                            <input type="date" name="pulang" id="pulang" class="form-control <?= (validation_show_error('pulang')) ? 'is-invalid' : ''; ?>" value="<?= old('pulang'); ?>">
                            <div class="invalid-feedback">
                                <?= validation_show_error('pulang') ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="width: 100%;" class="mt-3">
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control <?= (validation_show_error('keterangan')) ? 'is-invalid' : ''; ?>" id="keterangan" rows="3" name="keterangan"></textarea>
                        <div class="invalid-feedback">
                            <?= validation_show_error('keterangan') ?>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row justify-content-md-center">
                        <div class="container" style="width:300px;height:100px">
                            <div class="card bg-gray-300" style="width:100%;height:100%;justify-content:center;text-align:center;">
                                <b>Total Perjalanan Dinas</b>
                                <b class="text-lg" style="color:var(--blue);font-size:50px;" id="hari">0 Hari</b>
                            </div>
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

<script>
    $('#pulang').on('change', function(e) {
        const pulang = new Date(document.getElementById('pulang').value)
        const berangkat = new Date(document.getElementById('berangkat').value)
        const hari = Math.trunc(pulang - berangkat)
        const d = hari / (1000 * 3600 * 24)
        if (d >= 0) {
            document.getElementById('hari').innerHTML = '' + (d == 0 ? d + 1 : d) + ' Hari'
            $('#lama').val((d == 0 ? d + 1 : d))
        } else {
            swal({
                title: "Gagal",
                text: "Hari yang dimasukkan salah",
                icon: "error"
            })
        }
    })
    $('#berangkat').on('change', function(e) {
        const pulang = new Date(document.getElementById('pulang').value)
        const berangkat = new Date(document.getElementById('berangkat').value)
        const hari = Math.trunc(pulang - berangkat)
        const d = hari / (1000 * 3600 * 24)
        if (d >= 0) {
            document.getElementById('hari').innerHTML = '' + (d == 0 ? d + 1 : d) + ' Hari'
            $('#lama').val((d == 0 ? d + 1 : d))
        }
    })
</script>
<?= $this->endSection(); ?>