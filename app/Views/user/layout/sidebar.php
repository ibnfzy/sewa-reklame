<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Sidebar -->

  <div
    class="sidebar os-host os-theme-light os-host-overflow os-host-resize-disabled os-host-transition os-host-overflow-y os-host-scrollbar-horizontal-hidden">

    <!-- Sidebar Menu -->
    <nav class="">
      <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent nav-collapse-hide-child"
        data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?= base_url('Panel/') ?>" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Home
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('Panel/Transaksi') ?>" class="nav-link">
            <i class="nav-icon fas fa-tag"></i>
            <p>
              Transaksi Belum Selesai
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('Panel/TransaksiO') ?>" class="nav-link">
            <i class="nav-icon fas fa-tag"></i>
            <p>
              Transaksi History
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('Panel/Testimoni') ?>" class="nav-link">
            <i class="nav-icon fas fa-box-open"></i>
            <p>
              Testimoni
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="javascript::void" class="nav-link" data-toggle="modal" data-target="#informasi">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Informasi Pelanggan
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="javascript::void" class="nav-link" data-toggle="modal" data-target="#pwd">
            <i class="nav-icon fas fa-key"></i>
            <p>
              Ubah Akun Password
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('Lokasi'); ?>" class="nav-link">
            <i class="nav-icon fas fa-circle"></i>
            <p>Katalog Lokasi Reklame</p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<div class="modal fade" id="informasi" tabindex="-1" role="dialog" aria-labelledby="uploadLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="penyerahanDesainLabel">Informasi Pelanggan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('Panel/Informasi'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="fullname" class="form-control" value="<?= session()->get('fullname_customer'); ?>">
          </div>
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?= session()->get('username_customer'); ?>">
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="<?= session()->get('alamat_customer'); ?>">
          </div>
          <div class="form-group">
            <label>Nomor Whatsapp</label>
            <input type="text" name="nomor_wa" class="form-control" value="<?= session()->get('nomor_wa'); ?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="pwd" tabindex="-1" role="dialog" aria-labelledby="uploadLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="penyerahanDesainLabel">Ubah Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('Panel/Password'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label>Password Lama</label>
            <input type="password" name="password_lama" class="form-control">
          </div>
          <div class="form-group">
            <label>Password Baru</label>
            <input type="password" name="password" class="form-control">
          </div>
          <div class="form-group">
            <label>Konfirmasi Password Baru</label>
            <input type="password" name="confirm_password" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>