<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div class="card">
  <div class="card-header">
    <button onclick="history.back()" class="btn btn-primary">Kembali</button>
  </div>
  <form action="<?= base_url('AdminPanel/Corousel'); ?>" method="post" enctype="multipart/form-data">
    <div class="card-body">
      <div class="form-group">
        <label>Text</label>
        <input type="text" class="form-control" name="text">
      </div>
      <div class="form-group">
        <label>Gambar (Max 2MB)</label>
        <input type="file" class="form-control" name="gambar" accept="image/*">
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </form>
</div>

<?= $this->endSection(); ?>