<?php 

include('config.php');

if (isset($_POST['title'])) {
	mysqli_query($connect, "INSERT INTO events VALUES('', '$_POST[title]', '$_POST[start]', '$_POST[end]') ");
}

 ?>