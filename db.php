<?php 
function db_conn() {
    $host = "127.0.0.1";
    $dbname = "socialnet";
    $user = "socialNetAdmin";
    $password = "socialnetadmin@2026";

    // Create a connection with the database.
    $conn = new mysqli($host, $user, $password, $dbname);

    // If cannot connect to the database, then die.
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Return the object.
    return $conn;
}

// The function db_execute is to execute action such as insertion
// or update the database.
function db_execute($sql_command_str) {
    $conn = db_conn();
    $conn->query($sql_command_str);
    $conn->close();
}

// The function db_query is to retrieved data from the database.
function db_query($sql_str) {
    $conn = db_conn();
    $result = $conn->query($sql_str);
    return $result;
}
?>