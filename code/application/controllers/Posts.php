<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('security');
		$this->load->library('form_validation'); 
		$this->load->model("Post");
	}
	public function index_json() {
		$data["posts"] = $this->Post->all();
		echo json_encode($data);
	}
	public function index_html() {
		$data["posts"] = $this->Post->all();
		$this->load->view("partials/posts", $data);
	}
	public function post() {
		$result = $this->Post->validate_post();

        if($result != 'success') {
            $this->session->set_flashdata('input_errors', validation_errors());
        }
        else {
			$this->Post->create($this->input->post());
        }
		$data["posts"] = $this->Post->all();
		$this->load->view("partials/posts", $data);
	}
	public function index()
	{
		$this->load->view('index');
	}
}
