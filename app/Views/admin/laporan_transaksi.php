<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

<?php
$db = \Config\Database::connect();
$totalLunas = [];
?>

<div class="card">
  <div class="card-header">
    <button id="print" class="btn btn-default">Print</button>
    <button onclick="javascript:demoFromHTML();" class="btn btn-danger">Download PDF</button>
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
          <th>DP Harga</th>
          <th>Sisa Bayar</th>
          <th>Lunas</th>
        </tr>
      </thead>
      <tbody>

        <?php $i = 1;
        foreach ($data as $item):
          $get = $db->table('transaksi_detail_desain')->where('deskripsi_revisi', 'Bukti Bayar DP')->where('id_transaksi', $item['id_transaksi'])->get()->getRowArray();
          $getLunas = $db->table('transaksi_detail_desain')->where('deskripsi_revisi', 'Bukti Bayar Lunas')->where('id_transaksi', $item['id_transaksi'])->get()->getRowArray();
          $jenisBayar = 'Lunas';
          $harga_dp = 'Kosong';
          $total = $item['harga'] * $item['total_hari_sewa'];
          $lunas = 'Kosong';


          if ($get) {
            $jenisBayar = 'DP';
            $harga_dp = 'Rp ' . number_format($total / 2, 0, ',', '.');
          }

          if ($getLunas) {
            if (!$get) {
              $lunas = 'Rp ' . number_format($total, 0, ',', '.');
              $totalLunas[] = $total;
            } else {
              $lunas = $harga_dp;
              $totalLunas[] = $total / 2;
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
              <?= $harga_dp; ?>
            </td>
            <td>
              <?= $lunas; ?>
            </td>
          </tr>
        <?php endforeach ?>

      </tbody>

      <tfoot>
        <tr>
          <th colspan="8">TOTAL </th>
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
  function printData() {
    var divToPrint = document.getElementById("printTable");
    newWin = window.open("");
    newWin.document.write(divToPrint.outerHTML);
    newWin.print();
    newWin.close();
  }

  const btn = document.getElementById("print");
  btn.addEventListener('click', () => printData())

  function demoFromHTML() {
    const d = new Date()
    const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
      "November", "December"
    ];
    let month = months[d.getMonth()];
    let fulldate = d.getDate() + ' ' + month + ' ' + d.getFullYear();
    var doc = new jspdf.jsPDF()

    doc.setFontSize(18)
    doc.text('Laporan Transaksi', 110, 10, 'center')
    doc.autoTable({
      html: '#printTable'
    })

    var finalY = doc.lastAutoTable.finalY
    doc.setFontSize(12)
    doc.text('Makassar, ' + fulldate, 140, finalY + 10)
    doc.text('Admin', 140, finalY + 20)

    doc.save('laporan_transaksi.pdf')
  }
</script>
<?= $this->endSection(); ?>