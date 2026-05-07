<!-- The form to create/add new user to the system -->
<?php
require_once("../db.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	    // Get the user data from the input form.
	//     $username = $_POST['username'] ?? '';
	//         $fullname = $_POST['fullname'] ?? '';
	//             $password = $_POST['password'] ?? '';
	//                 $description = $_POST['description'] ?? '';
	//
	//                 	// Check if the username, fullname, and password are filled.
	//                 	    if (!$username || !$fullname || !$password) {
	//                 	            die("Missing required fields");
	//                 	                }
	//
	//                 	                    // Hash the password before insert into the database.
	//                 	                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
	//
	//                 	                            // Prepare SQL command string (IMPORTANT: prevents SQL injection)
	//                 	                                $conn = db_conn();
	//                 	                                    $stmt = $conn->prepare(
	//                 	                                        "INSERT INTO accounts (username, fullname, password, description)
	//                 	                                             VALUES (?, ?, ?, ?)"
	//                 	                                             );
	//                 	                                                 $stmt->bind_param("ssss", $username, $fullname, $hashedPassword, $description);
	//
	//                 	                                                     // Execute the SQL command.
	//                 	                                                         if ($stmt->execute()) {
	//                 	                                                                 echo "User registered successfully";
	//                 	                                                                     } else {
	//                 	                                                                             echo "Error: " . $stmt->error;
	//                 	                                                                                 }
	//                 	                                                                                     $stmt->close();
	//                 	                                                                                         $conn->close();
	//                 	                                                                                         }
	//                 	                                                                                         ?>
	//                 	                                                                                         <html>
	//                 	                                                                                         <head>
	//                 	                                                                                             <title>Register</title>
	//                 	                                                                                             </head>
	//                 	                                                                                             <body>
	//
	//                 	                                                                                             <h2>Create Account</h2>
	//
	//                 	                                                                                             <form action="/troy-classa/mini_project/admin_area/new_user.php" method="POST">
	//                 	                                                                                                 <label>Username:</label>
	//                 	                                                                                                     <input type="text" name="username" required><br><br>
	//
	//                 	                                                                                                         <label>Full Name:</label>
	//                 	                                                                                                             <input type="text" name="fullname" required><br><br>
	//
	//                 	                                                                                                                 <label>Password:</label>
	//                 	                                                                                                                     <input type="text" name="password" required><br><br>
	//
	//                 	                                                                                                                         <label>Description:</label><br>
	//                 	                                                                                                                             <textarea rows="3" cols="40" name="description"></textarea><br><br>
	//
	//                 	                                                                                                                                 <button type="submit">Register</button>
	//                 	                                                                                                                                 </form>
	//                 	                                                                                                                                 </body>
	//                 	                                                                                                                                 </html>
	//                 	                                                                                                                                 :
