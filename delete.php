<?php
include 'database.php';

if (isset($_GET['del'])) {
	$id = $_GET['del'];
	
	delete_record($id);
    header('Location: show.php'); 

}

?>

