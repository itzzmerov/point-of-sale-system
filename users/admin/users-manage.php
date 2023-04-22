<?php include_once 'header.php'; ?>

			<!--MENU SIDEBAR CONTENT-->
			<nav id="sidebar">
				<div class="sidebar-header">
					<img src="../../assets/images/logo.png" class="img-fluid"/>
					<?php 
						
						$admin = $_SESSION['admin_name'];
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
 
					<li class="dropdown active">
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
				

				<?php
					require_once '../../includes/config.php';

					if(isset($_GET['delid'])) {
						$id = intval($_GET['delid']);
						$sql = mysqli_query($conn, "DELETE FROM users WHERE user_id = '$id'");

						echo "<script>alert('Record has been successfully deleted!');</script>";
						echo "<script>window.location='users-manage.php';</script>";
					}
				?> 

				<!--MAIN CONTENT HERE!!!!!!!!-->
				<div class="container">

					<br /><br />

					<div class="row" style="margin: 0 20px;">
						<div class="col-md-12">
							<h2> Manage Users</h2>
							<div class="button-container pull-right">
								<a href="users-add.php" class="btn btn-success"> Add New User</a>
							</div>
						</div>
					</div>

					<div class="row" style="margin: 0 20px;">
						<div class="col-md-3">
							<label>Role:</label>
							<select id="role-filter" class="form-select">
								<option value="">All</option>
								<option value="admin">Admin</option>
								<option value="cashier">Cashier</option>
								<option value="accountant">Accountant</option>
							</select>
						</div> 
					</div>

					<br />

					<div class="row" style="margin: 0 20px;">
						<div class="col-md-12">
							<div class="table-responsive">
								<table id="example" class="table display nowrap" style="width:100%">
									<thead class="thead-dark">
										<tr>
											<th scope="col">Role</th>
											<th scope="col">First Name</th>
											<th scope="col">Last Name</th>
											<th scope="col">Sex</th>
											<th scope="col">Birthdate</th>
											<th scope="col">Phone Number</th>
											<th scope="col">Address</th>
											<th scope="col">Barangay</th>
											<th scope="col">City</th>
											<th scope="col">Username</th>
											<th scope="col">Email Address</th>
											<th scope="col" class="no-print">Actions</th>
										</tr>
									</thead> 
									<tbody>  
										<?php 

											include '../../includes/config.php';

											
                                            $admin = $_SESSION['admin_name'];
											$sql1 = "SELECT * FROM users WHERE username = '$admin'";
											$result = $conn->query($sql1);
											while($row = $result->fetch_assoc()) {
												$branch = $row['branch_id'];
											}

											$sql = "SELECT * FROM users WHERE branch_id = '$branch' AND role != 'superadmin' ORDER BY user_id";								
											$result = mysqli_query($conn, $sql);

											while($row = mysqli_fetch_assoc($result)) {

												?>

											<tr>
												<td><strong><?php echo $row['role']; ?></strong></td>
												<td><?php echo $row['first_name']; ?></td>
												<td><?php echo $row['last_name']; ?></td>
												<td><?php echo $row['sex']; ?></td>
												<td><?php echo $row['birthdate']; ?></td>
												<td><?php echo $row['phone_number']; ?></td>
												<td><?php echo $row['street_address']; ?></td>
												<td><?php echo $row['barangay']; ?></td>
												<td><?php echo $row['city']; ?></td>
												<td><?php echo $row['username']; ?></td>
												<td><?php echo $row['email']; ?></td>
												<td>
													<a href="users-edit.php?id=<?php echo htmlentities($row['user_id']); ?>" class="btn btn-primary btn-sm"> Edit </a>
													<a href="users-manage.php?delid=<?php echo htmlentities($row['user_id']); ?>" onclick="return confirm('Do you really want to delete this record?');" class="btn btn-danger btn-sm"> Delete </a>
												</td>
											</tr>

										<?php
											}
											
											mysqli_close($conn);
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
				<script>
					$(document).ready(function() {
						$('#example').DataTable( {
							dom: 'Bfrtip',
							buttons: [
								{
									extend: 'copy',
									exportOptions: {
										columns: ':visible:not(.no-print)'
									}
								},
								{
									extend: 'csv',
									exportOptions: {
										columns: ':visible:not(.no-print)'
									}
								},
								{
									extend: 'excel',
									exportOptions: {
										columns: ':visible:not(.no-print)'
									}
								},
								{
									extend: 'pdf',
									exportOptions: {
										columns: ':visible:not(.no-print)'
									}
								},
								{
									extend: 'print',
									customize: function ( win ) {
										$(win.document.body)
											.find('.no-print')
											.remove();
									}
								}
							],
							columnDefs: [
								{
									targets: [11], // replace 2 with the index of the column you want to exclude
									visible: true,
									className: 'no-print'
								}
							]
						} );
					});

					$(document).ready(function() {
						var table = $('#example').DataTable();

						// Add a custom filter function
						$.fn.dataTable.ext.search.push(
							function(settings, data, dataIndex) {
							var role = $('#role-filter').val();
							var roleData = data[0];

							// If the date column is empty, don't show the row
							if (roleData === "") {
								return false;
							}

							// Compare the branch with the user input date range
							
							if (role === "" || role === roleData) {
								return true;
							}

							return false;
							}
						);

						// Trigger the filtering when the user changes the date range
						$('#role-filter').change(function() {
							table.draw();
						});
					});
				</script>

<?php include_once 'footer.php'; ?>