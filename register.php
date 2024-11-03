<?php
require_once 'core/models.php';
require_once 'core/dbConfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $age = $_POST['age'];

    $stmt = $pdo->prepare("INSERT INTO users (username, password, first_name, last_name, address, age) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$username, $password, $first_name, $last_name, $address, $age]);

    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: #f4f1ea;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .form-container {
            background-color: #fff8e1;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #8b4513;
        }
        input[type="text"], input[type="password"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #d2691e;
            border-radius: 5px;
        }
        .submit-btn {
            background-color: #d2691e;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #c85a17;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Register</h1>
        <form method="post">
            <input type="text" name="username" required placeholder="Username"><br>
            <input type="password" name="password" required placeholder="Password"><br>
            <input type="text" name="first_name" required placeholder="First Name"><br>
            <input type="text" name="last_name" required placeholder="Last Name"><br>
            <input type="text" name="address" required placeholder="Address"><br>
            <input type="number" name="age" required placeholder="Age"><br>
            <button type="submit" class="submit-btn">Register</button>
        </form>
    </div>
</body>
</html>
