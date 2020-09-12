<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

	public function index()
	{
    if(!isset($this->session->user_id)) {
      header("Location: /account/login");
    }
    $viewData = array(
      'title' => $this->lang->line('account_title'),
      'headTitle' => $this->lang->line('account_title'),
      'headDesc' => 'puan'
    );
		$this->load->view('shared/header', $viewData);
		$this->load->view('pages/account_page', $viewData);
		$this->load->view('shared/footer', $viewData);
  }
  
  public function register()
  {
    $viewData = array(
      'title' => $this->lang->line('register_title'),
      'headTitle' => $this->lang->line('register_title'),
      'headDesc' => ''
    );

    if(isset($_POST['register'])) {
      $this->form_validation->set_rules('nameSurname', 'Display Name', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('userName', 'User Name', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required');

      if($this->form_validation->run() == TRUE) {
        $this->db->where('email', $this->input->post('email'));
        $query = $this->db->get('users');

        if($query->num_rows() > 0) {
          $viewData['validation_error'] = $this->lang->line('register_mail_error');
        } else {
          $formData = array(
            'name' => $this->input->post('nameSurname'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('userName'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
          );
          $result = $this->db->insert('users', $formData);
          if($result == 1){
            $sessionData = array(
              'user_id' => $this->db->insert_id(),
              'name' => $this->input->post('nameSurname'),
              'email' => $this->input->post('email'),
              'username' => $this->input->post('userName'),
            );
            $this->session->set_userdata($sessionData);
            header("Location: /account");
          } else {
            $viewData['validation_error'] = $this->lang->line('info_not_found');
          }
        }
      } else {
        $viewData['validation_error'] = $this->lang->line('register_all_areas');
      }
    }

    $this->load->view('shared/header', $viewData);
		$this->load->view('pages/register_page', $viewData);
		$this->load->view('shared/footer', $viewData);
  }

  public function login()
  {
    $viewData = array(
      'title' => $this->lang->line('login_title'),
      'headTitle' => $this->lang->line('login_title'),
      'headDesc' => ''
    );

    if(isset($_POST['login'])) {
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required');

      if($this->form_validation->run() == TRUE) {
        $this->db->where('email', $this->input->post('email'));
        $query = $this->db->get('users');

        if($query->row()) {
          if( password_verify($this->input->post('password'), $query->row()->password) ) {
            $sessionData = array(
              'user_id' => $query->row()->id,
              'name' => $query->row()->name,
              'email' => $query->row()->email,
              'username' => $query->row()->username,
              'is_admin' => $query->row()->is_admin,
            );
            $this->session->set_userdata($sessionData);
            header("Location: /account");
          } else {
            $viewData['validation_error'] = $this->lang->line('login_pass_ctrl');
          }
        } else {
          $viewData['validation_error'] = $this->lang->line('login_not_found_user');
        }
      } else {
        $viewData['validation_error'] = $this->lang->line('register_all_areas');
      }
    }
    
    $this->load->view('shared/header', $viewData);
		$this->load->view('pages/login_page', $viewData);
		$this->load->view('shared/footer', $viewData);
  }

  public function logout()
  {
    $this->session->sess_destroy();
    header("Location: /home");
  }


  public function myinfo()
  {
    if(!isset($this->session->user_id)) {
      header("Location: /account/login");
    }
    $viewData = array(
      'title' => $this->lang->line('account_title'),
      'headTitle' => $this->lang->line('account_title'),
      'headDesc' => 'puan'
    );

    if(isset($_POST['save'])) {
      $this->form_validation->set_rules('nameSurname', 'Display Name', 'required');
      $this->form_validation->set_rules('userName', 'User Name', 'required');

      if($this->form_validation->run() == TRUE) {
        $this->db->where('id', $this->session->user_id);
        $query = $this->db->get('users');

        if($query->num_rows() > 0) {
          $formData = array(
            'name' => $this->input->post('nameSurname'),
            'username' => $this->input->post('userName'),
          );
          $result = $this->db->update('users', $formData);
          if($result == 1){
            $sessionData = array(
              'name' => $this->input->post('nameSurname'),
              'username' => $this->input->post('userName'),
            );
            $this->session->set_userdata($sessionData);
            $viewData['success_text'] = $this->lang->line('info_save_success_text');
          } else {
            $viewData['validation_error'] = $this->lang->line('info_not_found');
          }
        } else {
          $viewData['validation_error'] = $this->lang->line('info_not_found');
        }
      } else {
        $viewData['validation_error'] = $this->lang->line('register_all_areas');
      }
    }

    $this->db->where('id', $this->session->user_id);
    $query = $this->db->get('users');
    if($query->row()) {
      $viewData['form_data']['name'] = $query->row()->name;
      $viewData['form_data']['email'] = $query->row()->email;
      $viewData['form_data']['username'] = $query->row()->username;
    }

		$this->load->view('shared/header', $viewData);
		$this->load->view('pages/account_info_page', $viewData);
		$this->load->view('shared/footer', $viewData);
  }


  public function changePass()
  {
    if(!isset($this->session->user_id)) {
      header("Location: /account/login");
    }
    $viewData = array(
      'title' => $this->lang->line('account_title'),
      'headTitle' => $this->lang->line('account_title'),
      'headDesc' => 'puan'
    );

    if(isset($_POST['passchange'])) {
      $this->form_validation->set_rules('password', 'Password', 'required');
      $this->form_validation->set_rules('password2', 'New Password', 'required');

      if($this->form_validation->run() == TRUE) {
        $this->db->where('id', $this->session->user_id);
        $query = $this->db->get('users');

        if($query->num_rows() > 0) {
          if( password_verify($this->input->post('password'), $query->row()->password) ) {
            $formData = array(
              'password' => password_hash($this->input->post('password2'), PASSWORD_DEFAULT),
            );
            $result = $this->db->update('users', $formData);
            if($result == 1){
              $viewData['success_text'] = $this->lang->line('info_save_success_text');
            } else {
              $viewData['validation_error'] = $this->lang->line('info_not_found');
            }
          } else {
            $viewData['validation_error'] = $this->lang->line('login_pass_ctrl');
          }
        } else {
          $viewData['validation_error'] = $this->lang->line('info_not_found');
        }
      } else {
        $viewData['validation_error'] = $this->lang->line('register_all_areas');
      }
    }

    $this->load->view('shared/header', $viewData);
		$this->load->view('pages/account_pass_page', $viewData);
		$this->load->view('shared/footer', $viewData);
  }


}
