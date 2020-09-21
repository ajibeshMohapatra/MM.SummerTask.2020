<?php
	class Forum_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}
		public function get_forums($id = FALSE){

			if ($id === FALSE) {
				$this->db->order_by('id', 'ASC');
				$query = $this->db->get('forums');
				return $query->result_array();
			}

			$query = $this->db->get_where('forums',array('id' => $id));
			return $query->row_array();
		}
		public function create_forum(){

			$data = array(
				'forum_title' => $this->input->post('forum_title'),
				'forum_body' => $this->input->post('forum_body'),
				'username' =>$this->session->userdata('username')
			);

			return $this->db->insert('forums', $data);
		}

		public function create_reply($forum_id){
			$data = array(
				'forum_id' => $forum_id,
				'username' => $this->input->post('username'),
				'reply' => $this->input->post('reply')
			);

			return $this->db->insert('forum_replies', $data);
		}

		public function get_replies($forum_id){
			$array = array(
				'forum_id' => $forum_id
			);
			$query = $this->db->get_where('forum_replies', $array);
			return $query->result_array();
		}
	}