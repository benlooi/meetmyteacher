<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function login () {
		$data=json_decode(file_get_contents('php://input'));
		$username=$data->user->username;
		$password=$data->user->password;

		$user=array (
			'username'=>$username,
			'password'=>$password,
			"role"=>"admin"

			);
		$this->db->select('fname,lname,role,user_id');
		$query=$this->db->get_where("users",$user);
		$query=$query->result_array();
		if (count($query)>0) {
			json_encode($query);

			$loginfo= array (
				"user_id"=>$query[0]['user_id'];
				);
			$this->db->insert('userlog',$loginfo);

		} else if (count($query)==0) {
			echo "user not found";
		}



	}

	public function createUser () {
		$data=json_decode(file_get_contents('php://input'));
		$newuser=$data->newuser;
		
		$userinfo=array (
			"user_id"=>$data->user_id,
			"role"=>$data->role,
			"status"=>$data->status
			);

				$this->db->select('user_id');
				$query=$this->db->get_where('users',$userinfo);
				$query=$query->result_array();
				
				if (count($query)>0){

					$userinfo=array (
			"user_id"=>$data->user_id,
			"role"=>$data->role,
			"status"=>$data->status
			);


					$this->db->insert('users',$userinfo);
								if($this->db->affected_rows() > 0)
						{
						  echo 'user created';
						}
						else {
							echo 'cannot create user...error!';
						}
					}

	}
	
}
