//function to check session 
function checkSession () {
	$.post ('includes/check_session.php', function (data) {
		if (data == 2) {
			//two is returned for no session!
			alert("Session expired! Please login again!");
			window.location.href = 'index.html';			
		}
		else {
			$(".nav-bar-mid").html(data);
		}
	});
}

//function to toggle div etc 
function Toggle (item) {
	$(item).slideToggle();
}

// function to get row count of a table
function getRowCount (table) {
	$.post("includes/row_count.php", {
		Table: table
		}, function (data) {
			$("#" + table + "-rowCount").html(data);
		}

	);
}