<?php
	class Poll_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}
		  function get_polls(){
        $this->db->order_by('poll_id', 'asc');
        $result=$this->db->get('polls');
        return $result->result_array();
    }
    function create($orderd_data)
    {
           foreach($orderd_data as $key => $value){
               $this->db->set('poll_title',$this->input->post('poll_title'));
               $this->db->set($key,$value);
           }
        $this->db->insert('polls');


    }

    function get_one($id){
       $this->db->where('poll_id',$id);
       $result=$this->db->get('polls');
       return $result->row_array();
    }

    function get_all_columns($id) {
        $this->db->where('poll_id',$id);
        $this->db->select('A,B,C,D,E,F,G,H,I,J');
        $result=$this->db->get('polls');
        $return = array();
        if ($result->num_rows() > 0) {
            foreach ($result->row_array() as $key=>$value) {
                $return[$key] = $value;
            }
        }

        return $return;
    }

     function is_polled($id){
        $this->db->where('polling_id', $id);
        $result = $this->db->get('poll_result');
        if ($result->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update($orderd_data,$id) {
         $this->db->where('poll_id',$id);
	     $this->db->delete('polls');

        foreach($orderd_data as $key => $value){
            $this->db->set($key,$value);
        }
        $this->db->set('poll_title',$this->input->post('poll_title'));
        $this->db->set('poll_state',$this->input->post('poll_state'));
        $this->db->insert('polls');
    }

    function delete($id) {
        $this->db->where('poll_id', $id);
        $this->db->delete('polls');

        $this->db->where('polling_id', $id);
        $this->db->delete('poll_result');
        return TRUE;
    }

    function active($id) {
        $this->db->set('poll_state', 1);
        $this->db->where('poll_id', $id);
        $this->db->update('polls');

        $this->db->set('poll_state',0);
        $this->db->where('poll_id !=', $id);
        $this->db->update('polls');
    }

    function deactivate($id) {
        $this->db->set('poll_state', 0);
        $this->db->where('poll_id', $id);
        $this->db->update('polls');

        $this->db->set('poll_state',1);
        $this->db->where('poll_id !=', $id);
        $this->db->update('polls');
    }

    function get_one_active()
	{
		$this->db->where('poll_state', 1);
		$result = $this->db->get('polls');
		return $result->row();
	}

	function get_all_columns_active()
	{
		$this->db->where('poll_state', 1);
		$this->db->select('A,B,C,D,E,F,G,H,I,J');
		$result = $this->db->get('polls');
		$return = array();
		if ($result->num_rows() > 0) {
			foreach ($result->row_array() as $key => $value) {
				$return[$key] = $value;
			}
		}

		return $return;
	}

	function check_user($id, $user)
	{
		$this->db->where('polling_id', $id);
		$this->db->where('user_id', $user);
		$result = $this->db->get('poll_result');
		if ($result->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function add_vote($id, $user)
	{
		$opt_leave = explode(",", $this->input->post('poll_option'));
		$column = $opt_leave[0];
		$data = $opt_leave[1];
		$this->db->set('poll_option',$column);
		$this->db->set('poll_data',$data);
		$this->db->set('user_id',$user);
		$this->db->set('polling_id', $id);
		$this->db->insert('poll_result');

	}

	function result($id)
	{

		$result = $this->db->query(" SELECT * FROM poll_result INNER JOIN polls
                            ON poll_result.polling_id = polls.poll_id
                            WHERE poll_id=$id ")->row();
		return $result;
	}

    function total($id){
        $total = $this->db->query("SELECT * FROM poll_result WHERE polling_id=$id");
        return $total->num_rows();
    }

	function getNumVoting($id)
	{
		$result = $this->db->query("SELECT poll_option,poll_data,
									SUM(poll_value) as polling_value,
			(SELECT SUM(poll_value)FROM poll_result WHERE polling_id=$id) as total
									FROM poll_result
									WHERE polling_id=$id
									GROUP BY poll_option")->result_array();

		foreach($result as $key => $value)
		{
			$value['prec'] = round(100*($value['polling_value'] / $value['total']),2);
			$result[$key] = $value;

		}
		return array_filter($result);

	}
}