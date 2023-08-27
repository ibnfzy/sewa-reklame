<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div class="card">
  <div class="card-header">
    <button onclick="history.back()" class="btn btn-primary">Kembali</button>
  </div>
  <form action="<?= base_url('AdminPanel/LokasiReklame'); ?>" method="post">
    <div class="card-body">
      <div class="form-group">
        <label>Nama Jalan</label>
        <input type="text" class="form-control" name="nama_jalan" placeholder="Contoh : Jl. Hertasning Baru">
      </div>
      <div class="form-group">
        <label>Link Google Map</label>
        <textarea name="link_gmap" class="form-control" id="" cols="30" rows="10"
          placeholder="Contoh: https://goo.gl/maps/xxx atau menggunakan iframe/sematkan peta"></textarea>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </form>
</div>

<?= $this->endSection(); ?>