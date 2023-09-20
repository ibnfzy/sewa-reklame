<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>
<?php $db = \Config\Database::connect(); ?>
<div class="card">
  <div class="card-header">

  </div>
  <div class="card-body">
    <table id='datatable' class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>ID Customer</th>
          <th>Nama Customer</th>
          <th>Hubungi Customer</th>
          <th>Total Transaksi</th>
          <th>Jenis Customer</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        <?php foreach ($data as $item): ?>
        <?php $getTransaksi = $db->table('transaksi')->where('id_customer', $item['id_customer'])->get()->getResultArray(); ?>
        <tr>
          <td>
            <?= $i; ?>
          </td>
          <td>
            <?= $item['id_customer']; ?>
          </td>
          <td>
            <?= $item['fullname']; ?>
          </td>
          <td>
            <a href="https://wa.me/<?= $item['nomor_wa'] ?>" target="_blank" class="btn btn-success">Hubungi
              Customer</a>
          </td>
          <td><?= count($getTransaksi) ?></td>
          <td>
            <?= $item['jenis_customer']; ?>
          </td>
          <td>
            <div class="btn-group">
              <?php if ($item['jenis_customer'] == 'Umum') : ?>
              <a class="btn btn-primary" href="<?= base_url('AdminPanel/CustKerja/'.$item['id_customer']) ;?>">Ubah
                Jenis Customer jadi Kerja Sama</a>
              <?php else : ?>
              <a class="btn btn-danger" href="<?= base_url('AdminPanel/CustUmum/' . $item['id_customer']); ?>">Ubah
                Jenis Customer jadi Umum</a>
              <?php endif ?>
            </div>
          </td>
        </tr>
        <?php $i++; ?>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection(); ?>