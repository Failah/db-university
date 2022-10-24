<?php

define("DB_SERVERNAME", "localhost:3306");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD);

if ($conn && $conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    die();
}

echo "<p>Connection OK!<p/>";
