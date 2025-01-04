<?php
session_start();
include('connect.php');

if (!isset($_SESSION['Admin'])) {
    header("location:admin_login.php");
    exit; // Add exit to prevent further execution
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (isset($_POST['id'], $_POST['table'], $_POST['primary_key'])) {
        $id = $_POST['id'];
        $table = $_POST['table'];
        $primary_key = $_POST['primary_key'];

        // Construct the update query
        $update_query = "UPDATE $table SET ";
        foreach ($_POST as $key => $value) {
            // Exclude id, table, and primary_key from update
            if ($key != 'id' && $key != 'table' && $key != 'primary_key') {
                $update_query .= "$key = '$value', ";
            }
        }
        // Remove the trailing comma and space
        $update_query = rtrim($update_query, ', ');
        $update_query .= " WHERE $primary_key = $id";

        // Execute the update query
        if (mysqli_query($conn, $update_query)) {
            echo "Record updated successfully";
            header("Location: home.php");
            exit;
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid request!";
    }
} else {
    echo "Invalid request!";
}
?>

