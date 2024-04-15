<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
session_start();

// Include connection parameters
require_once '../settings/connection.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if admin_id is set
    if (!isset($_SESSION['admin_id'])) {
        $_SESSION['message'] = "Not authorized to use this feature.";
        header("Location: ../views/create_event.php"); // Redirect to previous page
        exit;
    }

    // Retrieve form data
    $event_name = $_POST['title'];
    $event_description = $_POST['description'];
    $event_speaker = $_POST['speaker'];
    $event_date = $_POST['date'];
    $event_time = $_POST['time'];
    $event_location = $_POST['location'];
    $admin_id = $_SESSION['admin_id'];

    // Call the createEvent function
    $result = createEvent($event_name, $event_description, $event_speaker, $event_date, $event_time, $event_location, $admin_id);

    // Check the result and store a message in a session variable
    if ($result) {
        $_SESSION['message'] = "Event created successfully.";
    } else {
        $_SESSION['message'] = "Failed to create event.";
    }
    header("Location: ../admin/dashboard.php");
    exit;
}

function createEvent($event_name, $event_description, $event_speaker, $event_date, $event_time, $event_location, $created_by)
{
    global $conn;

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO Events (Title, Description, Speaker, Date, Time, Location, CreatedBy) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $event_name, $event_description, $event_speaker, $event_date, $event_time, $event_location, $created_by);

    // Execute the SQL statement and store the result
    $insertResult = $stmt->execute();

    // Close the statement
    $stmt->close();

    // Return the result of the execution
    return $insertResult;
}
