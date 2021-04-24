<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends CI_Model {

    public function all() {
        return $this->db->query("SELECT * FROM posts")->result_array();
    }

    public function create() {
        $query = "INSERT INTO posts (description, created_at, updated_at) VALUES (?, ?, ?)";
        $values = array(
            $this->security->xss_clean($this->input->post('my_post')), 
            date("Y-m-d h:i:s"),
            date("Y-m-d h:i:s")
        );
        return $this->db->query($query, $values);
    }
    public function validate_post() {

        //$this->form_validation->set_error_delimiters("<div class='text-danger'>",'</div>');
        $this->form_validation->set_rules('my_post', 'Post', 'required');

        if(!$this->form_validation->run()) {
            return validation_errors();
        } 
        else {
            return "success";
        }
    }
}