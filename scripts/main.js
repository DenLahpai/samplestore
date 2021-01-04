/****** function to Toggle ******/
function Toggle (item) {
	$(item).slideToggle(1000);
}

/****** function to search ******/
function searchItems () {
	if ($("#Search").val() == "" || $("#Search").val() == " " || $("#Search").val() == null) {
		alert("Please enter an item to search!");
	}
	else {
		window.location.href = 'search_items.html?Search=' + $("#Search").val();
	}
}

/****** function to change page ******/
function changePage (page) {
	const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const Cat1 = urlParams.get('Cat1');

    $.post("incl/browse_items.php", {Cat1: Cat1, page: page}, function (data) {
    	$("#main-data").html(data);
    });
}