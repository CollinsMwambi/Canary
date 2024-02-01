<?php
require 'logger.php';

// Log the access attempt and send an alert
Logger::logAccessAttempt();

// Redirect to the home page or show an error to avoid suspicion
header('Location: index.php');
exit;
?>
