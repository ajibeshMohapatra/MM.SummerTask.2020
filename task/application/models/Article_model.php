<?php
	class Article_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function get_articles($slug = FALSE,$limit = FALSE,$offset = FALSE){

			if($limit){
				$this->db->limit($limit,$offset);
			}

			if ($slug === FALSE) {
				$this->db->order_by('id', 'DESC');
				$query = $this->db->get('articles');
				return $query->result_array();
			}

			$query = $this->db->get_where('articles',array('slug' => $slug));
			return $query->row_array();
		}

		public function get_articles_by_id($id){
			$query = $this->db->get_where('articles',array('id' => $id));
			return $query->row_array();
		}

		public function create_article($post_image){
			$slug = url_title($this->input->post('title'));

			$data = array(
				'title' => $this->input->post('title'),
				'slug' => $slug,
				'body' => $this->input->post('body'),
				'user_id' =>$this->session->userdata('user_id'),
				'post_image' => $post_image
			);

			return $this->db->insert('articles', $data);
		}

		public function delete_article($id){
			$this->db->where('id', $id);
			$this->db->delete('articles');
			return true;
		}

		public function update_article(){
			$slug = url_title($this->input->post('title'));

			$data = array(
				'title' => $this->input->post('title'),
				'slug' => $slug,
				'body' => $this->input->post('body')
			);

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('articles', $data);
		}

		public function get_articles_by_user($user_id){

			$this->db->order_by('articles.id','DESC');

			$this->db->join('users','users.id = articles.user_id');
			$query = $this->db->get_where('articles',array('user_id' => $user_id));
			return $query->result_array();
		}

		public function search_articles($key){
			$this->db->like('title',$key);
			$this->db->or_like('body',$key);
			$query = $this->db->get('articles');
			return $query->result_array();
		}

		public function view_count($id){
			$this->db->where('id', $id);
			$data = array(
				'view' => $this->input->post('view')
			);
			return $this->db->update('articles', $data);
		}

		public function get_popular_articles($slug = FALSE,$limit = FALSE,$offset = FALSE){

			if($limit){
				$this->db->limit($limit,$offset);
			}

			if ($slug === FALSE) {
				$this->db->order_by('view', 'DESC');
				$query = $this->db->get('articles');
				return $query->result_array();
			}

			$query = $this->db->get_where('articles',array('slug' => $slug));
			return $query->row_array();
		}
	
	}