<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('level')) {
			$this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
			redirect('home');
		}
		include_once APPPATH . '../vendor/autoload.php'; //library Mpdf
	}

	public function index()
	{
		$data['title']      = 'Laporan';
		$data['subtitle']   = 'Semua data akan ditampikan disini';

		$this->db->order_by('nama', 'ASC');
		$data['dokter'] = $this->m_model->get_desc('tb_dokter');

		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/laporan');
		$this->load->view('admin/templates/footer');
	}

	public function cetak()
	{

		$post = $this->input->post(NULL, TRUE);
		$dari           = $post['dari'];
		$sampai           = $post['sampai'];

		$content = '
		<style type="text/css">
		
		.table1 {
			font-family: times new roman;
			color: #232323;
			border-collapse: collapse;
			border: 1px;
		}
		.label{
			border-style: solid;
			line-height: 20px;
		}

		</style>
		<h3 align="center">LAPORAN REKAM MEDIS KLINIK DR SHABRINA GHASSANI ROZA (' . $dari . ' s/d ' . $sampai . ')</h3>
		<table class="table1" border="1"  width="100%" >
		<tr style="background-color: #6495ED;">
		<th>No</th>
		<th>Tanggal </th>
		<th>No Reg</th>
		<th>No RM</th>
		<th>Nama Pasien</th>
		<th>Keluhan</th>
		<th>Resep</th>    
		<th>Diagnosa</th> 
		<th>Dokter</th>
		</tr>';
		$no = 1;
		if ($this->session->userdata('level') == 'Dokter') {
			$sql = $this->db->query('SELECT a.tb_soap_id,a.tb_reg_pasien_id,a.tanggalwaktu,a.tb_pasien_id,a.tb_dokter_id,a.keluhan,a.pemeriksaan_fisik,a.diagnosa,a.resep,a.created_by,b.nama,c.nama as nmdokter FROM tb_soap a 
    INNER JOIN tb_pasien b ON a.tb_pasien_id=b.tb_pasien_id
    INNER JOIN tb_dokter c ON a.tb_dokter_id=c.tb_dokter_id where a.tb_dokter_id=' . $this->session->userdata('dokter') . ' AND date(tanggalwaktu) between "' . $dari . '" AND "' . $sampai . '"   order by tb_soap_id desc');
		} else {
			$sql = $this->db->query('SELECT a.tb_soap_id,a.tb_reg_pasien_id,a.tanggalwaktu,a.tb_pasien_id,a.tb_dokter_id,a.keluhan,a.pemeriksaan_fisik,a.diagnosa,a.resep,a.created_by,b.nama,c.nama as nmdokter FROM tb_soap a 
    INNER JOIN tb_pasien b ON a.tb_pasien_id=b.tb_pasien_id
    INNER JOIN tb_dokter c ON a.tb_dokter_id=c.tb_dokter_id where date(tanggalwaktu) between "' . $dari . '" AND "' . $sampai . '"   order by tb_soap_id desc');
		}

		foreach ($sql->result() as $view) {

			$content .= '<tr>
			<td align="center" width="40px">' . $no . '</td>
			<td align="center" width="100px">' . date('d/m/Y', strtotime($view->tanggalwaktu)) . '</td>
			<td align="center" width="110px">' . $view->tb_reg_pasien_id   . '</td>
			<td align="center" width="80px">' . $view->tb_pasien_id . '</td>
			<td align="left" width="50px">' . $view->nama . '</td>
			<td align="left" width="100px">' . $view->keluhan . '</td>
			<td align="left" width="200px">' . $view->resep . '</td>
			<td width="100px">' . $view->diagnosa . '</td>
      <td width="100px">' . $view->nmdokter . '</td>
			</tr>';
			$no++;
		}

		$content .= '</table>
		<br>	
		<table>
		<tr>
		<td>Dibuat Oleh</td>
		<td width="600px"></td>
		<td>Jakarta,' . date('d/m/Y') . ' <br> Disetujui Oleh</td>
		</tr>
		<tr>
		<td><br> <br><br> <br></td>
		<td></td>
		<td></td>
		</tr>
		<tr>
		<td>( ' . $this->session->userdata('nama') . ' )</td>
		<td></td>
		<td>( dr.Shabrina Ghassani Roza )</td>
		</tr>
		</table>';

		$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
		$mpdf->AddPage('L');
		$mpdf->WriteHTML($content);
		$mpdf->Output();
	}
}
