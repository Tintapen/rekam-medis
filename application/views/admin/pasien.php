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
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahData">
                    <div class="fa fa-plus"></div> Tambah Data
                </button>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>No. MR</th>
                                <th>Nama Pasien</th>
                                <th>Tempat, Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>No. Telp</th>
                                <th>Riwayat Alergi Obat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($pasien->result_array() as $row) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nomr'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['tempat_lahir'] . ", " . date("d-m-Y", strtotime($row['tgl_lahir'])) ?></td>
                                    <td><?= $row['alamat'] ?></td>
                                    <td><?= $row['notelp'] ?></td>
                                    <td><?= $row['riwayat'] ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $row['tb_pasien_id'] ?>" style="margin-bottom: 2px">
                                            <div class="fa fa-edit"></div> Edit
                                        </button>
                                        <a href="<?= site_url('pasien/delete/') . $row['tb_pasien_id'] ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Ingin menghapus data ini">
                                            <div class="fa fa-trash"></div> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah <?= $title ?></h4>
            </div>
            <form action="<?= site_url('pasien/insert') ?>" method="POST">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <div class="modal-body">
                    <div class="form-group">
                        <label>No. Rekam Medis</label>
                        <input type="text" name="nomr" class="form-control" placeholder="AUTO" disabled>
                    </div>
                    <div class="form-group">
                        <label>Nama Pasien</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama Pasien" required>
                    </div>
                    <div class="form-group">
                        <label>Tempat, Tanggal Lahir</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat lahir" required>
                            </div>
                            <div class="col-md-6">
                                <input type="date" name="tgl_lahir" class="form-control" placeholder="Tanggal lahir" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>No. Telp</label>
                        <input type="text" name="notelp" class="form-control" placeholder="No Telp" required>
                    </div>
                    <div class="form-group">
                        <label>Riwayat Alergi Obat</label>
                        <textarea class="form-control" name="riwayat" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">
                        <div class="fa fa-trash"></div> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <div class="fa fa-save"></div> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<?php foreach ($pasien->result() as $edit) : ?>
    <div class="modal fade" id="editData<?= $edit->tb_pasien_id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?= $title ?></h4>
                </div>
                <form action="<?= site_url('pasien/update/') . $edit->tb_pasien_id ?>" method="POST">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>No. Rekam Medis</label>
                            <input type="text" name="nomr" class="form-control" value="<?= $edit->nomr ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="<?= $edit->nama ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Tempat, Tanggal Lahir</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat lahir" value="<?= $edit->tempat_lahir ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="date" name="tgl_lahir" class="form-control" placeholder="Tanggal lahir" value="<?= $edit->tgl_lahir ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" rows="3" required><?= $edit->alamat ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>No. Telp</label>
                            <input type="text" name="notelp" class="form-control" placeholder="No Telp" value="<?= $edit->notelp ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Riwayat Alergi Obat</label>
                            <textarea class="form-control" name="riwayat" rows="3"><?= $edit->riwayat ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                            <div class="fa fa-times"></div> Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <div class="fa fa-save"></div> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>