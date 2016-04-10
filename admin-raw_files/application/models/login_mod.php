<?php

class Login_mod extends CI_Model{

	function __construct(){

		parent:: __construct();

	}

	function encryptIt($q) {

		$cryptKey  = 'qJB0rGtInNSB1xG03efyCp';

		$qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );

		return( $qEncoded );

	}	

	function login_user($info){

		$res = array();

		$pass = $this->encryptIt($info['password']);

		$sql = "SELECT * FROM `admin` WHERE `username`='".mysql_real_escape_string($info['username'])."' AND `password`='".$pass."'"; 		

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();			

		}		

		return $res;

	}

	

	public function get_leagues(){

		$sql = "SELECT * FROM `leagues`";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();			

		}		

		return $res;

	}

}