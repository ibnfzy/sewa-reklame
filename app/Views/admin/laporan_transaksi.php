<?= $this->extend('admin/base'); ?>

<?= $this->section('content'); ?>

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
          <th>Nama Reklame</th>
          <th>Jumlah Transaksi</th>
          <th>Total Harga</th>
          <th>Total Customer</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        <?php foreach ($data as $item): ?>
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
    doc.text('Makassar, ' + fulldate, 140, finalY + 2)
    doc.text('Admin', 140, finalY + 15)

    doc.save('laporan_transaksi.pdf')
  }
</script>
<?= $this->endSection(); ?>