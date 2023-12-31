<?= $this->extend('user/base'); ?>
<?= $this->section('content'); ?>

<?php
$db = \Config\Database::connect();
$get = $db->table('transaksi_detail_desain')->where('id_transaksi', $data['id_transaksi'])->orderBy('id_transaksi_detail_desain', 'DESC')->get()->getResultArray();
$getFun = new \App\Controllers\AdmController;

$hariminggu = $getFun->hari_ke_minggu($data['total_hari_sewa']);
$total = $data['harga'] * $hariminggu['minggu'];
$totalhargahari = ($total / 7) * $hariminggu['hari_lebih'];
$isUpRefThere = false;
$bayarDP = false;
$lunas = false;
$totalDP = 0;
$informasiToko = $db->table('informasi')->where('id_toko_informasi', 1)->get()->getRowArray();
$ada20 = false;

if ($hariminggu['hari_lebih'] <= 0) {
  $totalwaktu = $hariminggu['minggu'] . ' Minggu ';
} else {
  $totalwaktu = $hariminggu['minggu'] . ' Minggu ' . $hariminggu['hari_lebih'] . ' Hari';
  $total = $total + $totalhargahari;
}

foreach ($get as $mo) {
  if ($mo['deskripsi_revisi'] == 'Bukti Bayar Lunas') {
    $lunas = true;
  } elseif ($mo['deskripsi_revisi'] == 'Bukti Bayar DP 20%') {
    $bayarDP = true;
    $ada20 = true;
  } elseif ($mo['deskripsi_revisi'] == 'Bukti Bayar DP 50%') {
    $bayarDP = true;
  }
}

?>

<style>
  .user-block .username,
  .user-block .description {
    margin-left: 0px;
  }
</style>

<button onclick="window.history.back()" class="btn btn-primary mb-3">Kembali</button>

<?php if ($data['status_transaksi'] == 'Gagal'): ?>
  <div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> Pemberitahuan!</h5>
    Transaksimu gagal, kamu dapat melanjutkan transaksi dengan menghubungi admin
  </div>
<?php endif ?>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Detail Transaksi</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
        <div class="row">
          <div class="col-12 col-sm-4">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-center text-muted">Total Hari Sewa</span>
                <span class="info-box-number text-center text-muted mb-0">
                  <?= $totalwaktu ?>
                </span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-4">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-center text-muted">Total Harga Sewa</span>
                <span class="info-box-number text-center text-muted mb-0">Rp.
                  <?= number_format($total, 0, ',', '.') ?>
                </span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-4">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-center text-muted">Status Transaksi</span>
                <span class="info-box-number text-center text-muted mb-0">
                  <?= $data['status_transaksi'] ?>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <h4>Timeline Transaksi</h4>

            <?php if ($get == null): ?>
              <div class="post clearfix">
                <div class="user-block">
                  <span class="username">
                    <a href="#">Belum Ada Post</a>
                  </span>
                </div>
              </div>
            <?php else: ?>

              <?php foreach ($get as $item): ?>
                <?php $isUpRefThere = ($item['jenis_post'] == 'Referensi & Kriteria Desain') ? true : false; ?>
                <div class="post">
                  <div class="user-block">
                    <span class="username">
                      <a href="javascript::void()">
                        <?= $item['jenis_post']; ?>
                      </a>
                    </span>
                    <span class="description">Di upload pada -
                      <?= $item['tanggal_post']; ?>
                    </span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    <?= $item['deskripsi_revisi']; ?>
                  </p>

                  <p>
                    <a href="<?= base_url('uploads/' . $item['gambar']); ?>" class="link-black text-sm" target="_blank"><i
                        class="fas fa-link mr-1"></i>
                      <?= $item['gambar']; ?>
                    </a>
                  </p>
                </div>
              <?php endforeach ?>

            <?php endif ?>

          </div>
        </div>
      </div>
      <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
        <h3 class="text-primary"><i class="fas fa-paint-brush"></i> CV Duta Mandiri Adsvertising</h3>
        <p class="text-muted">Rekening XYZ 1234567890 A/n Adrian Muis</p>
        <br>
        <div class="text-muted">
          <p class="text-sm">Jenis Desain
            <b class="d-block">
              <?= $data['jenis_desain_reklame'] ?? 'Belum Pilih' ?>
            </b>
          </p>
        </div>

        <div class="text-muted">
          <p class="text-sm">Tanggal Sewa Mulai
            <b class="d-block">
              <?= $data['tgl_sewa'] ?>
            </b>
          </p>
        </div>

        <?php if ($data['status_transaksi'] == 'Penyerahan Desain Berhasil'): ?>
          <div class="text-muted">
            <p class="text-sm">Tanggal Batas Pembayaran DP
              <b class="d-block">
                <?= date('m/d/Y', strtotime($data['tgl_sewa'] . ' +1 days')) ?>
              </b>
            </p>
          </div>
        <?php endif ?>

        <?php if ($data['tgl_selesai'] != null): ?>
          <div class="text-muted">
            <p class="text-sm">Tanggal Sewa Selesai
              <b class="d-block">
                <?= $data['tgl_selesai'] ?>
              </b>
            </p>
          </div>
        <?php endif ?>

        <?php if ($bayarDP == true && $lunas == false): ?>
          <div class="text-muted">
            <p class="text-sm">Tanggal Jatuh Tempo
              <b class="d-block">
                <!-- Here -->
                <?= $data['tgl_jatuh_tempo'] ?? 'Tanggal Jatuh Tempo akan dibuat saat pengerjaan reklame selesai'; ?>
              </b>
            </p>
          </div>
        <?php endif ?>

        <?php if ($bayarDP == true):
          $totalDP = ($ada20) ? ($total / 2) + ($total * 0.2) : $total / 2;
          ?>
          <div class="text-muted">
            <p class="text-sm">Total Bayar DP
              <b class="d-block">
                Rp.
                <?= number_format($totalDP, 0, ',', '.') ?>
              </b>
            </p>
          </div>
        <?php endif ?>

        <h5 class="mt-5 text-muted">Project files</h5>
        <ul class="list-unstyled">
          <?php if ($get == null): ?>
            <li>
              Tidak Ada File
            </li>
          <?php else: ?>
            <?php foreach ($get as $item): ?>
              <li>
                <a download="" href="<?= base_url('uploads/' . $item['gambar']); ?>" class="btn-link text-secondary"><i
                    class="fas fa-download"></i>
                  <?= $item['gambar']; ?>
                </a>
              </li>
            <?php endforeach ?>
          <?php endif ?>

        </ul>
        <div class="mt-5 mb-3">
          <?php if ($data['jenis_desain_reklame'] == null): ?>
            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#penyerahanDesain">Pilih Jenis
              Penyerahan
              Desain</a>
          <?php endif ?>

          <?php if ($data['jenis_desain_reklame'] == 'Upload Desain Sendiri' && $data['status_transaksi'] == 'Penyerahan Desain'): ?>
            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#penyerahanDesain">Upload
              Desain</a>
          <?php endif ?>

          <?php if ($data['status_transaksi'] == 'Penyerahan Desain Berhasil'): ?>
            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#uploadBB">Upload Bukti Pembayaran
              DP</a>
          <?php endif ?>

          <?php if ($data['status_transaksi'] == 'Penyerahan Desain' && $data['jenis_desain_reklame'] == 'Request Desain' && $isUpRefThere == false): ?>
            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#ref">Upload Referensi &
              Kriteria Desain</a>
          <?php endif ?>

          <?php if ($data['status_transaksi'] == 'Penyerahan Desain' && $data['jenis_desain_reklame'] == 'Request Desain' && $isUpRefThere == true): ?>
            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#rev">Upload Revisi Desain</a>
            <a href="<?= base_url('Panel/TerimaDesain/' . $data['id_transaksi']); ?>"
              class="btn btn-sm btn-primary">Terima
              Hasil Desain</a>
          <?php endif ?>

          <?php if ($bayarDP == true && $lunas == false && $data['status_transaksi'] != 'Gagal' && $data['status_transaksi'] != 'Transaksi Selesai' && $data['status_transaksi'] != 'Menunggu Validasi Bukti Bayar DP 20%' && $data['status_transaksi'] != 'Menunggu Pelunasan' && $data['status_transaksi'] != 'Menunggu Validasi Bukti Bayar DP 50%'): ?>
            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#uploadBBS">Upload Bukti
              Pembayaran
            </a>
          <?php endif ?>

          <?php if ($data['status_transaksi'] == 'Menunggu Pelunasan'): ?>
            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#pelunasan">Upload Bukti
              Pembayaran Pelunasan
            </a>
          <?php endif ?>

          <?php if ($data['status_transaksi'] == 'Transaksi Selesai' && $testi == 0): ?>
            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#testi">Berikan Testimoni</a>
          <?php endif ?>

          <a href="https://wa.me/<?= $informasiToko['nomor_wa'] ?>" class="btn btn-sm btn-success">Hubungi Admin</a>

        </div>
      </div>
    </div>
  </div>
  <!-- /.card-body -->
</div>

<?php if ($data['status_transaksi'] == 'Transaksi Selesai'): ?>
  <div class="modal fade" id="testi" tabindex="-1" role="dialog" aria-labelledby="uploadLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="penyerahanDesainLabel">Testimoni</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('Panel/Testimoni/' . $data['id_transaksi']); ?>" method="post"
          enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label>Bintang</label>
              <select name="bintang" id="bintang" class="form-control">
                <option value="1">⭐</option>
                <option value="2">⭐⭐</option>
                <option value="3">⭐⭐⭐</option>
                <option value="4">⭐⭐⭐⭐</option>
                <option value="5">⭐⭐⭐⭐⭐</option>
              </select>
            </div>
            <div class="form-group">
              <label for="">Deskripsi Testimoni</label>
              <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control" required></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            <button type="submit" class="btn btn-primary">Proses</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endif ?>

<?php if ($data['status_transaksi'] == 'Penyerahan Desain' && $data['jenis_desain_reklame'] == 'Request Desain' && $isUpRefThere == true): ?>
  <div class="modal fade" id="rev" tabindex="-1" role="dialog" aria-labelledby="uploadLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="penyerahanDesainLabel">Upload Revisi Desain</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('Panel/UploadRevisi/' . $data['id_transaksi']); ?>" method="post"
          enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label>Upload File Pendukung Revisi</label>
              <input type="file" class="form-control" name="gambar">
            </div>
            <div class="form-group">
              <label for="">Deskripsi Revisi Desain</label>
              <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control" required></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            <button type="submit" class="btn btn-primary">Proses</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endif ?>

<?php if ($data['status_transaksi'] == 'Penyerahan Desain' && $data['jenis_desain_reklame'] == 'Request Desain' && $isUpRefThere == false): ?>
  <div class="modal fade" id="ref" tabindex="-1" role="dialog" aria-labelledby="uploadLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="penyerahanDesainLabel">Upload Referensi &
            Kriteria Desain</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('Panel/UploadKriteria/' . $data['id_transaksi']); ?>" method="post"
          enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label>Upload Referensi</label>
              <input type="file" class="form-control" name="gambar">
            </div>
            <div class="form-group">
              <label for="">Deskripsi Kriteria Desain</label>
              <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control" required></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            <button type="submit" class="btn btn-primary">Proses</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endif ?>

<?php if ($bayarDP == true && $lunas == false): ?>
  <div class="modal fade" id="pelunasan" tabindex="-1" role="dialog" aria-labelledby="uploadLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="penyerahanDesainLabel">Upload Bukti Bayar Pelunasan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('Panel/UploadLunas/' . $data['id_transaksi']); ?>" method="post"
          enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label>Total Pelunasan Rp
                <?= number_format($total - $totalDP, 0, ',', '.'); ?>
              </label>
              <input type="file" class="form-control" name="gambar">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            <button type="submit" class="btn btn-primary">Proses</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="uploadBBS" tabindex="-1" role="dialog" aria-labelledby="uploadLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="penyerahanDesainLabel">Upload Bukti Bayar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('Panel/UploadBBDPS/' . $data['id_transaksi']); ?>" method="post"
          enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label>Upload</label>
              <input type="file" class="form-control" name="gambar">
            </div>
            <div class="form-group">
              <label>Jenis Pembayaran</label>
              <select name="jenis_pembayaran" id="bintang" class="form-control">
                <option value="1">Bayar Lunas Rp.
                  <?= number_format($total / 2, 0, ',', '.'); ?>
                </option>
                <option value="2">Bayar DP 20% Rp.
                  <?= number_format($total * 0.2, 0, ',', '.'); ?>
                </option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            <button type="submit" class="btn btn-primary">Proses</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endif ?>

<?php if ($data['status_transaksi'] == 'Penyerahan Desain Berhasil'): ?>
  <div class="modal fade" id="uploadBB" tabindex="-1" role="dialog" aria-labelledby="uploadLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="penyerahanDesainLabel">Upload Bukti Bayar DP</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('Panel/UploadBBDP/' . $data['id_transaksi']); ?>" method="post"
          enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label>Upload</label>
              <input type="file" class="form-control" name="gambar">
            </div>
            <div class="form-group">
              <label>Jenis Pembayaran</label>
              <select name="jenis_pembayaran" id="bintang" class="form-control">
                <option value="1">Bayar Lunas Rp.
                  <?= number_format($total, 0, ',', '.'); ?>
                </option>
                <option value="2">Bayar DP Rp.
                  <?= number_format($total / 2, 0, ',', '.'); ?>
                </option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            <button type="submit" class="btn btn-primary">Proses</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endif ?>

<?php if ($data['jenis_desain_reklame'] == 'Upload Desain Sendiri'): ?>
  <div class="modal fade" id="penyerahanDesain" tabindex="-1" role="dialog" aria-labelledby="penyerahanDesainLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="penyerahanDesainLabel">Upload Desain</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('Panel/UploadSendiri/' . $data['id_transaksi']); ?>" method="post"
          enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label>Upload Desain</label>
              <input type="file" class="form-control" name="gambar">
            </div>
            <div class="form-group">
              <label for="">Deskripsi Desain</label>
              <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            <button type="submit" class="btn btn-primary">Proses</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endif ?>

<?php if ($data['jenis_desain_reklame'] == null): ?>
  <div class="modal fade" id="penyerahanDesain" tabindex="-1" role="dialog" aria-labelledby="penyerahanDesainLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="penyerahanDesainLabel">Pilih Jenis Proses Penyerahan Desain</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('Panel/JenisDesain/' . $data['id_transaksi']); ?>" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label>Pilih</label>
              <select name="jenis" id="jenis" class="form-control" required>
                <option value="Request Desain">Request Desain</option>
                <option value="Upload Desain Sendiri">Upload Desain Sendiri</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            <button type="submit" class="btn btn-primary">Proses</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endif ?>

<?= $this->endSection(); ?>