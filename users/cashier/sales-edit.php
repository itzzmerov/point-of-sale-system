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

                <?php 
                    require_once '../../includes/config.php';

                    if(isset($_POST['update'])) {
                        $id = $_GET['id'];

						$imei = $_POST['imei'];
						$model_description = $_POST['model_description'];
						$quantity = $_POST['quantity'];
						$price = $_POST['price'];
						$subtotal_amount = $_POST['subtotal_amount'];
						$commission = $subtotal_amount * 0.01;
						$discount = $_POST['discount'];
						$status_id = $_POST['status_id'];
                        $payment_id = $_POST['payment_id'];
                        $invoice_date = $_POST['invoice_date'];

                        $sql = mysqli_query($conn, "UPDATE sales SET imei='$imei', model_description='$model_description', quantity='$quantity', price='$price', subtotal_amount='$subtotal_amount', 
                        commission='$commission', discount='$discount', status_id='$status_id', payment_id='$payment_id', invoice_date='$invoice_date' WHERE invoice_id='$id'");
                        if($sql) {
                            echo "<script>alert('You have successfully updated the record!');</script>";
                            echo "<script>document.location='sales-manage.php';</script>";
                        }
                    }
                ?>

                <!--MAIN CONTENT HERE!!!!!!!!-->
                <div class="container">
					<div class="row" style="margin: 0 20px;">
						<div class="col-md-12">
							<br /><br />
							<h2>Update Sale Information</h2>
						</div>
					</div>

					<!-- FORM FOR ADDING USERS --> 
					<form method="POST" style="margin: 0 20px;">

                        <?php 

                            $id = $_GET['id'];
                            $sql1 = mysqli_query($conn, "SELECT * FROM (((sales INNER JOIN users ON sales.user_id = users.user_id) INNER JOIN branches ON sales.branch_id = branches.branch_id) INNER JOIN products ON sales.product_id = products.product_id) WHERE invoice_id = '$id'");

                            while ($row = mysqli_fetch_array($sql1)) {

								$invoiceDateTime = $row['invoice_date'];

								$dateTime = new DateTime($invoiceDateTime);

								$dateOnly = $dateTime->format('Y-m-d');


                            
                        ?>
						<br /><br />

                        <div class="row">
                            <div class="col-md-8">
							</div>
                            <div class="col-md-4">
								<label>Invoice Date:</label>
								<input type="date" name="invoice_date" value="<?php echo $dateOnly; } ?>" class="form-control" required>
							</div>
                        </div>

                        <?php 

                            $id = $_GET['id'];
                            $sql5 = mysqli_query($conn, "SELECT * FROM ((((sales INNER JOIN users ON sales.user_id = users.user_id) INNER JOIN branches ON sales.branch_id = branches.branch_id) INNER JOIN products ON sales.product_id = products.product_id) INNER JOIN categories ON sales.category_id = categories.category_id) WHERE invoice_id = '$id'");

                            while ($row = mysqli_fetch_array($sql5)) {

                            
                        ?>

						<div class="row">
							<div class="col-md-8">
								<label>Category:</label>
								<input type="text" name="imei" value="<?php echo $row['category_description']; ?>" class="form-control" readonly>
							</div>
                            <div class="col-md-4">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label>Product Name:</label>
								<input type="text" name="model_description" value="<?php echo $row['name']; ?>" class="form-control" readonly>
							</div>
						</div>
						<div class="row">
                            <div class="col-md-4">
								<label>Quantity:</label>
								<input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" class="form-control" min="1" required>
                            </div>
                            <div class="col-md-4">
								<label>Price:</label>
								<input type="number" name="price" value="<?php echo $row['price']; ?>" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
								<label>Discount:</label>
								<input type="number" name="discount" value="<?php echo $row['discount']; ?>" class="form-control" min="0" required>
                            </div>
                            
						</div>
                        <div class="row">
                            <div class="col-md-8">
                            </div>
                            <div class="col-md-4">
								<label>SubTotal:</label>
								<input type="text" name="subtotal_amount" value="" class="form-control" readonly>
                            </div>
                        </div>

						<br />

                        <?php 
                        }
                        ?>
						<!-- BUTTONS FOR ADDING USERS --> 
						<div class="row" style="margin-top: 1%;">
							<div class="col-md-12 d-flex justify-content-end">
								<button type="text" name="update" class="btn btn-success">Update</button> &nbsp;&nbsp;&nbsp;
								<a href="sales-manage.php" class="btn btn-danger">Cancel</a>
							</div>
						</div><br />

					</form>
				</div>

                <script>
                    const quantityInput = document.getElementsByName('quantity')[0];
                    const priceInput = document.getElementsByName('price')[0];
                    const discountInput = document.getElementsByName('discount')[0];
                    const subtotalInput = document.getElementsByName('subtotal_amount')[0];

                    // Calculate subtotal function
                    function calculateSubtotal() {
                        const quantity = Number(quantityInput.value);
                        const price = Number(priceInput.value);
                        const discount = Number(discountInput.value);

                        const subtotal = quantity * price * (1 - discount / 100);

                        subtotalInput.value = subtotal.toFixed(2);
                    }

                    // Call calculateSubtotal on page load
                    calculateSubtotal();

                    // Add event listeners to the quantity and discount inputs
                    quantityInput.addEventListener('change', calculateSubtotal);
                    discountInput.addEventListener('change', calculateSubtotal);

					
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