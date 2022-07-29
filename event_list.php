<?php 

$connection = mysqli_connect("localhost","root","","bims_db");

$sql = "SELECT * FROM schedule_list";
$result = mysqli_query($connection,$sql);
$user = array();

while($row = mysqli_fetch_assoc($result)){
    $index['title'] = $row['title'];
    $index['description'] = $row['description'];
    $index['start_datetime'] = $row['start_datetime'];
    $index['end_datetime'] = $row['end_datetime'];
    array_push($user,$index);
}
echo json_encode($user);


?>