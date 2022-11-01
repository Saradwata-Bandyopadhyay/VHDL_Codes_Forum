<?php
$conn = mysqli_connect('localhost', 'root','', "vhdl");
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
?>
