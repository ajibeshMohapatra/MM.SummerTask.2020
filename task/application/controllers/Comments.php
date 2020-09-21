<?php
	class Comments extends CI_Controller{
		public function create($post_id){
			$slug = $this->input->post('slug');
			$data['article'] = $this->article_model->get_articles($slug);
			$data['comments'] = $this->comment_model->get_comments($post_id);
			$data['requests'] = $this->comment_model->get_requests($post_id);

			$this->form_validation->set_rules('body','Body','required');

			if ($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('articles/view',$data);
				$this->load->view('templates/footer');
			} else {
				$this->comment_model->create_comment($post_id);
				redirect('articles/'.$slug);
			}	
		}
		public function update($id){

			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}


			$this->comment_model->update_comments($id);

			redirect('articles');
		}
		public function delete($id){

			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}


			$this->comment_model->delete_comments($id);

			redirect('articles');
		}

	}