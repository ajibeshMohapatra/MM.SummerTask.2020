<?php
	class Questions extends CI_Controller{
		public function view(){

			$data['questions'] = $this->question_model->get_questions();

				$this->load->view('templates/header');
				$this->load->view('questions/view',$data);
				$this->load->view('templates/footer');
		}
		public function ask(){

			$data['questions'] = $this->question_model->get_questions();
			$this->form_validation->set_rules('question','Qestion','required|callback_check_question_exists');

			if ($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('questions/view',$data);
				$this->load->view('templates/footer');
			} else {
				$this->question_model->create_question();
				redirect('ask-a-question');
			}
		}

		public function answer(){
			if(!$this->session->userdata('role_id') == 1){
                redirect('users/login');
            }

            $data['questions'] = $this->question_model->get_questionaries();

				$this->load->view('users/head');
				$this->load->view('questions/answer',$data);
				$this->load->view('users/foot');
		}
		public function add($id){
			$this->form_validation->set_rules('answer','Answer','required');

			if ($this->form_validation->run() === FALSE){
			} else {
				$this->question_model->add_answer($id);
				redirect('users/question');
			}
		}
		public function check_question_exists($question){

			if ($this->question_model->check_question_exists($question)) {
				return true;
			} else {
				$this->form_validation->set_message('check_question_exists','That question is already there');
				return false;
			}
			
		}		

		public function ques($id){
			$data['question'] = $this->question_model->get_ques($id);


				$this->load->view('templates/header');
				$this->load->view('questions/ques',$data);
				$this->load->view('templates/footer');
		}

		public function autocomplete(){
			if(isset($_GET['term'])){
			$results = $this->question_model->search_ques($_GET['term']);
			foreach ($results as $row)
                 $arr_result[] = array(
                    'label'   => $row['question'],
                    'value'   => $row['id'],
             	);
                echo json_encode($arr_result);
		}
	}
}