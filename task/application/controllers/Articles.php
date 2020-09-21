<?php
	class Articles extends CI_Controller{
		public function index($offset = 0){

			$config['base_url'] = base_url().'articles/index';
			$config['total_rows'] = $this->db->count_all('articles');
			$config['per_page'] = 2;
			$config['uri_segmengt'] = 3;
			$config['attributes'] = array('class' => 'pagination-link');

			$this->pagination->initialize($config);

			$data['title'] = 'Latest Posts';

			$data['articles'] = $this->article_model->get_articles(FALSE,$config['per_page'],$offset);

			$this->load->view('templates/header');
			$this->load->view('articles/index',$data);
			$this->load->view('templates/footer');
		}

		public function view($slug = NULL){

			$data['article'] = $this->article_model->get_articles($slug);
			$post_id = $data['article']['id'];
			$data['comments'] = $this->comment_model->get_comments($post_id);
			$data['requests'] = $this->comment_model->get_requests($post_id);

			if(empty($data['article'])){
				show_404();
			}

			$data['title'] = $data['article']['title'];

			$this->load->view('templates/header');
			$this->load->view('articles/view',$data);
			$this->load->view('templates/footer');
		}

		public function create(){

			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$data['title'] = 'Create Posts';

			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('body', 'Body', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('articles/create',$data);
				$this->load->view('templates/footer');
			}else{
				// Upload Image
				$config['upload_path'] = './assets/images/articles';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2048';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload()) {
					$errors = array('error' => $this->upload->display_errors());
					$post_image = 'noimage.jpg';
				} else {
					$data = array('upload_data' => $this->upload->data());
					$post_image = $_FILES['userfile']['name'];
				}
				

				$this->article_model->create_article($post_image);

				$this->session->set_flashdata('post_created','Your post has been created.');

				redirect('articles');
			}

		}

		public function delete($id){

			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			if($this->session->userdata('user_id') != $this->article_model->get_articles($slug)['user_id']){
				redirect('articles');
			}

			$this->article_model->delete_article($id);

			$this->session->set_flashdata('post_deleted','Your post has been deleted.');

			redirect('articles');
		}

		public function edit($slug){

			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$data['article'] = $this->article_model->get_articles($slug);

			if($this->session->userdata('user_id') != $this->article_model->get_articles($slug)['user_id']){
				redirect('articles');
			}

			if(empty($data['article'])){
				show_404();
			}

			$data['title'] = 'Edit Post';

			$this->load->view('templates/header');
			$this->load->view('articles/edit',$data);
			$this->load->view('templates/footer');
		}

		public function update(){

			if(!$this->session->userdata('logged_in')){
				redirect('userss/login');
			}

			$this->article_model->update_article();

			$this->session->set_flashdata('post_updated','Your post has been updated.');

			redirect('articles');
		}

		public function search(){
			$key = $this->input->post('title');
			$data['results'] = $this->article_model->search_articles($key);

			$this->load->view('templates/header');
			$this->load->view('articles/search',$data);
			$this->load->view('templates/footer');
		}

		public function view_counter($id){
			$this->article_model->view_count($id);
		}
		
		public function popular($offset = 0){

		$data['articles'] = $this->article_model->get__popular_articles(FALSE,3,$offset);

		 $this->load->view('templates/header');
		 $this->load->view('pages/home',$data);
		 $this->load->view('templates/footer');
		}
	}