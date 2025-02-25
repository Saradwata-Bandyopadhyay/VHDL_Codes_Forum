<?php
$conn = mysqli_connect('localhost', 'root','1234', "vhdl");
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
?>
