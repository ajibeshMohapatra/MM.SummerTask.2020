<?php
	class Question_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}
		public function create_question(){
			$data = array(
				'question' => $this->input->post('question'),
			);

			return $this->db->insert('questions', $data);
		}
		public function get_all_questions(){
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('questions');
			return $query->result_array();
		}
		public function get_questionaries(){

			$array = array(
				'answer'=> ''
			);

			$this->db->order_by('id', 'DESC');
			$query = $this->db->get_where('questions',$array);
			return $query->result_array();
		}
		public function get_questions(){

			$array = array(
				'answer!='=> ''
			);

			$this->db->order_by('id', 'DESC');
			$query = $this->db->get_where('questions',$array);
			return $query->result_array();
		}

		public function add_answer($id){
				$data = array(
				'answer' => $this->input->post('answer'),
			);

			$this->db->where('id', $id);
			return $this->db->update('questions', $data);
		}
		public function check_question_exists($question){


			$query = $this->db->get_where('questions',array('question' => $question));
			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}

		public function get_ques($id){
			$query = $this->db->get_where('questions',array('id' => $id));
			return $query->row_array();
		}

		public function search_ques($key){
			$array = array(
				'answer!='=> ''
			);
			$this->db->like('question',$key);
			$this->db->order_by('id','DESC');
			$this->db->limit(10);
			$query = $this->db->get_where('questions',$array);
			return $query->result_array();
		}
	}
