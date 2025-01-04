<?php
session_start();
error_reporting(0);

if (!isset($_SESSION['Admin'])) {
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
       
}

</style>
</head>
<body>

<div class="content">
    <div class="product_info">

    <div class="all">
        <div class="top">
        <h2 >KRUSHIKISAN</h2>
        <h3>Registration Reports</h3>
           </div>
        <div class="date">
        <h4>Date : 03-01-2025 <br> Time : 07:32:36 PM</h4>
        </div>
        </div>
        <table>
            <tr>
                <th>User Id</th>
                <th>User Name</th>
                <th>User Phone</th>
                <th>User Email Id</th>
                <th>User Password</th>
                <th>Signup Time</th>
            </tr>
            <?php
            include('connect.php');

            $query = mysqli_query($conn, "select * from signup");
            while ($row = mysqli_fetch_array($query)) {
                $id = $row['User_Id']; 
            ?>
                <tr>
                    <td><?php echo $row['User_Id']; ?></td>
                    <td><?php echo $row['User_Name']; ?></td>
                    <td><?php echo $row['Phone']; ?></td>
                    <td><?php echo $row['Email']; ?></td>
                    <td><?php echo $row['Password']; ?></td>
                    <td><?php echo $row['Signup_Time']; ?></td>
       </tr>
            <?php } ?>

        </table>
    </div>
</div>
</body>
</html>}