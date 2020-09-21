<?php
	class User_model extends CI_Model{
		public function register($enc_password){
			$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => $enc_password,
				'zipcode' => $this->input->post('zipcode'),
				'role_id' => $this->input->post('role_id')
			);

			return $this->db->insert('users',$data);
		}

		public function login($username,$password){
			$this->db->where('username',$username);
			$this->db->where('password',$password);

			$result = $this->db->get('users');

			if($result->num_rows() == 1){
				return array(
				'user_id' => $result->row(0)->id,
				'email'=> $result->row(0)->email,
				'role_id'=> $result->row(0)->role_id
				);
			}else{
				return false;
			}

		}

		public function check_username_exists($username){
			$query = $this->db->get_where('users',array('username' => $username));
			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}

		public function get_user(){
				$this->db->order_by('id','DESC');
				$query = $this->db->get('users');
				return $query->result_array();
			
		}

		public function update_users(){

			$data = array(
				'role_id' => $this->input->post('role_id'),
			);

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('users', $data);
		}

		public function check_email_exists($email){


			$query = $this->db->get_where('users',array('email' => $email));
			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}
	}