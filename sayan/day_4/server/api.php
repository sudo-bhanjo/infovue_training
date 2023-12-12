<?php
include('db.php');
$baseUri = 'http://localhost/server/api.php';

header("Content-Type:application/json");
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$idQ = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
	$taskId = null;
	$id = null;
	if($idQ ){
		$taskId = explode('=', $idQ);
		$id = $taskId[1];
	}


	if ($taskId && $id) {
		if($taskId[0] === "id" && $id){
			$sql_query = "SELECT id, name, status FROM todos WHERE id = $id";
			$result = mysqli_query($conn, $sql_query);
			$row = mysqli_fetch_array($result);
			if ($row) {
				$object = new stdClass();
				$object->id = $row['id'];
				$object->name = $row['name'];
				$object->status = $row['status'];
				response($object);
			} else {
				response(null, "not found", 400);
			}
			mysqli_close($conn);
			exit;
		}

	}

	$result = mysqli_query($conn, "SELECT * FROM `todos` ORDER BY id DESC");
	$results = array();
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)) {
			$object = new stdClass();
			$object->id = $row['id'];
			$object->name = $row['name'];
			$object->status = $row['status'];
			array_push($results, $object);
		}
		response($results);
	} else {
		response(NULL, "Error Occured", 400);
	}
	mysqli_close($conn);
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$data = json_decode(file_get_contents('php://input'), true);
	$name = $data['name'];
	$sql_query = "INSERT INTO todos (name) VALUES ('$name')";
	$result = mysqli_query($conn, $sql_query);
	if ($result) {
		response($conn->insert_id);
	} else {
		response(NULL, "Error Occured", 400);
	}
	mysqli_close($conn);
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
	$id = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
	$taskId = explode('=', $id);

	if ($taskId[0] === "id" && $taskId[1]) {
		$id = $taskId[1];
		$data = json_decode(file_get_contents('php://input'), true);
		$name = $data['name'];

		if ($data['status'])
			$status = $data['status'];
		else
			$status = false;


		$sql_query = "UPDATE todos SET name = '$name', status='$status' WHERE id = $id";
		$result = mysqli_query($conn, $sql_query);

		if ($result) {
			response(null, "Task updated successfully", 200);
		} else {
			response(null, "Error: occured", 400);
		}
	}
	mysqli_close($conn);
	exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

	$id = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
	$taskId = explode('=', $id);

	if ($taskId[0] === "id" && $taskId[1]) {
		$id = $taskId[1];
		$sql_query = "DELETE FROM todos WHERE id = $id";
		$result = mysqli_query($conn, $sql_query);
		if ($result) {
			response(null);
		} else {
			response(NULL, "Error Occured", 400);
		}
	} else
		echo response(null, "Invalid ID", 400);

	mysqli_close($conn);
	exit;
}




function response($data, $message = "Success", $status = 200)
{
	header('Content-Type: application/json');
	$object = new stdClass();
	$object->data = $data;
	$object->message = $message;
	http_response_code($status);
	echo json_encode($object);
}
