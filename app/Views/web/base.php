<!DOCTYPE HTML>
<html>

<head>
  <title>Website CV Duta Mandiri Advertising</title>
  <link href="<?= base_url('') ?>css/bootstrap.css" rel='stylesheet' type='text/css' />
  <link href="<?= base_url('') ?>css/style.css" rel='stylesheet' type='text/css' />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
  <script type="application/x-javascript">
  addEventListener("load", function() {
    setTimeout(hideURLbar, 0);
  }, false);

  function hideURLbar() {
    window.scrollTo(0, 1);
  };
  </script>
  <script src="<?= base_url('') ?>js/jquery.min.js"></script>
  <!--<script src="<?= base_url('') ?>js/jquery.easydropdown.js"></script>-->
  <!--start slider -->
  <link rel="stylesheet" href="<?= base_url('') ?>css/fwslider.css" media="all">
  <script src="<?= base_url('') ?>js/jquery-ui.min.js"></script>
  <script src="<?= base_url('') ?>js/fwslider.js"></script>
  <!--end slider -->
  <script type="text/javascript">
  $(document).ready(function() {
    $(".dropdown img.flag").addClass("flagvisibility");

    $(".dropdown dt a").click(function() {
      $(".dropdown dd ul").toggle();
    });

    $(".dropdown dd ul li a").click(function() {
      var text = $(this).html();
      $(".dropdown dt a span").html(text);
      $(".dropdown dd ul").hide();
      $("#result").html("Selected value is: " + getSelectedValue("sample"));
    });

    function getSelectedValue(id) {
      return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function(e) {
      var $clicked = $(e.target);
      if (!$clicked.parents().hasClass("dropdown"))
        $(".dropdown dd ul").hide();
    });


    $("#flagSwitcher").click(function() {
      $(".dropdown img.flag").toggleClass("flagvisibility");
    });
  });
  </script>
</head>

<body>
  <?= $this->include('web/layout/navbar'); ?>

  <?= $this->renderSection('content'); ?>

  <?= $this->include('web/layout/footer'); ?>
</body>

</html>