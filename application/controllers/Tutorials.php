<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tutorials extends MY_Controller {

	public function index($id = null)
	{
		$viewData = array(
      'title' => $this->lang->line('tutorials_title'),
      'headTitle' => $this->lang->line('tutorials_page_title'),
      'headDesc' => $this->lang->line('tutorials_page_subtitle')
    );

		if(isset($_POST['model_id'])) {
			$id = $this->input->post('model_id');
			$this->db->where('id', $id);
			$res = $this->db->get('models');
			if($res->num_rows() > 0){
				$viewData['layout_link'] = "/upload_layouts/" . $res->row()->layout_file;
			} else {
				$viewData['result'] = $this->lang->line('tutorials_notfound');
			}
		}

		$this->load->view('shared/header', $viewData);
		$this->load->view('pages/tutorials_page', $viewData);
		$this->load->view('shared/footer', $viewData);
	}
}
