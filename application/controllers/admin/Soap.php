<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Soap extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata('level')) {
      $this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
      redirect('home');
    }
  }

  public function index()
  {
    $data['title']      = 'SOAP Pasien';
    $data['subtitle']   = 'Semua data SOAP pasien akan ditampikan disini';

    $this->db->order_by('tb_reg_pasien_id', 'ASC');
    $data['reg_pasien'] = $this->m_model->get_desc('tb_reg_pasien');
    $this->db->order_by('tb_pasien_id', 'ASC');
    $data['pasien'] = $this->m_model->get_desc('tb_pasien')->result();
    $this->db->order_by('nama', 'ASC');
    $data['dokter'] = $this->m_model->get_desc('tb_dokter')->result();
    $this->db->order_by('tb_pasien_id', 'ASC');
    $data['daftarsoap'] = $this->m_model->get_desc('tb_soap');

    $this->load->view('admin/templates/header', $data);
    $this->load->view('admin/templates/sidebar');
    $this->load->view('admin/soap');
    $this->load->view('admin/templates/footer');
  }

  public function insert()
  {
    $post = $this->input->post(NULL, TRUE);

    $tb_reg_pasien_id           = $post['tb_reg_pasien_id'];
    $tb_pasien_id           = $post['tb_pasien_id'];
    $riwayat          = $post['tb_pasien_id'];
    $Keluhan         = $post['Keluhan'];
    $pemeriksaanpisik      = $post['pemeriksaanpisik'];
    $Diagnosa         = $post['Diagnosa'];
    $Resep          = $post['Resep'];

    $data = [
      'tanggalwaktu'       => date('Y-m-d H:i:s'),
      'created_by'          => $this->session->userdata('id'),
      'tb_reg_pasien_id'    => $tb_reg_pasien_id,
      'tb_pasien_id'        => $tb_pasien_id,
      'tb_pasien_id'        => $riwayat,
      'keluhan'             => $Keluhan,
      'pemeriksaan_fisik'   => $pemeriksaanpisik,
      'diagnosa'        => $Diagnosa,
      'resep'           => $Resep
    ];

    $this->m_model->insert($data, 'tb_soap');
    $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan!');
    redirect('soap');
  }

  public function update($id)
  {
    $post = $this->input->post(NULL, TRUE);

    $nomr           = $post['nomr'];
    $nama           = $post['nama'];
    $riwayat        = $post['riwayat'];
    $tgl_lahir      = $post['tgl_lahir'];
    $dokter         = $post['dokter'];
    $shift          = $post['shift'];

    $data = [
      'updated'       => date('Y-m-d H:i:s'),
      'updated_by'    => $this->session->userdata('id'),
      'nomr'          => $nomr,
      'nama'          => $nama,
      'riwayat'        => $riwayat,
      'tgl_lahir'     => $tgl_lahir,
      'tb_dokter_id'  => $dokter,
      'jam_kerja'     => $shift
    ];

    $where = ['tb_reg_pasien_id' => $id];

    $this->m_model->update($where, $data, 'tb_reg_pasien');
    $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
    redirect('reg_pasien');
  }

  public function delete($id)
  {
    $where = ['tb_reg_pasien_id' => $id];

    $this->m_model->delete($where, 'tb_reg_pasien');
    $this->session->set_flashdata('pesan', 'Data berhasil dihapus!');
    redirect('reg_pasien');
  }

  private function getNomorPend()
  {
    $this->db->select('MAX(RIGHT(nopendaftaran,6)) as nopendaftaran');
    $sql = $this->m_model->get_desc('tb_reg_pasien');

    $code = "";
    if ($sql->num_rows() > 0) {
      foreach ($sql->result() as $row) {
        $doc = ((int)$row->nopendaftaran + 1);
        $code = sprintf("%06s", $doc);
      }
    } else {
      $code = "000001";
    }

    return $code;
  }
}
