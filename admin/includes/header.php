<!-- nav-bar -->
<div class="nav-bar">
	<div class="nav-bar-left" onclick="openMenu();">
		<div class="hamburger">&#9776;</div>
	</div>
	<div class="nav-bar-mid">
		
	</div>
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
		<!-- cards-container -->
		<div class="cards-container">
			<!-- cards -->
				<div class="cards">

					<!-- Brands-card -->
					<div class="card" id="Brands-card" onclick="window.location.href='Brands.html';">
						<div class="card-title">
							<h2>Brands</h2>
							<div>
								&#9934
							</div>
						</div>
						<div class="card-body">
							This is where you start! You must start by creating the brands of the products on your web shevles.
							This will help your customers to search their products they want to find by filtering their favorite brands.
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
					<div class="card">
						<div class="card-title">
							<h2>Brands</h2>
							<div>
								&#9934
							</div>
						</div>
						<div class="card-body">
							Lorem, ipsum, dolor sit amet consectetur adipisicing elit. Ipsa eos dignissimos nulla beatae expedita amet quis, accusantium atque aliquam et alias, necessitatibus officia, excepturi non perferendis facilis magnam quam cupiditate!
							Lorem, ipsum dolor sit amet consectetur adipisicing, elit. Vitae ducimus eligendi quae assumenda corrupti illum repudiandae, culpa eveniet dolores quaerat quisquam veritatis ipsam consequatur, placeat quidem quas, necessitatibus tenetur itaque.
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
</script>