<?php
include('connect.php');
session_start();
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = $_POST["Email"];
    $Password = $_POST["password"];
    
    // Query the signup table for regular users
    $query1 = "SELECT * FROM signup WHERE Email = '$Email' AND Password = '$Password'";
    $result1 = $conn->query($query1);

    if ($result1->num_rows > 0 || $result2->num_rows > 0) {
        
            $row = $result1->fetch_assoc();
            $_SESSION['user_id'] = $row['User_Id'];
            $_SESSION['username'] = $row['User_Name'];
            $_SESSION['phone'] = $row['Phone'];
            $_SESSION['email'] = $row['Email'];
            $_SESSION['password'] = $row['Password'];
            $_SESSION['time'] = $row['Signup_Time'];
            
            // Insert login record for regular user
            $userid = $row['User_Id'];
            $username = $row['User_Name'];
            $insertQuery = "INSERT INTO login (User_Id, Name, Email_Id, Password) VALUES ('$userid', '$username', '$Email', '$Password')";
            $conn->query($insertQuery);
            
            // Redirect regular user to index page
            header("Location: index.php");
            exit();
        }
     else {
        // Display error message if login fails
        $error_message = "Error: Invalid Email or password";
        echo '<script>alert("' . $error_message . '");</script>';
    }

    // Close the database connection
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url("l5.jpg");
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.5); 
            text-align: center;
            max-width: 400px;
            border: 1px solid black; 
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc; 
            border-radius: 5px;
            font-size: 16px;
        }

        .login-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-container input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .signup-link {
            margin-top: 20px;
            color: #333;
        }

        .signup-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            padding: 20px;
            text-align: center;
            color: #fff;
            background-color: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
<header>
    <h1>KRUSHIKISAN</h1>
</header>

<div class="login-container">
    <h2>Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="email" id="Email" name="Email" placeholder="Enter your email" required><br>
        <input type="password" id="password" name="password" placeholder="Enter your password" required><br>
        <input type="submit" value="Login">
    </form>
    <div class="signup-link">
        Don't have an account? <a href="signup.php">Sign up now</a>
    </div>
</div>

</body>
</html>