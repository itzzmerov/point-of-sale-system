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
					<li class="active">
						<a href="reports.php" class="dashboard"><i class="material-icons">summarize</i><span>Reports</span></a>
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
						
						<a class="navbar-brand" href="#">Reports</a>
						<button class="d-inline-block d-lg-none ml-auto more-button" type="button" data-toggle="collapse"
						data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle">
							<span class="material-icons">menu</span>
						</button>
						
					</nav>
				</div>

				<!-- MAIN CONTENT -->
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<br /><br />
							<h2 style="margin: 0 20px;">Sales Report</h2>
							<br />
						</div>
					</div>
					<table id="example" class="table display nowrap" style="width:100%">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Invoice No.</th>
								<th scope="col">Qty</th>
								<th scope="col">Name</th>
								<th scope="col">Category</th>
								<th scope="col">SRP</th>
								<th scope="col">Disc</th>
								<th scope="col">Subtotal</th>
								<th scope="col">S. R.</th>
							</tr>
						</thead>
						<tbody> 
							<?php 

								include '../../includes/config.php';

								$sql = "SELECT * FROM ((((sales INNER JOIN users ON sales.user_id = users.user_id) INNER JOIN branches ON sales.branch_id = branches.branch_id) INNER JOIN products ON sales.product_id = products.product_id) INNER JOIN categories ON sales.category_id = categories.category_id) ORDER BY invoice_number";
								$result = mysqli_query($conn, $sql);

								$currentInvoiceNumber = null;
								$total = 0;

								while($row = mysqli_fetch_assoc($result)) {

									// Add the row data to the table
									echo "<tr>";
									echo "<td><strong>".$row['invoice_number']."</strong></td>";
									echo "<td>".$row['quantity']."</td>";
									echo "<td>".$row['name']."</td>";
									echo "<td>".$row['category_description']."</td>";
									echo "<td>".$row['price']."</td>";
									echo "<td>".$row['discount']."</td>";
									echo "<td>".$row['subtotal_amount']."</td>";
									echo "<td>". substr($row['first_name'], 0, 1). ". " . substr($row['last_name'], 0, 1) .".</td>";
									echo "</tr>";
								}
								
								mysqli_close($conn);
							?>
						</tbody>
					</table>
				</div>
				<script>
					$(document).ready(function() {
						$('#example').DataTable( {
							dom: 'Bfrtip',
							buttons: [
								'copy', 'csv', 'excel', 'pdf', 'print'
							]
						} );
					});

					
					$(document).ready(function() {
						// Set initial state for user info visibility
						var isUserInfoVisible = true;
						
						// Listen for click event on sidebar-collapse button
						$('#sidebar-collapse').on('click', function() {
							// Toggle user info visibility
							if (isUserInfoVisible) {
								$('#userInfo').hide();
							} else {
								$('#userInfo').show();
							}
							
							// Update the state of user info visibility
							isUserInfoVisible = !isUserInfoVisible;
						});
					});
				
				</script>


<?php include_once 'footer.php'; ?>