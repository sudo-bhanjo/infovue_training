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
	include('put.php');

	$put= new put();
	$id = null;
	if(isset($_REQUEST['id']))
	$id=$_REQUEST['id'];

	print_r($a);
	exit;
	if ($id) {

		$data = json_decode(file_get_contents('php://input'), true);
		$put->id=$taskId[1];
		$put->conn=$conn;
		$put->exec($data);
		exit;
	}
	mysqli_close($conn);
	exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
	include('delete.php');
	$id = null;

	if(isset($_REQUEST['id'])){
		$id=$_REQUEST['id'];
	}
	if ($id) {
		$delete=new delete();
		$delete->id=$id;
		$delete->conn=$conn;
		$delete->exec();
		exit;
	} else
		echo response(null, "Invalid ID", 400);

	mysqli_close($conn);
	exit;
}

