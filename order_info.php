<?php
session_start();
error_reporting(0);

if(!isset($_SESSION['Admin'])){
    header("location:admin_login.php");
}
?>

<?php
include('include/header.php');
error_reporting(0);
?>
<html>
<head>
<link rel="stylesheet" href="admin_panel.css">

<style>
    table, th , td{
    border:1px solid black;
    </style>        
}

</style>

</head>
<body>
<div class="content">
    <div class="product_info">
    <div class="all">
        <div class="top">
        <h2 >KRUSHIKISAN</h2>
        <h3>Orders Reports</h3>
        </div>
        <div class="date">
        <h4>Date : 3-01-2025 <br> Time : 07:35:08 PM</h4>
        </div>
        </div>
        <table>
            <tr>
                <th> Order Id</th>
                <th>Product Id</th>
                <th>Product</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
                <th>Shipping Charges</th>
                <th>Total</th>
                <th>Cuatomer Name</th>
                <th>Customer Phone</th>
                <th>Customer Email</th>
                <th>Customer Address</th>
                <th>Customer Pincode</th>
                <th>Order Date</th>

            </tr>

            <?php
            include('connect.php');

            $query = mysqli_query($conn, "select * from orders");
            while ($row = mysqli_fetch_array($query)) {
                $id = $row['Order_Id'];
            ?>
                <tr>
                    <td><?php echo $row['Order_Id']; ?></td>
                    <td><?php echo $row['Product_Id']; ?></td>
                    <td><?php echo $row['Product_Name']; ?></td>
                    <td><?php echo $row['Product_Price']; ?></td>
                    <td><?php echo $row['Product_Quantity']; ?></td>
                    <td><?php echo $row['Shipping_Charges']; ?></td>
                    <td><?php echo $row['Total']; ?></td>
                    <td><?php echo $row['Customer_Name']; ?></td>
                    <td><?php echo $row['Customer_Phone']; ?></td>
                    <td><?php echo $row['Customer_Email']; ?></td>
                    <td><?php echo $row['Customer_Address']; ?></td>
                    <td><?php echo $row['Customer_Pincode']; ?></td>
                    <td><?php echo $row['Order_Date']; ?></td>
                </tr>


            <?php } ?>

        </table>

    </div>

<div class="product_info">

<h2>Cancelled Orders</h2>

<table>
    <tr>
        <th>Order Id</th>
        <th>Product Id</th>
        <th>Product</th>
        <th>Product Price</th>
        <th>Product Quantity</th>
        <th>Shipping Charges</th>
        <th>Total</th>
        <th>Cuatomer Name</th>
        <th>Cancellation time</th>
      
    </tr>
    <?php
    include('connect.php');
    $query1 = mysqli_query($conn, "select * from order_cancellation_table");
    while ($row = mysqli_fetch_array($query1)) {
        $id = $row['Order_Cancellation_Id'];
    ?>
        <tr>
            <td><?php echo $row['Order_Id']; ?></td>
            <td><?php echo $row['Product_Id']; ?></td>
            <td><?php echo $row['Product_Name']; ?></td>
            <td><?php echo $row['Product_Price']; ?></td>
            <td><?php echo $row['Product_Quantity']; ?></td>
            <td><?php echo $row['Shipping_Charges']; ?></td>
            <td><?php echo $row['Total']; ?></td>
            <td><?php echo $row['Customer_Name']; ?></td>
            <td><?php echo $row['Cancellation_Time']; ?></td>

            
            
        </tr>


    <?php } ?>

</table>

</div>
</div>

    </body>
    </html>