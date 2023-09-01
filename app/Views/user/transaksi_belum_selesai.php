<?= $this->extend('user/base'); ?>

<?= $this->section('content'); ?>

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
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($data as $item): ?>
              <tr>
                <td>
                  <?= $i; ?>
                </td>
                <td>
                  <?= $item['id_transaksi']; ?>
                </td>
                <td>
                  <?= $item['nama_reklame']; ?>
                </td>
                <td>Rp.
                  <?= number_format($item['harga'], 0, ',', '.'); ?>
                </td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-primary"
                      href="<?= base_url('Panel/Transaksi/' . $item['id_transaksi']); ?>">Detail Desain Reklame</a>
                    <a class="btn btn-danger" href="<?= base_url('Panel/Delete/' . $item['id_transaksi']); ?>">Batal
                      Transaksi</a>
                  </div>
                </td>
              </tr>
              <?php $i++; ?>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>