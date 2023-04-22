<?php include_once 'header.php'; ?>

			<!--MENU SIDEBAR CONTENT-->
			<nav id="sidebar">
				<div class="sidebar-header">
					<img src="../../assets/images/logo.png" class="img-fluid"/>
					<?php 
						
						$admin = $_SESSION['cashier_name'];
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
						
					<li class="dropdown active">
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
					<li class="">
						<a href="charts.php" class="dashboard"><i class="material-icons">equalizer</i><span>Charts</span></a>
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

								$admin = $_SESSION['cashier_name'];
								$sql1 = "SELECT * FROM users WHERE username = '$admin'";
								$result = $conn->query($sql1);
								while($row = $result->fetch_assoc()) {
									$branch = $row['branch_id'];
									$user_id = $row['user_id'];
								}

								$sql = "SELECT * FROM ((((sales INNER JOIN users ON sales.user_id = users.user_id) INNER JOIN branches ON sales.branch_id = branches.branch_id) INNER JOIN products ON sales.product_id = products.product_id) INNER JOIN categories ON sales.category_id = categories.category_id) WHERE sales.branch_id = '$branch' AND sales.user_id = '$user_id' ORDER BY invoice_number";
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