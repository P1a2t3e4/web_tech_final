<?php
include '../settings/connection.php'; // Adjust the path according to your file structure
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check whether the user is a student
    $sql = "SELECT * FROM students WHERE Email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['psw'])) {
            // Password is correct, set session variables
            $_SESSION['student_id'] = $row['User_id'];
            $_SESSION['user_email'] = $row['Email'];
            header("Location: ../views/event_calender.php");
            exit();
        } else {
            $_SESSION['error'] = 'Incorrect password';
            header("Location: ../views/login.php");
            exit();
        }
    }

    // Check if user is admin
    $sql2 = "SELECT * FROM admins WHERE Email='$email'";
    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {
        $row = $result2->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['psw'])) {
            // Password is correct, set session variables
            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['user_email'] = $row['Email'];
            header("Location: ../admin/dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = 'Incorrect password';
            header("Location: ../views/login.php");
            exit();
        }
    }

    // If the user is not registered as either student or admin, redirect to the register page
    header("Location:../views/register.php");
    exit();
}

$conn->close();
?>