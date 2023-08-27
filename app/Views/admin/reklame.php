<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div class="card">
  <div class="card-header">
    <a href="<?= base_url('AdminPanel/Reklame/add'); ?>" class="btn btn-primary">Tambah Data</a>
  </div>
  <div class="card-body">
    <table id='datatable' class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama Reklme</th>
          <th>Nama Jalan</th>
          <th>Link Google Maps</th>
          <th>Ukuran Reklame</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;
        $db = \Config\Database::connect();
        ?>
        <?php foreach ($data as $item): ?>
          <?php $getLink = $db->table('lokasi_reklame')->where('id_lokasi', $item['id_lokasi'])->get()->getRowArray();
          ; ?>
          <tr>
            <td>
              <?= $i; ?>
            </td>
            <td>
              <?= $item['nama_reklame']; ?>
            </td>
            <td>
              <?= $item['lokasi']; ?>
            </td>
            <td>
              <a href="<?= $getLink['link_gmap']; ?>" target="_blank" class="btn btn-primary">Buka Link</a>
            </td>
            <td>
              <?= 'Tinggi ' . $item['tinggi_reklame'] . ' x Lebar ' . $item['lebar_reklame']; ?>
            </td>
            <td>
              <div class="btn-group">
                <a class="btn btn-primary"
                  href="<?= base_url('AdminPanel/LokasiReklame/' . $item['id_guru']); ?>">Edit</a>
                <a class="btn btn-danger"
                  href="<?= base_url('AdminPanel/LokasiReklame/delete/' . $item['id_guru']); ?>">Delete</a>
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