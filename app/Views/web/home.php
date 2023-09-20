<?= $this->extend('web/base'); ?>
<?= $this->section('content'); ?>

<div class="banner">
  <!-- start slider -->
  <div id="fwslider">
    <div class="slider_container">
      <?php foreach ($data as $item): ?>
        <div class="slide">
          <!-- Slide image -->
          <img src="<?= base_url('uploads/' . $item['gambar']) ?>" class="img-responsive" alt="" />
          <!-- /Slide image -->
          <!-- Texts container -->
          <div class="slide_content">
            <div class="slide_content_wrap">
              <!-- Text title -->
              <h1 class="title">
                <?= $item['text']; ?>
              </h1>
              <!-- /Text title -->
              <!-- <div class="button"><a href="#">See Details</a></div> -->
            </div>
          </div>
          <!-- /Texts container -->
        </div>
      <?php endforeach ?>

      <!--/slide -->
    </div>
    <div class="timers"></div>
    <div class="slidePrev"><span></span></div>
    <div class="slideNext"><span></span></div>
  </div>
  <!--/slider -->
</div>

<div class="content-bottom" style="background: black; height: 800px; padding: 5% 0;">
  <div class="container">
    <div class="row content_bottom-text">
      <div class="col-md-7">
        <h3>Selamat Datang<br>di Website CV Duta Mandiri Advertising</h3>
        <p class="m_1">
          <?= $informasi['tentang']; ?>
        </p>
      </div>
    </div>
  </div>

  <?= $this->endSection(); ?>