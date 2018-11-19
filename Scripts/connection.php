<?php 
$servername = 'localhost';
$username = 'root';
$password_db = '';
$dbname = 'online_shop';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
       // Change error to exception and handle it
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {
       // Let user know something is wrong
    echo "<script type='text/javascript'>alert('Connection to database failed');</script>";
       // Until better way is found:
    echo "<script> console.log($e->getMessage()) </script>";
}
?>