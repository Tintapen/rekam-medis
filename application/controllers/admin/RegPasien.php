<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RegPasien extends CI_Controller
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
        $data['title']      = 'Registerasi Pasien';
        $data['subtitle']   = 'Semua data registerasi pasien akan ditampikan disini';
        $data['reg_pasien'] = $this->m_model->get_desc('tb_reg_pasien');
        $this->db->order_by('tb_pasien_id', 'ASC');
        $data['pasien'] = $this->m_model->get_desc('tb_pasien')->result();
        $this->db->order_by('nama', 'ASC');
        $data['dokter'] = $this->m_model->get_desc('tb_dokter')->result();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/reg_pasien');
        $this->load->view('admin/templates/footer');
    }

    public function insert()
    {
        $post = $this->input->post(NULL, TRUE);

        $tb_pasien_id           = $post['tb_pasien_id'];
        $nama           = $post['nama'];
        $alamat         = $post['alamat'];
        $tgl_lahir      = $post['tgl_lahir'];
        $dokter         = $post['dokter'];
        $shift          = $post['shift'];
        $terdaftar      = date('Y-m-d H:i:s');
        $umur           = date('Y') - date('Y', strtotime($tgl_lahir));

        $data = [
            'tb_reg_pasien_id'  => $this->getNomorRg(),
            'created'       => date('Y-m-d H:i:s'),
            'created_by'    => $this->session->userdata('id'),
            'updated'       => date('Y-m-d H:i:s'),
            'updated_by'    => $this->session->userdata('id'),
            'tb_pasien_id'          => $tb_pasien_id,
            'nama'          => $nama,
            'alamat'        => $alamat,
            'umur'     => $umur,
            'tb_dokter_id'  => $dokter,
            'jam_kerja'     => $shift,
            'terdaftar'     => $terdaftar
        ];

        $this->m_model->insert($data, 'tb_reg_pasien');
        $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan!');
        redirect('reg_pasien');
    }
    private function getNomorRg()
    {
        $this->db->select('MAX(RIGHT(tb_reg_pasien_id,6)) as tb_reg_pasien_id');
        $sql = $this->m_model->get_desc('tb_reg_pasien');

        $code = "";
        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $row) {
                $doc = ((int)$row->tb_reg_pasien_id + 1);
                $code = date('ymd') . '' . sprintf("%06s", $doc);
            }
        } else {
            $code = date('ymd') . '' . "000001";
        }

        return $code;
    }

    public function update($id)
    {
        $post = $this->input->post(NULL, TRUE);

        $tb_pasien_id           = $post['tb_pasien_id'];
        $nama           = $post['nama'];
        $alamat         = $post['alamat'];
        $dokter         = $post['dokter'];
        $shift          = $post['shift'];

        $data = [
            'updated'       => date('Y-m-d H:i:s'),
            'updated_by'    => $this->session->userdata('id'),
            'tb_pasien_id'          => $tb_pasien_id,
            'nama'          => $nama,
            'alamat'        => $alamat,
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
}
