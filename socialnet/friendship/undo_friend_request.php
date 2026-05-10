<?php

session_start();

require_once("../../db.php");

// Check if user is logged in.
if (!isset($_SESSION['username']))
{
    header("Location: ../index.php");
    exit();
}

// Check requester id exists.
if (!isset($_GET['targetID']))
{
    header("Location: ../index.php");
    exit();
}

// Get current user id.
$result = db_query(
    "SELECT id
    FROM account
    WHERE username = '" . $_SESSION['username'] . "'"
);

if ($result->num_rows == 0)
{
    header("Location: ../index.php");
    exit();
}

$row = $result->fetch_assoc();
$current_user_id = $row['id'];

// Get requested id.
$requested_id = $_GET['targetID'];

// Delete pending request.
db_execute(
    "DELETE FROM friendship
    WHERE account_id_1 = " . $current_user_id . "
    AND account_id_2 = " . $requested_id . "
    AND status = 'pending'"
);

// Redirect back.
header("Location: ../index.php");
exit();

?>