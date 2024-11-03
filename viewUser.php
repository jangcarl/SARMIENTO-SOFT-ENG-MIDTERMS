<?php
session_start();
require_once 'core/models.php';
require_once 'core/handleForms.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Café System - User Details</title>
    <style>
        body {
            font-family: "Courier New"; /* Updated font to match your preference */
        }
        input {
            font-size: 1.5em;
            height: 50px;
            width: 200px;
        }
        table,
        th,
        td {
            border: 1px solid black;
        }
        .backButton {
            position: fixed;
            top: 20px;
            left: 10px; /* Fixed left positioning */
            z-index: 10000;
            background-color: white;
            border: 1px solid;
            padding: 10px; /* Adjusted padding for better appearance */
            border-radius: 25px; /* Modified border-radius for a sleeker look */
            text-align: center;
            text-decoration: none;
            color: inherit;
        }
        .main {
            background-color: #f8f8f8; /* Changed background for a café vibe */
        }
        .mainInner {
            background-color: white;
            width: 50%; /* Increased width for better layout */
            text-align: left;
            margin: 150px auto;
            padding: 30px;
            border-radius: 20px; /* Adjusted border-radius */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Enhanced shadow for depth */
            border: 1px solid #ddd; /* Softer border color */
        }
        h3 {
            color: #333; /* Darker text color for headings */
        }
    </style>
</head>
<body>
    <a class="backButton" href="index.php">Back</a>
    <?php $getUserByID = getUserByID($pdo, $_GET['user_id']); ?>
    <div class="main">
        <div class="mainInner">
            <h3>Café Username: <span style="font-weight: normal"><?php echo htmlspecialchars($getUserByID['username']); ?></span></h3>
            <h3>Date Joined: <span style="font-weight: normal"><?php echo htmlspecialchars($getUserByID['date_added']); ?></span></h3>
            <h3>Café Staff ID: <span style="font-weight: normal"><?php echo htmlspecialchars($getUserByID['cafe_staff_id']); ?></span></h3>
            <h3>Role: <span style="font-weight: normal"><?php echo htmlspecialchars($getUserByID['role']); ?></span></h3>
            <h3>Contact Number: <span style="font-weight: normal"><?php echo htmlspecialchars($getUserByID['contact_number']); ?></span></h3>
        </div>
    </div>
</body>
</html>
