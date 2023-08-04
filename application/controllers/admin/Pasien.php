<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
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
        $data['title']      = 'Data Pasien';
        $data['subtitle']   = 'Semua data pasien akan ditampikan disini';

        $this->db->order_by('nomr', 'ASC');
        $data['pasien'] = $this->m_model->get_desc('tb_pasien');

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/pasien');
        $this->load->view('admin/templates/footer');
    }

    public function insert()
    {
        $post = $this->input->post(NULL, TRUE);

        $nama           = $post['nama'];
        $tempat_lahir   = $post['tempat_lahir'];
        $tgl_lahir      = $post['tgl_lahir'];
        $alamat         = $post['alamat'];
        $notelp         = $post['notelp'];
        $riwayat        = $post['riwayat'];
        $terdaftar      = date('Y-m-d H:i:s');

        $data = [
            'created'       => date('Y-m-d H:i:s'),
            'created_by'    => $this->session->userdata('id'),
            'updated'       => date('Y-m-d H:i:s'),
            'updated_by'    => $this->session->userdata('id'),
            'nomr'          => $this->getNomorMr(),
            'nama'          => $nama,
            'tempat_lahir'  => $tempat_lahir,
            'tgl_lahir'     => $tgl_lahir,
            'alamat'        => $alamat,
            'notelp'        => $notelp,
            'riwayat'       => $riwayat,
            'terdaftar'     => $terdaftar
        ];

        $this->m_model->insert($data, 'tb_pasien');
        $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan!');
        redirect('pasien');
    }

    public function update($id)
    {
        $post = $this->input->post(NULL, TRUE);

        $nama           = $post['nama'];
        $tempat_lahir   = $post['tempat_lahir'];
        $tgl_lahir      = $post['tgl_lahir'];
        $alamat         = $post['alamat'];
        $notelp         = $post['notelp'];
        $riwayat        = $post['riwayat'];

        $data = [
            'updated'       => date('Y-m-d H:i:s'),
            'updated_by'    => $this->session->userdata('id'),
            'nama'          => $nama,
            'tempat_lahir'  => $tempat_lahir,
            'tgl_lahir'     => $tgl_lahir,
            'alamat'        => $alamat,
            'notelp'        => $notelp,
            'riwayat'       => $riwayat
        ];

        $where = ['tb_pasien_id' => $id];

        $this->m_model->update($where, $data, 'tb_pasien');
        $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
        redirect('pasien');
    }

    public function delete($id)
    {
        $where = ['tb_pasien_id' => $id];

        $this->m_model->delete($where, 'tb_pasien');
        $this->session->set_flashdata('pesan', 'Data berhasil dihapus!');
        redirect('pasien');
    }

    private function getNomorMr()
    {
        $this->db->select('MAX(RIGHT(nomr,6)) as nomr');
        $sql = $this->m_model->get_desc('tb_pasien');

        $code = "";
        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $row) {
                $doc = ((int)$row->nomr + 1);
                $code = sprintf("%06s", $doc);
            }
        } else {
            $code = "000001";
        }

        return $code;
    }

    public function getPasien($noMr)
    {
        $where['nomr'] = $noMr;
        $data = $this->m_model->get_where($where, 'tb_pasien')->row();
        echo json_encode($data);
    }
}
