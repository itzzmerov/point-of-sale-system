<?php
// Connect to MySQL database
include '../../includes/config.php';

// Prepare and bind statement for inserting sales data
$stmt = $conn->prepare("INSERT INTO sales (invoice_number, invoice_date, product_id, category_id, quantity, price, subtotal_amount, discount, user_id, branch_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssiiddiii", $invoice_number, $invoice_date, $name, $category_id, $quantity, $price, $subtotal_amount, $discount, $user_id, $branch_id);


// Get the current date and time
$date = new DateTime();
$timestamp = $date->format('YmdHis');

// Generate a random number
$rand = rand(1000, 9999); 

// Get form data
$invoice_number = "INV-" . $timestamp . "-" . $rand;
$user_id = $_POST["user"];
$branch_id = $_POST["branch"];
$invoice_date = $_POST["date"];

// Loop through each product in the table and insert into database
for ($i = 0; $i < count($_POST["category"]); $i++) {
    $category_id = $_POST["category"][$i];
    $name = $_POST["name"][$i];
    $quantity = $_POST["quantity"][$i];
    $price = $_POST["price"][$i];
    $discount = $_POST["discount"][$i];
    $subtotal_amount = $_POST["subtotal"][$i];

    // Insert sales data into the sales table
    $stmt->execute();
}

// Close statement and database connection
$stmt->close();
$conn->close();

// Redirect back to the form page
if($stmt){
    
    echo "<script>alert('You have successfully added a new sale!');</script>";
    echo "<script>document.location='sales-manage.php';</script>";
}
exit();
?>