<?php 

include('config.php');

if (isset($_POST['id'])) {
	mysqli_query($connect, "UPDATE events SET title = '$_POST[title]', start = '$_POST[start]', end = '$_POST[end]' WHERE id = '$_POST[id]'");
}

 ?>