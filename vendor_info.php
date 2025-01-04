
<?php
session_start();
error_reporting(0);

if(!isset($_SESSION['Admin'])){
    header("location:admin_login.php");
}

include('include/header.php');
error_reporting(0);
?>
</html>
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
        <h3>Vendors Reports</h3>
        </div>
        <div class="date">
        <h4>Date : 3-01-2025 <br> Time : 07:25:11 PM</h4>
        </div>
        </div>

        <table>
            <tr>
                <th>Transaction Id</th>
                <th>Vendor Id</th>
                <th>Vendor Name</th>
                <th>Vendor Email</th>
                <th>Vendor Phone</th>
                <th>Vendor Address</th>
                <th>Vendor Pincode</th>
                <th>Crops Name</th>
                <th>Stock Quantity</th>
                <th>Crops Price</th>
                <th>Total Price Of Stock</th>
                <th>Vendor Entery Time</th>
                <th>Vendor History</th>
            </tr>

            <?php
            include('connect.php');

            $query = mysqli_query($conn, "select * from vendors");
            while ($row = mysqli_fetch_array($query)) {
                $id = $row['Transaction_Id'];
            ?>
                <tr>
                    <td><?php echo $row['Transaction_Id']; ?></td>
                    <td><?php echo $row['Vendor_Id']; ?></td>
                    <td><?php echo $row['Vendor_Name']; ?></td>
                    <td><?php echo $row['Vendor_Email']; ?></td>
                    <td><?php echo $row['Vendor_Phone']; ?></td>
                    <td><?php echo $row['Vendor_Address']; ?></td>
                    <td><?php echo $row['Vendor_Pincode']; ?></td>
                    <td><?php echo $row['Crops_Name']; ?></td>
                    <td><?php echo $row['Stock_Quantity_in_qt']; ?></td>
                    <td><?php echo $row['Crops_Price']; ?></td>
                    <td><?php echo $row['Total_Price_Of_Stock']; ?></td>
                    <td><?php echo $row['Vendor_Entery_Time']; ?></td>
                    <td><?php echo $row['Vendor_History']; ?></td>
                </tr>


            <?php } ?>

        </table>

    </div>
</div>

</body>
</html>