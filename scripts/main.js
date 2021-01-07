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

/****** function to calculate total *******/
function calculateTotal(cls) {
	var subtotal = document.getElementsByClassName(cls);
	
	var sum = 0;
	$('.' + cls).each(function () {
		sum += parseFloat(this.value);
	});

	$("#grand-total").html(sum);	
}

/***** function to update price of an item according to qty ******/
function updatePrice (qty, cls, link) {
	if (qty <= 0) {
		alert('Please enter proper number!');
	}
	$.post("incl/update_price.php", {
		qty: qty,
		link: link
		}, function(data) {
			document.getElementById('sub_' + link).value = data;
			calculateTotal(cls);
			alert(data);	
		}
	);
}

/****** function to remove an item form the cart ******/
function removeItem (link) {
	var r = confirm("Are you sure to remove the item?");
	if (r == true) {
		$.post("incl/remove_item_cart.php", {
			link: link
			}, function (data) {
				if (!data) {
					location.reload();
				}
				else {
					alert(data);
				}
			}	
		);
	}
	else {
		alert('NO');
	}
}

/****** function to validate email  ******/
// Note function copied from Stackoverflow.com
function validateEmail(sEmail) {
    var reEmail = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;

    if(!sEmail.match(reEmail)) {
    alert("Invalid email address!");
    return false;
    }
    return true;
}