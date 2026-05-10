<?php
session_start();
require_once("../db.php");
?>

<?php
    $current_description = "";
    if (!isset($_SESSION['username']))
    {   
        // If the user does not sign in yet, redirect to signin page.
        header("Location: signin.php");
        exit();
    }
    else
    {
        // Update the description column in the database.
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $username = addslashes($_SESSION['username']);
            $new_description = $_POST['description'];
            // Escape quotes so SQL syntax does not break
            $new_description = addslashes($new_description);

            db_execute("UPDATE account SET description = '" . $new_description . "' WHERE username = '". $username . "'");
        }

        // Take the current desciption to display.
        $result = db_query("SELECT description FROM account WHERE username = '" . $username . "'");
        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $current_description = $row['description'];
        }
    }
?>

<!-- Display the menu bar -->
<?php include_once("menubar.php") ?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting - Social Network</title>
    <style>
        /* Reset and Base Styles */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f9f9f9; color: #333; }


        /* Main Content Container */
        .main-content {
            display: flex; 
            justify-content: center;
            align-items: flex-start;
            padding: 50px 20px;
            min-height: 80vh;
        }
        
        /* Form Card */
        .form-container {
            background: white; 
            padding: 30px; 
            border-radius: 8px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
            width: 100%; 
            max-width: 600px;
        }
        
        h3 { margin-bottom: 15px; font-size: 1.2rem; color: #444; }
        
        textarea { 
            width: 100%; 
            height: 200px; 
            padding: 15px; 
            border: 1px solid #ddd; 
            border-radius: 4px; 
            resize: none; 
            font-size: 1rem; 
            margin-bottom: 20px;
        }
        
        /* Green Save Button from Image */
        .save-btn { 
            width: 100%; 
            padding: 12px; 
            background-color: #28a745; 
            color: white; 
            border: none; 
            border-radius: 4px; 
            font-size: 1.1rem; 
            font-weight: bold; 
            cursor: pointer; 
            transition: background 0.3s;
        }

        .save-btn:hover { background-color: #218838; }

        /* Mobile Adjustments */
        @media (max-width: 600px) {
            nav { flex-direction: column; gap: 1rem; text-align: center; }
            .nav-links { gap: 1rem; font-size: 0.9rem; }
        }
    </style>
</head>
<body>

    <!-- A form to modify description -->
    <div class="main-content">
        <div class="form-container">
            <form action="setting.php" method="POST">
                <h3>Enter description</h3>
                <textarea name="description" required><?= $current_description ?></textarea>
                <button type="submit" class="save-btn">Save</button>
            </form>
        </div>
    </div>

</body>
</html>
