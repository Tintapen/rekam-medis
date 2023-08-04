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
                                <th>Nama Dokter</th>
                                <th>Shift</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($dokter->result_array() as $row) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['shift'] ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $row['tb_dokter_id'] ?>" style="margin-bottom: 2px">
                                            <div class="fa fa-edit"></div> Edit
                                        </button>
                                        <a href="<?= site_url('dokter/delete/') . $row['tb_dokter_id'] ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Ingin menghapus data ini">
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
            <form action="<?= site_url('dokter/insert') ?>" method="POST">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Dokter</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama Dokter" required>
                    </div>
                    <div class="form-group">
                        <label>Shift</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="shift" id="shift1" value="pagi">Pagi
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="shift" id="shift2" value="malam">Malam
                            </label>
                        </div>
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
<?php foreach ($dokter->result() as $edit) : ?>
    <div class="modal fade" id="editData<?= $edit->tb_dokter_id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?= $title ?></h4>
                </div>
                <form action="<?= site_url('dokter/update/') . $edit->tb_dokter_id ?>" method="POST">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Dokter</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="<?= $edit->nama ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Shift</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="shift" id="shift1" value="pagi" <?= $edit->shift === "pagi" ? "checked" : "" ?>>Pagi
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="shift" id="shift2" value="malam" <?= $edit->shift === "malam" ? "checked" : "" ?>>Malam
                                </label>
                            </div>
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