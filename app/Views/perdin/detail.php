<?php
$jumlahSaku = $dataPerdin['saku'];
$currency = substr($jumlahSaku, 0, 1);
// dd($currency);
if ($currency == '$') {
    $rule = "(Luar Negeri)";
    $currency = substr($jumlahSaku, 0, 2);
    $jumlahSaku = substr($jumlahSaku, 2);
    $saku = number_format((float)$jumlahSaku, 2, ',', '.');
} else {
    $currency = substr($jumlahSaku, 0, 4);
    $jumlahSaku = substr($jumlahSaku, 3);
    $saku = number_format((float)$jumlahSaku, 2, ',', '.');

    if ($dataPerdin['jarak'] <= 60) {
        $rule = "(Jarak < 60 KM)";
    } else {
        $rule = "(Jarak > 60 KM)";
    }
}

function tanggal($date)
{
    $date = date('d F Y', strtotime($date));
    return $date;
}

?>

<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <style>
        div.info {
            width: 600px;
        }


        @media screen and (max-width:680px) {
            div.info {
                width: 300px;
            }
        }

        @media screen and (max-width:380px) {
            div.info {
                width: 200px;
            }
        }
    </style>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div style="width: 100%;">
                <label class="form-label">Kota</label>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" disabled value="<?= $dataPerdin['asal']; ?>">
                    </div>
                    <div style="text-align:center;margin:auto">
                        <i class="fas fa-long-arrow-alt-right"></i>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" disabled value="<?= $dataPerdin['tujuan']; ?>">
                    </div>
                </div>
            </div>
            <div style="width: 100%;">
                <label class="form-label mt-3">Tanggal</label>
                <div class="row">
                    <div class="col">
                        <input type="text" name="berangkat" id="berangkat" class="form-control date" value="<?= tanggal($dataPerdin['berangkat']); ?>" disabled>
                    </div>
                    <div style="text-align:center;margin:auto">
                        <i class="fas fa-long-arrow-alt-right"></i>
                    </div>
                    <div class="col">
                        <input type="text" name="pulang" id="pulang" class="form-control date" value="<?= tanggal($dataPerdin['pulang']); ?>" disabled>
                    </div>
                </div>
            </div>

            <div style="width: 100%;" class="mt-3">
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea disabled class="form-control" id="keterangan" rows="3" name="keterangan"><?= $dataPerdin['keterangan']; ?></textarea>
                </div>
            </div>

            <div class="card card-header info mx-auto text-md">
                <div class="row card-header text-center bg-primary text-light">
                    <div class="col-4">
                        Total Hari
                    </div>
                    <div class="col-4">
                        Jarak Tempuh
                    </div>
                    <div class="col-4">
                        Total Uang Perdin
                    </div>
                </div>
                <div class="row card-body text-center text-sm text-info">
                    <div class="col-4">
                        <?= $dataPerdin['lama']; ?> Hari
                    </div>
                    <div class="col-4">
                        <?= $dataPerdin['jarak']; ?> KM
                    </div>
                    <div class="col-4">
                        <?= $currency . $saku; ?>
                    </div>
                </div>
                <div class="row card-body text-center text-sm text-muted mt-n4 pt-1 mx-auto">
                    <div class="col-12">
                        <?= $currency; ?> <?= number_format($jumlahSaku / $dataPerdin['lama'], 0, ',', '.'); ?> / Hari
                    </div>
                    <div class="col-12 text-xs text-gray-400">
                        <?= $rule; ?>
                    </div>
                </div>
            </div>
            <div class="container d-flex justify-content-center mt-3">
                <div class="row" <?= ($dataPerdin['status'] == 1 || $dataPerdin['status'] == 0) ? 'hidden' : ''; ?>>
                    <div class="col-12">
                        <a class="btn btn-danger" href="/perdin/reject/<?= $dataPerdin['id']; ?>" style="width:100px">Reject</a>
                        <a class="btn btn-primary" href="/perdin/approve/<?= $dataPerdin['id']; ?>" style="width:100px">Approve</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
</section>


<?= $this->endSection(); ?>