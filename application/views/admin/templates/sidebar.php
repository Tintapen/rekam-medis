<aside class="main-sidebar">
    <section class="sidebar">
        <!-- <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= base_url('assets') ?>/profil/<?= $this->session->userdata('foto') ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= $this->session->userdata('nama') ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div> -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header"></li>
            <?php if ($this->session->userdata('level') == "Dokter") { ?>
                <li class="<?php if ($this->uri->segment(1) === 'dashboard') echo "active"; ?>">
                    <a href="<?= site_url('dashboard') ?>">
                        <i class="fa fa-tachometer"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="<?php if ($this->uri->segment(1) === 'soap') echo "active"; ?>">
                    <a href="<?= site_url('soap') ?>">
                        <i class="fa fa-medkit"></i> <span>SOAP</span>
                    </a>
                </li>
                <li class="<?php if ($this->uri->segment(1) === 'laporan') echo "active"; ?>">
                    <a href="<?= site_url('laporan') ?>">
                        <i class="fa fa-print"></i> <span>Laporan</span>
                    </a>
                </li>
                <li class="<?php if ($this->uri->segment(1) === 'logout') echo "active"; ?>">
                    <a href="<?= site_url('home/logout') ?>" class="tombol-yakin" data-isidata="Ingin keluar dari sistem ini?">
                        <i class="fa fa-sign-out"></i> <span>Sign Out</span>
                    </a>
                </li>
            <?php } else { ?>
                <li class="<?php if ($this->uri->segment(1) === 'dashboard') echo "active"; ?>">
                    <a href="<?= site_url('dashboard') ?>">
                        <i class="fa fa-tachometer"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="<?php if ($this->uri->segment(1) === 'pasien') echo "active"; ?>">
                    <a href="<?= site_url('pasien') ?>">
                        <i class="fa fa-users"></i> <span>Data Pasien</span>
                    </a>
                </li>
                <li class="<?php if ($this->uri->segment(1) === 'reg_pasien') echo "active"; ?>">
                    <a href="<?= site_url('reg_pasien') ?>">
                        <i class="fa fa-users"></i> <span>Regiterasi Pasien</span>
                    </a>
                </li>

                <li class="<?php if ($this->uri->segment(1) === 'dokter') echo "active"; ?>">
                    <a href="<?= site_url('dokter') ?>">
                        <i class="fa fa-medkit"></i> <span>Data Dokter</span>
                    </a>
                </li>
                <li class="<?php if ($this->uri->segment(1) === 'laporan') echo "active"; ?>">
                    <a href="<?= site_url('laporan') ?>">
                        <i class="fa fa-print"></i> <span>Laporan</span>
                    </a>
                </li>
                <li class="<?php if ($this->uri->segment(1) === 'logout') echo "active"; ?>">
                    <a href="<?= site_url('home/logout') ?>" class="tombol-yakin" data-isidata="Ingin keluar dari sistem ini?">
                        <i class="fa fa-sign-out"></i> <span>Sign Out</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </section>
</aside>