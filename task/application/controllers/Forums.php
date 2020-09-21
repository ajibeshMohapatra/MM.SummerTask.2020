<?php
	class Forums extends CI_Controller{
		public function forum(){
			$data['forums'] = $this->forum_model->get_forums(FALSE);

			$this->load->view('templates/header');
			$this->load->view('forums/forum',$data);
			$this->load->view('templates/footer');
		}

		public function view($id){
			$data['forum'] = $this->forum_model->get_forums($id);
			$forum_id = $data['forum']['id'];
			$data['replies'] = $this->forum_model->get_replies($forum_id);

			$this->load->view('templates/header');
			$this->load->view('forums/view',$data);
			$this->load->view('templates/footer');
		}
		public function create(){
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$data['title'] = 'Create Forums';

			$this->form_validation->set_rules('forum_title', 'Title', 'required');
			$this->form_validation->set_rules('forum_body', 'Body', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('forums/create',$data);
				$this->load->view('templates/footer');
			}else{

				$this->forum_model->create_forum();

				redirect('forum');
		}
	}
		public function reply($forum_id){

				$this->forum_model->create_reply($forum_id);
				redirect('forums/view/'.$forum_id);
			}	
		
}
