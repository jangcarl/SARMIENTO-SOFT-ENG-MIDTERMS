<?php
session_start();
require_once 'dbConfig.php';
require_once 'models.php';

$username = $_SESSION['username'];

// Handle Customer Insertion
if (isset($_POST['insertOrderBtn'])) {
    $query = insertCustomer($pdo, $_POST['fullname'], $_POST['contact_number'], $_POST['date_joined'], $username);
    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Insertion failed";
    }
}

// Handle Customer Update
if (isset($_POST['editEmployeeBtn'])) {
    $query = updateEmployee($pdo, $_POST['fullname'], $_POST['contact_number'], $_POST['date_joined'], $_GET['customer_id'], $username);
    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Edit failed";
    }
}

// Handle Customer Deletion
if (isset($_POST['deleteEmployeeBtn'])) {
    $query = deleteEmployee($pdo, $_GET['customer_id']);
    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Deletion failed";
    }
}

// Handle Order Insertion
if (isset($_POST['insertNewOrderBtn'])) {
    $query = insertOrder($pdo, $_POST['order_details'], $_POST['order_date'], $_GET['customer_id'], $username);
    if ($query) {
        header("Location: ../viewOrder.php?customer_id=" . $_GET['customer_id']);
    } else {
        echo "Insertion failed";
    }
}

// Handle Order Update
if (isset($_POST['editOrderBtn'])) {
    $query = updateOrder($pdo, $_POST['order_details'], $_POST['order_date'], $_GET['order_id'], $username);
    if ($query) {
        header("Location: ../viewOrder.php?customer_id=" . $_GET['customer_id']);
    } else {
        echo "Update failed";
    }
}

// Handle Order Deletion
if (isset($_POST['deleteOrderBtn'])) {
    $query = deleteOrder($pdo, $_GET['order_id'], $username);
    if ($query) {
        header("Location: ../viewOrder.php?customer_id=" . $_GET['customer_id']);
    } else {
        echo "Deletion failed";
    }
}

function getAllInfoByCustomerID($pdo, $customer_id)
{
	$sql = "SELECT * FROM customers WHERE customer_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$customer_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

?>
