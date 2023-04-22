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
				

				<!-- PHP to ADD NEW USER -->
				<?php 

					require_once '../../includes/config.php';

					$admin = $_SESSION['admin_name'];
					$sql1 = "SELECT * FROM users WHERE username = '$admin'";
					$result = $conn->query($sql1);
					while($row = $result->fetch_assoc()) {
						$branch = $row['branch_id'];
					}

					if(isset($_POST['submit'])) {
						$first_name = $_POST['first_name'];
						$middle_name = $_POST['middle_name'];
						$last_name = $_POST['last_name'];
						$sex = $_POST['sex'];
						$birthdate = $_POST['birthdate'];
						$phone_number = $_POST['phone_number'];
						$street_address = $_POST['street_address'];
						$barangay = $_POST['barangay'];
						$city = $_POST['city'];
						$province = $_POST['province'];
						$country = $_POST['country'];
						$zipcode = $_POST['zipcode'];
						$branch = $branch;
						$role = $_POST['role'];
						$username = $_POST['username'];
						$email = $_POST['email'];
						$password = $_POST['password'];
						$password = md5($password);

						$sql = mysqli_query($conn, "INSERT INTO users(role, first_name, middle_name, last_name, sex, birthdate, phone_number, street_address, barangay, city, province, country, zipcode, username, email, password, branch_id) VALUES ('$role', '$first_name', '$middle_name', '$last_name', '$sex', '$birthdate', '$phone_number', '$street_address', '$barangay', '$city', '$province', '$country', '$zipcode', '$username', '$email', '$password', '$branch')");

						if ($sql) {
							echo "<script>alert('New record successfully added!!!');</script>";
							echo "<script>document.location='users-manage.php';</script>";
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
							<h2 style="margin: 0 20px;">Add New User</h2>
						</div>
					</div>

					<!-- FORM FOR ADDING USERS --> 
					<form method="POST" style="margin: 0 20px;">

						<br /><br />
						<h4>Personal Information: </h4>

						<div class="row">
							<div class="col-md-4">
								<label>First Name:</label>
								<input type="text" name="first_name" class="form-control" required>
							</div>
							<div class="col-md-4">
								<label>Middle Name:</label>
								<input type="text" name="middle_name" class="form-control" required>
							</div>
							<div class="col-md-4">
								<label>Last Name:</label>
								<input type="text" name="last_name" class="form-control" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<label>Sex:</label>
								<select class="form-select" name="sex" id="sex" required>
									<option selected hidden value="">Select Here...</option>
									<option value="male">Male</option>
									<option value="female">Female</option>
								</select>
							</div>
							<div class="col-md-4">
								<label>Birthdate:</label>
								<input type="date" class="form-control" id="birthdate" name="birthdate" required>
							</div>
							<div class="col-md-4">
								<label>Phone Number:</label>
								<input type="text" class="form-control" id="phone_number" name="phone_number" maxlength="11" placeholder="e.g. 09123456789" required>
							</div>
						</div>

						<br />
						<h4>Address: </h4>

						<div class="row">
							<div class="col-md-4">
								<label>Street Address:</label>
								<input type="text" name="street_address" class="form-control" required>
							</div>
							<div class="col-md-4">
								<label>Barangay:</label>
								<input type="text" name="barangay" class="form-control" required>
							</div>
							<div class="col-md-4">
								<label>City:</label>
								<input type="text" name="city" class="form-control" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<label>Province:</label>
								<input type="text" name="province" class="form-control" required>
							</div>
							<div class="col-md-4">
								<label>Country:</label>
								<input type="text" name="country" class="form-control" required>
							</div>
							<div class="col-md-4">
								<label>Postal Code:</label>
								<input type="text" name="zipcode" class="form-control" required>
							</div>
						</div>

						<br />
						<h4>Account Information: </h4>
						<div class="row">
							<div class="col-md-6">
								<label>Role:</label>
								<select class="form-select" name="role" id="role" required>
									<option selected hidden value="">Select Here </option>
									<option value="admin">Administrator</option>
									<option value="admin">Accountant</option>
									<option value="cashier">Cashier / Staff</option>
								</select>
								
							</div>
							<div class="col-md-6">
								<label>Username:</label>
								<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text">@</div>
								</div>
								<input type="text" name="username" class="form-control" id="inlineFormInputGroup" placeholder="Username">
							</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label>Email Address:</label>
								<input type="text" name="email" class="form-control" required>
							</div>
							<div class="col-md-6">
								<label>Password:</label>
								<input type="password" name="password" class="form-control" required>
							</div>
						</div><br />

						<!-- BUTTONS FOR ADDING USERS --> 
						<div class="row" style="margin-top: 1%;">
							<div class="col-md-12 d-flex justify-content-end">
								<button type="text" name="submit" class="btn btn-primary">Submit</button>&nbsp; &nbsp;
								<a href="users-manage.php" class="btn btn-danger">Cancel</a>
							</div>
						</div><br />
 
					</form>
				</div>


<?php include_once 'footer.php'; ?>