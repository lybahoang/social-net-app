<?php

session_start();

require_once("../../db.php");

// Check if the user is logged in.
if (!isset($_SESSION['username']))
{
    header("Location: ../index.php");
    exit();
}

// Check if friend id who the current user wants to unfriend exists.
if (!isset($_GET['friendID']))
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

// Get the friend ID.
$friend_id = $_GET['friendID'];

// Prevent self action.
if ($current_user_id == $friend_id)
{
    header("Location: ../index.php");
    exit();
}

// Check if friendship exists.
$check = db_query(
    "SELECT *
    FROM friendship
    WHERE (
        account_id_1 = " . $current_user_id . "
        AND account_id_2 = " . $friend_id . "
        AND status = 'friend'
    )
    OR (
        account_id_1 = " . $friend_id . "
        AND account_id_2 = " . $current_user_id . "
        AND status = 'friend'
    )"
);

// Remove friendship.
if ($check->num_rows > 0)
{
    db_execute(
        "DELETE FROM friendship
        WHERE (
            account_id_1 = " . $current_user_id . "
            AND account_id_2 = " . $friend_id . "
        )
        OR (
            account_id_1 = " . $friend_id . "
            AND account_id_2 = " . $current_user_id . "
        )"
    );
}

// Redirect back to homepage.
header("Location: ../index.php");
exit();
?>