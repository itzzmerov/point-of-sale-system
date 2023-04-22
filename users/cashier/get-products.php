<?php
	// Connect to MySQL database
	include '../../includes/config.php';

	// Build query based on branch filter
	$query = "SELECT name, SUM(quantity) AS total FROM sales INNER JOIN products ON sales.product_id = products.product_id GROUP BY sales.product_id ORDER BY total DESC LIMIT 10";

	// Retrieve highest selling products
	$result = mysqli_query($conn, $query);

	$counter = 0; // initialize row counter

	// Loop through results and display in table
	while ($row = mysqli_fetch_assoc($result)) {
		$counter++;
		echo "<tr>";
		echo "<td>" . $counter . "</td>"; // add row number column
		echo "<td>" . $row["name"] . "</td>";
		echo "<td>" . $row["total"] . "</td>";
		echo "</tr>";
	}

	// Close MySQL connection
	mysqli_close($conn);
?>