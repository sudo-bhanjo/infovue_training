<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class students extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('student');
    }
  

	public function index()
	{
        $data = array();
		$data["students"] = $this->student->getRows("SELECT * FROM student");
        $this->load->view('student', $data);
	}

    public function new(){
        $this->load->view('new');
    }

    public function create()
	{
        $name = $this->input->post('title');
		$class = $this->input->post('class');
		$roll = $this->input->post('roll');
        $query="INSERT INTO student (name, class, roll) VALUES ('$name', '$class', $roll)";

		$this->student->addNew($query);
		redirect(base_url());
	}

    public function subjects($id){
        $data = array();
		$data["student"] = $this->student->getRows("SELECT * FROM student WHERE student.id=$id");
        // print_r($data);
        // $data["student"]="ssdsdsd";
        $this->load->view('addMarks',$data);
    }
}
