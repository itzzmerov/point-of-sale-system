<?php
include '../../includes/config.php';

// Get filter parameter
$filter = isset($_POST['filter']) ? $_POST['filter'] : 'weekly';

// Set date format and query interval based on filter
switch ($filter) {
    case 'monthly':
        $date_format = '%M %d';
        $interval = '1 DAY';
        break;
    case 'quarterly':
        $date_format = '%M';
        $interval = '1 MONTH';
        break;
    case 'yearly':
        $date_format = '%b';
        $interval = '1 MONTH';
        break;
    case 'weekly':
        $date_format = '%M Week %u';
        $interval = '1 WEEK';
        break;
    default:
        $date_format = '%a %d';
        $interval = '1 DAY';
        break;
}

// Query sales data

session_start();

$admin = $_SESSION['admin_name'];
$sql1 = "SELECT * FROM users WHERE username = '$admin'";
$result = $conn->query($sql1);
while($row = $result->fetch_assoc()) {
    $branch = $row['branch_id'];
}

$currentMonth = date('m');

$sql = "SELECT DATE_FORMAT(invoice_date, '{$date_format}') AS date, SUM(subtotal_amount) AS total_sales
        FROM sales
        WHERE MONTH(invoice_date) = '$currentMonth' AND branch_id = '$branch'
        GROUP BY date
        ORDER BY invoice_date ASC";
$result = mysqli_query($conn, $sql);

// Format data for line chart
$labels = array();
$values = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $labels[] = $row['date'];
        $values[] = $row['total_sales'];
    }
}

// Return data as JSON
$data = array('labels' => $labels, 'values' => $values);
echo json_encode($data);

mysqli_close($conn);
?>