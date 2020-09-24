<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends MY_Controller {

	public function index($id = null)
	{
		$viewData = array(
      'title' => $this->lang->line('reports_title'),
      'headTitle' => $this->lang->line('reports_page_title'),
      'headDesc' => $this->lang->line('reports_page_subtitle')
    );

    if(isset($_POST['dmca'])) {
      $formData = array(
        'name' => $this->input->post('nameSurname'),
        'email' => $this->input->post('email'),
        'company' => $this->input->post('company'),
        'mod_url' => $this->input->post('mod'),
        'document' => $this->input->post('document'),
        'complaint' => $this->input->post('complaint'),
      );
      if(!empty($_FILES['document'])) {
        $config['upload_path']    = './report_docs/'; // set
        $config['allowed_types']  = 'jpg|jpeg|png'; // set
        $config['max_size']       = '5000'; // set
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('document') ) {
          $viewData['upload_error'] = $this->upload->display_errors();
        } else {
          $formData['document'] = $this->upload->data()['file_name'];
        }
      }

      if( $this->db->insert('reports', $formData) ) {
        $viewData['success_msg'] = "İletiniz Gönderildi";
      }
    }

		$this->load->view('shared/header', $viewData);
		$this->load->view('pages/report_page', $viewData);
		$this->load->view('shared/footer', $viewData);
	}
}
