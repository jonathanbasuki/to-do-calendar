<?php 

include('config.php');

if (isset($_POST['id'])) {
	mysqli_query($connect, "DELETE FROM events WHERE id = '$_POST[id]'");
}

 ?>