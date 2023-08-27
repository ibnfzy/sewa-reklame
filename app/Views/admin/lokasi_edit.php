<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div class="card">
  <div class="card-header">
    <button onclick="history.back()" class="btn btn-primary">Kembali</button>
  </div>
  <form action="<?= base_url('AdminPanel/LokasiReklame/' . $data['id_lokasi']); ?>" method="post">
    <div class="card-body">
      <div class="form-group">
        <label>Nama Jalan</label>
        <input type="text" class="form-control" name="nama_jalan" value="<?= $data['nama_jalan'] ?>">
      </div>
      <div class="form-group">
        <label>Link Google Map</label>
        <!-- <input type="text" class="form-control" name="link_gmap" value=""> -->
        <textarea class="form-control" name="link_gmap" id="" cols="30" rows="10"><?= $data['link_gmap'] ?></textarea>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </form>
</div>

<?= $this->endSection(); ?>