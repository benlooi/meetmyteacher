<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$username=$data->user->password;

		$user=array (
			'username'=>$username,
			'password'=>$password

			);
		$this->db->select('fname,lname,role,user_id');
		$query=$this->db->get_where("users",$user);
		$query=$query->result_array();
		if (count($query)>0) {
			json_encode($query);

		} else if (count($query)==0) {
			echo "user not found";
		}



	}

	public function createSlot () {
		$data=json_decode(file_get_contents('php://input'));
		$teacher=$data->teacher;
		$slot=$data->slot;

		$slotinfo = array (
			"teacher"=>$teacher->user_id;
			"date"=>$slot->date;
			"time"=>$slot->time;
			)


		$this->db->insert('slots',$slotinfo);
					if($this->db->affected_rows() > 0)
			{
			  echo 'slot created';
			}
			else {
				echo 'cannot create...error!';
			}


	}
}
