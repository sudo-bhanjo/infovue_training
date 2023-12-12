<?php

class student extends CI_Model
{

    public function getStudents($id)
    {
        if (empty($id)) {
            $query = "SELECT * FROM student";
        } else {
            $query = "SELECT * FROM student WHERE student.id IN ($id)";
        }

        $results = $this->db->query($query);
        if ($results) {
            return $results->result_array();
        } else {
            return;
        }
    }

    public function getMarks($id)
    {
        
        if (!empty($id)) {
            $query="SELECT * FROM  subject  WHERE subject.student_id=$id";
            $results = $this->db->query($query);
            return $results->result_array();
        } else {
            return;
        }
    }


    public function addNew($data)
    {
        if (!empty($data)) {
            $name = $data['name'];
            $class = $data['class'];
            $sec = $data['sec'];
            $query = "INSERT INTO student (name, class, sec) VALUES ('$name', '$class', '$sec')";
            $this->db->query($query);
        } else {
            return;
        }
    }

    public function addtolimit($data,$id)
    {
        if (!empty($data)) {
            $query = "UPDATE `log` SET hit_count=$data WHERE log.api_key='$id'";
            $this->db->query($query);
        } else {
            return;
        }
    }

    public function getcurrentlimit($id)
    {
        if (!empty($id)) {
            $query = "SELECT * FROM `log` WHERE log.api_key='$id'";
            $results=$this->db->query($query);
            return $results->result_array();
        } else {
            return;
        }
    }


    public function getlimit($id)
    {
        if (!empty($id)) {
            $query = "SELECT * FROM `keys` WHERE `key`='$id'";
            $results=$this->db->query($query);
            return $results->result_array();
        } else {
            return;
        }
    }

    public function saveimage($url,$hash)
    {
        if (!empty($url)) {
            $query = "INSERT INTO uploads (url, hash) VALUES ('$url','$hash')";
            $this->db->query($query);
        } else {
            return;
        }
    }


    public function addMarks($data)
    {
        if (!empty($data)) {
            $query="INSERT INTO subject (student_id, sub_a, sub_b, sub_c,sub_d) VALUES (".$data['id'].",".$data['sub_a']."," .$data['sub_b']."," .$data['sub_c'].",".$data['sub_d'].")";
            $this->db->query($query);
        } else {
            return;
        }
    }

    public function deleteStudent($id)
    {
        if (!empty($id)) {
            $query = "DELETE FROM student WHERE id = $id";
            $this->db->query($query);
        } else {
            return;
        }
    }

    public function deleteMarks($student_id=null,$id=null)
    {
        if ($student_id ) {
            $query = "DELETE FROM subject WHERE student_id = $student_id";
            $this->db->query($query);
        } else if($id){
            $query = "DELETE FROM subject WHERE id = $id";
            $this->db->query($query);
        }else{
            return;
        }
    }

    public function checkhash($hash)
    {
        if ($hash ) {
            $query="SELECT * FROM  uploads  WHERE uploads.hash='$hash'";
            $results= $this->db->query($query);
            $arr=$results->result_array();
            
            if(!empty($arr))
            return true;

            return false;

        }else{
            return false;
        }
    }
}
