<?php
	class API extends CI_Controller{
		public function articles(){
			$data['articles'] = $this->article_model->get_articles();
			$this->output->set_content_type('application/json');
			echo json_encode($data);
		}
		public function articles_by_id($id){
			$data['article'] = $this->article_model->get_articles_by_id($id);
			$this->output->set_content_type('application/json');
			echo json_encode($data);
		}
		public function comments_by_id($post_id){
			$data['comment'] = $this->comment_model->get_comments($post_id);
			$this->output->set_content_type('application/json');
			echo json_encode($data);
		}
		public function comments(){
			$data['comments'] = $this->comment_model->get_all_comments();
			$this->output->set_content_type('application/json');
			echo json_encode($data);
		}
		public function users(){
			$data['users'] = $this->user_model->get_user();
			$this->output->set_content_type('application/json');
			echo json_encode($data);
		}
		public function forums(){
			$data['forums'] = $this->forum_model->get_forums();
			$this->output->set_content_type('application/json');
			echo json_encode($data);
		}
		public function polls(){
			$data['polls'] = $this->poll_model->get_polls();
			$this->output->set_content_type('application/json');
			echo json_encode($data);
		}
		public function questions(){
			$data['questions'] = $this->question_model->getall__questions();
			$this->output->set_content_type('application/json');
			echo json_encode($data);
		}
	}