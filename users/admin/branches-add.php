<?php include_once 'header.php'; ?>

			<!--MENU SIDEBAR CONTENT-->
			<nav id="sidebar">
				<div class="sidebar-header">
					<img src="../../assets/images/logo.png" class="img-fluid"/>
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
					<li class="dropdown active">
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
					<li class="">
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
						
						<a class="navbar-brand" href="#">Add New Branch</a>
						<button class="d-inline-block d-lg-none ml-auto more-button" type="button" data-toggle="collapse"
						data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle">
							<span class="material-icons">menu</span>
						</button>
					</nav>
				</div>

                <!-- PHP TO ADD NEW BRANCH -->
                <?php 

					require_once '../../includes/config.php';

					if(isset($_POST['submit'])) {
						$branch_description = $_POST['description'];
						$contact_number = $_POST['contact'];
						$location = $_POST['location'];
						$city = $_POST['city'];
						$province = $_POST['province'];
						$postal_code = $_POST['postal_code'];
						$branch_status = $_POST['status'];
						
						$sql = mysqli_query($conn, "INSERT INTO branches(branch_description, contact_number, location, city, province, postal_code, branch_status) 
							VALUES ('$branch_description', '$contact_number', '$location', '$city', '$province', '$postal_code', '$branch_status')");

						if ($sql) {
							echo "<script>alert('New record successfully added!!!');</script>";
							echo "<script>document.location='branches-manage.php';</script>";
						} else {
							echo "<script>alert('Something went wrong!');</script>";
						}
					}
				
				?>

                <!--MAIN CONTENT HERE!!!!!!!!-->
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<br /><br />
							<h2 style="margin: 0 20px;">Add New Branch</h2>
						</div>
					</div>

					<!-- FORM FOR ADDING USERS --> 
					<form method="POST" style="margin: 0 20px;">

						<br /><br />

						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<label>Status:</label>
								<select class='form-select' name='status' required>
									<option selected hidden value="">Select Here... </option>
									<?php 
										require_once '../../includes/config.php';

										$sql = "SELECT * FROM branch_status";
										$result = $conn->query($sql);

										while ($row = $result->fetch_assoc()) {
											echo "<option value='" . $row["status_id"] . "'>" . $row["status_description"] . "</option>";
										}
									?>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label>Name:</label>
								<input type="text" name="description" class="form-control" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label>Contact Number:</label>
								<input type="text" name="contact" class="form-control" required>
							</div>
						</div>

						<br />
						<h4>Address: </h4>

						<div class="row">
							<div class="col-md-6">
								<label>Location:</label>
								<input type="text" name="location" class="form-control" required>
							</div>
							<div class="col-md-6">
								<label>City:</label>
								<input type="text" name="city" class="form-control" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label>Province:</label>
								<input type="text" name="province" class="form-control" required>
							</div>
							<div class="col-md-6">
								<label>Postal Code:</label>
								<input type="text" name="postal_code" class="form-control" required>
							</div>
						</div>

						<!-- BUTTONS FOR ADDING USERS --> 
						<div class="row" style="margin-top: 1%;">
							<div class="col-md-12 d-flex justify-content-end">
								<button type="text" name="submit" class="btn btn-primary">Submit</button>&nbsp; &nbsp;
								<a href="branches-manage.php" class="btn btn-danger">Cancel</a>
							</div>
						</div><br />
 
					</form>
				</div>

                
<?php include_once 'footer.php'; ?>