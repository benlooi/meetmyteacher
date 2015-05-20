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
		$password=$data->user->password;

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

		$userinfo=array (
			"user_id"=>$teacher->user_id,
			"role"=>"teacher",
			"status"=>"active"
			);

				$this->db->select('user_id');
				$query=$this->db->get_where('users',$userinfo);
				$query=$query->result_array();
				
				if (count($query)>0){

					$slotinfo = array (
						"teacher"=>$teacher->user_id,
						"date"=>$slot->date,
						"time"=>$slot->time,
						"status"=>"available"
						);


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
	public function bookSlot () {
		$data=json_decode(file_get_contents('php://input'));
		$slot_id=$data->slot_id;
		$student=$data->user_id;

		$userinfo=array (
			"user_id"=>$student,
			"role"=>"student",
			"status"=>"active"
			);
		$this->db->select("role, status");
		$query=$this-db->get_where("users",$userinfo);
		$query=$query->result_array();
		if (count($query)>0) {


				$this->db->select('status');
				$this->db->where('slot_id',$slot_id);
				$query=$this->db->get("slots");
				$query=$query->result_array();
				if (count($query)>0 && $query[0]['status']=='available'){
					$booking_info= array (
						"student_id"=>$student_id,
						"status"=>"booked"
						);
					$this->db->update('slots',$booking_info);
					$this->db->where('slot_id',$slot_id);
				$query=$this->db->get("slots");
				$query=$query->result_array();
				echo json_encode($query);
					

				} else if (count($query)>0 && $query[0]['status']=='booked') {
					echo "Slot unavailable";


				}
			} else {
				echo "Function not available";
			}
	}

	public function deleteSlot () {
		$data=json_decode(file_get_contents('php://input'));

		$teacher=$data->teacher;
		$slot=$data->slot;

		$userinfo=array (
			"user_id"=>$teacher->user_id,
			"role"=>"teacher",
			"status"=>"active"
			);

				$this->db->select('user_id');
				$query=$this->db->get_where('users',$userinfo);
				$query=$query->result_array();
				
				if (count($query)>0){
					$slotinfo = array (
						"teacher"=>$teacher->user_id,
						"date"=>$slot->date,
						"time"=>$slot->time,
						"status"=>"cancelled"
						);


					$this->db->update('slots',$slotinfo);
								if($this->db->affected_rows() > 0)
						{
						  echo 'slot cancelled';
						}




	}

}


public function updateSlot () {
		$data=json_decode(file_get_contents('php://input'));

		$teacher=$data->teacher;
		$slot=$data->slot;

		$userinfo=array (
			"user_id"=>$teacher->user_id,
			"role"=>"teacher",
			"status"=>"active"
			);

				$this->db->select('user_id');
				$query=$this->db->get_where('users',$userinfo);
				$query=$query->result_array();
				
				if (count($query)>0){
					$slotinfo = array (
						"teacher"=>$teacher->user_id,
						"date"=>$slot->date,
						"time"=>$slot->time,
						"status"=>"cancelled"
						);


					$this->db->update('slots',$slotinfo);
								if($this->db->affected_rows() > 0)
						{
						  echo 'slot updated';
						}




	}

}

	public function cancelBooking () {
		$data=json_decode(file_get_contents('php://input'));
		$slot_id=$data->slot_id;
		$student=$data->student_id;

		$this->db->select('status');
		$this->db->where('slot_id',$slot_id);
		$query=$this->db->get("slots");
		$query=$query->result_array();
		if (count($query)>0 && $query[0]['status']=='booked'){
			$booking_info= array (
				"student_id"=>""
				"status"=>"available"
				);
			$this->db->update('slots',$booking_info);
			$this->db->where('slot_id',$slot_id);
		$query=$this->db->get("slots");
		$query=$query->result_array();
		$query[0]['result']="updated";
		echo json_encode($query);
			

		} 


	}
}
