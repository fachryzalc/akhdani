<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="card shadow mb-4">
        <div class="card-body table-responsive">
            <table class="table table-bordered dataTable" id="dataPerdin" role="grid" aria-describedby="dataTable_info" style="width: 100%;" width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-gray-300">
                        <th style="width: 10px;">No</th>
                        <th>Nama</th>
                        <th style="text-align:center;">Kota</th>
                        <th style="text-align:center;">Tanggal</th>
                        <th>Keterangan</th>
                        <th style="text-align:center;">Status</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0;
                    function tanggal($date)
                    {
                        $date = date('d M Y', strtotime($date));
                        return $date;
                    }

                    foreach ($dataPerdin as $v) {
                        $no++;

                        if ($v['status'] == 2) {
                            $pesan = 'Diproses';
                            $class = 'bg-info text-white';
                            // dd($status);
                        } elseif ($v['status'] == 1) {
                            $pesan = "Diterima";
                            $class = 'bg-success text-white';
                        } else {
                            $pesan = "Ditolak";
                            $class = 'bg-danger text-white';
                        }
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $v['nama']; ?></td>
                            <td style="text-align:center;"><?= $v['asal']; ?><i class="fas fa-long-arrow-alt-right mr-2 ml-2"></i><?= $v['tujuan']; ?></td>
                            <td style="text-align:center;"><?= tanggal($v['berangkat']); ?><i class="fas fa-long-arrow-alt-right mr-2 ml-2"></i><?= tanggal($v['pulang']); ?></td>
                            <td style="width:20%;">
                                <p style="height:50px;width:100%;overflow: hidden;text-overflow: clip; "><?= $v['keterangan']; ?></p>
                            </td>
                            <td style="text-align:center;"><span class="<?= $class; ?>" style="padding:.5rem;border-radius:2.5rem;width:5rem;display:inline-block;"><?= $pesan; ?></span></td>
                            <td style="text-align:center;"><a href="/perdin/detail/<?= $v['id']; ?>"><i class="fas fa-eye" style="color:#3D90D4;"></i></a></td>
                        </tr>

                    <?php $status = null;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>
<script type="text/javascript" class="init">
    $(document).ready(function() {
        $("#dataPerdin").DataTable({
            "responsive": true,
            "autoWidth": true,
            "rowReorder": true,
            "columnDefs": [{
                "targets": [-3, -1],
                "sorting": false
            }],
        });
    });
</script>
<?= $this->endSection(); ?>