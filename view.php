<?php 

include('config.php');

$show = mysqli_query($connect, "SELECT * FROM events ORDER BY id");
$dataArray = array();

while ($data = mysqli_fetch_array($show)) {
	$dataArray[] = array(
		'id' => $data['id'],
		'title' => $data['title'],
		'start' => $data['start'],
		'end' => $data['end'] 
	);
}

echo json_encode($dataArray);

 ?>