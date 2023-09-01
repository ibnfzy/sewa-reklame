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
                  <a href="#">Jenis.</a>
                </span>
                <span class="description">Shared publicly - 7:45 PM today</span>
              </div>
              <!-- /.user-block -->
              <p>
                Lorem ipsum represents a long-held tradition for designers,
                typographers and the like. Some people hate it and argue for
                its demise, but others ignore.
              </p>

              <p>
                <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v2</a>
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
            <b class="d-block">Desain Sendiri</b>
          </p>
        </div>

        <h5 class="mt-5 text-muted">Project files</h5>
        <ul class="list-unstyled">
          <?php if ($get == null): ?>
          <li>
            Tidak Ada File
          </li>
          <?php else: ?>
          <?php foreach ($get as $item) : ?>
          <li>
            <a href="#" class="btn-link text-secondary"><i class="far fa-fw fa-file-alt"></i>
              Functional-requirements.docx</a>
          </li>
          <?php endforeach ?>
          <?php endif ?>

        </ul>
        <div class="text-center mt-5 mb-3">
          <a href="#" class="btn btn-sm btn-primary">Add files</a>
          <a href="#" class="btn btn-sm btn-success">Hubungi Admin</a>
          <a href="#" class="btn btn-sm btn-warning">Upload Invoice</a>
        </div>
      </div>
    </div>
  </div>
  <!-- /.card-body -->
</div>

<?= $this->endSection(); ?>