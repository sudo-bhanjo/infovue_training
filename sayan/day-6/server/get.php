<?php

class get{

    public $conn;

    function execGetById($taskId){
        $sql_query = "SELECT id, name, status FROM todos WHERE id IN ($taskId)";
        $result = mysqli_query($this->conn, $sql_query);
        if (mysqli_num_rows($result) > 0) {
            $results = MakeObjectArray($result);
            response($results);
        } else {
            response(NULL, "Error Occured", 400);
        }
        mysqli_close($this->conn);
        
    }

    function execGetAll(){
		$result = mysqli_query($this->conn, "SELECT * FROM `todos` ORDER BY id DESC");
		if (mysqli_num_rows($result) > 0) {
			$results = MakeObjectArray($result);
			response($results);
		} else {
			response(null, "Error Occured", 400);
		}
		mysqli_close($this->conn);
        
    }

}

?>