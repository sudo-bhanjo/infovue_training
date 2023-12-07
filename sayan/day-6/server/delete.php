<?php

class delete
{
    public $conn;
    public $id;

    function exec(){
        $sql_query = "DELETE FROM todos WHERE id = $this->id";
        $result = mysqli_query($this->conn, $sql_query);
        if ($result) {
            response(null);
        } else {
            response(null, "Error Occured", 400);
        }
        mysqli_close($this->conn);
    }
}
