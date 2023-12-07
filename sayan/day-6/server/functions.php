<?php

class todo{

    public $id;
    public $name;
    public $status;

}

// function ParseId($query){
//     if (!$query)
//     return null;

//     $idList = explode(",", $query);
//     $idString = '';
//     for ($i = 0; $i < count($idList); $i++) {
//         $idString .= $idList[$i];
//         if ($i < count($idList) - 1) {
//             $idString .= ',';
//         }
//     }
//     return $idString;
// }



function MakeObjectArray($result){

    if(!$result)
    return [];

    $results = array();
    while ($row = mysqli_fetch_array($result)) {
        $task= new todo();
        $task->id=$row['id'];
        $task->name=$row['name'];
        $task->status=$row['status'];
        array_push($results, $task);
    }
    return $results;
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

function Checkpath($baseUri,$url){
    if(!$baseUri || !$url ){
        return null;
    }
	$path=$url;
	return str_replace($baseUri,"",$path);
}

?>
