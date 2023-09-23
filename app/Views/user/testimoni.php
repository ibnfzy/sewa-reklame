<?= $this->extend('user/base'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
          <table id='datatable' class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>ID Reklame</th>
                <th>Nama Reklame</th>
                <th>Bintang</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              $db = \Config\Database::connect();
              ?>
              <?php foreach ($data as $item): ?>
              <?php $get = $db->table('reklame')->where('id_reklame', $item['id_reklame'])->get()->getRowArray(); ?>
              <tr>
                <td>
                  <?= $i; ?>
                </td>
                <td>
                  <?= $item['id_reklame']; ?>
                </td>
                <td>
                  <?= $get['nama_reklame']; ?>
                </td>
                <td>
                  <?php for ($i = 0; $i < $item['bintang']; $i++): ?>
                  ⭐
                  <?php endfor; ?>
                </td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-danger" href="<?= base_url('Panel/Testimoni/' . $item['id_review']); ?>">Hapus
                      Testimoni</a>
                  </div>
                </td>
              </tr>
              <?php $i++; ?>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>