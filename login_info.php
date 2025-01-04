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
    </style>        
}
.date{
       text-align:right;
    }

</style>
</head>

<body>
<div class="content">
    <div class="product_info">
    <div class="all">
        <div class="top">
        <h2 >KRUSHIKISAN</h2>
        <h3>Login Reports</h3>
           </div>
        <div class="date">
        <h4>Date : 03-01-2025 <br> Time : 07:37:36 PM</h4>
        </div>
        </div>
        <table>
            <tr>
                <th>Login Id</th>
                <th>User Id</th>
                <th>Email_Id</th>
                <th>Password</th>
                <th>Login Time</th>

            </tr>

            <?php
            include('connect.php');

            $query = mysqli_query($conn, "select * from login");
            while ($row = mysqli_fetch_array($query)) {
                $id = $row['Login_Id']; 
            ?>
                <tr>
                    <td><?php echo $row['Login_Id']; ?></td>
                    <td><?php echo $row['User_Id']; ?></td>
                    <td><?php echo $row['Email_Id']; ?></td>
                    <td><?php echo $row['Password']; ?></td>
                    <td><?php echo $row['Login_Time']; ?></td>

                </tr>


            <?php } ?>

        </table>

    </div>
</div>

</body>
</html>