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
						
						<a class="navbar-brand" href="#">Add New Expenses</a>
						<button class="d-inline-block d-lg-none ml-auto more-button" type="button" data-toggle="collapse"
						data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle">
							<span class="material-icons">menu</span>
						</button>
					</nav>
				</div>

                <!-- PHP TO ADD NEW EXPENSES -->
                <?php 

					require_once '../../includes/config.php';

					$admin = $_SESSION['admin_name'];
					$sql1 = "SELECT * FROM users WHERE username = '$admin'";
					$result = $conn->query($sql1);
					while($row = $result->fetch_assoc()) {
						$branch = $row['branch_id'];
					}

					if(isset($_POST['submit'])) {
						$type = $_POST['type'];
						$amount = $_POST['amount'];
						$date = date('Y-m-d H:i:s');
						$remarks = $_POST['remarks'];
						
						
						$sql = mysqli_query($conn, "INSERT INTO expenses(type, amount, date, remarks, branch_id) VALUES ('$type', '$amount', '$date', '$remarks', '$branch')");

						if ($sql) {
							echo "<script>alert('New record successfully added!!!');</script>";
							echo "<script>document.location='expenses-manage.php';</script>";
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
							<h2 style="margin: 0 20px;">Add New Expenses</h2>
						</div>
					</div>

					<!-- FORM FOR ADDING USERS --> 
					<form method="POST" style="margin: 0 20px;">

						<br /><br />

						<div class="row">
							<div class="col-md-6">
								<label>Type:</label>
								<select class='form-select' name='type' required>
									<option selected hidden value="">Select Here... </option>
                                    <option value="Electric">Electric Bill</option>
                                    <option value="Water">Water Bill</option>
                                    <option value="Rent">Rent Bill</option>
                                    <option value="Payroll">Payroll</option>
                                    <option value="Miscellaneous">Miscellaneous</option>
								</select>
							</div>
                            <div class="col-md-6">
								<label>Amount:</label>
								<input type="number" name="amount" class="form-control" min="1" step="1" required>
							</div>
						</div>
						<div class="row">
                            <div class="col-md-12">
                                <label>Remarks:</label>
                                <textarea class="form-control" id="remarks" name="remarks" rows="4" required></textarea>
                            </div>
                        </div>

						<!-- BUTTONS FOR ADDING USERS --> 
						<div class="row" style="margin-top: 1%;">
							<div class="col-md-12 d-flex justify-content-end">
								<button type="text" name="submit" class="btn btn-primary">Submit</button>&nbsp; &nbsp;
								<a href="expenses-manage.php" class="btn btn-danger">Cancel</a>
							</div>
						</div><br />
 
					</form>
				</div>

                
<?php include_once 'footer.php'; ?>