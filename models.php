<?php

function insertCustomer($pdo, $fullname, $contact_number, $date_joined, $username)
{
    $sql = "INSERT INTO customers (fullname, contact_number, date_joined, added_by, last_updated) VALUES (?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$fullname, $contact_number, $date_joined, $username, date("Y-m-d H:i:s")]);
}

function updateEmployee($pdo, $fullname, $contact_number, $date_joined, $customer_id, $username)
{
    $sql = "UPDATE customers SET fullname = ?, contact_number = ?, date_joined = ?, last_updated = ?, added_by = ? WHERE customer_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$fullname, $contact_number, $date_joined, date("Y-m-d H:i:s"), $username, $customer_id]);
}

function deleteEmployee($pdo, $customer_id)
{

    $deleteWebDevProj = "DELETE FROM orders WHERE customer_id = ?";
    $deleteStmt = $pdo->prepare($deleteWebDevProj);
    $executeDeleteQuery = $deleteStmt->execute([$customer_id]);

    if ($executeDeleteQuery) {
        $sql = "DELETE FROM customers WHERE customer_id = ?";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$customer_id]);

        if ($executeQuery) {
            return true;
        }

    }

}

function getAllCustomers($pdo)
{
    $sql = "SELECT * FROM customers";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getEmployeeByID($pdo, $customer_id)
{
    $sql = "SELECT * FROM customers WHERE customer_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$customer_id]);
    return $stmt->fetch();
}

function getOrdersByEmployee($pdo, $customer_id)
{

    $sql = "SELECT 
				orders.order_id AS order_id,
				orders.order_details AS order_details,
				orders.order_date AS order_date
			FROM orders
			JOIN customers ON orders.customer_id = customers.customer_id
			WHERE orders.customer_id = ? 
			GROUP BY orders.order_details;
			";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$customer_id]);
    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

function insertOrder($pdo, $order_details, $order_date, $customer_id, $username)
{
    $sql = "INSERT INTO orders (order_details, order_date, customer_id, added_by, last_updated) VALUES (?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$order_details, $order_date, $customer_id, $username, date("Y-m-d H:i:s")]);
}

function updateOrder($pdo, $order_details, $order_date, $order_id, $username)
{
    $sql = "UPDATE orders SET order_details = ?, order_date = ?, last_updated = ?, added_by = ? WHERE order_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$order_details, $order_date, date("Y-m-d H:i:s"), $username, $order_id]);
}

function deleteOrder($pdo, $order_id, $username)
{
    $sql = "DELETE FROM orders WHERE order_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$order_id]);
}

function getOrderByID($pdo, $order_id)
{
    $sql = "SELECT * FROM orders WHERE order_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$order_id]);
    return $stmt->fetch();
}

function getAllInfoByEmployeeID($pdo, $customer_id)
{
    $sql = "SELECT * FROM customers WHERE customer_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$customer_id]);
    return $stmt->fetch();
}

function getUserByID($pdo, $user_id)
{
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$user_id]);
    if ($executeQuery) {
        return $stmt->fetch();
    }
}

?>