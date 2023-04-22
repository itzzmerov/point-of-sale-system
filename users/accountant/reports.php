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
					<li class="">
						<a href="charts.php" class="dashboard"><i class="material-icons">equalizer</i><span>Charts</span></a>
					</li>
					<li class="active">
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

				<!--MAIN CONTENT HERE!!!!!!!!-->
				<div class="container">

                    <br /><br />

                    <div class="row" style="margin: 0 20px;">
                        <div class="col-md-12">
                            <h2> Sales Report</h2>
                        </div>
                    </div>

                    <div class="row" style="margin: 0 20px;">
						<div class="col-md-3">
							<label>Start Date:</label>
							<input type="date" id="min-date" class="form-control">
						</div>
						<div class="col-md-3">
							<label>End Date:</label>
							<input type="date" id="max-date" class="form-control">
						</div>
						<div class="col-md-3">
							<label>Branch:</label>
							<select id="branch-filter" class="form-select">
								<option value="">All</option>
								<?php 
									require_once '../../includes/config.php';

									$sql10 = "SELECT * FROM branches";
									$result = $conn->query($sql10);
									while($row = $result->fetch_assoc()) {
										echo "<option value='" . $row['branch_description'] . "'>" . $row['branch_description'] . "</option>";
									}

									mysqli_close($conn);
								?>
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
											<th col="scope">Branch</th>
                                            <th col="scope">Date</th>
                                            <th col="scope">Invoice No.</th>
                                            <th col="scope">Name</th>
                                            <th col="scope">Category</th>
                                            <th col="scope">Quantity</th>
                                            <th col="scope">Price</th>
                                            <th col="scope">Discount</th>
                                            <th col="scope">SubTotal</th>
                                            <th col="scope">S.R.</th>
											<th col="scope">Actions</th>
										</tr>
									</thead>
									<tbody> 
										<?php 

											include '../../includes/config.php';

											$sql = "SELECT * FROM ((((sales INNER JOIN products ON sales.product_id = products.product_id) INNER JOIN categories ON sales.category_id = categories.category_id) INNER JOIN users ON sales.user_id = users.user_id) INNER JOIN branches ON sales.branch_id = branches.branch_id) ORDER BY invoice_number";
											$result = mysqli_query($conn, $sql);

											$currentInvoiceNumber = null;
											$total = 0;

											while($row = mysqli_fetch_assoc($result)) {

												?>

											<tr>
												<td><strong><?php echo $row['branch_description']; ?></strong></td>
												<td><?php echo $row['invoice_date']; ?></td>
												<td><?php echo $row['invoice_number']; ?></td>
												<td><?php echo $row['name']; ?></td>
												<td><?php echo $row['category_description']; ?></td>
												<td><?php echo $row['quantity']; ?></td>
												<td><?php echo $row['price']; ?></td>
												<td><?php echo $row['discount']; ?></td>
												<td><?php echo $row['subtotal_amount']; ?></td>
												<td><?php echo substr($row['first_name'], 0, 1) . ". " . substr($row['last_name'], 0, 1) . "."; ?></td>
												<td>
													<a href="sales-edit.php?id=<?php echo htmlentities($row['invoice_id']); ?>" class="btn btn-primary btn-sm"> Edit </a>
													<a href="sales-manage.php?delid=<?php echo htmlentities($row['invoice_id']); ?>" onclick="return confirm('Do you really want to delete this record?');" class="btn btn-danger btn-sm"> Delete </a>
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
									targets: [10], // replace 2 with the index of the column you want to exclude
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
							var minDate = $('#min-date').val();
							var maxDate = $('#max-date').val();
							var branch = $('#branch-filter').val();
							var date = data[1]; // assuming your date column is the first column
							var branchData = data[0];

							// If the date column is empty, don't show the row
							if (date === "" || branchData === "") {
								return false;
							}

							// Compare the date with the user input date range
							if ((minDate === "" || date >= minDate) &&
								(maxDate === "" || date <= maxDate)) {
								// Compare the branch with the selected branch
								if (branch === "" || branch === branchData) {
									return true;
								}
							}

							return false;
							}
						);

						// Trigger the filtering when the user changes the date range
						$('#min-date, #max-date, #branch-filter').change(function() {
							table.draw();
						});
					});
				</script>


<?php include_once 'footer.php'; ?>