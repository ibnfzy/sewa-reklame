<?= $this->extend('user/base'); ?>

<?= $this->section('content'); ?>

<?php $getFun = new \App\Controllers\AdmController; ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
          <table id='datatable' class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>ID Transaksi</th>
                <th>Nama Reklame</th>
                <th>Harga</th>
                <th>Status</th>
                <th>AKSI</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($data as $item):
                $hariminggu = $getFun->hari_ke_minggu($item['total_hari_sewa']);
                $total = $item['harga'] * $hariminggu['minggu'];
                $totalhargahari = ($total / 7) * $hariminggu['hari_lebih'];

                if ($hariminggu['hari_lebih'] <= 0) {
                  $totalwaktu = $hariminggu['minggu'];
                } else {
                  $totalwaktu = $hariminggu['minggu'] . ' Minggu ' . $hariminggu['hari_lebih'] . ' Hari';
                  $total = $total + $totalhargahari;
                }
                ?>
                <tr>
                  <td>
                    <?= $i++; ?>
                  </td>
                  <td>
                    <?= $item['id_transaksi']; ?>
                  </td>
                  <td>
                    <?= $item['nama_reklame']; ?>
                  </td>
                  <td>Rp.
                    <?= number_format($total, 0, ',', '.') ?>
                  </td>
                  <td>
                    <?= $item['status_transaksi']; ?>
                  </td>
                  <td>
                    <a class="btn btn-primary" href="<?= base_url('Panel/Transaksi/' . $item['id_transaksi']); ?>">Detail
                      Desain Reklame</a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>