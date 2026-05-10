<?php

session_start();

require_once("../db.php");

// Check if the user is logged in.
if (!isset($_SESSION['username']))
{
    header("Location: index.php");
    exit();
}

// Check if requester id exists.
if (!isset($_GET['requesterID']))
{
    header("Location: index.php");
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
    header("Location: index.php");
    exit();
}

$row = $result->fetch_assoc();
$current_user_id = $row['id'];
$requester_id = $_GET['requesterID'];

// Prevent self action.
if ($current_user_id == $requester_user_id)
{
    header("Location: index.php");
    exit();
}

// Check if pending request exists.
$check = db_query(
    "SELECT *
    FROM friendship
    WHERE account_id_1 = " . $requester_user_id . "
    AND account_id_2 = " . $current_user_id . "
    AND status = 'pending'"
);

// Accept friend request.
if ($check->num_rows > 0)
{
    db_execute(
        "UPDATE friendship
        SET status = 'friend'
        WHERE account_id_1 = " . $requester_user_id . "
        AND account_id_2 = " . $current_user_id
    );
}

// Redirect back to homepage.
header("Location: index.php");
exit();
?>