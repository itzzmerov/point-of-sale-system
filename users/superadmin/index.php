<?php include_once 'header.php'; ?>

			<!--MENU SIDEBAR CONTENT-->
			<nav id="sidebar">
				<div class="sidebar-header">
					<img src="../../assets/images/logo.png" class="img-fluid"/>
					<?php 
						
						$admin = $_SESSION['superadmin_name'];
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
					<li class="active">
						<a href="index.php" class="dashboard"><i class="material-icons">dashboard</i><span>Dashboard</span></a>
						
					</li>
						
					<li class="dropdown">
						<a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
						<i class="material-icons">point_of_sale</i><span>Sales</span></a>
						<ul class="collapse list-unstyled menu" id="homeSubmenu1">
							<li>
								<a href="sales-add.php">Add New Sale</a>
							</li>
							<li>
								<a href="sales-manage.php">Manage Sales</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
						<i class="material-icons">inventory</i><span>Products</span></a>
						<ul class="collapse list-unstyled menu" id="pageSubmenu2">
							<li>
								<a href="products-add.php">Add New Product</a>
							</li>
							<li>
								<a href="products-manage.php">Manage Products</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
						<i class="material-icons">group</i><span>Categories</span></a>
						<ul class="collapse list-unstyled menu" id="pageSubmenu3">
							<li>
								<a href="categories-add.php">Add New Category</a>
							</li>
							<li>
								<a href="categories-manage.php">Manage Categories</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#pageSubmenu4" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
						<i class="material-icons">local_shipping</i><span>Branches</span></a>
						<ul class="collapse list-unstyled menu" id="pageSubmenu4">
							<li>
								<a href="branches-add.php">Add New Branch</a>
							</li>
							<li>
								<a href="branches-manage.php">Manage Branches</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#pageSubmenu5" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
						<i class="material-icons">payments</i><span>Expenses</span></a>
						<ul class="collapse list-unstyled menu" id="pageSubmenu5">
							<li>
								<a href="expenses-add.php">Add New Expenses</a>
							</li>
							<li>
								<a href="expenses-manage.php">Manage Expenses</a>
							</li>
						</ul>
					</li>
					<li class="">
						<a href="charts.php" class="dashboard"><i class="material-icons">equalizer</i><span>Charts</span></a>
					</li>
 
					<li class="dropdown">
						<a href="#pageSubmenu7" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
						<i class="material-icons">account_circle</i><span>Manage Users</span></a>
						<ul class="collapse list-unstyled menu" id="pageSubmenu7">
							<li>
								<a href="users-add.php">Add New User</a>
							</li>
							<li>
								<a href="users-manage.php">Manage Users</a>
							</li>
						</ul>
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
				
				<!--DASHBOARD CONTENT-->
				<div class="main-content">
					<div class="row">
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header">
									<div class="icon icon-warning">
										<span class="material-icons">equalizer</span>
									</div>
								</div>

								<?php 
									include '../../includes/config.php';

									$sql = "SELECT COUNT(name) AS total_products FROM products";
									$result = $conn->query($sql);
									
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {

								?>

								<div class="card-content">
									<p class="category"><strong>No. of Products</strong></p>
									<h4 class="card-title"><?php echo $row['total_products']; ?></h4>
								</div>

								<?php 
										}
									}

									$conn->close();

								?>

								<div class="card-footer">
									<div class="stats">
										<i class="material-icons text-info">info</i>
										<a href="products-manage.php">See detailed report</a>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header">
									<div class="icon icon-rose">
										<span class="material-icons">shopping_cart</span>
									</div>
								</div>

								<?php 
									include '../../includes/config.php';

									$sql = "SELECT SUM(subtotal_amount) AS total_amount FROM sales";
									$result = $conn->query($sql);
									
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {

								?>

								<div class="card-content">
									<p class="category"><strong>Total Sales</strong></p>
									<h4 class="card-title">₱<?php echo number_format($row['total_amount']); ?></h4>
								<?php 
										}
									}

									$conn->close();

								?>
								</div>
								<div class="card-footer">
									<div class="stats">
										<i class="material-icons">local_offer</i>
										product-wise sales
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header">
									<div class="icon icon-success">
										<span class="material-icons">attach_money</span>
									</div>
								</div>

								<?php 
									include '../../includes/config.php';

									$sql = "SELECT SUM(amount) AS total_amount FROM expenses";
									$result = $conn->query($sql);
									
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {

								?>

								<div class="card-content">
									<p class="category"><strong>Expenses</strong></p>
									<h4 class="card-title">₱<?php echo number_format($row['total_amount']); ?></h4>
								</div>

								<?php 
										}
									}

									$conn->close();

								?>

								<div class="card-footer">
									<div class="stats">
										<i class="material-icons">date_range</i> Total Sales Amount
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header">
									<div class="icon icon-info">
										<span class="material-icons">follow_the_signs</span>
									</div>
								</div>

								<?php 
									include '../../includes/config.php';

									$sql = "SELECT COUNT(user_id) AS total_users FROM users";
									$result = $conn->query($sql);
									
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {

								?>
								<div class="card-content">
									<p class="category"><strong>No. of Users</strong></p>
									<h3 class="card-title">+<?php echo $row['total_users']; ?></h3>
								</div>

								<?php 
										}
									}

									$conn->close();

								?>

								<div class="card-footer">
									<div class="stats">
										<i class="material-icons">update</i>
										just Updated
									</div>
								</div>
							</div>
						</div>
					</div>

					<!--SECOND ROW OF DASHBOARD CONTENT-->
					
					<div class="row">
						<div class="col-lg-7 col-md-18">
							<div class="card" style="min-height:485px">
								<div class="card-header card-header-text">
									<h4 class="card-title">Total Sales (Line Chart)</h4>
								</div>

								<div class="filter pull-right" style="margin: 20px;">
									<label for="filter">Filter by:</label>
									<select id="filter" class="form-select">
										<option value="weekly">Weekly</option>
										<option value="monthly">Monthly</option>
										<option value="quarterly">Quarterly</option>
										<option value="yearly">Yearly</option>
									</select>
								</div>

								<div style="margin: 20px;">
        							<canvas id="sales-chart"></canvas>
    							</div>

							</div>
						</div>
						<div class="col-lg-5 col-md-18">
							<div class="card" style="min-height:485px">
								<div class="card-header card-header-text">
									<h4 class="card-title">Trending Products</h4>
								</div>

								<div class="filter pull-right" style="margin: 20px;">
									<select id="branch_filter" class="form-select" hidden>
										<option selected value="all">All branches</option>
										<?php 
											include '../../includes/config.php';

											$sql = "SELECT * FROM branches";
											$result = $conn->query($sql);
											
											while($row = $result->fetch_assoc()) {
												echo "<option value='" . $row['branch_id'] . "'>" . $row['branch_description']  . "</option>";
											}

											$conn->close();
										?>
									</select>
								</div>
								<br/><br/>

								<div class="table-responsive">
									<table class="table table-striped table-bordered" id="products_table">
										<thead>
											<tr>
												<th>#</th>
												<th>Name</th>
												<th>Sold</th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

				<script>
					var filter = 'weekly';

					var salesChart = new Chart($('#sales-chart'), {
						type: 'line',
						data: {
							labels: [],
							datasets: [{
								label: 'Total Sales',
								data: [],
								fill: false,
								borderColor: 'rgb(75, 192, 192)',
								pointBackgroundColor: 'rgb(75, 192, 192)',
								pointRadius: 3,
								pointHoverRadius: 7
							}]
						},
						options: {
							scales: {
								yAxes: [{
									ticks: {
										beginAtZero: true
									}
								}]
							}
						}
					});

					$('#filter').on('change', function() {
						filter = $(this).val();
						updateChart();
					});

					function updateChart() {
						$.ajax({
							url: 'get-data.php',
							type: 'POST',
							data: {filter: filter},
							dataType: 'json',
							success: function(data) {
								salesChart.data.labels = data.labels;
								if (filter === 'monthly') {
									salesChart.options.scales.xAxes = [{
										type: 'category',
										labels: data.labels
									}];
								} else {
									salesChart.options.scales.xAxes = [{
										type: 'time',
										time: {
											unit: 'day'
										}
									}];
								}
								salesChart.data.datasets[0].data = data.values;
								salesChart.update();
							}
						});
					}

					updateChart();

					//SCRIPT FOR THE HIGHEST SELLING PRODUCTS
					$(document).ready(function() {
						// Add event listener to branch filter
						$('#branch_filter').change(function() {
							// Get selected branch filter value
							var branch_filter = $(this).val();

							// Make AJAX request to get products data
							$.ajax({
								url: 'get-products.php',
								data: {
									'branch_filter': branch_filter
								},
								success: function(data) {
									// Replace table content with new data
									$('#products_table tbody').html(data);
								}
							});
						});

						// Load initial data
						$('#branch_filter').trigger('change');
					});
				</script>

<?php include_once 'footer.php'; ?>