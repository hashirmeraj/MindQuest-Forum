<?php
// Define the server name, username, password, and database name for the MySQL connection
$servername = 'localhost:3307'; // Server address and port, commonly 'localhost', but using port 3307 instead of the default 3306
$username = 'root'; // MySQL username, 'root' is the default for local development
$password = ''; // MySQL password, empty by default for 'root' on XAMPP
$dbName = 'forum'; // Name of the database you want to connect to, in this case, 'forum'

// Establish a connection to the MySQL database using mysqli_connect
$conn = mysqli_connect($servername, $username, $password, $dbName);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); // Display error message if connection fails
}

// Connection was successful; you can now interact with the database
