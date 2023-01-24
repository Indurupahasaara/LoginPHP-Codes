<?php

// Inialize session
session_start();

// Delete certain session

unset($_SESSION['txtun']);

// Delete all session variables

session_destroy();

// Jump to login page

header('Location: Login.php');

?>
