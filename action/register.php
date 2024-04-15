<?php
include '../settings/connection.php'; // Include the connection file
session_start();

$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $userType = mysqli_real_escape_string($conn, $_POST['userType']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password2= mysqli_real_escape_string($conn, $_POST['password2']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $terms = isset($_POST['terms']) ? true : false;

    // Validate input fields
    $errors = [];

    // Perform validation as needed
    if (empty($userType) || empty($email) || empty($phoneNumber) || !$terms ||empty($password) || empty($password2 )) {
        $errors[] = "Please fill in all fields and agree to the terms.";
    }

    if(empty($errors)) {
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "";

        if($userType=="student"){
            $firstName = mysqli_real_escape_string($conn, $_POST['first_name']);
            $lastName = mysqli_real_escape_string($conn, $_POST['last_name']);
            $major = mysqli_real_escape_string($conn, $_POST['major']);
            $sql = "INSERT INTO students (FirstName, LastName, Major, Email, PhoneNumber, psw) 
            VALUES ('$firstName', '$lastName', ' $major', '$email', '$phoneNumber', '$hashedpassword')";
        }
        else if($userType=="admin"){
            $admin_name = mysqli_real_escape_string($conn, $_POST['admin_name']);
            $department = mysqli_real_escape_string($conn, $_POST['department']);
            $sql = "INSERT INTO admins (FirstName, department, Email, PhoneNumber, psw) 
            VALUES (' $admin_name', ' $department', '$email', '$phoneNumber', '$hashedpassword')";
        }

        $insertResult = mysqli_query($conn,$sql);

        if($insertResult){
            $response['success'] = true;
            $response['message'] = 'Registration was successful!!';
        }
        else{
            $response['message'] = 'Registration was not successful!!';
        }
    }
    else {
        $response['message'] = implode(", ", $errors);
    }
}

echo json_encode($response);
?>