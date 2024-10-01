<?php
// Main index file that includes required PHP files and redirects
include "validate.php";
include "ip.php";
include "post.php";

// After including the necessary scripts, redirect to the HTML page
header("Location: index.html.php");
exit();
?>

