<?php
include('db.php');
include('functions.php');
$baseUri = '/infovue/sayan/day_4/server/api.php';

header("Content-Type:application/json");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	include('get.php');
	$get= new get();
	$get->conn=$conn;
	$taskId = null;
	if (isset($_GET["id"])) {
		$taskId = $_GET["id"];
		$get->execGetById($taskId);
		exit;
	}
	if (!$taskId) {
		$get->execGetAll();
		exit;
	}

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && Checkpath($baseUri,$_SERVER['REQUEST_URI'])==='/new') {
	include('post.php');
	$data = json_decode(file_get_contents('php://input'), true);
	$name = null;

	if (isset($data['name'])) {
		$name = $data['name'];
		$post = new post();
		$post->name=$name;
		$post->conn=$conn;
	
		$post->exe();
		exit;
	}

	if (!$name) {
		response(NULL, "Error Occured", 400);
		exit;
	}

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
			response(null, "Error Occured", 400);
		}
	} else
		echo response(null, "Invalid ID", 400);

	mysqli_close($conn);
	exit;
}

