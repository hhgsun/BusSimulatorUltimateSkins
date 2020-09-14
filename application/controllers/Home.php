<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
		$viewData = array(
      'title' => $this->lang->line('home_title'),
      'headTitle' => $this->lang->line('home_page_title'),
      'headDesc' => $this->lang->line('home_page_subtitle')
		);
		
		$this->db->order_by('id', 'DESC');
		$this->db->limit(8);
		$viewData['brands'] = $this->db->get('brands')->result();

		$this->load->view('shared/header', $viewData);
		$this->load->view('pages/home_page', $viewData);
		$this->load->view('shared/footer', $viewData);
	}
}
