<!-- nav-bar -->
<div class="nav-bar">
	<div class="nav-bar-left" onclick="openMenu();">
		<div class="hamburger">&#9776;</div>
	</div>
	<div class="nav-bar-mid"></div>
	<div class="nav-bar-right">
		<div class="settings-button">&#9881;</div>
	</div>
</div>
<!-- end of nav-bar -->
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
					<div class="card" id="Home-card" onclick="window.location.href='Home.html';">
						<div class="card-title">
							<h2>Home</h2>
							<div>
								<img src="../images/home.svg" alt="">
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
							<h2>Products</h2>
							<div style="font-size: 3em; color: black; ">
								<img src="../images/t-shirt-181707.png" alt="">
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
</script>
