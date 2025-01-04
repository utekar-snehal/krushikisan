<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css"  href="style.css">    
    <title>Loginpage</title> 


    <script>
          function validateForm(){
             var username = document.getElementById("email").value;
             var password = document.getElementById("password").value;

             if(email =="" || password ==""){
                 alert("please fill out both username and password");
                 return false;
             }
             return true;
          }
     </script>  

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
            margin-top: 12%;
            margin-left: 60%; 
            height:350px;
            width: 25%;
            color:white;
            border:3px solid #333;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            text-align: center;
        }


        header {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            text-align: center;
        }


   </style>
               
</head>
<body>


  
        <header>
        <h1 >AGROINSIGHT HUB</h1>
    </header>
    <div class="square">
   
    <form action="indexcon.php" onsubmit="return validateForm()" method="POST" >
      <h2>User Login</h2> <hr>
        <label>Email id :</label>
        <input type="Email" id="Email" name="Email"><br><br>
        <label>Password:</label>
        <input type="Password" id="Password" name="Password"> <br><br>

        <input value="login" type="submit">

          <hr>
         
       <h3>NO Account..? <a href="signup.php" style="color: #fff;"><u>Sign Up</u></a>
      </h3>
    </form>
    
    </div>
</body>
</html>