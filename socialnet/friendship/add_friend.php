<?php 

session_start();

require_once("../../db.php");

// Check if the user is logged in.
if (!isset($_SESSION['username']))
{
    header("Location: ../index.php");
    exit();
}

// Check if target user id exists.
if (!isset($_GET['targetID']))
{
    header("Location: index.php");
    exit();
}

// Get the current user id.
$result = db_query(
    "SELECT id
    FROM account
    WHERE username = '" . addslashes($_SESSION['username']) . "'");

if ($result->num_rows == 0)
{
    header("Location: ../index.php");
    exit();
}

$row = $result->fetch_assoc();
$current_user_id = $row['id'];

// Get the target user id.
$target_user_id = $_GET['targetID'];

// Prevent self-friend request.
if ($current_user_id == $target_user_id)
{
    header("Location: ../index.php");
    exit();
}

// Check if relationship already exists.
$check = db_query(
    "SELECT *
    FROM friendship
    WHERE (
        account_id_1 = " . $current_user_id . "
        AND account_id_2 = " . $target_user_id . "
    )
    OR (
        account_id_1 = " . $target_user_id . "
        AND account_id_2 = " . $current_user_id . "
    )"
);

// If no relationship exists, create friend request.
if ($check->num_rows == 0)
{
    db_execute(
        "INSERT INTO friendship (
            account_id_1,
            account_id_2,
            status
        )
        VALUES (
            " . $current_user_id . ",
            " . $target_user_id . ",
            'pending'
        )"
    );
}

// Redirect back to homepage.
header("Location: ../index.php");
exit();
?>