<?php
include 'functions-page.php';


session_unset();
session_destroy();

header('refresh:1; url=index.php');
echo "You have been logged out. Redirecting to the homepage in 1 seconds...";
exit;
?>