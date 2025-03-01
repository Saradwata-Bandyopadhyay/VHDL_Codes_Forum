<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "vhdl";
$conn = mysqli_connect($servername,$username,$password,$dbname);
	if(!$conn)
	{
		echo 'Connection error: '. mysqli_connect_error();
	}
?>