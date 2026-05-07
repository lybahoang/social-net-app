<?php
session_start();
require_once("../db.php");
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Social Network</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }

        /* Main Container */
        .container {
            width: 80%;
            max-width: 900px;
            margin: 40px auto;
        }

        /* Profile Card */
        .profile-card {
            background-color: white;
            border-radius: 12px;
            padding: 35px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Profile Header */
        .profile-header {
            margin-bottom: 25px;
            border-bottom: 2px solid #eeeeee;
            padding-bottom: 15px;
        }

        .profile-header h1 {
            color: #2c3e50;
            font-size: 32px;
        }

        .profile-header p {
            margin-top: 8px;
            color: #777;
            font-size: 16px;
        }

        /* Profile Content */
        .profile-content h2 {
            margin-bottom: 15px;
            color: #34495e;
        }

        .description-box {
            background-color: #fafafa;
            border: 1px solid #dddddd;
            border-radius: 8px;
            padding: 20px;
            line-height: 1.7;
        }

        /* Footer */
        footer {
            text-align: center;
            margin-top: 40px;
            padding: 15px;
            color: #777;
            font-size: 14px;
        }
    </style>
</head>

<body>
    
    <?php
        // Get the user fullname and description.
        $fullname = "";
        $description = "";

        if (!isset($_SESSION['username']))
        {
            header("Location: signin.php");
            exit();
        }
        else
        {
            $result = db_query("SELECT fullname, description FROM accounts WHERE username = '" . $_SESSION['username'] . "'");
            if (count($result) > 0)
            {
                $fullname = $result[0]['fullname'];
                $description = $result[0]['description'];
            }
        }
    ?>

    <!-- Menu bar -->
    <?php include_once("menubar.php") ?>

    <!-- Main Content -->
    <div class="container">
        <div class="profile-card">

            <!-- Profile Owner -->
            <div class="profile-header">
                <h1><?= $_SESSION['username'] . "'s Profile"?></h1>
                <p>Owner of this profile page</p>
            </div>

            <!-- Profile Description -->
            <div class="profile-content">
                <h2>Profile Page Content</h2>

                <div class="description-box">
                    <p> <?= $description ?> </p>
                </div>
            </div>

        </div>
    </div>
</body>
</html>