<?php
	class Comments extends CI_Controller{
		public function create($post_id){
			$slug = $this->input->post('slug');
			$data['article'] = $this->article_model->get_articles($slug);

			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('email','Email','required');
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
	}