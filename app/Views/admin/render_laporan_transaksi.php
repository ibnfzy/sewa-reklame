<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<?php
$db = \Config\Database::connect();
$getFun = new \App\Controllers\AdmController;
$totalLunas = [];
?>

<div class="card">
  <div class="card-header">
  </div>
  <div class="card-body">
    <table id="printTable" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama Pelanggan</th>
          <th>Nama Reklame</th>
          <th>Keterangan</th>
          <th>Jenis Pembayaran</th>
          <th>Total Harga</th>
          <th>DP Harga 50%</th>
          <th>DP Harga 20%</th>
          <th>Sisa Bayar</th>
          <th>Lunas</th>
        </tr>
      </thead>
      <tbody>

        <?php $i = 1;
        foreach ($data as $item):
          $get = $db->table('transaksi_detail_desain')->where('deskripsi_revisi', 'Bukti Bayar DP 50%')->where('id_transaksi', $item['id_transaksi'])->get()->getRowArray();
          $get20 = $db->table('transaksi_detail_desain')->where('deskripsi_revisi', 'Bukti Bayar DP 20%')->where('id_transaksi', $item['id_transaksi'])->get()->getRowArray();
          $getLunas = $db->table('transaksi_detail_desain')->where('deskripsi_revisi', 'Bukti Bayar Lunas')->where('id_transaksi', $item['id_transaksi'])->get()->getRowArray();
          $hariminggu = $getFun->hari_ke_minggu($item['total_hari_sewa']);
          $jenisBayar = 'Lunas';
          $harga_dp = 'Kosong';
          $total = $item['harga'] * $hariminggu['minggu'];
          $totalhargahari = ($total / 7) * $hariminggu['hari_lebih'];
          $lunas = 'Kosong';
          $harga20 = 'Kosong';
          $sisa = 'Kosong';
          $sisad = 0;

          if ($hariminggu['hari_lebih'] <= 0) {
            $totalwaktu = $hariminggu['minggu'] . ' Minggu ';
          } else {
            $totalwaktu = $hariminggu['minggu'] . ' Minggu ' . $hariminggu['hari_lebih'] . ' Hari';
            $total = $total + $totalhargahari;
          }

          if ($get) {
            $jenisBayar = 'DP';
            $harga_dp = 'Rp ' . number_format($total / 2, 0, ',', '.');
            $sisa = $harga_dp;
            $sisad = $total / 2;
          }

          if ($get20) {
            $harga20 = 'Rp ' . number_format($total * 0.2, 0, ',', '.');
            $sisad = $total - (($total / 2) + ($total * 0.2));
            $sisa = 'Rp ' . number_format($sisad, 0, ',', '.');
          }

          if ($getLunas) {
            if (!$get && !$get20) {
              $totalLunas[] = $total;
            } else {
              $totalLunas[] = $sisad;
            }
          }
          ?>
          <tr>
            <td>
              <?= $i++; ?>
            </td>
            <td>
              <?= $item['fullname']; ?>
            </td>
            <td>
              <?= $item['nama_reklame']; ?>
            </td>
            <td>
              <?= $item['status_transaksi']; ?>
            </td>
            <td>
              <?= $jenisBayar; ?>
            </td>
            <td>Rp
              <?= number_format($total, 0, ',', '.'); ?>
            </td>
            <td>
              <?= $harga_dp; ?>
            </td>
            <td>
              <?= $harga20; ?>
            </td>
            <td>
              <?= $sisa; ?>
            </td>
            <td>
              <?= $sisa; ?>
            </td>
          </tr>
        <?php endforeach ?>

      </tbody>

      <tfoot>
        <tr>
          <th colspan="9">TOTAL </th>
          <th>Rp.
            <?= number_format(array_sum($totalLunas), 0, ',', '.'); ?>
          </th>
        </tr>
      </tfoot>

    </table>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  $(document).ready(function () {
    const d = new Date()
    const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
      "November", "December"
    ];
    let month = months[d.getMonth()];
    let fulldate = d.getDate() + ' ' + month + ' ' + d.getFullYear();
    var doc = new jspdf.jsPDF()

    doc.setFontSize(18)
    doc.text('Laporan Transaksi', 110, 10, 'center')
    doc.setFontSize(10)
    doc.autoTable({
      html: '#printTable'
    })

    var finalY = doc.lastAutoTable.finalY
    doc.setFontSize(12)
    doc.text('Makassar, ' + fulldate, 140, finalY + 10)
    doc.text('Admin', 140, finalY + 20)

    var string = doc.output('datauristring', 'laporan.pdf');
    var iframe = "<iframe width='100%' height='100%' src='" + string + "'></iframe>"
    window.document.open();
    window.document.write(iframe);
    window.document.close();
  });
</script>
<?= $this->endSection(); ?>