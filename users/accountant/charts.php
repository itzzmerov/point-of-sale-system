<?php include_once 'header.php'; ?>

			<!--MENU SIDEBAR CONTENT-->
			<nav id="sidebar">
				<div class="sidebar-header">
					<img src="../../assets/images/logo.png" class="img-fluid"/>
					<?php 
						
						$admin = $_SESSION['accountant_name'];
						$sql1 = "SELECT * FROM (users INNER JOIN branches ON users.branch_id = branches.branch_id) WHERE username = '$admin'";
						$result = $conn->query($sql1);
						while($row = $result->fetch_assoc()) {
							$branch = $row['branch_description'];
							$name = $row['first_name'] . " " . $row['last_name'];
							$role = $row['role'];
						
					?>

					<div class="ml-auto" id="userInfo">
						<p class="text-right"><?php echo $name . " | " . $role; ?></p>
						<p class="text-right"><?php echo $branch; } ?></p>
					</div>
				</div>
				<ul class="list-unstyled components">
					<li class="">
						<a href="index.php" class="dashboard"><i class="material-icons">dashboard</i><span>Dashboard</span></a>
					</li>
					<li class="active">
						<a href="charts.php" class="dashboard"><i class="material-icons">equalizer</i><span>Charts</span></a>
					</li>
					<li class="">
						<a href="reports.php" class="dashboard"><i class="material-icons">summarize</i><span>Reports</span></a>
					</li>
					<li class="logout">
						<a href="?logout='1'"><i class="material-icons">logout</i><span>Logout</span></a>
					</li>
				</ul>
			</nav>
			<div id="content">

				<!--TOP NAVBAR CONTENT-->
				<div class="top-navbar">
					<nav class="navbar  navbar-expand-lg">
						<button type="button" id="sidebar-collapse" class="back">
						<span class="material-icons"></span>
						</button>
						
						<a class="navbar-brand" href="#">Dashboard</a>
						<button class="d-inline-block d-lg-none ml-auto more-button" type="button" data-toggle="collapse"
						data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle">
							<span class="material-icons">menu</span>
						</button>
					</nav>
				</div>	

                <div style="max-width: 800px; margin: 0 auto;">
                    <canvas id="branchSalesChart"></canvas>
                </div>

                <?php
                    // Fetch data from 'sales' table using your database connection
                    include '../../includes/config.php';

                    // Query to fetch sales data with branch descriptions and total sales
                    $sql = "SELECT branch_description, invoice_date, SUM(subtotal_amount) AS total_sales FROM sales INNER JOIN branches ON sales.branch_id = branches.branch_id GROUP BY branches.branch_id, MONTH(sales.invoice_date)";
                    $result = mysqli_query($conn, $sql);

                    // Fetch data into an associative array
                    $data = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $data[] = $row;
                    }

                    // Close database connection
                    mysqli_close($conn);
                ?>

                <script>
                    // Convert PHP data to JavaScript data for Chart.js
                    var salesData = <?php echo json_encode($data); ?>;

                    // Extract branch descriptions and sales data from data
                    var branchLabels = Array.from(new Set(salesData.map(function(item) {
                    return item.branch_description;
                    })));

                    var salesDataByBranch = branchLabels.map(function(branch) {
                    return salesData.filter(function(item) {
                        return item.branch_description === branch;
                    });
                    });

                    // Define an array of colors for the lines
                    var lineColors = ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'];

                    // Create datasets for each branch with different colors
                    var datasets = [];
                    var salesMonths = []; // Create an empty array for salesMonths
                    salesDataByBranch.forEach(function(branchData, index) {
                    var totalSalesData = branchData.map(function(item) {
                        salesMonths.push(new Date(item.invoice_date).toLocaleString('default', { month: 'long' })); // Format sales_date to month and add to salesMonths array
                        return item.total_sales;
                    });

                    datasets.push({
                        label: branchLabels[index],
                        data: totalSalesData,
                        backgroundColor: lineColors[index], // Use different colors for each line
                        borderColor: lineColors[index], // Use different colors for each line
                        borderWidth: 2
                    });
                    });

                    // Create a Chart.js line chart
                    var ctx = document.getElementById('branchSalesChart').getContext('2d');
                    var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: salesMonths, // Use the salesMonths array for x-axis labels
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        scales: {
                        x: {
                            display: true,
                            title: {
                            display: true,
                            text: 'Month' // Add x-axis title
                            }
                        },
                        y: {
                            display: true,
                            title: {
                            display: true,
                            text: 'Total Sales' // Add y-axis title
                            },
                            beginAtZero: true,
                            suggestedMax: 5000 // Update suggested max value for y-axis
                        }
                        }
                    }
                    });
                </script>

<?php include_once 'footer.php'; ?>