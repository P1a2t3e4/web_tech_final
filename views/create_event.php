<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <style>
        /* body{
            background-image: url("..images");
        } */
    </style>
</head>

<body>
    <h1>Create Event</h1>
    <form action="../action/creating_events.php" method="POST">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="speaker">Speaker:</label><br>
        <input type="text" id="speaker" name="speaker"><br><br>

        <label for="date">Date:</label><br>
        <input type="date" id="date" name="date" required><br><br>

        <label for="time">Time:</label><br>
        <input type="time" id="time" name="time" required><br><br>

        <label for="location">Location:</label><br>
        <input type="text" id="location" name="location" required><br><br>

        <input type="submit" value="Create Event">
    </form>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php

    session_start();
    if (isset($_SESSION['message'])) {
        // Store the message in a variable and unset the session variable
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
        // Display the message using SweetAlert
        echo "<script>
        Swal.fire({
            title: 'Message',
            text: '$message',
            icon: 'info',
            confirmButtonText: 'OK'
        });
        </script>";
    }
    ?>
</body>

</html>