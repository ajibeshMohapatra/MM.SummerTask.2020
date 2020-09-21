<?php
	class Polls extends CI_Controller{
		 public function poll()
    {
        if(!$this->session->userdata('role_id') == 1){
                redirect('users/login');
            }

        $data['polls'] = $this->poll_model->get_polls();
        
         $this->load->view('users/head');
		 $this->load->view('users/poll',$data);
		 $this->load->view('users/foot');
    }

        public function create()
    {
        if(!$this->session->userdata('role_id') == 1){
                redirect('users/login');
            }

        $this->form_validation->set_rules('poll_title', 'title' , 'required');
        if ($this->form_validation->run() == false) {
        	$this->load->view('users/head');
		 	$this->load->view('users/poll_create');
		 	$this->load->view('users/foot');
        } else {
            // choices sent by the form
            $fields = $this->input->post('fields');
            // remove empty choices,order every choice by chars from A To Z
            $orderd_data = $this->array_combine2($fields);

            $this->poll_model->create($orderd_data);
            redirect('users/poll');
        }
    }
     function array_combine2($arr2)
    {
        $filter_arr2 = array_filter($arr2);
        $arr1 = range('A', 'z');
        $count = min(count($arr1), count($filter_arr2));
        return array_combine(array_slice($arr1, 0, $count), array_slice($filter_arr2, 0, $count));
    }

    public function edit($id)
    {

        if(!$this->session->userdata('role_id') == 1){
                redirect('users/login');
            }

        $data['poll'] = $this->poll_model->get_one($id);
        $columns = $this->poll_model->get_all_columns($id);
        $data['columns'] = array_filter($columns);
        $polls = $this->poll_model->is_polled($id);
        if (!empty($polls)) {
            redirect('users/poll');
        }
        $this->form_validation->set_rules('poll_title','Poll_title', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('users/poll_edit', $data);
        } else {

            $fields = $this->input->post('fields');
            $orderd_data = $this->array_combine2($fields);
            $this->poll_model->update($orderd_data, $id);
            redirect('users/poll');
        }
    }

    public function remove($id)
    {
        if(!$this->session->userdata('role_id') == 1){
                redirect('users/login');
            }

        if ($this->poll_model->delete($id)) {
            redirect('users/poll');
        }
    }

     function activate_poll($id)
    {
        if(!$this->session->userdata('role_id') == 1){
                redirect('users/login');
            }
        $this->poll_model->active($id);
        redirect('users/poll');
    }

    function deactivate_poll($id)
    {
        if(!$this->session->userdata('role_id') == 1){
                redirect('users/login');
            }
        $this->poll_model->deactivate($id);
        redirect('users/poll');
    }

      public function poll_page()
    {
        $data['poll'] = $this->poll_model->get_one_active();
        $columns = $this->poll_model->get_all_columns_active();
        $data['columns'] = array_filter($columns);

         $this->load->view('templates/header');
		 $this->load->view('pages/home',$data);
		 $this->load->view('templates/footer');
    }

     public function poll_given($id)
    {

        $user = $this->session->userdata('user_id');
        $poll_option = $this->input->post('poll_option');
        if (!empty($poll_option)) {
            $found_id = $this->poll_model->check_user($id, $user);
            if (empty($found_id)) {
                $this->poll_model->add_vote($id, $user);
                $data['result'] = $this->poll_model->result($id);
                $data['rows'] = $this->poll_model->getNumVoting($id);

				 $this->load->view('users/poll_result',$data);
 
            } else {
                $data['result'] = $this->poll_model->result($id);
                $data['rows'] = $this->poll_model->getNumVoting($id);
                
				$this->load->view('users/poll_result',$data);
            }
        }
    }
    public function polling($id){
         $data['result'] = $this->poll_model->result($id);
         $data['rows'] = $this->poll_model->getNumVoting($id);
         $data['total'] = $this->poll_model->total($id);

        $this->load->view('users/head');
        $this->load->view('users/polling',$data);
        $this->load->view('users/foot');
    }
}