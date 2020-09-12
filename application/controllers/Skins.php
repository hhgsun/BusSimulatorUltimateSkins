<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skins extends MY_Controller {

	public function index()
	{
    $viewData = array(
      'title' => $this->lang->line('skins_title'),
      'headTitle' => $this->lang->line('skins_title'),
      'headDesc' => $this->lang->line('skins_title')
    );
		$this->load->view('shared/header.php', $viewData);
		$this->load->view('pages/home_page.php', $viewData);
		$this->load->view('shared/footer.php', $viewData);
  }

  public function uploadSkin()
  {
    if(!isset($this->session->user_id)) {
      header("Location: /account/login");
    }
    $viewData = array(
      'title' => $this->lang->line('uploadskin_title'),
      'headTitle' => $this->lang->line('uploadskin_page_title'),
      'headDesc' => $this->lang->line('uploadskin_page_subtitle')
    );

    if(isset($_POST['upload']) && isset($_FILES['skin']) && isset($_FILES['screenshot'])) {
      $formDataList = array();
      $formData = array(
        'user_id' => $this->session->user_id,
        'name' => $this->input->post('nameSurname'),
        'email' => $this->input->post('email'),
        'business' => $this->input->post('company'),
        'credits' => $this->input->post('credits'),
      );
      $config['upload_path']    = './uploads/'; // set
      $config['allowed_types']  = 'jpg|jpeg|png'; // set
      $config['max_size']       = '5000'; // set
      //$config['max_width']    = 1024;
      //$config['max_height']   = 768;
      $this->load->library('upload', $config);

      $count = count($_FILES['skin']['name']);
      for($i=0;$i<$count;$i++){
        // upload skin
        if(!empty($_FILES['skin']['name'][$i])) {
          $_FILES['file']['name']     = $_FILES['skin']['name'][$i];
          $_FILES['file']['type']     = $_FILES['skin']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['skin']['tmp_name'][$i];
          $_FILES['file']['error']    = $_FILES['skin']['error'][$i];
          $_FILES['file']['size']     = $_FILES['skin']['size'][$i];
          if ( ! $this->upload->do_upload('file') ) {
            $viewData['upload_error'][] = $this->upload->display_errors();
          } else {
            $formData['skin_img'] = $this->upload->data()['file_name'];
          }
        }
        // upload screenshot
        if(!empty($_FILES['screenshot']['name'][$i])) {
          $_FILES['file2']['name']     = $_FILES['screenshot']['name'][$i];
          $_FILES['file2']['type']     = $_FILES['screenshot']['type'][$i];
          $_FILES['file2']['tmp_name'] = $_FILES['screenshot']['tmp_name'][$i];
          $_FILES['file2']['error']    = $_FILES['screenshot']['error'][$i];
          $_FILES['file2']['size']     = $_FILES['screenshot']['size'][$i];
          if ( ! $this->upload->do_upload('file2') ) {
            $viewData['upload_error'][] = $this->upload->display_errors();
          } else {
            $formData['screen_img'] = $this->upload->data()['file_name'];
          }
        }
        $formData['title'] = $this->input->post('title')[$i];
        // $formData['manufacturers'] = $this->input->post('manufacturers')[$i];
        // $formData['model'] = $this->input->post('model')[$i];
        $brand_model = explode("-", $this->input->post('model')[$i]);
        $formData['manufacturers'] = $brand_model[0];
        $formData['model'] = $brand_model[1];
        $formData['description'] = $this->input->post('description')[$i];
        array_push($formDataList, $formData);
      }

      if(!isset($viewData['upload_error'])) {
        foreach ($formDataList as $key => $value) {
          $result = $this->db->insert('skins', $value);
          if($result != 1) {
            $viewData['upload_error'] = 'error';
          }
        }
      }
      if(!isset($viewData['upload_error'])){
        $viewData['upload_skin_success'] = $this->lang->line('success_upload_skin_text');
      }
    }
		$this->load->view('shared/header', $viewData);
		$this->load->view('pages/upload_skin_page', $viewData);
		$this->load->view('shared/footer', $viewData);
  }
}
