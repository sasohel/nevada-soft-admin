<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {
	function __construct(){
		parent::__construct();		
		$this->load->library('session');
		$this->load->helper('URL');
	}
	public function index()	{
		if($this->session->userdata('uid')!='' && $this->session->userdata('uid') > 0){			
			$this->session->unset_userdata('uid');
			redirect();
		}
	}
}
