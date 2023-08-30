<?= $this->extend('web/base'); ?>

<?= $this->section('content'); ?>

<style>
.col-md-4.team1 {
  margin-bottom: 20px;
}
</style>

<div class="main">
  <div class="shop_top">
    <div class="container">
      <div class="row ex2_box">
        <h3 class="m_2">Lokasi Reklame</h3>
        <?php foreach ($data as $item): ?>
        <div class="col-md-4 team1">
          <div class="img_section magnifier2">
            <a class="fancybox" href="<?= base_url('Lokasi/' . $item['id_lokasi']) ?>"><img src="ads.jpg"
                class="img-responsive" alt=""><span> </span>
              <div class="img_section_txt">
                <?= $item['nama_jalan']; ?>
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