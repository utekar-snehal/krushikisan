<?php
include('connect.php');
session_start();

if (isset($_SESSION['user_id'])) {
    $e = $_SESSION['email'];
}
else
{
    $e = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>My Orders</title>

    <style> 
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container{
            margin-top:5%;
            width: 70%;
            height: auto;
            margin-left:15%;
            margin-right:15%;
            background-color:#CCCCCC;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            border-radius: 0%;
            text-align:center;
        }
        .container p , .container1 p{
            margin-left:6%;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 5px;
            text-align: center;
            font-size:100%;
        }

        h2 {
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-align:center;
            font-size:180%;
        }

        p {
            color: #555;
            margin-bottom: 1px;
            margin-top:1%;
            font-size:180%;
        }

        strong{
            color:teal;
            font-size:15px;
        }
        h3{
            text-align:center;
            font-size:300%;
        }
        .number{
            color:black;
            font-size:250%;
            margin-top:15%;
            margin-bottom:5%;
            decoration:underline;
        }
        button{
            text-align:center;
            margin-left:15%;
            margin-right:15%;
            margin-top: 10%;
            margin-bottom: 10%;
            font-size:110%;
            background-color: green;
            width:120px;
            height:40px;
            border:1px solid black;
            border-radius:10%;
            color:white;
        }
        button:hover {
            background-color: red;
        }
        .content{
            width:90%;
            margin:5%;
            border:1px solid black;
            border-radius:5%;
            background-color:white;
        }

        .content1{
            width:90%;
            margin-left:10%;
            text-align:left;
        }
    </style>
</head>

<body>

<h3>KRUSHIKISAN</h3>
<header>
    <h1>My Orders</h1>
</header>

    <div class="container">
        <?php
        $query = "SELECT * FROM orders WHERE Customer_Email = '$e'";
        $result1 = $conn->query($query);
        if($result1->num_rows > 0){
            while ($row = $result1->fetch_assoc()) {
                echo '<div class="content">';
                echo '<div class="content1">';
                echo '<p class="number"> <b>Order ID :      ' . $row['Order_Id'] . '</b></p><br>';
                echo '<p> <b>Product  : </b>' . $row['Product_Name'] . '</p><br>';
                echo '<p> <b>Price : </b> &#8377;' . $row['Product_Price'] . '/kg</p><br>';
                echo '<p> <b>Quantity : </b>' . $row['Product_Quantity'] . 'kg</p><br>';
                $quantity =  $row['Product_Quantity'];
                $fix = 50 ;
                $factor = 0.1;
                $p_price =  $row["Product_Price"] ;
                $ship_price = $factor * $p_price * $quantity + $fix;
                $total = $p_price * $quantity + $ship_price ;


                echo '<p> <b>Shipping Charges  : </b> &#8377;' .$ship_price. '/-</p><br>';     
                echo '<p> <b>Total : </b> &#8377;' . $total. '/-</p><br>';
                
                echo '<p> <b>Status :  Shipped</b></p><br>';
                echo '</div>';
                echo '<button onclick="deleteOrder(' . $row['Order_Id'] . ')">Cancel Order</button>';
                
                echo '</div>';
            }
        } else {
            echo  '<h2>You have no Orders.</h2>';
        }
        
        ?>
    </div>
<script>
function deleteOrder(orderId) {
    if (confirm("Are you sure you want to cancel this order?")) {
        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();
        
        // Configure the request
        xhr.open("POST", "delete_order.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        // Set up the callback function
        xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                if (xhr.status == 200) {
                    // Reload the page after successful deletion
                    location.reload();
                } else {
                    // Handle deletion error
                    alert('Error: ' + xhr.status);
                }
            }
        };
        xhr.send("order_id=" + orderId);
    }
}
</script>

</body>
</html>
