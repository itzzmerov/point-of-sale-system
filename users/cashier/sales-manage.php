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

                <!--MAIN CONTENT HERE!!!!!!!!-->
				<div class="container">

                    <br /><br />

                    <div class="row" style="margin: 0 20px;">
                        <div class="col-md-12">
                            <h2> Manage Sales</h2>
                            <a href="sales-add.php" class="btn btn-success pull-right"> Add New Sales</a>
                        </div>
                    </div>

                    <br />

                    <div class="row" style="margin: 0 20px;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" id="myInput" placeholder="Search..." class="form-control">
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>SubTotal</th>
                                    </thead>
                                    <tbody id="myTable">

                                        <?php 
                                            require_once '../../includes/config.php';

                                            if(isset($_GET['page_no']) && $_GET['page_no']!= ""){
                                                $page_no = $_GET['page_no'];
                                            } else {
                                                $page_no = 1;
                                            }

                                            $total_records_per_page = 10;
                                            $offset = ($page_no-1) * $total_records_per_page;
                                            $previous_page = $page_no - 1;
                                            $next_page = $page_no + 1;
                                            $adjacents = "2";

                                            $result_count = mysqli_query($conn, "SELECT COUNT(*) as total_records FROM sales");
                                            $total_records = mysqli_fetch_array($result_count);
                                            $total_records = $total_records['total_records'];
                                            $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                            $second_last = $total_no_of_pages - 1;

                                            $admin = $_SESSION['cashier_name'];
											$sql1 = "SELECT * FROM users WHERE username = '$admin'";
											$result = $conn->query($sql1);
											while($row = $result->fetch_assoc()) {
												$branch = $row['branch_id'];
                                                $user_id = $row['user_id'];
											}

                                            $sql = mysqli_query($conn, "SELECT * FROM ((sales INNER JOIN products ON sales.product_id = products.product_id) INNER JOIN categories ON sales.category_id = categories.category_id) WHERE sales.branch_id = '$branch' AND sales.user_id = '$user_id' LIMIT $offset, $total_records_per_page");
                                            $count = 1;
                                            $row = mysqli_num_rows($sql);
                                            if ($row > 0) {
                                                while($row = mysqli_fetch_array($sql)) {

                                        ?>

                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $row['category_description']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['quantity']; ?></td>
                                            <td><?php echo $row['price']; ?></td>
                                            <td><?php echo $row['discount']; ?></td>
                                            <td><?php echo $row['subtotal_amount']; ?></td>
                                        </tr>

                                        <?php
                                                    $count = $count + 1;
                                                }
                                            }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>

                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-end">
                                    <li class="pull-left btn btn-default disabled">Showing page <?php echo $page_no. " of " . $total_no_of_pages;?></li>
                                    <li <?php if($page_no <= 1) {echo "class='page-item disabled'";} ?>>
                                        <a class="page-link" <?php if($page_no > 1) {echo "href='?page_no=$previous_page'";} ?>>Previous</a>
                                    </li>

                                    <?php 

                                        if($total_no_of_pages <= 10){

                                            for($counter = 1; $counter <= $total_no_of_pages; $counter++){

                                                if($counter == $page_no) {
                                                    echo "<li class='page-item active'><a class='page-link'>$counter<span class='sr-only'>(current)</span></a></li>";
                                                } else {
                                                    echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                                }
                                            }

                                        } elseif($total_no_of_pages > 10) {

                                            if($page_no <= 4){

                                                for($counter = 1; $counter < 8; $counter++){

                                                    if($counter == $page_no){
                                                        echo "<li class='page-item active'><a class='page-link'>$counter<span class='sr-only'>(current)</span></a></li>";
                                                    } else {
                                                        echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                                    }
                                                }

                                                echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                                echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                                                echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";

                                            }elseif($page_no > 4 && $page_no < $total_no_of_pages - 4){
                                                echo "<li class='page-item'><a class='page-link' href='?page_no=1>1</a></li>";
                                                echo "<li class='page-item'><a class='page-link' href='?page_no=2>2</a></li>";
                                                echo "<li class='page-item'><a class='page-link'>...</a></li>";

                                                for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++){

                                                    if($counter == $page_no){
                                                        echo "<li class='page-item active'><a class='page-link'>$counter<span class='sr-only'>(current)</span></a></li>";
                                                    } else {
                                                        echo "<li class='page-item'><a class='page-link' href='page_no=$counter'>$counter</a></li>";
                                                    }
                                                }

                                                echo "<li class='page-item'><a class='page-link'>...</a></li>";
                                                echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                                                echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";

                                            } else {
                                                echo "<li class='page-item'><a class='page-link' href='?page_no=1>1</a></li>";
                                                echo "<li class='page-item'><a class='page-link' href='?page_no=2>2</a></li>";
                                                echo "<li class='page-item'><a class='page-link'>...</a></li>";

                                                for($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++){

                                                    if($counter == $page_no){
                                                        echo "<li class='page-item active'><a class='page-link'>$counter<span class='sr-only'>(current)</span></a></li>";
                                                    } else {
                                                        echo "<li class='page-item'><a class='page-link' href='page_no=$counter'>$counter</a></li>";
                                                    }
                                                }
                                            }
                                        }
                                    ?>

                                    <li <?php if($page_no >= $total_no_of_pages){ echo "class='page-item disabled'";} ?>>
                                        <a class='page-link' <?php if($page_no < $total_no_of_pages){ echo "href='?page_no=$next_page'";} ?>>Next</a>
                                    </li>
                                    <?php //if($page_no < $total_no_of_pages){ echo "<li><a class='page-link' href='?page_no=$total_no_of_pages'>Last &rsaquo; &rsaquo;</a></li>";} ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    </div>

                    <script>
                    $(document).ready(function(){
                        $("#myInput").on("keyup",function() {
                            var value = $(this).val().toLowerCase();
                            $("#myTable tr").filter(function(){
                                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                            });
                        });
                    });
                    </script>



<?php include_once 'footer.php'; ?>