<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends CI_Controller
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
        $data['title']      = 'Data Dokter';
        $data['subtitle']   = 'Semua data dokter akan ditampikan disini';

        $this->db->order_by('nama', 'ASC');
        $data['dokter'] = $this->m_model->get_desc('tb_dokter');

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/dokter');
        $this->load->view('admin/templates/footer');
    }

    public function insert()
    {
        $post = $this->input->post(NULL, TRUE);

        $nama           = $post['nama'];
        $noinduk           = $post['noinduk'];
        $haripraktek           = $post['haripraktek'];
        $shift          = $post['shift'];
        $terdaftar      = date('Y-m-d H:i:s');

        $data = [
            'created'       => date('Y-m-d H:i:s'),
            'created_by'    => $this->session->userdata('id'),
            'updated'       => date('Y-m-d H:i:s'),
            'updated_by'    => $this->session->userdata('id'),
            'noinduk'          => $noinduk,
            'nama'          => $nama,
            'haripraktek'          => $haripraktek,
            'shift'         => $shift,
            'terdaftar'     => $terdaftar
        ];

        $this->m_model->insert($data, 'tb_dokter');
        $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan!');
        redirect('dokter');
    }

    public function update($id)
    {
        $post = $this->input->post(NULL, TRUE);

        $noinduk           = $post['noinduk'];
        $nama           = $post['nama'];
        $haripraktek           = $post['haripraktek'];
        $shift          = $post['shift'];

        $data = [
            'updated'       => date('Y-m-d H:i:s'),
            'updated_by'    => $this->session->userdata('id'),
            'noinduk'          => $noinduk,
            'haripraktek'          => $haripraktek,
            'nama'          => $nama,
            'shift'         => $shift
        ];

        $where = ['tb_dokter_id' => $id];

        $this->m_model->update($where, $data, 'tb_dokter');
        $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
        redirect('dokter');
    }

    public function delete($id)
    {
        $where = ['tb_dokter_id' => $id];

        $this->m_model->delete($where, 'tb_dokter');
        $this->session->set_flashdata('pesan', 'Data berhasil dihapus!');
        redirect('dokter');
    }
}
