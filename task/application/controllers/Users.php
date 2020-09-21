<?php
	class Users extends CI_Controller{
		public function register(){
			$data['title'] = 'Sign Up';

			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('username','username','required|callback_check_username_exists');
			$this->form_validation->set_rules('email','Email','required|callback_check_email_exists');
			$this->form_validation->set_rules('password','Password','required');
			$this->form_validation->set_rules('password2','Confirm Password','matches[password]');

			if ($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/register',$data);
				$this->load->view('templates/footer');
			} else {
				$enc_password = md5($this->input->post('password'));

				$this->user_model->register($enc_password);

				$this->session->set_flashdata('user_registred','You are now registered.');

				redirect('');
			}
		}

		public function login(){
			$data['title'] = 'Sign In';

			$this->form_validation->set_rules('username','username','required');
			$this->form_validation->set_rules('password','Password','required');

			if ($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/login',$data);
				$this->load->view('templates/footer');
			} else {
				$username = $this->input->post('username');
				$password = md5($this->input->post('password'));

				$user_data = $this->user_model->login($username,$password);

				if($user_data){

					$user_data['logged_in'] = true;
					$user_data['username'] = $username;

					$this->session->set_userdata($user_data);

					$this->session->set_flashdata('user_loggedin','You are now logged in.');

					redirect('');

				} else {

					$this->session->set_flashdata('login_failed','Login Invalid');

					redirect('users/login');
				}
			}
		}

		public function logout(){

			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('role_id');

			$this->session->set_flashdata('user_loggedout','You are now logged out.');

			redirect('users/login');

		}

		public function check_username_exists($username){
			$this->form_validation->set_message('check_username_exists','That username is already taken');

			if ($this->user_model->check_username_exists($username)) {
				return true;
			} else {
				return false;
			}	
		}

		public function check_email_exists($email){
			$this->form_validation->set_message('check_email_exists','That email is already taken');

			if ($this->user_model->check_email_exists($email)) {
				return true;
			} else {
				return false;
			}
			
		}

		public function posts(){

			if($this->session->userdata('role_id') == 1){



			$data['title'] = $this->session->userdata('username');

			$user_id = $this->session->userdata('user_id');

			$data['articles'] = $this->article_model->get_articles_by_user($user_id);

		   $this->load->view('users/head',$data);
		   $this->load->view('users/posts',$data);
		   $this->load->view('users/foot');
		}else{
			redirect('');
		}
		}

		public function panel(){

			if(!$this->session->userdata('role_id') == 1){
				redirect('users/login');
			}

			$data['title'] = $this->session->userdata('username');

			$user_id = $this->session->userdata('user_id');

			$data['articles'] = $this->article_model->get_articles_by_user($user_id);

		   $this->load->view('users/head',$data);
		   $this->load->view('users/panel',$data);
		   $this->load->view('users/foot');
		}

		public function role(){

			if(!$this->session->userdata('role_id') ==1){
				redirect('users/login');
			}

			$data['title'] = $this->session->userdata('username');

			$data['users'] = $this->user_model->get_user();

		   $this->load->view('users/head',$data);
		   $this->load->view('users/role',$data);
		   $this->load->view('users/foot');
}

public function update(){

			if(!$this->session->userdata('role_id') ==1){
				redirect('users/login');
			}

			$this->user_model->update_users();

			redirect('users/role');
		}

	}