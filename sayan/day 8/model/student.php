<?php 

class student extends CI_Model
{

    public function getStudents($customQuery = "") {
        if (!empty($customQuery)) {
            $results = $this->db->query($customQuery);
            return $results->result_array();
        } else {

            return ;
        }
    }

    public function getMarks($customQuery = "") {
        if (!empty($customQuery)) {
            $results = $this->db->query($customQuery);
            return $results->result_array();
        } else {
            return ;
        }
    }


    public function addNew($customQuery="")
    {
        if (!empty($customQuery)) {
            $this->db->query($customQuery);
        } else {
            return; 
        }
    }

    public function addMarks($customQuery="")
    {
        if (!empty($customQuery)) {
            $this->db->query($customQuery);
        } else {
            return; 
        }
    }

    public function deleteStudent($customQuery="")
    {
        if (!empty($customQuery)) {
            $this->db->query($customQuery);
        } else {
            return; 
        }
    }
    public function deleteMarks($customQuery="")
    {
        if (!empty($customQuery)) {
            $this->db->query($customQuery);
        } else {
            return; 
        }
    }
}
