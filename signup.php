<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Create Account</title>
    <style> 
        body {
            margin: 0;
            padding: 0;
            background-image: url("l5.jpg");
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            color: #fff;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        header {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            text-align: center;
        }

        .square {
            margin-top: 9%;
            margin-left: 34%;
            height: 400px;
            width: 400px;
            color: white;
            border: 4px solid rgb(14, 38, 104);
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.5);
        }

        .square h2 {
            margin-bottom: 20px;
        }

        .square label {
            display: block;
            margin-bottom: 10px;
            color: #fff;
        }

        .square input[type="text"],
        .square input[type="email"],
        .square input[type="password"] {
            width: calc(100% - 40px);
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            outline: none;
            font-size: 16px;
        }

        .square input[type="submit"] {
            width: calc(100% - 40px);
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .square input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .signup-link {
            color: #fff;
            font-size: 14px;
            margin-top: 20px;
        }

        .signup-link a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php
    include('connect.php');
    session_start();

    $error_message = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $Username = $_POST["username"];
        $Phone = $_POST["phone"];
        $Email = $_POST["email"];
        $Password = $_POST["password"];

        $checkQuery = "SELECT * FROM signup WHERE Phone = '$Phone' OR Email = '$Email'";
        $result = $conn->query($checkQuery);

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

            if ($row['Phone'] == $Phone) {
                $error_message = "Someone already logged in with this Phone Number. Please use another Phone Number.";
            } elseif ($row['Email'] == $Email) {
                $error_message = "Someone already logged in with this Email Id. Please use another Email Id.";
            }
        } else {
            $insertQuery = "INSERT INTO signup (User_Name, Phone, Email, Password) VALUES ('$Username', '$Phone', '$Email', '$Password')";

            if ($conn->query($insertQuery) === TRUE) {
                $row = $result->fetch_assoc();
                $_SESSION['user_id'] = $row['Accountno'];
                $_SESSION['username'] = $row['User_Name'];
                $_SESSION['phone'] = $row['Phone'];  
                $_SESSION['email'] = $row['Email'];
                $_SESSION['password'] = $row['Password'];
                $_SESSION['time_to_signup'] = $row['signup_time'];
                $error_message = "Registration successful!";
                header("Location:home page.php");
                exit();
            } else {
                $error_message = "KRUSHIKISAN: " . $insertQuery . "<br>" . $conn->error;
            }
        }
    }
    $conn->close();
    ?>

    <header>
        <h1>KRUSHIKISAN</h1>
    </header>
    
    <div class="square">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <h2>Create Account</h2><hr>
            <label>Username:</label>
            <input type="text" id="username" name="username" required><br>
            <label>Phone Number:</label>
            <input type="text" id="phone" name="phone" required><br>
            <label>Email:</label>
            <input type="email" id="email" name="email" required><br>
            <label>Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Create Account">
        </form>
        <div class="signup-link">
            If already have an account, <a href="signin.php">click here</a> to sign in.
        </div>
    </div>

    <?php if (!empty($error_message)): ?>
        <script>
            alert("<?php echo $error_message; ?>");
        </script>
    <?php endif;?>
</body>
</html>
