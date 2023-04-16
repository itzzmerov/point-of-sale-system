<?php 

    include '../../includes/config.php';

    // Get the selected product ID from the AJAX request
    $product_id = $_POST["product_id"];

    // Prepare a query to fetch the product price with the selected product ID
    $stmt = $conn->prepare("SELECT price FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    // Fetch the product price and echo it as the response
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row["price"];
    } else {
        echo "0"; // Echo 0 or any default value if product price is not found
    }

    // Close the database connection
    $conn->close();
?>