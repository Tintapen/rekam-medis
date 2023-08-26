<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <?= $title ?>
      <small><?= $subtitle ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><?= $title ?></li>
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header">
        Buat Laporan Rekam Medis
      </div>
      <div class="box-body">
        <form action="<?= site_url('laporan/cetak') ?>" method="POST">
          <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
          <div class="modal-body">
            <div class="form-group">
              <label>Dari Tanggal</label>
              <input type="date" name="dari" class="form-control" placeholder="Dari Tanggal" required>
            </div>
            <div class="form-group">
              <label>Sampai Tanggal</label>
              <input type="date" name="sampai" class="form-control" placeholder=" Sampai Tanggal" required>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-danger">
                <div class="fa fa-trash"></div> Reset
              </button>
              <button type="submit" class="btn btn-primary">
                <div class="fa fa-print"></div> Cetak
              </button>
            </div>
        </form>
      </div>
    </div>
  </section>
</div>