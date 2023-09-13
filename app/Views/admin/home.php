<?= $this->extend('admin/base'); ?>
<?= $this->section('content'); ?>
<?php $db = \Config\Database::connect(); ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title">Table Reklame Transaksi Berhasil</h5>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama Reklame</th>
                <th>Jumlah Transaksi</th>
                <th>Total Harga</th>
                <th>Total Customer</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($transaksi == null): ?>
              <tr>
                <td colspan="5">Tidak Ada Transaksi</td>
              </tr>
              <?php endif ?>

              <?php $i = 1; ?>
              <?php foreach ($transaksi as $item): ?>
              <tr>
                <td>
                  <?= $i++; ?>
                </td>
                <td>
                  <?= $item['nama_reklame']; ?>
                </td>
                <td>
                  <?= $item['total_transaksi']; ?>
                </td>
                <td>Rp.
                  <?= number_format($item['total_harga'], 0, ',', '.'); ?>
                </td>
                <td>
                  <?= $item['total_customer']; ?>
                </td>
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Grafik Table Reklame Berhasil Tahun <?= date('Y') ;?></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="stackedBarChart"
              style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
      </div><!-- /.card -->
    </div>
    <!-- /.col-md-6 -->
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">
          <h5 class="m-0">Informasi Toko</h5>
        </div>
        <div class="card-body">
          <h6 class="card-title">Nomor Whatsapp Toko</h6>

          <p class="card-text">
            <?= '+' . $data['nomor_wa']; ?>
          </p>
          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editInformasi">Edit</a>
        </div>
      </div>

      <div class="card card-primary card-outline">
        <div class="card-header">
          <h5 class="m-0">Tentang Toko</h5>
        </div>
        <div class="card-body">

          <p class="card-text">
            <?= $data['tentang']; ?>
          </p>
          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editTentang">Edit</a>
        </div>
      </div>
    </div>
    <!-- /.col-md-6 -->
  </div>
  <!-- /.row -->
</div>

<div class=" modal fade" id="editInformasi" tabindex="-1" role="dialog" aria-labelledby="uploadLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="penyerahanDesainLabel">Informasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('AdminPanel/UpdateInformasi'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label>Nomor Whatsapp</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">+62</span>
              </div>
              <input name="nomor_wa" type="text" class="form-control" placeholder="Nomor Whatsapp">
            </div>
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

<div class=" modal fade" id="editTentang" tabindex="-1" role="dialog" aria-labelledby="uploadLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="penyerahanDesainLabel">Informasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('AdminPanel/UpdateTentang'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label>Tentang Toko</label>
            <textarea name="tentang" class="form-control" id="" cols="30" rows="10"></textarea>
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
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
$(function() {
  /* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */

  function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }

  //  $this->db->query('SELECT DISTINCT id_reklame, MONTHNAME(tgl_proses_checkout) as label, COUNT(id_transaksi) as val FROM transaksi GROUP BY id_reklame')->getResultArray()

  <?php $label = [
      'January',
      'February',
      'March',
      'April',
      'May',
      'June',
      'July',
      'August',
      'September',
      'October',
      'November',
      'December',
    ]; ?>

  var areaChartData = {
    labels: <?= json_encode($label); ?>,
    datasets: [
      <?php foreach ($reklame as $item): ?> {
        <?php $id = $item['id_reklame']; ?>
        label: '<?= $item['nama_reklame']; ?>',
          backgroundColor: getRandomColor(),
          borderColor: getRandomColor(),
          pointRadius: false,
          pointColor: getRandomColor(),
          pointStrokeColor: getRandomColor(),
          pointHighlightFill: '#fff',
          pointHighlightStroke: getRandomColor(),
          data: [
            <?php foreach ($label as $month): ?>
            <?php $g = $db->query("SELECT MONTHNAME(tgl_proses_checkout) as label, COUNT(id_transaksi) as val FROM transaksi WHERE id_reklame = '$id' AND MONTHNAME(tgl_proses_checkout) = '$month' AND status_transaksi = 'Selesai'")->getRowArray(); ?>

            <?= $g['val'] ?? 0; ?>,

            <?php endforeach ?>
          ]
      },
      <?php endforeach ?>
    ]
  }


  // var areaChartData = {
  //   labels: [
  //     'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
  //     'November', 'December',
  //   ],
  //   datasets: [{
  //       label: 'Digital Goods',
  //       backgroundColor: 'rgba(60,141,188,0.9)',
  //       borderColor: 'rgba(60,141,188,0.8)',
  //       pointRadius: false,
  //       pointColor: '#3b8bba',
  //       pointStrokeColor: 'rgba(60,141,188,1)',
  //       pointHighlightFill: '#fff',
  //       pointHighlightStroke: 'rgba(60,141,188,1)',
  //       data: [28, 48, 40, 19, 86, 27, 90]
  //     },
  //     {
  //       label: 'Electronics',
  //       backgroundColor: 'rgba(210, 214, 222, 1)',
  //       borderColor: 'rgba(210, 214, 222, 1)',
  //       pointRadius: false,
  //       pointColor: 'rgba(210, 214, 222, 1)',
  //       pointStrokeColor: '#c1c7d1',
  //       pointHighlightFill: '#fff',
  //       pointHighlightStroke: 'rgba(220,220,220,1)',
  //       data: [65, 59, 80, 81, 56, 55, 40]
  //     },
  //   ]
  // }


  var barChartData = $.extend(true, {}, areaChartData)

  var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
  var stackedBarChartData = $.extend(true, {}, barChartData)

  var stackedBarChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      xAxes: [{
        stacked: true,
      }],
      yAxes: [{
        stacked: true
      }]
    }
  }

  new Chart(stackedBarChartCanvas, {
    type: 'bar',
    data: stackedBarChartData,
    options: stackedBarChartOptions
  })
});
</script>

<?= $this->endSection(); ?>