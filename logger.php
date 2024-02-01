<?php
class Logger {
    private static function getDatabaseConnection() {
        // Replace these variables with your database connection details
        $servername = "localhost";
        $username = "";
        $password = "";
        $dbname = "canary";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    public static function logAccessAttempt() {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

                // Set the correct time zone
        date_default_timezone_set('Africa/Nairobi');
        $timestamp = date('Y-m-d H:i:s');

        $conn = self::getDatabaseConnection();

        $stmt = $conn->prepare("INSERT INTO canary_logs (ip_address, user_agent, timestamp) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $ipAddress, $userAgent, $timestamp);
        $stmt->execute();

        $stmt->close();
        $conn->close();
    }
}
?>
