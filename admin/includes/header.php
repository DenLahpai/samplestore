<!-- nav-bar -->
<div class="nav-bar">
	<div class="nav-bar-left" onclick="openMenu();">
		<div class="hamburger">&#9776;</div>
	</div>
	<div class="nav-bar-mid"></div>
	<div class="nav-bar-right">
		<div class="settings-button" onclick="Toggle('.setting-menu');">&#9881;</div>
	</div>
</div>
<!-- end of nav-bar -->
<!-- setting-menu -->
<div class="setting-menu">
	<div class="setting-menu-items">
		<div class="setting-menu-item" onclick="window.location.href='update_Users.html';">
			Update Info	
		</div>
		<div class="setting-menu-item" onclick="window.location.href='change_password.html';">
			Change Password
		</div>
		<div class="setting-menu-item" onclick="window.location.href='logout.php';">
			Logout
		</div>
	</div>	
</div>
<!-- end of setting-menu -->
<!-- modal-menu -->
<div id="modal-menu" class="modal-menu">
	<div class="modal-menu-header">
		<div onclick="closeMenu();">&#10008;</div>
	</div>
	<div class="modal-menu-body">
		<!-- <div style="text-align: center; font-size: 3em;">
			<a href="home.html">Home</a>
		</div> -->
		<!-- cards-container -->
		<div class="cards-container">
			<!-- cards -->
				<div class="cards">
					<!-- Home-card -->
					<div class="card" id="Home-card" onclick="window.location.href='home.html';">
						<div class="card-title">
							<h2>Home</h2>
							<div>
								<img src="../home.svg" alt="">
							</div>
						</div>
						<div class="card-body">
							Home page, this is where you will find more information about modules. 
						</div>
					</div>
					<!-- end of Home-card -->

					<!-- Brands-card -->
					<div class="card" id="Brands-card" onclick="window.location.href='Brands.html';">
						<div class="card-title">
							<h2>Brands</h2>
							<div style="font-size: 3em;">
								&#9934;
							</div>
						</div>
						<div class="card-body">
							This is where you start! Add and manage the brands of your products.
						</div>
						<div class="card-command">
							<div class=counter>
								<div id="Brands-rowCount"></div>
							</div>
							<div>
								Entries
							</div>
						</div>
					</div>
					<!-- end of Brands-card -->

					<!-- Products-card -->
					<div class="card" id="Products-card" onclick="window.location.href='Products.html';">
						<div class="card-title">
							<h2 style="font-size: 90%;">Products</h2>
							<div style="font-size: 3em; color: black; ">
								<img src="../products.png" alt="">
							</div>
						</div>
						<div class="card-body">
							Add and manage your products for your online store.
						</div>
						<div class="card-command">
							<div class=counter>
								<div id="Products-rowCount"></div>
							</div>
							<div>
								Entries
							</div>
						</div>
					</div>
					<!-- end of Products-cards -->

					<!-- Delivery Fees-card -->
					<div class="card" id="Delivery-Zone-card" onclick="window.location.href='DeliveryZones.html';">
						<div class="card-title">
							<h2 style="font-size: 90%">Delivery Zones</h2>
							<div style="font-size: 3em; color: black; ">
								<img src="../deliveryzones.png" alt="">
							</div>
						</div>
						<div class="card-body">
							Define your delivery zones and delivery fees, here!
						</div>
						<div class="card-command">
							<div class=counter>
								<div id="Delivery_Fees-rowCount"></div>
							</div>
							<div>
								Entries
							</div>
						</div>
					</div>
					<!-- end of Orders-cards -->

					<!-- Orders-card -->
					<div class="card" id="Orders-card" onclick="window.location.href='Orders.html';">
						<div class="card-title">
							<h2>Orders</h2>
							<div style="font-size: 3em; color: black; ">
								<img src="../orders.png" alt="">
							</div>
						</div>
						<div class="card-body">
							View the orders received from the store. 
						</div>
						<div class="card-command">
							<div class=counter>
								<div id="Orders-rowCount"></div>
							</div>
							<div>
								Entries
							</div>
						</div>
					</div>
					<!-- end of Orders-cards -->

					<!-- Payments-card -->
					<div class="card" id="Payments-card" onclick="window.location.href='Payments.html';">
						<div class="card-title">
							<h2 style="font-size: 90%">Payments</h2>
							<div style="font-size: 3em; color: black; ">
								<img src="../payments.png" alt="">
							</div>
						</div>
						<div class="card-body">
							View the payments submitted by your clients, here. 
						</div>
						<div class="card-command">
							<div class=counter>
								<div id="Payments-rowCount"></div>
							</div>
							<div>
								Entries
							</div>
						</div>
					</div>
					<!-- end of Orders-cards -->

					<!-- Invoices-card -->
					<div class="card" id="Invoices-card" onclick="window.location.href='Invoices.html';">
						<div class="card-title">
							<h2>Invoices</h2>
							<div style="font-size: 3em; color: black; ">
								<img src="../invoices.png" alt="">
							</div>
						</div>
						<div class="card-body">
							View the invoices generated with each order
						</div>
						<div class="card-command">
							<div class=counter>
								<div id="Invoices-rowCount"></div>
							</div>
							<div>
								Entries
							</div>
						</div>
					</div>
					<!-- end of Orders-cards -->

				</div>
			<!-- end of cards -->
		</div>
		<!-- end of cards-container -->
	</div>
	<!-- end of modal-menu-body -->
</div>
<!-- end of modal-menu -->
<script type="text/javascript">
    //get menu
    var modalmenu = document.getElementById('modal-menu');

    window.addEventListener('click', outsideClick);

    //function to expand the menu
    function openMenu() {
        modalmenu.style.display = 'block';
    }

    //function to close the menu
    function closeMenu() {
    	modalmenu.style.display = 'none';
    }

    //function to close menu
    function outsideClick(e) {
        if (e.target == modalmenu) {
            modalmenu.style.display = 'none';
        }
	}
	
    getRowCount ('Brands');
    getRowCount ('Products');
	getRowCount ('Orders');
	getRowCount ('Payments');
	getRowCount ('Invoices');
	getRowCount ('Delivery_Fees');
</script>
