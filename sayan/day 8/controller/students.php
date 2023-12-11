<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class students extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('student', 'student');

    }

	public function index()
	{
        $data = array();
        $query="SELECT * FROM student";
		$data["students"] = $this->student->getStudents($query);
        $this->load->view('student', $data);
	}

    public function new(){
        $this->load->view('new');
    }

    public function create()
	{
        $name = $this->input->post('title');
		$class = $this->input->post('class');
		$sec = $this->input->post('sec');
        $query="INSERT INTO student (name, class, sec) VALUES ('$name', '$class', '$sec')";
		$this->student->addNew($query);
		redirect(base_url());
	}

    public function subjects($id){
        $data = array();
        $query1="SELECT * FROM student WHERE student.id=$id";
        $query2="SELECT * FROM  subject  WHERE subject.student_id=$id";
		$data["student"] = $this->student->getStudents($query1);
		$data["marks"] = $this->student->getMarks($query2);
        $this->load->view('addMarks',$data);
    }

    public function newMarks($id){
        $sub_a = $this->input->post('sub_a');
		$sub_b = $this->input->post('sub_b');
		$sub_c = $this->input->post('sub_c');
		$sub_d = $this->input->post('sub_d');
        print_r($id);
        $query="INSERT INTO subject (student_id, sub_a, sub_b, sub_c,sub_d) VALUES ($id,$sub_a, $sub_b, $sub_c,$sub_d)";
		$this->student->addNew($query);
		redirect(base_url("students/subjects/$id"));
	}

    public function removeStudent($id){

        $query1="DELETE FROM student WHERE id = $id";
        $query2="DELETE FROM subject WHERE student_id = $id";
        $this->student->deleteStudent($query1);
        $this->student->deleteMarks($query2);
		redirect(base_url());

    }

    public function removeMarks($id,$student_id){

        $query2="DELETE FROM subject WHERE id =".$id;
        $this->student->deleteMarks($query2);
        redirect(base_url("students/subjects/".$student_id));

    }
}
