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
          <th>ID Pelanggan</th>
          <th>Nama Pelanggan</th>
          <th>Jenis Customer</th>
          <th>Total Transaksi Selesai</th>
          <th>Total Bayar</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;
        $db = \Config\Database::connect();
        ?>
        <?php foreach ($data as $item): ?>
        <?php $get = $db->table('transaksi')->where('id_customer', $item['id_customer'])->where('status_transaksi', 'Pengerjaan Selesai')->get()->getResultArray();

          $hargarr = [];
          foreach ($get as $field) {
            $hargarr[] = $field['harga'] * $field['total_hari_sewa'];
          }
          ?>
        <tr>
          <td>
            <?= $i++; ?>
          </td>
          <td>
            <?= $item['id_customer']; ?>
          </td>
          <td>
            <?= $item['fullname']; ?>
          </td>
          <td>
            <?= $item['jenis_customer']; ?>
          </td>
          <td>
            <?= count($get) ?? 0; ?>
          </td>
          <td>Rp.
            <?= number_format(array_sum($hargarr), 0, ',', '.'); ?>
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
  doc.text('Laporan Pelanggan', 110, 10, 'center')
  doc.autoTable({
    html: '#printTable'
  })

  var finalY = doc.lastAutoTable.finalY
  doc.setFontSize(12)
  doc.text('Makassar, ' + fulldate, 140, finalY + 5)
  doc.text('Admin', 140, finalY + 15)

  doc.save('laporan_pelanggan.pdf')
}
</script>
<?= $this->endSection(); ?>