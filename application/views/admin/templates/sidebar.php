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
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php if ($this->uri->segment(2) === 'dashboard') echo "active"; ?>">
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
            <li class="<?php if ($this->uri->segment(2) === 'logout') echo "active"; ?>">
                <a href="<?= site_url('home/logout') ?>" class="tombol-yakin" data-isidata="Ingin keluar dari sistem ini?">
                    <i class="fa fa-sign-out"></i> <span>Sign Out</span>
                </a>
            </li>
        </ul>
    </section>
</aside>