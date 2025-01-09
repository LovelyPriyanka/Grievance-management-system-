<?php
session_start();
session_destroy(); // End the session
header("Location: shop.html"); // Redirect to shop.html
exit();
?>
