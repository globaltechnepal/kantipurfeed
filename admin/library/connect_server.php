<?php
function dbConnecting()
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'kantipurfeed';
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Unable to connect database: " . mysqli_connect_error());
    } else {
        // echo "Connected";
        return $conn;
    }
}
?>
