<?= $this->extend('user/base'); ?>
<?= $this->section('content'); ?>

<?php
$db = \Config\Database::connect();
$get = $db->table('transaksi_detail_desain')->where('id_transaksi', $data['id_transaksi'])->get()->getResultArray(); ?>

<style>
  .user-block .username,
  .user-block .description {
    margin-left: 0px;
  }
</style>

<button onclick="window.history.back()" class="btn btn-primary mb-3">Kembali</button>

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
                  <?= $data['total_hari_sewa'] ?> Hari
                </span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-4">
            <div class="info-box bg-light">
              <div class="info-box-content">
                <span class="info-box-text text-center text-muted">Total Harga Sewa</span>
                <span class="info-box-number text-center text-muted mb-0">Rp.
                  <?= number_format($data['harga'], 0, ',', '.') ?>
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

          <a href="#" class="btn btn-sm btn-success">Hubungi Admin</a>
          <a href="#" class="btn btn-sm btn-warning">Upload Invoice</a>
        </div>
      </div>
    </div>
  </div>
  <!-- /.card-body -->
</div>

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
              <label>Upload</label>
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