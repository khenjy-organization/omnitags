<?php
defined('BASEPATH') or exit('No direct script access allowed');

include 'Omnitags.php';

class C_tabel_b11 extends Omnitags
{
	// Pages
	// Public Pages


	// Account Only Pages


	// Admin Pages
	public function admin()
	{
		$this->declarew();
		$this->page_session_3();

		$data1 = array(
			'title' => lang('tabel_b11_alias_v3_title'),
			'konten' => $this->v3['tabel_b11'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_b11']),
			'tbl_b11' => $this->tl_b11->get_all_b11(),
		);

		$this->load_page('tabel_b11', '_layouts/template', $data1);
	}

	// Print all data
	public function laporan()
	{
		$this->declarew();
		$this->page_session_3();

		$data1 = array(
			'title' => lang('tabel_b11_alias_v4_title'),
			'konten' => $this->v4['tabel_b11'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_b11']),
			'tbl_b11' => $this->tl_b11->get_all_b11(),
		);

		$this->load_page('tabel_b11', '_layouts/printpage_landscape', $data1);
	}

	// Print one data



	// Functions
	// Add data
	public function tambah()
	{
		$this->declarew();
		$this->session_3();

		// $id = get_next_code($this->aliases['tabel_b11'], $this->aliases['tabel_b11_field1'], 'USR');

		$data = array(
			// $this->aliases['tabel_b11_field1'] => $id,
			$this->aliases['tabel_b11_field1'] => '',
			$this->aliases['tabel_b11_field2'] => userdata($this->aliases['tabel_c2_field1']),

			'created_at' => date("Y-m-d\TH:i:s"),
			'updated_at' => date("Y-m-d\TH:i:s"),
			'updated_by' => userdata($this->aliases['tabel_c2_field1']),
		);

		$aksi = $this->tl_b11->insert_b11($data);
	}
	
	//Soft Delete Data
	public function soft_delete($code = null)
	{
		$this->declarew();
		$this->session_3();

		$tabel = $this->tl_b11->get_b11_by_field('tabel_b11_field1', $code)->result();
		$this->check_data($tabel);

		// menggunakan nama khusus sama dengan konfigurasi
		$data = array(
			'deleted_at' => date("Y-m-d\TH:i:s"),
		); 

		$aksi = $this->tl_b11->update_b11($data, $code);
		$this->insert_history('tabel_b11', $data);

		$notif = $this->handle_4e($aksi, 'tabel_b11', $code);

		redirect($_SERVER['HTTP_REFERER']);
	}

	// Soft Delete data
	public function restore($code = null)
	{
		$this->declarew();
		$this->session_3();

		$tabel = $this->tl_b11->get_b11_by_field_archive('tabel_b11_field1', $code)->result();
		$this->check_data($tabel);

		// menggunakan nama khusus sama dengan konfigurasi
		$data = array(
			'deleted_at' => NULL,
			'updated_by' => userdata($this->aliases['tabel_c2_field1']),
		);

		$aksi = $this->tl_b11->update_b11($data, $code);
		$this->insert_history('tabel_b11', $data);

		$notif = $this->handle_4e($aksi, 'tabel_b11', $code);

		redirect($_SERVER['HTTP_REFERER']);
	}

	// Archive Page
	public function archive()
	{
		$this->declarew();
		$this->page_session_3();

		$data1 = array(
			'title' => lang('tabel_b11_alias_v9_title'),
			'konten' => $this->v9['tabel_b11'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_b11']),
			'tbl_b11' => $this->tl_b11->get_all_b11_archive(),
		);

		$this->load_page('tabel_b11', '_layouts/template', $data1);
	}

	// Public Pages
	public function detail_archive($code = null)
	{
		$this->declarew();
		$this->page_session_all();

		$tabel = $this->tl_b11->get_b11_by_field('tabel_b11_field1', $code)->result();
		$this->check_data($tabel);

		$data1 = array(
			'title' => lang('tabel_b11_alias_v10_title'),
			'konten' => $this->v10['tabel_b11'],
			'dekor' => $this->tl_b11->dekor($this->theme_id, $this->aliases['tabel_b11']),
			'tbl_b11' => $this->tl_b11->get_b11_by_field_archive('tabel_b11_field1', $code),
		);

		$this->load_page('tabel_b11', '_layouts/template', $data1);
	}
	
	public function history($code = null)
	{
		$this->declarew();
		$this->page_session_all();

		$tabel = $this->tl_b11->get_b11_by_field('tabel_b11_field1', $code)->result();
		$this->check_data($tabel);

		$data1 = array(
			'table_id' => $code,
			'title' => lang('tabel_b11_alias_v11_title'),
			'konten' => $this->v11['tabel_b11'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_b11']),
			'tbl_b11' => $this->tl_ot->get_by_field_history('tabel_b11', 'tabel_b11_field1', $code),
			'current' => $this->tl_ot->get_by_field('tabel_b11', 'tabel_b11_field1', $code),
		);

		$this->load_page('tabel_b11', '_layouts/template', $data1);
	}

	//Push History Data into current data
	public function push($code = null)
	{
		$this->declarew();
		$this->session_3();

		$tabel = $this->tl_ot->get_by_id_history('tabel_b11', $code)->result();
		$this->check_data($tabel);

		$code = $tabel[0]->{$this->aliases['tabel_b11_field1']};

		// menggunakan nama khusus sama dengan konfigurasi
		$data = array(
			$this->aliases['tabel_b11_field2'] => $tabel[0]->{$this->aliases['tabel_b11_field2']},

			'updated_at' => date("Y-m-d\TH:i:s"),
			'updated_by' => userdata($this ->aliases['tabel_c2_field1']),
		);

		$aksi = $this->tl_b11->update_b11($data, $tabel[0]->{$this->aliases['tabel_b11_field1']});

		$notif = $this->handle_4c($aksi, 'tabel_b11', $code);

		redirect($_SERVER['HTTP_REFERER']);
	}
}

