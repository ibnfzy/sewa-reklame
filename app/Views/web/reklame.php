<?= $this->extend('web/base'); ?>

<?= $this->section('content'); ?>

<style>
.col-md-3.shop_box {
  margin-bottom: 20px;
}
</style>

<div class="main">
  <?php if (!isset($data) or count($data) == 0): ?>
  <div class="content-top">
    <h2>Reklame Tidak tersedia</h2>
    <p>Sepertinya reklame pada jalan ini sedang tidak tersedia, silahkan hubungi <a
        href="https://wa.me/6282194712245">Kami</a> untuk informasi lebih lanjut</p>
    <div class="close_but"><i class="close1"> </i></div>
  </div>
  <?php endif ?>
  <div class="shop_top">
    <div class="container">
      <div class="row shop_box-top">

        <?php foreach ($data as $item): ?>
        <div class="col-md-3 shop_box"><a href="<?= base_url('Reklame/' . $item['id_reklame']) ?>">
            <img src="<?= base_url('uploads/' . $item['gambar']) ?>" class="img-responsive" alt="" />
            <span class="new-box">
              <span class="new-label">Tersedia</span>
            </span>
            <!-- <span class="sale-box">
              <span class="sale-label">Sale!</span>
            </span> -->
            <div class="shop_desc">
              <h3><a href="<?= base_url('Reklame/' . $item['id_reklame']) ?>">
                  <?= $item['nama_reklame']; ?>
                </a></h3>
              <p>
                <?= $item['lokasi']; ?> <br> Tinggi
                <?= $item['tinggi_reklame']; ?> x Lebar
                <?= $item['lebar_reklame']; ?> <br>
                Bentuk <?= $item['bentuk_reklame'] ;?>
              </p>
              <!-- <span class="reducedfrom">$66.00</span> -->
              <span class="actual">Rp.
                <?= number_format($item['harga_reklame'], 0, ',', '.'); ?> / Hari
              </span><br>
              <ul class="buttons">
                <!-- <li class="cart"><a href="#">Add To Cart</a></li> -->
                <li class="shop_btn"><a href="<?= base_url('Reklame/' . $item['id_reklame']) ?>">Lihat Detail</a></li>
                <div class="clear"> </div>
              </ul>
            </div>
          </a>
        </div>
        <?php endforeach ?>

      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>