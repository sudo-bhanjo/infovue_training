<?php
class put{
    public $id;
    public $conn;

    function exec($data){
		$name = $data['name'];

		if (isset($data['status']))
		$status = $data['status'];
		else
		$status = false;

		$sql_query = "UPDATE todos SET name = '$name', status='$status' WHERE id = $this->id";
		$result = mysqli_query($this->conn, $sql_query);

		if ($result) {
			response(null, "Task updated successfully", 200);
		} else {
			response(null, "Error: occured", 400);
		}
    }


}


?>