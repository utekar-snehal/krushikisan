
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css"  href="style.css">    
    <title>Create Account</title> 
        <style> 
        body{
            margin: 0;
            padding: 0;
            background-image: url("l5.jpg");
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            color:#fff;
            font-family: Arial, sans-serif;

        }
        .square{
            margin-top: 9%;
            margin-left:34%; 
            height:320px;
            width: 35%;
            color:white;
            border:3px solid rgb(14, 38, 104);
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            text-align: center;
            border-radius: 5%;
        }

        header {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            text-align: center;
        }
    </style>
               
</head>
<body style="text-align:center;">
   <header>
        <h1 >LIVE CHAT</h1>
    </header>
    <div class="square">
    <form  action="signupcon.php" onsubmit="return validateForm()" method="POST" >
      <h2>Create Account</h2> <hr>
        <label>Username :</label>
        <input type="username" id="username" name="username"><br><br>
        <label>Phone Number :</label>
        <input type="phone" id="phone" name="phone"><br><br>
        <label>Email id :</label>
        <input type="email" id="email" name="email"><br><br>
        <label>Password:</label>
        <input type="password" id="password" name="password"> <br><br><br>
        <input value="Create Account" type="submit"></h3>
    </form>
    </div>
    <script>
    <script>
    <script>
        function validateForm() {
            var username = document.getElementById("username").value;
            var phone = document.getElementById("phone").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

            if (username == "" || phone == "" || email == "" || password == "") {
                alert("Please fill all fields");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>