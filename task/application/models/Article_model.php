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

		public function get_articles_by_admin($admin_id){

			$this->db->order_by('articles.id','DESC');

			$this->db->join('admins','admins.id = articles.admin_id');
			$query = $this->db->get_where('articles',array('admin_id' => $admin_id));
			return $query->result_array();
		}
	}