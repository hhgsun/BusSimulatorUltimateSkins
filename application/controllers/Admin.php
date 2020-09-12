<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function index()
	{
		$viewData = array(
      'title' => "ADMIN PANEL",
    );
		$this->load->view('admin/admin_header', $viewData);
		$this->load->view('admin/dash_page', $viewData);
		$this->load->view('admin/admin_footer', $viewData);
	}
	
	public function users($action = null)
	{
		$viewData = array(
			'title' => "KULLANICILAR",
			'users' => array(),
		);

		if(isset($action) && isset($_GET['id']) && isset($_GET['confirm'])){
			$id = $_GET['id'];
			$confirm = $_GET['confirm'];
			if($action == 'delete') {
				$this->db->where('id', $id);
				$this->db->delete('users');
				$viewData['result'] = 'Kullanıcı tamamen silindi';
			} else if($action == 'admin') {
				$this->db->set('is_admin', $confirm);
				$this->db->where('id', $id);
				$this->db->update('users');
				$viewData['result'] = $confirm == 0 ? 'Adminlikten kaldırıldı' : 'Admin Yapıldı';;
			} else if($action == 'editor'){
				$this->db->set('is_editor', $confirm);
				$this->db->where('id', $id);
				$this->db->update('users');
				$viewData['result'] = $confirm == 0 ? 'Editörlükten kaldırıldı' : 'Editör Yapıldı';;
			}
		}
		
		$this->db->order_by('id', 'DESC');
		$viewData['users'] = $this->db->get('users')->result();

		$this->load->view('admin/admin_header', $viewData);
		$this->load->view('admin/users_page', $viewData);
		$this->load->view('admin/admin_footer', $viewData);		
	}
	
	public function brands($action = null)
	{
		$viewData = array(
			'title' => "Markalar",
			'brands' => array(),
		);
		if($action == 'add') {
			if(isset($_POST['name'])) {
				$result = $this->db->insert( 'brands', array('name' => $this->input->post('name') ));
				$viewData['result'] = $result == 1 ? 'Marka Eklendi' : 'Beklenmedik Hata';
			}
		} else if($action == 'delete') {
			if(isset($_POST['id'])) {
				$this->db->where('id', $this->input->post('id') );
				$this->db->delete('brands');
				$viewData['result'] = 'Marka tamamen silindi';
			}
		}

		$this->db->order_by('id', 'DESC');
		$viewData['brands'] = $this->db->get('brands')->result();

		$this->load->view('admin/admin_header', $viewData);
		$this->load->view('admin/brands_page', $viewData);
		$this->load->view('admin/admin_footer', $viewData);
	}

	public function models($action = null)
	{
		$viewData = array(
			'title' => "Modeller",
			'brands' => array(),
		);
		if($action == 'add') {
			if(isset($_POST['name']) && isset($_POST['brand_id']) && isset($_FILES['layoutfile'])) {
				if($this->input->post('brand_id') != -1){
					$config['upload_path']    = './upload_layouts/'; // set
					$config['allowed_types']  = 'jpg|jpeg|png|psd|pdf|ai'; // set
					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('layoutfile') ) {
            $viewData['upload_error'] = $this->upload->display_errors();
          } else {
            $viewData['layoutfile_name'] = $this->upload->data()['file_name'];
					}
					
					if(!isset($viewData['upload_error'])) {
						$result = $this->db->insert( 'models', array(
							'name' => $this->input->post('name'),
							'brand_id' => $this->input->post('brand_id'),
							'layout_file' => $viewData['layoutfile_name'],
						));
						$viewData['result'] = $result == 1 ? 'Model Eklendi' : 'Beklenmedik Hata';
					}
				} else {
					$viewData['result'] = 'Marka seçimi yapınız';
				}
			} else {
				$viewData['result'] = 'İstenilen veriler gönderilmedi';
			}
		} else if($action == 'delete') {
			if(isset($_POST['id'])) {
				$this->db->where('id', $this->input->post('id') );
				$this->db->delete('models');
				$viewData['result'] = 'Model tamamen silindi';
			}
		}

		$this->db->select('models.id, models.name, models.layout_file, brands.name as brand_name');
		$this->db->from('brands');
		$this->db->join('models', 'brands.id = models.brand_id');
		$this->db->order_by('id', 'DESC');
		$viewData['models'] = $this->db->get()->result();

		$this->load->view('admin/admin_header', $viewData);
		$this->load->view('admin/models_page', $viewData);
		$this->load->view('admin/admin_footer', $viewData);
	}

	public function skins($action = null)
	{
		$viewData = array(
			'title' => "SKINLER",
			'skins' => array(),
		);
		if($action == 'add') {
			if(isset($_POST['name'])) {
				$result = $this->db->insert( 'models', array('name' => $this->input->post('name') ));
				$viewData['result'] = $result == 1 ? 'Model Eklendi' : 'Beklenmedik Hata';
			}
		} else if($action == 'delete') {
			if(isset($_POST['id'])) {
				$this->db->where('id', $this->input->post('id') );
				$this->db->delete('models');
				$viewData['result'] = 'Model tamamen silindi';
			}
		}

		$this->db->order_by('id', 'DESC');
		$viewData['skins'] = $this->db->get('skins')->result();

		$this->load->view('admin/admin_header', $viewData);
		$this->load->view('admin/skins_page', $viewData);
		$this->load->view('admin/admin_footer', $viewData);
	}
}
