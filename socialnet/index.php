<?php
session_start();
require_once("../db.php");
?>

<!-- Check if the user sign in and take their fullname -->
<?php
$fullname = "";
if (!isset($_SESSION['username']))
{
    // Do not sign it yet, redirect to signin.php
    header("Location: signin.php");
    exit();
}
else
{
    // Take the user full name in the database.
    $result = db_query("SELECT fullname, id FROM account WHERE username = '" . $_SESSION['username'] . "'");
    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $fullname = $row['fullname'];
        $current_user_id = $row['id'];

        // Take a list of strange users.
        $strange_users = db_query(
            "SELECT username, fullname, id
            FROM account
            WHERE id != " . $current_user_id . "
            AND id NOT IN (    
                SELECT account_id_1
                FROM friendship
                WHERE account_id_2 = " . $current_user_id . "
                
                UNION

                SELECT account_id_2
                FROM friendship
                WHERE account_id_1 = " . $current_user_id . ")"
            );

        // Take the list of requesting users in the system.
        $requesting_users = db_query(
            "SELECT username, fullname
            FROM account
            WHERE id != " . $current_user_id . "
            AND id IN (
                SELECT account_id_1
                FROM friendship
                WHERE account_id_2 = " . $current_user_id . "
                AND status = 'pending'
            )");
        }

        // Take the list of pending request that the current user sent to other users.
        $pending_users = db_query(
            "SELECT username, fullname
            FROM account
            WHERE id != " . $current_user_id . "
            AND id IN (
                SELECT account_id_2
                FROM friendship
                WHERE account_id_1 = " . $current_user_id . "
                AND status = 'pending'
            )"
        );

        // Take the list of friends.
        $friends = db_query(
            "SELECT username, fullname
            FROM account
            WHERE id != " . $current_user_id . "
            AND id IN (
                SELECT account_id_2
                FROM friendship
                WHERE account_id_1 = " . $current_user_id . "
                AND status = 'friend'

                UNION

                SELECT account_id_1
                FROM friendship
                WHERE account_id_2 = " . $current_user_id . "
                AND status = 'friend'
            )"
        );
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Network</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
            color: #333;
        }

        /* Hero Section */
        .hero {
            height: 40vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background:
                linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
                url('https://placeholder.com');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 0 20px;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.2rem;
            max-width: 600px;
        }

        /* User List Section */
        .users-section {
            width: 90%;
            max-width: 1100px;
            margin: 50px auto;
            background-color: white;
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .users-section h2 {
            font-size: 2rem;
            margin-bottom: 25px;
            color: #222;
        }

        /* Table Styling */
        .users-table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 10px;
        }

        .users-table thead {
            background-color: #222;
            color: white;
        }

        .users-table th,
        .users-table td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #e5e5e5;
        }

        .users-table tbody tr {
            transition: background-color 0.2s ease;
        }

        .users-table tbody tr:hover {
            background-color: #f3f3f3;
        }

        /* Button Styling */
        .view-btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: 0.3s ease;
            font-size: 0.95rem;
        }

        .view-btn:hover {
            background-color: #555;
        }

        /* Responsive Design */
        @media (max-width: 600px) {

            .hero h1 {
                font-size: 2rem;
            }

            .users-section {
                padding: 20px;
            }

            .users-table,
            .users-table thead,
            .users-table tbody,
            .users-table th,
            .users-table td,
            .users-table tr {
                display: block;
            }

            .users-table thead {
                display: none;
            }

            .users-table tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 10px;
                padding: 10px;
            }

            .users-table td {
                border: none;
                position: relative;
                padding-left: 50%;
            }

            .users-table td::before {
                position: absolute;
                left: 15px;
                top: 15px;
                font-weight: bold;
            }

            .users-table td:nth-child(1)::before {
                content: "Username";
            }

            .users-table td:nth-child(2)::before {
                content: "Full Name";
            }

            .users-table td:nth-child(3)::before {
                content: "Action";
            }
        }
    </style>
</head>
<body>

    <!-- Display the menu bar -->
    <?php
        include_once("menubar.php");
    ?>

    <header id="home" class="hero">
        <h1>Welcome <?= $fullname ?></h1>
        <p><?= "username: " . $_SESSION['username'] ?></p>
    </header>

    <!-- List of friendship users -->
    <section class="users-section">
        <h2>List of Friends</h2>

        <table class="users-table">

            <thead>
                <tr>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Profile</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($user = $friends->fetch_assoc()) {
                    if ($user['username'] != $_SESSION['username']) {
                ?>
                <tr>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['fullname'] ?></td>
                    <td>
                        <a href="unfriend.php?owner=<?= $user['username']?>" class="view-btn">
                            Unfriend
                        </a>
                    </td>
                </tr>
                <?php }} ?>

            </tbody>

        </table>

    </section>

    <!-- List of requesting users -->
    <section class="users-section">
        <h2>List of Strange Users</h2>

        <table class="users-table">

            <thead>
                <tr>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($user = $requesting_users->fetch_assoc()) {
                    if ($user['username'] != $_SESSION['username']) {
                ?>
                <tr>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['fullname'] ?></td>
                    <td>
                        <a href="accept_friend.php?owner=<?= $user['id']?>" class="view-btn">
                            Accept
                        </a>
                    </td>
                </tr>
                <?php }} ?>

            </tbody>

        </table>

    </section>

    <!-- List of stranger and pending users -->
    <section class="users-section">
        <h2>List of Strange Users</h2>

        <table class="users-table">

            <thead>
                <tr>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <!-- Strangers -->
                <?php while ($user = $strange_users->fetch_assoc()) {
                    if ($user['username'] != $_SESSION['username']) {
                ?>
                <tr>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['fullname'] ?></td>
                    <td>
                        <a href="add_friend.php?targetID=<?= $user['id']?>" class="view-btn">
                            Add friend
                        </a>
                    </td>
                </tr>
                <?php }} ?>

                <!-- Pending request to other users -->
                <?php while ($user = $pending_users->fetch_assoc()) {
                    if ($user['username'] != $_SESSION['username']) {
                ?>
                <tr>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['fullname'] ?></td>
                    <td>
                        <p class="view-btn"> Pending
                        </p>
                    </td>
                </tr>
                <?php }} ?>
            </tbody>

        </table>

    </section>
</body>
</html>