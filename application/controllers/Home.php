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


		$this->db->select('packets.title as package_title, packets.id as package_id, skins.id, packets.status, packets.is_pack, packets.editor_choice, packets.user_id, skins.title, skins.brand, skins.model, skins.skin_img, skins.screen_img, skins.description');
    $this->db->from('skins');
    $this->db->join('packets', 'packets.id = skins.package_id');
    $this->db->order_by('id', 'DESC');
    $this->db->where('status', 1);
		$this->db->where('editor_choice', 1);
    $viewData['editor_choice'] = $this->db->get()->row();
		
		$this->db->order_by('id', 'DESC');
		$this->db->limit(8);
		$viewData['brands'] = $this->db->get('brands')->result();

		$this->db->order_by('id', 'DESC');
		$this->db->limit(4);
		$viewData['new_skins'] = $this->db->get('skins')->result();

		$this->db->select('packets.title as package_title, packets.id as package_id, skins.id, packets.last_down_date, packets.status, packets.user_id, skins.title, skins.brand, skins.model, skins.skin_img, skins.screen_img, skins.description');
		$this->db->from('skins');
		$this->db->join('packets', 'packets.id = skins.package_id');
		$this->db->order_by('last_down_date', 'DESC');
		$this->db->where('status', 1);
		$this->db->limit(4);
		$viewData['most_down_skins'] = $this->db->get()->result();

		$this->db->select('packets.title as package_title, packets.id as package_id, skins.id, packets.last_down_date, packets.status, packets.user_id, skins.title, skins.brand, skins.model, skins.skin_img, skins.screen_img, skins.description');
		$this->db->from('skins');
		$this->db->join('packets', 'packets.id = skins.package_id');
		$this->db->order_by('id', 'DESC');
		$this->db->where('status', 1);
		$this->db->where('is_pack', 1);
		$this->db->limit(4);
		$viewData['skin_packs'] = $this->db->get()->result();



		$this->load->view('shared/header', $viewData);
		$this->load->view('pages/home_page', $viewData);
		$this->load->view('shared/footer', $viewData);
	}
}
