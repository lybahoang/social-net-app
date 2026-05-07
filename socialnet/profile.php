<?php
session_start();
require_once("../db.php");
?>

<?php     

    // If the user does not signin yet, redirect to sigin page.
    if (!isset($_SESSION['username']))
    {
        header("Location: signin.php");
        exit();
    }
        
    // If the user does sign in, check for query string.
    $profile_username = "";
    if (isset($_GET['owner']))  // If there is a query string.
    {
        $profile_username = $_GET['owner'];
    }
    else
    {
        $profile_username = $_SESSION['username'];
    }

    // Get the profile of the user.
    $fullname = "";
    $description = "";
    $result = db_query("SELECT fullname, description FROM account WHERE username = '" . $profile_username . "'");
    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $fullname = $row['fullname'];
        $description = $row['description'];
    }
    
?>

<!-- Menu bar -->
<?php include_once("menubar.php") ?>

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

    <!-- Main Content -->
    <div class="container">
        <div class="profile-card">

            <!-- Profile Owner -->
            <div class="profile-header">
                <h1><?= $profile_username . "'s Profile"?></h1>
            </div>

            <!-- Profile Description -->
            <div class="profile-content">
                <div class="description-box">
                    <p> <?= $description ?> </p>
                </div>
            </div>

        </div>
    </div>
</body>
</html>