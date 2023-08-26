<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Html2Text\Html2Text;

class Home extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('level') == 'Administrator' or $this->session->userdata('level') == 'Dokter') {
            redirect('dashboard');
        } else {
            $data['title']  = 'Login';
            $this->load->view('v_login', $data);
        }
    }

    public function login()
    {
        if ($this->session->userdata('level') == 'Administrator' or $this->session->userdata('level') == 'Dokter') {
            redirect('dashboard');
        } else {
            $data['title']  = 'Login';
            $this->load->view('v_login', $data);
        }
    }

    public function auth()
    {
        $post = $this->input->post(NULL, TRUE);
        $cleanPost = $this->security->xss_clean($post);
        $username   = $post['username'];
        $password   = $cleanPost['password'];

        $where = array('username' => $username);
        $cek = $this->m_model->get_where($where, 'tb_user');

        if ($cek->num_rows() > 0) {
            foreach ($cek->result_array() as $row) {

                if (password_verify($password, $row['password'])) {

                    $datauser = array(
                        'id'            => $row['tb_user_id'],
                        'nama'          => $row['nama'],
                        'telp'          => $row['telp'],
                        'email'         => $row['email'],
                        'username'      => $row['username'],
                        'skin'          => $row['skin'],
                        'level'         => $row['level'],
                        'foto'          => $row['foto']
                    );

                    $this->session->set_userdata($datauser);
                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata('pesan', 'Password anda salah!');
                    redirect();
                }
            }
        } else {
            $this->session->set_flashdata('pesan', 'Username tidak ditemukan!');
            redirect();
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
