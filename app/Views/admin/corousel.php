<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div class="card">
  <div class="card-header">
    <a href="<?= base_url('AdminPanel/Corousel/new'); ?>" class="btn btn-primary">Tambah Data</a>
  </div>
  <div class="card-body">
    <table id='datatable' class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Text</th>
          <th>Gambar</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;
        ?>
        <?php foreach ($data as $item): ?>

          <tr>
            <td>
              <?= $i; ?>
            </td>
            <td>
              <?= $item['text']; ?>
            </td>
            <td>
              <a target="_blank" href="<?= base_url('uploads/' . $item['gambar']); ?>">
                <img width="200" src="<?= base_url('uploads/' . $item['gambar']); ?>" alt="">
              </a>
            </td>
            <td>
              <div class="btn-group">
                <a class="btn btn-danger"
                  href="<?= base_url('AdminPanel/Corousel/delete/' . $item['id_corousel']); ?>">Delete</a>
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