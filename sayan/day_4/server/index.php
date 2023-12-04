<?php
include 'db.php';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost/infovue/sayan/day_4/server/api.php');
$result = curl_exec($ch);

curl_close($ch);
$v=json_decode($result);

echo $v->data;
?>

<!-- <?php
$query = "SELECT * FROM todos";
$todos = mysqli_query($conn, $query);
if (mysqli_num_rows($todos) > 0) {
    $result = mysqli_fetch_assoc($todos);
    $name=[];
    $id=[];
    $status=[];
    while($results = mysqli_fetch_assoc($todos)){
        array_push($id,$results['id']);
        array_push($name,$results['name']);
        array_push($status,$results['status']);

    }
    
}
?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>


<body>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NAME</th>
                    <th scope="col">STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM todos";
                $todos = mysqli_query($conn, $query);
                if (mysqli_num_rows($todos) > 0) {
                    while ($row = mysqli_fetch_assoc($todos)) {

                        echo '<tr>
                <td>' . $row["id"] . '</td>
                <td>' . $row["name"] . '</td>
                <td>' . $row["status"] . '</td>
                </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>