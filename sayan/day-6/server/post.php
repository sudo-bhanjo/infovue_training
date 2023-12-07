<?php

class post{

    public $name;
    public $conn;
    function exe(){
        $sql_query = "INSERT INTO todos (name) VALUES ('$this->name')";
        $result = mysqli_query($this->conn, $sql_query);
        if ($result) {
            response($this->conn->insert_id);
        } else {
            response(NULL, "Error Occured", 400);
        }
        mysqli_close($this->conn);
    }

}

?>