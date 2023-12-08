<?php 

class student extends CI_Model
{
    /*
     * Get student
     */
    public function getRows($customQuery = "") {
        if (!empty($customQuery)) {
            $results = $this->db->query($customQuery);
            return $results->result_array();
        } else {
            $query = $this->db->get('student');
            return $query->result_array();
        }
    }

    /*
     * Insert post
     */
    public function addNew($customQuery)
    {
        if (!empty($customQuery)) {
            $this->db->query($customQuery);
        } else {
            return; 
        }
    }

    /*
     * Update post
     */
    public function update($data, $id)
    {
        if (!empty($data) && !empty($id)) {
            $update = $this->db->update('posts', $data, array('id' => $id));
            return $update ? true : false;
        } else {
            return false;
        }
    }

    /*
     * Delete post
     */
    public function delete($id)
    {
        $delete = $this->db->delete('posts', array('id' => $id));
        return $delete ? true : false;
    }
}
