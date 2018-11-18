<?php 
function test_input($data) {
    $data = trim($data);              // Trims whitespace around
    $data = stripslashes($data);      // Removes / and \
    $data = htmlspecialchars($data);  // Disables code injections
    return $data;
}
?>