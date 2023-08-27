<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<div class="card">
  <div class="card-header">
    <button onclick="history.back()" class="btn btn-primary">Kembali</button>
  </div>
  <form action="<?= base_url('AdminPanel/Reklame'); ?>" method="post" enctype="multipart/form-data">
    <div class="card-body">
      <div class="form-group">
        <label>Jalan</label>
        <select class="form-control" name="id_lokasi" id="">
          <?php $i = 1; ?>
          <?php foreach ($lokasi as $item): ?>
          <option value="<?= $item['id_lokasi'] ?>"><?= $i . '. ' . $item['nama_jalan'] ?></option>
          <?php $i++ ?>
          <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <label>Bentuk Reklame</label>
        <select name="bentuk_reklame" id="" class="form-control">
          <option value="vert">1. Vertikal</option>
          <option value="horizon">2. Horizontal</option>
        </select>
      </div>
      <div class="form-group">
        <label for="">Harga Sewa/Hari</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Rp.</span>
          </div>
          <input type="text" class="form-control" name="harga_reklame">
        </div>
      </div>
      <div class="form-group">
        <label>Nama Reklame</label>
        <input type="text" class="form-control" name="nama_reklame">
      </div>
      <div class="form-group">
        <label>Tinggi Reklame (Meter)</label>
        <input type="text" class="form-control" name="tinggi_reklame">
      </div>
      <div class="form-group">
        <label>Lebar Reklame (Meter)</label>
        <input type="text" class="form-control" name="lebar_reklame">
      </div>
      <div class="form-group">
        <label>Gambar Reklame (Untuk Display)</label>
        <input type="file" class="form-control" name="gambar" accept="image/*">
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control"></textarea>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </form>
</div>

<?= $this->endSection(); ?>