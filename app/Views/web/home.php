<?= $this->extend('web/base'); ?>
<?= $this->section('content'); ?>

<div class="banner">
  <!-- start slider -->
  <div id="fwslider">
    <div class="slider_container">
      <div class="slide">
        <!-- Slide image -->
        <img src="<?= base_url('') ?>images/slider1.jpg" class="img-responsive" alt="" />
        <!-- /Slide image -->
        <!-- Texts container -->
        <div class="slide_content">
          <div class="slide_content_wrap">
            <!-- Text title -->
            <h1 class="title">Run Over<br>Everything</h1>
            <!-- /Text title -->
            <div class="button"><a href="#">See Details</a></div>
          </div>
        </div>
        <!-- /Texts container -->
      </div>
      <!-- /Duplicate to create more slides -->
      <div class="slide">
        <img src="<?= base_url('') ?>images/slider2.jpg" class="img-responsive" alt="" />
        <div class="slide_content">
          <div class="slide_content_wrap">
            <h1 class="title">Run Over<br>Everything</h1>
            <div class="button"><a href="#">See Details</a></div>
          </div>
        </div>
      </div>
      <!--/slide -->
    </div>
    <div class="timers"></div>
    <div class="slidePrev"><span></span></div>
    <div class="slideNext"><span></span></div>
  </div>
  <!--/slider -->
</div>

<div class="content-bottom" style="background: url(<?= base_url('makassar.jpg') ?>); height: 800px;">
  <div class="container">
    <div class="row content_bottom-text">
      <div class="col-md-7">
        <h3>Selamat Datang<br>di Website CV Duta Mandiri Advertising</h3>
        <p class="m_1">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
          tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci
          tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure
          dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis
          at vero eros et accumsan et iusto odio.</p>
      </div>
    </div>
  </div>

  <?= $this->endSection(); ?>