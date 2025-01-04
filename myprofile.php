<?php
include('connect.php');
session_start();

// Check if 'user_id' exists in the session
if (!isset($_SESSION['user_id'])) {
    $e = "";
} else {
    $e = isset($_SESSION['email']) ? $_SESSION['email'] : "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>My Profile</title>

    <style> 
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-around;
            margin-left: 10%;
            margin-right: 10%;
            margin-top: 3%;
        }

        .container1 {
            width: 60%;
            height: 70%;
            background-color: white;
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 5px;
            text-align: center;
            font-size: 100%;
        }

        h2 {
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 230%;
        }

        p {
            color: #555;
            margin-bottom: 15;
            margin-top: 1%;
            font-size: 180%;
            margin-left: 6%;
        }

        strong {
            color: teal;
            font-size: 90%;
            margin-bottom: 2%;
        }

        h3 {
            text-align: center;
            font-size: 300%;
        }

        .number {
            color: black;
            font-size: 130%;
            margin-top: 15%;
        }

        button {
            text-align: center;
            margin-left: 45%;
            margin-top: 10%;
            margin-bottom: 10%;
            font-size: 110%;
            background-color: red;
            width: 90px;
            height: 40px;
            border: 1px solid black;
            border-radius: 10%;
            color: white;
        }

        button:hover {
            background-color: green;
        }

        .content {
            width: 90%;
            margin: 5%;
            border: 1px solid black;
            border-radius: 10%;
            background-color: white;
        }
    </style>
</head>

<body>

<h3>KRUSHIKISAN</h3>
<header>
    <h1>My Profile</h1>
</header>

<div class="product-container">
<?php if (isset($_SESSION['user_id'])) { ?>
    <div class="container1">
        <p><strong><br>Username:</strong> <br><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : "Not available"; ?></p>
        <p><strong>User ID:</strong> <br><?php echo $_SESSION['user_id']; ?></p>
        <p><strong>Email ID:</strong> <br><?php echo $e; ?></p>
        <p><strong>Phone:</strong> <br><?php echo isset($_SESSION['phone']) ? $_SESSION['phone'] : "Not available"; ?></p>
        <p><strong>Password:</strong> <br><?php echo isset($_SESSION['password']) ? $_SESSION['password'] : "Not available"; ?></p>
        <p><strong>Time of Signup:</strong> <br><?php echo isset($_SESSION['time']) ? $_SESSION['time'] : "Not available"; ?></p>
        <p><a href="logout.php">Logout</a></p>
    </div>
<?php } else { ?>
    <h2>You Have Not Signed In .. <a href="sign in.php">click here to Sign In</a></h2>
<?php } ?>
</div>   
</body>
</html> 