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
                <th>Status Reklame</th>
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
                  <td>
                    <?= $item['harga']; ?>
                  </td>
                  <td>
                    <?= $item['status_transaksi']; ?>
                  </td>
                  <td>
                    <div class="btn-group">
                      <a class="btn btn-primary" href="#">Testimoni</a>
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