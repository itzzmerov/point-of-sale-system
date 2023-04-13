<?php 

    include '../../includes/config.php';

    // Get the selected category_id from the AJAX request
    $category_id = $_POST["category_id"];

    // Prepare a query to fetch products with the selected category_id
    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = ?");
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    // Generate the options for the "Name" select tag
    if ($result->num_rows > 0) {
        echo "<option selected hidden value=''>Select Name Here...</option>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["product_id"] . "'>" . $row["name"] . "</option>";
        }
    } else {
        echo "<option selected hidden value=''>No products found</option>";
    }

    // Close the database connection
    $conn->close();
?>