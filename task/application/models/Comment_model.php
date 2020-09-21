<?php
	class Comment_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function create_comment($post_id){
			$data = array(
				'post_id' => $post_id,
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'body' => $this->input->post('body'),
				'request' => $this->input->post('request')
			);

			return $this->db->insert('comments', $data);
		}

		public function get_all_comments(){
			$query = $this->db->get('comments');
			return $query->result_array();
		}

		public function get_comments($post_id){
			$array = array(
				'post_id' => $post_id,
				'request' => 1
			);
			$query = $this->db->get_where('comments', $array);
			return $query->result_array();
		}

		public function get_requests($post_id){
			$array = array(
				'post_id' => $post_id,
				'request' => 0
			);
			$query = $this->db->get_where('comments', $array);
			return $query->result_array();
		}

		public function update_comments($id){

			$data = array(
				'request' => 1,
			);

			$this->db->where('id', $id);
			return $this->db->update('comments', $data);
		}
		public function delete_comments($id){
			$this->db->where('id', $id);
			$this->db->delete('comments');
			return true;
		}
	}