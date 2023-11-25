<?= $this->extend('web/base'); ?>

<?= $this->section('content'); ?>

<style>
.col-md-4.team1 {
  margin-bottom: 20px;
}
</style>

<?php
$db = \Config\Database::connect();
?>

<div class="main">
  <div class="shop_top">
    <div class="container">
      <div class="row ex2_box">
        <h3 class="m_2">Lokasi Reklame</h3>
        <?php foreach ($data as $item):
          $get = $db->table('reklame')->where('id_lokasi', $item['id_lokasi'])->where('status_reklame', 'Tersedia')->orderBy('id_reklame', 'RAND()')->get()->getResultArray();
          $gambar = (!$get) ? 'ads.jpg' : 'uploads/' . $get[0]['gambar'];
          ?>
        <div class="col-md-4 team1">
          <div class="img_section magnifier2">
            <a class="fancybox" href="<?= base_url('Lokasi/' . $item['id_lokasi']) ?>"><img
                src="<?= base_url($gambar); ?>" class="img-responsive" alt=""><span>
              </span>
              <div class="img_section_txt">
                <?= $item['nama_jalan']; ?> <br>
                Total Reklame Tersedia :
                <?= count($get); ?>
              </div>
            </a>
          </div>
        </div>
        <?php endforeach ?>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>