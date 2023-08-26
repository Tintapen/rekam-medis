<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small><?= $subtitle ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url() ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?= $title ?></li>
        </ol>
    </section>
    <?php
    //menghitung jml data pasien
    $sqlt = $this->db->query('select COUNT(tb_pasien_id) as jml from tb_pasien');
    foreach ($sqlt->result() as $pasien) {
    }
    //menghitung jumlah data rekamidek
    $sqlreg = $this->db->query('select COUNT(	tb_reg_pasien_id) as jml from tb_reg_pasien');
    foreach ($sqlreg->result() as $registrasi) {
    }
    //menghitung jumlah data dokter
    $sqldok = $this->db->query('select COUNT(tb_dokter_id) as jml from tb_dokter');
    foreach ($sqldok->result() as $dokter) {
    }
    //menghitung jumlah data SOAP
    $sqlsoap = $this->db->query('select COUNT(tb_soap_id) as jml from tb_soap WHERE tb_dokter_id ="' . $this->session->userdata('ref_dokter_id') . '"');
    foreach ($sqlsoap->result() as $soap) {
    }

    ?>
    <section class="content">
        <div class="row">
            <?php if ($this->session->userdata('level') != "Dokter") { ?>
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3>
                                <?php echo $pasien->jml; ?>
                            </h3>

                            <p>Total Pasien</p>
                        </div>
                        <div class="icon">
                            <div class="fa fa-users"></div>
                        </div>
                        <a href="<?= site_url('pasien') ?>" class="small-box-footer">
                            Lihat Data <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>
                                <?php echo $registrasi->jml; ?>
                            </h3>

                            <p>Total Regiterasi</p>
                        </div>
                        <div class="icon">
                            <div class="fa fa-file"></div>
                        </div>
                        <a href="<?= site_url('reg_pasien') ?>" class="small-box-footer">
                            Lihat Data <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>
                                <?php echo $dokter->jml; ?>
                            </h3>
                            <p>Total Dokter</p>
                        </div>
                        <div class="icon">
                            <div class="fa fa-users"></div>
                        </div>
                        <a href="<?= site_url('dokter') ?>" class="small-box-footer">
                            Lihat Data <i class="fa fa-arrow-circle-right"></i>
                        </a>
                        </a>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>
                                <?php echo $soap->jml; ?>
                            </h3>
                            <p>Total SOAP</p>
                        </div>
                        <div class="icon">
                            <div class="fa fa-users"></div>
                        </div>
                        <a href="<?= site_url('soap') ?>" class="small-box-footer">
                            Lihat Data <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</div>