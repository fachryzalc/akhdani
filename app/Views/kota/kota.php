<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="card shadow mb-4">
        <div class="tambahBtn">
            <a class="btn btn-primary float-right mt-3 mr-4" style="width: fit-content;padding:.5rem; height:fit-content;" href="/kota/tambah"><i class="fas fa-plus"></i> Tambah Kota</a>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered dataTable" id="dataKota" role="grid" aria-describedby="dataTable_info" style="width: 100%;" width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-gray-300">
                        <th style="width: 10px;">No</th>
                        <th>Nama</th>
                        <th>Provinsi</th>
                        <th>Pulau</th>
                        <th style="width: 100px;">Luar Negeri</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th style="text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0;
                    foreach ($dataKota as $v) {
                        $no++; ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $v['nama']; ?></td>
                            <td><?= $v['provinsi']; ?></td>
                            <td><?= $v['pulau']; ?></td>
                            <td><?= ($v['luar'] == 1) ? 'Ya' : 'Tidak'; ?></td>
                            <td><?= $v['latitude']; ?></td>
                            <td><?= $v['longitude']; ?></td>
                            <td style="text-align:center;"><a href="kota/edit/<?= $v['id']; ?>"><i class="fas fa-pencil-alt" style="color:#3D90D4;"></i></a>
                                <form action="/kota/<?= $v['id']; ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button hidden type="submit" class="btn btn-danger" id="<?= $v['id']; ?>"><i class="fas fa-trash danger"></i> Hapus</button>
                                    <button type="submit" class="text-danger ml-2" style="background: none;	color: inherit;border: none;padding: 0;font: inherit;cursor: pointer;outline: inherit;"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>
<script type="text/javascript" class="init">
    $(document).ready(function() {
        $("#dataKota").DataTable({
            "responsive": true,
            "autoWidth": true,
            "rowReorder": true,
            "columnDefs": [{
                "targets": [-1, -2, -3],
                "sorting": false
            }],
        });
    });
</script>
<?= $this->endSection(); ?>