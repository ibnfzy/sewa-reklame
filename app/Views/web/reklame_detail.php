<?= $this->extend('web/base'); ?>

<?= $this->section('content'); ?>
<?php $db = \Config\Database::connect();
$item = $db->table('lokasi_reklame')->where('id_lokasi', $data['id_lokasi'])->get()->getRowArray();
$home = new \App\Controllers\Home;
$star = $home->review_star($data['id_reklame']);
$total_star = $home->total_review($data['id_reklame']);
$get = $home->review($data['id_reklame']);
?>

<div class="main">
  <div class="shop_top">
    <div class="container">
      <div class="row">
        <div class="col-md-9 single_left">
          <div class="single_image">
            <ul id="etalage">
              <li>
                <a href="javascript::void">
                  <img class="etalage_thumb_image" src="<?= base_url('uploads/' . $data['gambar']) ?>" />
                  <img class="etalage_source_image" src="<?= base_url('uploads/' . $data['gambar']) ?>" />
                </a>
              </li>
            </ul>
          </div>
          <!-- end product_slider -->
          <div class="single_right">
            <h3>
              <?= $data['nama_reklame'] ?>
              <?= $star; ?>
              (
              <?= $total_star ?>)
            </h3>
            <p class="m_10">
              <li>Tinggi
                <?= $data['tinggi_reklame']; ?> M x Lebar
                <?= $data['lebar_reklame']; ?> M
              </li>
              <li>Bentuk
                <?= $data['bentuk_reklame']; ?>
              </li>
              <li>
                <?= $data['lokasi']; ?>
              </li>
              <li>Lightning
                <?= $data['lightning']; ?> Buah
              </li>
              <li>Formasi
                <?= $data['formasi']; ?> Arah
              </li>

              <br><br>

              <?php
              $frame = $item['link_gmap'];

              if (str_contains($item['link_gmap'], 'iframe')) {
                $frame = str_replace([
                  'width="600"',
                  'width="800"',
                  'width="700"',
                  'width="500"',
                ], 'width="400"', $item['link_gmap']);
              }
              ?>

              <?= (str_contains($item['link_gmap'], 'iframe')) ? $frame : '<a class="btn btn-primary" href="' . $item['link_gmap'] . '" target="_blank">Liat di Google Maps</a>' ?>
              <!-- <a class="btn btn-primary mt-2">Liat di Google Maps</a> -->
            </p>
            <div class="btn_form">
            </div>
          </div>
          <div class="clear"> </div>
        </div>
        <div class="col-md-3">
          <div class="box-info-product">
            <p class="price2">Rp.
              <?= number_format($data['harga_reklame'], 0, ',', '.'); ?>
            </p>
            <form action="<?= base_url('Panel/Proses/' . $data['id_reklame']) ?>" method="POST">
              <ul class="prosuct-qty">
                <span>/ Hari:</span>
                <input type="text" name="hari">
              </ul>
              <button type="submit" name="Submit" class="exclusive">
                <span>Sewa</span>
              </button>
            </form>
          </div>
        </div>
      </div>
      <div class="desc">
        <h4>Deskripsi</h4>
        <p>
          <?= $data['deskripsi']; ?>
        </p>


      </div>
      <div class="row">
        <ul class="team_list">
          <h4>Testimoni / Review
            (
            <?= count($get); ?>)
          </h4>
          <?php foreach ($get as $item): ?>
          <?php $getcustomer = $db->table('customer')->where('id_customer', $item['id_customer'])->get()->getRowArray(); ?>
          <li>
            <a href="javascript::void">
              <?= $getcustomer['fullname']; ?>
              <?php for ($i = 0; $i < $item['bintang']; $i++): ?>
              ⭐
              <?php endfor ?>
            </a>
            <p>
              <?= $item['isi_review']; ?>
            </p>
          </li>
          <?php endforeach ?>

        </ul>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>