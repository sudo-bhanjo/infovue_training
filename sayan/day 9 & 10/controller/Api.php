<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . '/libraries/RestController.php');
require(APPPATH . '/libraries/Format.php');

use chriskacerguis\RestServer\RestController;

class Api extends RestController
{   
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('user_model');
        // echo $this->count;
        $this->load->model('student');
        $this->load->helper(array('form', 'url'));
        

        $key=$this->input->get_request_header("X-API-KEY");
        $r=10;
        // $r=$this->student->getlimit($key);
        $c=$this->student->getcurrentlimit($key);
        if($c[0]['hit_count']>=$r){
            echo "limit expired";
            exit;
        }else{
            $this->student->addtolimit($c[0]['hit_count']+1,$key);
            echo $c[0]['hit_count'];
        }
        
    }

    public function index_get()
    {

        // $c=$this->student->getcurrentlimit($id);

        // print_r($r);
        // print_r($c);
        $this->response("Welcome to student db api");
    }

    public function all_get()
    {
        $data = array();
        try {
            $id = $this->input->get("id");
            $data['data'] = $this->student->getStudents($id);
            for ($i = 0; $i < count($data['data']); $i++) {
                $r = $this->student->getMarks($data['data'][$i]['id']);
                $data['data'][$i]['subjects'] = $r;
            }
            $data['status'] = "success";
            $this->response($data);
        } catch (\Throwable $th) {
            $data['status'] = "failed";
            $data['message'] = "error occured";
            $this->response($data);
        }

    }

    public function new_post()
    {
        $r = array();
        try {
            $data = array();
            $data['name'] = $this->input->post('title');
            $data['class'] = $this->input->post('class');
            $data['sec'] = $this->input->post('sec');
            $this->student->addNew($data);
            $r['status'] = "success";
            $r['message'] = "student added successfully";
            $this->response($r);
        } catch (\Throwable $th) {
            $r['status'] = "failed";
            $r['message'] = "error occured";
            $this->response($r);
        }
    }

    public function remove_delete()
    {
        $r = array();
        try {
            $student_id = $this->input->get("id");
            $this->student->deleteStudent($student_id);
            $this->student->deleteMarks($student_id);
            $r['status'] = "success";
            $r['message'] = "student deleted successfully";
            $this->response($r);
        } catch (\Throwable $th) {
            $r['status'] = "failed";
            $r['message'] = "error occured";
            $this->response($r);
        }
    }

    public function addmarks_post()
    {
        $r = array();
        try {
            $data = array();
            $data['id'] = $this->input->get("id");
            $data['sub_a'] = $this->input->post('sub_a');
            $data['sub_b'] = $this->input->post('sub_b');
            $data['sub_c'] = $this->input->post('sub_c');
            $data['sub_d'] = $this->input->post('sub_d');
            $this->student->addMarks($data);
            $r['status'] = "success";
            $r['message'] = "marks added successfully";
            $this->response($r);
        } catch (\Throwable $th) {
            $r['status'] = "failed";
            $r['message'] = "error occured";
            $this->response($data);
        }
    }

    public function removemarks_delete()
    {
        $data = array();
        try {
            $id = $this->input->get("id");
            $this->student->deleteMarks(null, $id);
            $data['status'] = "success";
            $data['message'] = "marks deleted successfully";
            $this->response($data);
        } catch (\Throwable $th) {
            $data['status'] = "failed";
            $data['message'] = "error occured";
            $this->response($data);
        }
    }

    public function do_upload_post()
    {
        $data = array();
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);


        if (!$this->upload->do_upload('userfile')) {
            //    $error = array('error' => $this->upload->display_errors()); 
            $data['status'] = "failed";
            $data['message'] = "error occured";
            $this->response($data);
        } else {
            $r = array('upload_data' => $this->upload->data());
            $fullPath = $data['url'] = base_url('/uploads/' . $r['upload_data']['file_name']);
            $hash = hash_file('sha1', $fullPath);
            $isExist = $this->student->checkhash($hash);
            if (!$isExist) {
                $this->student->saveimage($data['url'], $hash);
                $data['status'] = "success";
                $this->response($data);
            } else {
                unlink('./uploads/' . $r['upload_data']['file_name']);
                $data['status'] = "failed";
                $data['message'] = "file exist";
                $this->response($data);
            }
        }
    }
}
