<?php
session_start();
  $connect = mysqli_connect("localhost", "root", "", "kantipurfeed");
  mysqli_set_charset($connect, 'UTF8');

  if (!$connect) {
	    echo "Error: Unable to connect to MySQL." . PHP_EOL;
	    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	    exit;
  }


?>