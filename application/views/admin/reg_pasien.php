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
                                <th>No. Pendaftaran</th>
                                <th>No. Rekam Medis</th>
                                <th>Nama Pasien</th>
                                <th>Alamat</th>
                                <th>Tanggal Lahir</th>
                                <th>Dokter</th>
                                <th>Jam Praktek</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($reg_pasien->result_array() as $row) : ?>
                                <?php
                                $where = array('tb_dokter_id' => $row['tb_dokter_id']);
                                $dok = $this->m_model->get_where($where, 'tb_dokter')->row();
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nopendaftaran'] ?></td>
                                    <td><?= $row['nomr'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['alamat'] ?></td>
                                    <td><?= $row['tgl_lahir'] ?></td>
                                    <td><?= $dok->nama ?></td>
                                    <td><?= $row['jam_kerja'] ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $row['tb_reg_pasien_id'] ?>" style="margin-bottom: 2px">
                                            <div class="fa fa-edit"></div> Edit
                                        </button>
                                        <a href="<?= site_url('reg_pasien/delete/') . $row['tb_reg_pasien_id'] ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Ingin menghapus data ini">
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
            <form action="<?= site_url('reg_pasien/insert') ?>" method="POST">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                <div class="modal-body">
                    <div class="form-group">
                        <label>No. Pendaftaran</label>
                        <input type="text" name="nopendaftaran" class="form-control" placeholder="AUTO" disabled>
                    </div>
                    <div class="form-group">
                        <label>No. Rekam Medis</label>
                        <select class="form-control select2" name="nomr" style="width: 100%;" required>
                            <option value="">Select Status</option>
                            <?php foreach ($pasien as $val) : ?>
                                <option value="<?= $val->nomr ?>"><?= $val->nomr ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Pasien</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" readonly>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control" placeholder="Tanggal lahir" readonly>
                    </div>
                    <div class="form-group">
                        <label>Dokter</label>
                        <select class="form-control select2" name="dokter" style="width: 100%;" required>
                            <option value="">Select Status</option>
                            <?php foreach ($dokter as $val) : ?>
                                <option value="<?= $val->tb_dokter_id ?>"><?= $val->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jam Praktek</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="shift" id="shift1" value="pagi" required>Pagi
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="shift" id="shift2" value="malam" required>Malam
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
<?php foreach ($reg_pasien->result() as $edit) : ?>
    <div class="modal fade" id="editData<?= $edit->tb_reg_pasien_id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?= $title ?></h4>
                </div>
                <form action="<?= site_url('reg_pasien/update/') . $edit->tb_reg_pasien_id ?>" method="POST">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>No. Pendaftaran</label>
                            <input type="text" name="nopendaftaran" class="form-control" placeholder="AUTO" value="<?= $edit->nopendaftaran ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>No. Rekam Medis</label>
                            <select class="form-control select2" name="nomr" style="width: 100%;" required>
                                <option value="">Select Status</option>
                                <?php foreach ($pasien as $val) : ?>
                                    <?php if ($edit->nomr == $val->nomr) : ?>
                                        <option value="<?= $val->nomr ?>" selected><?= $val->nomr ?></option>
                                    <?php else : ?>
                                        <option value="<?= $val->nomr ?>"><?= $val->nomr ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="<?= $edit->nama ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" rows="3" readonly><?= $edit->alamat ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control" placeholder="Tanggal lahir" value="<?= $edit->tgl_lahir ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Dokter</label>
                            <select class="form-control select2" name="dokter" style="width: 100%;" required>
                                <option value="">Select Status</option>
                                <?php foreach ($dokter as $val) : ?>
                                    <?php if ($edit->tb_dokter_id == $val->tb_dokter_id) : ?>
                                        <option value="<?= $val->tb_dokter_id ?>" selected><?= $val->nama ?></option>
                                    <?php else : ?>
                                        <option value="<?= $val->tb_dokter_id ?>"><?= $val->nama ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jam Praktek</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="shift" id="shift1" value="pagi" <?= $edit->jam_kerja === "pagi" ? "checked" : "" ?> required>Pagi
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="shift" id="shift2" value="malam" <?= $edit->jam_kerja === "malam" ? "checked" : "" ?> required>Malam
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