<?php
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $Username = $_POST["username"];
    $Phone = $_POST["phone"];
    $Email = $_POST["email"];
    $Password = $_POST["password"];

    // Check if the phone or email already exists in the database
    $checkQuery = "SELECT * FROM signup WHERE Phone = '$Phone' OR Email = '$Email'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        // Duplicate entry found
        $row = $result->fetch_assoc();
        if ($row['Phone'] == $Phone) {
            echo '<script>alert("Error: Phone number already exists!");</script>';
        } elseif ($row['Email'] == $Email) {
            echo '<script>alert("Error: Email already exists!");</script>';
        }
    } else {
        // No duplicate entry, proceed with registration
        $insertQuery = "INSERT INTO signup (Username, Phone, Email, Password) VALUES ('$Username', '$Phone', '$Email', '$Password')";

        if ($conn->query($insertQuery) === TRUE) {
            echo '<script>alert("Registration successful!");</script>';
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
