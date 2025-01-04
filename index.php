<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> AGROINSIGHT HUB </title>
    <style>
        .square{
            width: 30%;
            height: 30%;
            background-color: white;
            color: black;
            text-align:center;
            font-size: 20px;
            cursor: pointer;
            position: relative;
            display:inline-block;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border:2px solid black; 
            border-radius: 25px;
            box-shadow: 8px 8px 5px rgb(85, 85, 85);
            overflow: hidden;
            margin: 3%;
        }
        .square:hover {
            background-color: #8ddd0d;
            transform: scale(1.02);
        }
      
       .square img{
            width: 100%;
            height: 100%;
            object-fit:cover;
            margin-top:10%;    
        }
       
       .square h1{
            font-size:130%;
        }
       
        body{
            padding: 0;
            background-image: url("l3.jpg");
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            color: #fff;
        }
         
        header{
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            text-align: center;
            font-size:200%;
        }

        nav{
            display: flex;
            justify-content: center;
            background-color: #333;
            padding: 10px;
        }

        nav a{
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 20px;
        }

        nav a:hover {
            background-color: #555;
        }

        .content {
            padding: 50px;
            text-align: center;
        }

    </style>
</head>
<body>
    <header>
        <h1 style="font-size:300%;">KrushiKisan</h1>
    </header>


    <nav>

        <a href="sign in.php">Sign in</a>
        <a href="about us.php">About us</a>
        <a href="contactus.php">Contact</a>
        <a href="myprofile.php">My Profile</a>
        <a href="my_orders.php">My Orders</a>

    </nav>
    <div class="content">
        <a href="<?php echo isset($_SESSION['user_id']) ? 'farmer.php' : 'javascript:checkLogin();'; ?>"> 
            <div class="square">
                <img src="5.jpg">
                <h1><b>Farmer</b></h1>
            </div>
        </a>

        <a href="products.php">
            <div class="square">
                <img src="3.jpg">
                <h1><b>Retail Store</b></h1>
            </div>
        </a>
    </div>

    <footer style="text-align: center;">
        &copy; 2023 Krushikisan. All rights reserved.
    </footer>
       
    <script>
        <?php if (!isset($_SESSION['user_id'])) : ?>
            function checkLogin(){
                alert("Please sign up or log in to access this feature.");
            }
        <?php endif; ?>
    </script>
</body>
</html>
