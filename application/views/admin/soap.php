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
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>No. Reg</th>
                                <th>No. Rekam Medis</th>
                                <th>Nama Pasien</th>
                                <th>Riwayat Alergi Obat</th>
                                <th>Umur</th>
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
                                $where = array('tb_pasien_id' => $row['tb_pasien_id']);
                                $pasien = $this->m_model->get_where($where, 'tb_pasien')->row();
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['tb_reg_pasien_id'] ?></td>
                                    <td><?= $row['tb_pasien_id'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $pasien->riwayat ?></td>
                                    <td><?= $row['umur'] ?></td>
                                    <td><?= $dok->nama ?></td>
                                    <td><?= $row['jam_kerja'] ?></td>
                                    <td>
                                        <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#editData<?= $row['tb_reg_pasien_id'] ?>" style="margin-bottom: 2px">
                                            <div class="fa fa-paper-plane"></div> SOAP
                                        </button>
                                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#RiwayatData<?= $row['tb_pasien_id'] ?>" style="margin-bottom: 2px">
                                            <div class="fa fa-edit"></div> Riwayat
                                        </button>

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

<!-- Modal SOAP -->
<?php foreach ($reg_pasien->result() as $edit) : ?>
    <div class="modal fade" id="editData<?= $edit->tb_reg_pasien_id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?= $title ?></h4>
                </div>

                <form action="<?= site_url('soap/insert/') ?>" method="POST">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>No. Reg</label>
                            <input type="text" name="tb_reg_pasien_id" class="form-control" placeholder="AUTO" value="<?= $edit->tb_reg_pasien_id; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>No. Rekam Medis</label>
                            <input type="text" name="tb_pasien_id" class="form-control" placeholder="AUTO" value="<?= $edit->tb_pasien_id; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="<?= $edit->nama ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Umur</label>
                            <input type="number" name="tgl_lahir" class="form-control" placeholder="Tanggal lahir" value="<?= $edit->umur ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Keluhan</label>
                            <textarea class="form-control" name="Keluhan" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Pemeriksaan Fisik</label>
                            <textarea class="form-control" name="pemeriksaanpisik" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Diagnosa</label>
                            <textarea class="form-control" name="Diagnosa" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Resep</label>
                            <textarea class="form-control" name="Resep" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Dokter</label>
                            <select class="form-control select2" name="dokter" style="width: 100%;" disabled required>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                            <div class="fa fa-times"></div> Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <div class="fa fa-save"></div> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Data Hystori Soap -->
<?php
foreach ($daftarsoap->result() as $data) { ?>
    <div class="modal fade" id="RiwayatData<?= $data->tb_pasien_id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">History <?= $title ?></h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th width="10px">#</th>
                                    <th>No. Reg</th>
                                    <th>Waktu Kunjungan</th>
                                    <th>Keluhan</th>
                                    <th>Pemeriksaan Fisik</th>
                                    <th>Diagnosa</th>
                                    <th>Resep</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $query = $this->db->where('tb_pasien_id', $data->tb_pasien_id)->get('tb_soap');
                                foreach ($query->result() as $row) {

                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row->tb_reg_pasien_id ?></td>
                                        <td><?= $row->tanggalwaktu ?></td>
                                        <td><?= $row->keluhan ?></td>
                                        <td><?= $row->pemeriksaan_fisik ?></td>
                                        <td><?= $row->diagnosa ?></td>
                                        <td><?= $row->resep ?></td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
} ?>