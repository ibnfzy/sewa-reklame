<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/node_modules/sweetalert2/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/node_modules/toastr/build/toastr.min.css">
</head>

<body class="hold-transition layout-navbar-fixed text-sm layout-footer-fixed sidebar-mini-xs layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <?= $this->include('admin/layout/navbar'); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= $this->include('admin/layout/sidebar'); ?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <!-- <h1 class="m-0">Selamat Datang </h1> -->
            </div><!-- /.col -->
            <!-- <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li>
          </ol>
        </div>/.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <!-- /.container-fluid -->
        <?= $this->renderSection('content'); ?>
      </div>
      <!-- /.content -->
    </div>

    <!-- Main Footer -->
    <?= $this->include('admin/layout/footer'); ?>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="<?= base_url() ?>plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url(); ?>/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
  <script src="<?= base_url() ?>/node_modules/toastr/build/toastr.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="<?= base_url('') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url('') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url('') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url('') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url('') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url('') ?>/plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url('') ?>/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url('') ?>/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url('') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url('') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url('') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- ChartJS -->
  <script src="<?= base_url('') ?>plugins/chart.js/Chart.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>dist/js/adminlte.min.js"></script>

  <script src="<?= base_url(''); ?>/jspdf/examples/libs/jspdf.umd.js"></script>
  <script src="<?= base_url(''); ?>/jspdf/dist/jspdf.plugin.autotable.js"></script>

  <script>
    $(function () {
      $("#db_button").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#datatable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  </script>

  <?= $this->renderSection('script'); ?>

  <?php
  if (session()->getFlashdata('dataMessage')) {
    foreach (session()->getFlashdata('dataMessage') as $item) {
      echo '<script>toastr["' .
        session()->getFlashdata('type-status') . '"]("' . $item . '")</script>';
    }
  }
  if (session()->getFlashdata('message')) {
    echo '<script>toastr["' .
      session()->getFlashdata('type-status') . '"]("' . session()->getFlashdata('message') . '")</script>';
  }
  ?>
</body>

</html>