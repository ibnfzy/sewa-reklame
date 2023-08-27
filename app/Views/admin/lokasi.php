<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div class="card">
  <div class="card-header">
    <a href="<?= base_url('AdminPanel/LokasiReklame/add'); ?>" class="btn btn-primary">Tambah Data</a>
  </div>
  <div class="card-body">
    <table id='datatable' class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama Jalan</th>
          <th>Link Google Maps</th>
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
              <?= $item['nama_jalan']; ?>
            </td>
            <td>
              <?= (str_contains($item['link_gmap'], 'iframe')) ? $item['link_gmap'] : '<a class="btn btn-primary" href="' . $item['link_gmap'] . '" target="_blank">Buka Link Google Maps</a>' ?>
            </td>
            <td>
              <div class="btn-group">
                <a class="btn btn-primary"
                  href="<?= base_url('AdminPanel/LokasiReklame/' . $item['id_lokasi']); ?>">Edit</a>
                <a class="btn btn-danger"
                  href="<?= base_url('AdminPanel/LokasiReklame/delete/' . $item['id_lokasi']); ?>">Delete</a>
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