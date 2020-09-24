<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skins extends MY_Controller {

  private function set_query_where_url_filter($str_db_key, $array_query = null) {
    if(isset($array_query)) {
      if(is_array($array_query)) {
        foreach ($array_query as $q_id => $value) {
          $this->db->where($str_db_key, $q_id);
        }
      }
    }
  }

  private function paginationSkinsList($page_number, $only_pack = false) {
    $resData = array(
      'pagination_count' => 0,
      'skin_list' => array(),
    );
    if(isset($_GET['filter_brands'])) {
      $this->set_query_where_url_filter('brand', $_GET['filter_brands']);
    }
    if(isset($_GET['filter_models'])) {
      $this->set_query_where_url_filter('model', $_GET['filter_models']);
    }
    // pagination count
    $this->db->select('packets.title as package_title, packets.id as package_id, skins.id, packets.status, packets.is_pack, packets.user_id, skins.title, skins.brand, skins.model, skins.skin_img, skins.screen_img, skins.description');
    $this->db->from('skins');
    $this->db->join('packets', 'packets.id = skins.package_id');
    $this->db->order_by('id', 'DESC');
    $this->db->where('status', 1);
    if($only_pack == true) {
      $this->db->where('is_pack', 1);
    }
    $skin_list = $this->db->get();
    if($skin_list->num_rows() > 0) {
      $one_list_count = 12;
      $current_page = isset($page_number) ? $page_number : 1;
      $offset_count = 0;
      if($current_page > 1) {
        $offset_count = ($current_page - 1) * $one_list_count;
      }
      $skin_total_number = $skin_list->num_rows();
      $resData['pagination_count'] = floor($skin_total_number / $one_list_count);
      if($skin_total_number % $one_list_count > 0) {
        $resData['pagination_count'] = $resData['pagination_count'] + 1;
      }
      if(isset($_GET['filter_brands'])) {
        $this->set_query_where_url_filter('brand', $_GET['filter_brands']);
      }
      if(isset($_GET['filter_models'])) {
        $this->set_query_where_url_filter('model', $_GET['filter_models']);
      }
      $this->db->select('packets.title as package_title, packets.id as package_id, skins.id, packets.status, packets.is_pack, packets.user_id, skins.title, skins.brand, skins.model, skins.skin_img, skins.screen_img, skins.description');
      $this->db->from('skins');
      $this->db->join('packets', 'packets.id = skins.package_id');
      $this->db->order_by('id', 'DESC');
      $this->db->where('status', 1);
      if($only_pack == true) {
        $this->db->where('is_pack', 1);
      }
      $skin_list = $this->db->limit($one_list_count, $offset_count)->get();
      $resData['skin_list'] = $skin_list->result();
    }
    return $resData;
  }

	public function index($page_number = null)
	{
    $viewData = array(
      'title' => $this->lang->line('skins_title'),
      'headTitle' => $this->lang->line('skins_page_title'),
      'headDesc' => $this->lang->line('skins_page_subtitle'),
      'pagination_count' => 0,
      'skin_list' => array(),
    );

    $data = $this->paginationSkinsList($page_number, 0);
    $viewData['skin_list'] = $data['skin_list'];
    $viewData['pagination_count'] = $data['pagination_count'];

		$this->load->view('shared/header.php', $viewData);
		$this->load->view('pages/skins_page.php', $viewData);
		$this->load->view('shared/footer.php', $viewData);
  }

  public function packs($page_number = null)
	{
    $viewData = array(
      'title' => $this->lang->line('packs_title'),
      'headTitle' => $this->lang->line('packs_page_title'),
      'headDesc' => $this->lang->line('packs_page_subtitle'),
      'pagination_count' => 0,
      'skin_list' => array(),
    );

    $data = $this->paginationSkinsList($page_number, 1);
    $viewData['skin_list'] = $data['skin_list'];
    $viewData['pagination_count'] = $data['pagination_count'];

		$this->load->view('shared/header.php', $viewData);
		$this->load->view('pages/skins_page.php', $viewData);
		$this->load->view('shared/footer.php', $viewData);
  }


  public function detail($skin_id = null)
  {
    $viewData = array(
      'title' => $this->lang->line('skins_title'),
      'headTitle' => $this->lang->line('skins_title'),
      'headDesc' => '',
      'skin_data' => null,
      'more_skins' => array(),
    );

    $this->db->where('id', $skin_id);
    $skin_data = $this->db->get('skins');
    if($skin_data->num_rows() > 0) {
      $viewData['skin_data'] = $skin_data->result()[0];

      $viewData['title'] = $viewData['skin_data']->title;
      $viewData['headTitle'] = $viewData['skin_data']->title;
    }

    $this->db->where('brand', $viewData['skin_data']->brand);
    $this->db->limit(4);
    $viewData['more_skins'] = $this->db->get("skins")->result();

		$this->load->view('shared/header.php', $viewData);
		$this->load->view('pages/skin_detail_page.php', $viewData);
		$this->load->view('shared/footer.php', $viewData);    
  }

  // UPLOAD CTRL - UPDATE SKIN
  public function uploadSkin($update_id = null)
  {
    if(!isset($this->session->user_id)) {
      header("Location: /account/login");
    }
    $viewData = array(
      'title' => $this->lang->line('uploadskin_title'),
      'headTitle' => $this->lang->line('uploadskin_page_title'),
      'headDesc' => $this->lang->line('uploadskin_page_subtitle'),
      'update_id' => $update_id,
    );

    if(isset($_GET['skin_sil']) && $update_id) {
      $this->db->where('id', $_GET['skin_sil']);
      $this->db->delete('skins');
    }

    if(isset($_POST['upload']) && isset($_FILES['skin']) && isset($_FILES['screenshot'])) {
      $formDataList = array();
      $config['upload_path']    = './uploads/'; // set
      $config['allowed_types']  = 'jpg|jpeg|png'; // set
      $config['max_size']       = '5000'; // set
      //$config['max_width']    = 1024;
      //$config['max_height']   = 768;
      $this->load->library('upload', $config);

      $count = count($_POST['title']);
      for($i=0;$i<$count;$i++){
        $formData = array();
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
            $config2['image_library'] = 'gd2';
            $config2['source_image'] = './uploads/' . $formData['skin_img'];
            $config2['create_thumb'] = FALSE;
            $config2['maintain_ratio'] = FALSE;
            $config2['width']         = 1024;
            $config2['height']       = 1024;
            $this->load->library('image_lib', $config2);
            if ( ! $this->image_lib->resize()) {
              echo $this->image_lib->display_errors();
            }
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
        $brand_model = explode("-", $this->input->post('model')[$i]);
        $formData['brand'] = $brand_model[0];
        $formData['model'] = $brand_model[1];
        $formData['description'] = $this->input->post('description')[$i];
        $formData['skin_id'] = isset($_POST['skin_ids']) ? $this->input->post('skin_ids')[$i] : 0;
        array_push($formDataList, $formData);
      }

      $package_id = null;

      if(isset( $_POST['package_title'] )) {
        if($update_id == null) {
          $p_data['title'] = $this->input->post('package_title');
          $p_data['user_id'] = $this->session->user_id;
          $this->db->insert('packets', $p_data);
          $package_id = $this->db->insert_id();
        } else {
          $this->db->set('title', $this->input->post('package_title'));
          $this->db->set('is_update', 1);
          $this->db->set('status', 0);
          $this->db->where('id', $update_id);
          $this->db->update('packets');
          $package_id = $update_id;
        }
      }

      if( $package_id ) {
        if(!isset($viewData['upload_error'])) {
          foreach ($formDataList as $key => $value) {
            if($value['skin_id'] && $value['skin_id'] != 0) {
              $skin_id = $value['skin_id'];
              unset($value['skin_id']);
              $this->db->set($value);
              $this->db->where('id', $skin_id);
              $result = $this->db->update('skins', $value);
            } else {
              unset($value['skin_id']);
              $value['package_id'] = $package_id;
              $result = $this->db->insert('skins', $value);
            }
            if($result != 1) {
              $viewData['upload_error'] = 'error';
            }
          }
        }
        if(!isset($viewData['upload_error'])){
          $viewData['upload_skin_success'] = $this->lang->line('success_upload_skin_text');
        }
      } else {
        $viewData['upload_error'] = 'Paket adı belirlenmemiş';
      }
    }
		$this->load->view('shared/header', $viewData);
		$this->load->view('pages/upload_skin_page', $viewData);
		$this->load->view('shared/footer', $viewData);
  }


  public function download($package_id = null)
  {
    if( isset($package_id) ) {

      $this->db->where('id', $package_id);
      $package = $this->db->get('packets')->row();

      $this->db->where('id', $package->user_id);
      $user = $this->db->get('users')->row();

      $this->db->where('package_id', $package_id);
      $skins = $this->db->get('skins')->result();

      if(isset($package)){
        header ("Content-Type:text/xml");
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        $xmlData = '
        <skins name="'. $package->title .'" decals="false" createdby="'. $user->username .'" version="' . ($package->is_update == 1 ? '1.1' : '1.0') . '">';
        foreach ($skins as $skey => $skin) {
          $xmlData = $xmlData . '<skin id="'. $skin->id .'" name="' . $package->title . '" title="'. $skin->title .'" url="http://'. site_url() .'uploads/'. $skin->skin_img .'"/>';
        }
        $xmlData = $xmlData . '</skins>';
        echo $xmlData;
      } else {
        echo 'BULUNAMADI';
      }
    }
  }

  public function most_download($package_id = null)
  {
    if(isset($package_id)) {
      $this->db->set('last_down_date', date('Y-m-d H:i:s'));
      $this->db->where('id', $package_id);
      if( $this->db->update('packets') ) {
        echo true;
      } else {
        echo false;
      }
    } else {
      echo false;
    }
  }

}
