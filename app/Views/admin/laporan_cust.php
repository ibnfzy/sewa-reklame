<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div class="card">
  <div class="card-header">
    <button class="btn btn-danger">Download PDF</button>
  </div>
  <div class="card-body">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>ID Pelanggan</th>
          <th>Nama Pelanggan</th>
          <th>Jenis Customer</th>
          <th>Total Transaksi</th>
          <th>Total Bayar</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        <?php foreach ($data as $item): ?>

          <?php $i++; ?>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection(); ?>