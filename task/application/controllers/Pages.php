<?php
	class Pages extends CI_Controller{
		public function view($page = 'home'){
			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
				show_404();
			}

			$data['title'] = ucfirst($page);

			$data['poll'] = $this->poll_model->get_one_active();
        	$columns = $this->poll_model->get_all_columns_active();
        	$data['columns'] = array_filter($columns);
        	$data['articles'] = $this->article_model->get_popular_articles(FALSE,3,0);

			$this->load->view('templates/header');
			$this->load->view('pages/'.$page,$data);
			$this->load->view('templates/footer');
		}
	}