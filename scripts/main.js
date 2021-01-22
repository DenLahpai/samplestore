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
function updatePrice (i , cls, link) {
	var Qty = $("#Qty" + i);
	if (Qty.val() == "" || Qty.val() == " " || Qty.val() == null || Qty.val() < 0) {
		Qty.val(0);
	}	

	$.post("incl/update_price.php", {
		Qty: Qty.val(),
		link: link
		}, function(data) {
			$("#subtotal" + i).val(data);
			calculateTotal(cls);
			if (data < 1) {
				Qty.addClass("input-error");
				$("#subtotal" + i).addClass('input-error');
			}
			else {
				Qty.removeClass("input-error");
				$("#subtotal" + i).removeClass('input-error');
			}
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


//function to apply delivery fees 
function applyDeliFees(link) {
    $.post('incl/select_table_row_Delivery_Fees.php', {
		link: link
	}, function (data) {
		$("#deli-fees").html(data);
		calculateTotal ('subtotal');
	});
}

/****** function to create Orders and Orderlist ******/
function createOrder () {
	//checking if there is any zeros
	var n = $(".Qty").length;
	var Name = $("#Name");
	var Mobile = $("#Mobile");
	var Address = $("#Address");
	var Delivery_FeesLink = $("#Delivery_FeesLink");

	var error = false;

	if (Name.val() == "" || Name.val() == " " || Name.val() == null) {
		error = true;
		var msg = "<span style='color: red;'>Please enter your name!</span>";
		$("#sys_message").html(msg);
		Name.addClass("input-error");
	}

	if (Mobile.val() == "" || Mobile.val() == " " || Mobile.val() == null) {
		error = true;
		var msg = "<span style='color: red;'>Please enter your phone number!</span>";
		$("#sys_message").html(msg);
		Mobile.addClass("input-error");
	}

	if (Address.val() == "" || Address.val() == " " || Address.val() == null) {
		error = true;
		var msg = "<span style='color: red;'>Please enter your address!</span>";
		$("#sys_message").html(msg);
		Address.addClass("input-error");
	}

	if (Delivery_FeesLink.val() == "" || Delivery_FeesLink.val() == " " || Delivery_FeesLink.val() == null) {
		error = true;
		var msg = "<span style='color: red;'>Please enter choose your town!</span>";
		$("#sys_message").html(msg);
		Delivery_FeesLink.addClass("input-error");
	}
	
	if (error == false) {
		// adding Orders, Invoices and getting $OrdersLink 
		$.post("incl/add_Orders.php", {
			Total: $("#grand-total").html(),
			}, function (data) {
			if (!data) {
				alert("There was a connection error! Please try again!");
				// Note: nothing is returned if there is an error! 
			}
			else {			
				var OrdersLink = data;
				//adding customer and Invoiced_Delivery_Fees
				$.ajax({
					url: "incl/add_Customers.php?link=" + OrdersLink,
					type: "post",
					data: $("#client-form").serialize(),
					success: function (data) {
						if (!data) {
							window.location.href = 'incl/invoice.php?link=' + OrdersLink;
						}
						else {
							alert(data);
						}
					}

				});

				for (var i = 1; i <= n; i++) {
					if ($("#Qty" + i).val() == 0) {
						$("#Qty" + i).addClass("input-error");
						alert("Please correct the Qty or remove the item highlighted in red to continue!");
					}
					else {
						$("#Qty" + i).removeClass("input-error");
						$.post("incl/add_Orders_List.php", {
							OrdersLink: OrdersLink,
							ProductsLink: $("#ProductsLink" + i).val(),
							Qty: $("#Qty" + i).val(),
							Subtotal: $("#subtotal" + i).val(),
							}, function (data) {
								if (!data) {
									// window.location.href = 'customer_form.html?link=' + OrdersLink;
								}
								else {
									alert(data);
								}
							}
						);
					}
				}
			}
		});	
	}	
}
