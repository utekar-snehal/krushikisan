<?php
session_start();
error_reporting(0);

if (!isset($_SESSION['Admin'])) {
    header("location:admin_login.php");
    exit; // Add exit to prevent further execution
}
?>

<?php
include('include/header.php');
error_reporting(0);
?>

<link rel="stylesheet" href="admin_panel.css">

<style>
    table,
    th,
    td {
        border: 1px solid black;
    }
    img{
        width:50px; 
        height:50px;
    }
</style>

<div class="content">
    <div class="product_info">

    <div class="all">
        <div class="top">
        <h2 >KRUSHIKISAN</h2>
        <h3>Products Reports</h3>
        </div>
        <div class="date">
        <h4>Date : 03-01-2025 <br> Time : 07:25:11 PM</h4>
        </div>
        </div>

        <table>
            <tr>
                <th>Product Id</th>
                <th>Product Name</th>
                <th>Product Img</th>
                <th>Product Category</th>
                <th>Product Info</th>
                <th>Product Price</th>
                <th>Quantity Available</th>
                <th>MFG</th>
                <th>Updated At</th>
                <th>Marathi_Name</th>

            </tr>

            <?php
            include('connect.php');

            $query = mysqli_query($conn, "SELECT * FROM products");
            while ($row = mysqli_fetch_array($query)) {
                $id = $row['Product_Id']; // Assuming 'Product_Id' is the primary key column
            ?>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $row['Product_Name']; ?></td>
                    <td><?php $image = "products/$row[Product_Img]";
                    echo "<img src='$image'>";?></td>
                    <td><?php echo $row['Product_Category']; ?></td>
                    <td><?php echo $row['Product_Info']; ?></td>
                    <td><?php echo $row['Product_Price']; ?></td>
                    <td><?php echo $row['Product_Quantity_Available']; ?></td>
                    <td><?php echo $row['Product_Created_At']; ?></td>
                    <td><?php echo $row['Product_Updated_At']; ?></td>
                    <td><?php echo $row['Product_Marathi_Name']; ?></td>
          </tr>
            <?php } ?>
        </table>

    </div>
</div>
