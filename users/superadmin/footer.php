<!--FOOTER CONTENT-->

			</div>
		</div>
    
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="../../assets/js/jquery-3.3.1.slim.min.js"></script>
		<script src="../../assets/js/popper.min.js"></script>
		<script src="../../assets/js/bootstrap.min.js"></script>
		<script src="../../assets/js/jquery-3.3.1.min.js"></script>


		<script type="text/javascript">
				
				$(document).ready(function(){
					$("#sidebar-collapse").on('click',function(){
						$('#sidebar').toggleClass('active');
						$('#content').toggleClass('active');
					});
					
					$(".more-button,.body-overlay").on('click',function(){
						$('#sidebar,.body-overlay').toggleClass('show-nav');
					});
				});	

                document.getElementById("sidebar-collapse").addEventListener("click", function() {
					var icon = this.querySelector("span");
					if (this.classList.contains("back")) {
						this.classList.remove("back");
						this.classList.add("forward");
					} else {
						this.classList.remove("forward");
						this.classList.add("back");
					}
				});

				document.addEventListener('DOMContentLoaded', function() {
					// get all dropdown links
					var dropdownLinks = document.querySelectorAll('.dropdown-toggle');

					// add click event listener to all dropdown links
					dropdownLinks.forEach(function(link) {
						link.addEventListener('click', function() {
						// check if this link is inside an open dropdown
						var dropdowns = document.querySelectorAll('.dropdown.show');
						dropdowns.forEach(function(dropdown) {
							if (dropdown.contains(link)) {
							// close the dropdown
							dropdown.classList.remove('show');
							}
						});
						});
					});
				});
		</script>
	</body>
  
</html>	 		