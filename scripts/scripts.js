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

/****** Function to request for forgotten password ******/
function forgotPasswordRequest() {
    var Email = $("#Email");
    var Mobile = $("#Mobile");

    Email.removeClass('input-error');
    Mobile.removeClass('input-error');
    var inputError = false;
    // var errorMsg = ""; 

    if (Email.val() == "") {
        var inputError = true;
        errorMsg = "<span style='color:red'>Please input all the filed(s) in red!</span>";
        Email.addClass('input-error');
        $("#sys_message").html(errorMsg);
    }

    if (Mobile.val() == "") {
        var inputError = true;
        errorMsg = "<span style='color:red'>Please input all the field(s) in red!</span>";
        Mobile.addClass('input-error');
        $("#sys_message").html(errorMsg);
    }

    if (inputError == false) {
        errorMsg = "";
        $.post("includes/forgot_password.php", {
            Email: Email.val(), 
            Mobile: Mobile.val()
            }, function (data) {
                $("#sys_message").html(data);
                //TODO need to continue after uploading on a webserver
            }        
        );        
    }
}

/***** function to check if 2 passwords match ******/
function checkPasswords () {
    var password = $("#password");
    var repassword = $("#repassword");
    var errorMsg = "";
    $("#button-submit").attr("disabled", "disabled");
    
    if (password.val() === repassword.val()) {
        $("#button-submit").removeAttr("disabled", "disabled");
    }
    else {
        errorMsg = "<span style='color: red;'>The two passwords do NOT match!</span>";
        $("#response").html(errorMsg);
    }
}

/***** function to update password match ******/
function updatePassword () {
    var password = $("#password");
    var repassword = $("#repassword");
    var DOB = $("#DOB");
    var Email = $("#Email");

    if (password.val() === repassword.val()) {
        $.post("includes/update_password.php", {
            Password: password.val(),
            Email: Email.val(),
            DOB: DOB.val()
            }, function (data) {
                $("#response").html(data);
            }
        
        );
    }
    else {
        errorMsg = "<span style='color: red;'>The two passwords do NOT match!</span>";
        $("#response").html(errorMsg);
    }
}

//function to dispaly preview of an image to be uploaded
function imagePreview(input) {
    if (input.files && input.files[0]) {
        var img = document.getElementById('Image').files[0];
        var imageName = img.name;
        var imageExtension = imageName.split('.').pop().toLowerCase();
        if(jQuery.inArray(imageExtension, ['jpg', 'jpeg', 'png']) == -1) {
            alert("Invalid Image Type! Only \".jpg & jpeg\" file types are allowed!");
            $("#btn-submit").attr('disabled', 'disabled');
        }

        else {
            // $("#btn-submit").removeAttr('disabled');
            var imagePv = new FileReader();
            imagePv.onload = function (e) {
                $("#image_preview").attr('src', e.target.result);                
            };              
        }

        var imageSize = img.size;
        if (imageSize > 12000000) {
            alert("Image is too large!");
            $("#btn-submit").attr('disabled', 'disabled');      
        }        
        imagePv.readAsDataURL(input.files[0]);   
    }
}

/****** function to insert Brands ******/
function insertBrands () {
    var BrandsName = $("#BrandsName");
    var Country = $("#Country");
    if (!BrandsName.val() || BrandsName.val() == null || BrandsName.val() == "") {
        var errorMsg = "<span style='color: red'>Please enter the brand's name!";
        BrandsName.addClass('input-error');
        $("#sys_message").html(errorMsg);
    }
    else {
        BrandsName.removeClass('input-error');
        var fdata = new FormData();
        var files = $("#Image")[0].files[0];
        fdata.append('Image', files);
        $.ajax({
            // adding BrandsName and Country through the link
            url: "includes/add_Brands.php?BrandsName=" + BrandsName.val() + "&Country=" + Country.val(), 
            type: 'post',
            data: fdata,
            contentType: false,
            processData: false,
            success: function (data) {
            	
                if (!data || data == "" || data == null) {
                    window.location.href = 'Brands.html';
                }
                else {
                    $("#sys_message").html(data);
                }
            }
        });
    }
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

/****** function to get data from the table  ******/
function pagination (table) {
    var limit = 10;    
    var current_page = Number($("#current_page").val());
    // var current_page = 1;
    var Search = $("#Search").val();

    if (!Search) {
        var source = "row_count.php";
    }    
    else {
        var source = "search_" + table + "_row_count.php";
    }

    getData(table);

    $.post("includes/" + source, {  
        Table: table,
        Search: Search
        }, function (data) {
            var numRows = data;
            //calculating number of pages
            var totalPages = Math.ceil(numRows / limit);
            // var totalPages = 9; //DUMMY to test pagination

            if (current_page == 1) {
                $("#page1").val(current_page);
                $("#page2").val(current_page + 1);
                $("#page3").val(current_page + 2);
                $("#page4").val(current_page + 3);
                $("#previous").attr('disabled', true);
            }

            else {
                $("#previous").attr('disabled', false);
                $("#page1").val(current_page - 1);
                $("#page2").val(current_page);
                $("#page3").val(current_page + 1);
                $("#page4").val(current_page + 2);
            }

            var i = 1;
            while (i <= 4) {
                var page_num = $("#page" + i).val();
                if (page_num == current_page) {
                    $("#page" + i).attr('disabled', true);
                }
                else {
                    $("#page" + i).removeAttr('disabled');
                }

                if (page_num == totalPages) {
                    $("#next").attr('disabled', true);
                }

                else {
                    $("#next").attr('disabled', true);
                }

                if (page_num < 1) {
                    $("#page" + i).attr('disabled', true);
                    $("#page" + i).css({"color": "#FFFFFF"});
                }

                if (page_num > totalPages) {
                    $("#page" + i).attr('disabled', true);
                    $("#page" + i).css({"color": "#FFFFFF"});
                }

                i++;
            }            
        }
    );    
}


/****** function to get data from the table  ******/
function getData(table){
    var Search = $("#Search").val();
    var page = $("#current_page").val();
    var order = $("#order").val();
    if (!Search || Search == "" || Search == null) {
        var source = "select_" + table + ".php";
    } 
    else {
        var source = "search_" + table + ".php";
    }
    $.post("includes/" + source, {
        Search: Search,
        page: page,
        order: order
        }, function (data) {
            $("#main-data").html(data);
        }
    
    );
}

function changeCurrentPage (num, table) {
    $("#current_page").val(num);
    pagination(table);
}

function previousPage (table) {
    var page = Number($("#current_page").val());
    var new_page = page - 1;
    $("#current_page").val(new_page);
    pagination (table);  
}

function nextPage (table) {
    var page = Number($("#current_page").val());
    var new_page = page + 1;
    $("#current_page").val(new_page);
    pagination (table);
}

/****** function to update Brands  ******/
function updateBrands (link) {
    var BrandsName = $("#BrandsName");
    var Country = $("#Country");
    if (!BrandsName.val() || BrandsName.val() == null || BrandsName.val() == "") {
        var errorMsg = "<span style='color: red'>Please enter the brand's name!";
        BrandsName.addClass('input-error');
        $("#response").html(errorMsg);
    }
    else {
        BrandsName.removeClass('input-error');
        var fdata = new FormData();
        var files = $("#Image")[0].files[0];
        fdata.append('Image', files);
        $.ajax({
            // adding BrandsName and Country through the link
            url: "includes/updating_Brands.php?BrandsName=" + BrandsName.val() + "&Country=" + Country.val() + "&link=" + link, 
            type: 'post',
            data: fdata,
            contentType: false,
            processData: false,
            success: function (data) {
                
                if (!data || data == "" || data == null) {
                    window.location.href = 'Brands.html';
                }
                else {
                    $("#sys_message").html(data);
                }
            }
        });
    }
}


/****** function to update Image  ******/
function exportTable (Table) {
    var Search = $("#Search").val();
    var order = $("#order").val();
    var limit = $("#limit").val();
    var offset = $("#offset").val();

    window.location.href = 'includes/export_' + Table + '.php?Search=' + Search + '&order=' + 
    order + '&limit=' + limit + '&offset=' + offset; 
}

/****** function to get data from a table as option ******/
function getOptions (Table) {
    $.post("includes/get_options_" + Table + ".php", function (data) {
        $("#" + Table + "Id").append(data);
    });
}

/****** function to preview color ******/
function previewColor (str) {
    if ($("#color").val() != "") {
        $(".color-preview").css({"background": str});
    }
    else {
        $(".color-preview").css({"background": "white"});
    }
}

/****** function to insert Products ******/
function insertProducts () {
    var ProductsCode = $("#ProductsCode");
    var BrandsId = $("#BrandsId");
    var Name = $("#Name");
    var Gender = $("#Gender");
    var Size = $("#Size");
    var Price = $("#Price");
    var Color = $("#Color");

    var error = false;
    ProductsCode.removeClass("input-error");
    BrandsId.removeClass("input-error");
    Name.removeClass("input-error");
    Gender.removeClass("input-error");
    Size.removeClass("input-error");
    Price.removeClass("input-error");

    if (ProductsCode.val() == "" || ProductsCode.val() == " " || ProductsCode.val() == null) {
        error = true;
        ProductsCode.addClass("input-error");
    }

    if (BrandsId.val() == "") {
        error = true;
        BrandsId.addClass("input-error");
    }

    if (Name.val() == "" ||  Name.val() == " " || Name.val() == null) {
        error = true;
        Name.addClass("input-error");
    }

    if (Gender.val() == "") {
        error = true;
        Gender.addClass("input-error");
    }

    if (Price.val() == "") {
        error = true;
        Price.addClass("input-error");
    } 

    if (error == true) {
        var error_msg = "<span style='color: red'>Please fill out all the field(s) in red!</span>";
        $("#sys_message").html(error_msg);
    }

    else {
        $.ajax({
            url: "includes/add_Products.php",
            type: 'post',
            data:$("#add-Products").serialize(),
            success: function (data) {
                if (data == 0) {
                    window.location.href= 'Products.html';
                }
                else {
                    $("#sys_message").html(data);
                }
            }
        });
    }
}

/****** function to update Products ******/
function updateProducts () {
    var ProductsCode = $("#ProductsCode");
    var Name = $("#Name");
    var Color = $("#Color");
    ProductsCode.removeClass("input-error");
    Name.removeClass("input-error");
    Color.removeClass("input-error");
    var msg =  null;
    var error = false;
    
    if (ProductsCode.val() == "" || ProductsCode.val() == null) {
        ProductsCode.attr("input-error");
        var msg = "Please fill out all the field(s) in red!";
        error = true;
    }

    if (Name.val() == "" || Name.val() == null) {
        Name.attr("input-error");
        var msg = "Please fill out all the field(s) in red!";
        error = true;
    }

    if (Color.val() == "" || Color.val() == null) {
        Color.attr("input-error");
        var msg = "Please fill out all the field(s) in red!";
        error = true;
    }

    if (error == false) {
        $.ajax({
            url: "includes/updating_Products.php",
            type: "post", 
            data: $("#update_Products").serialize(),
            success: function (data) {
                if (!data) {
                    window.location.href = 'Products.html';
                }
                else {
                    $("#sys_message").html(data);
                }
            }
        });
    }
}

/****** function to update main Img ******/
function updateMainImg (link) {
    
    if ($("#Image").val() == null || $("#Image").val() == "") {
        var msg = "<span style='color: red'>Please choose an image to upload!</span>";
        $("#sys_message").html(msg);
    }
    else {
        var fdata = new FormData();
        var files = $("#Image")[0].files[0];
        fdata.append('Image', files);
        $.ajax({
            url: "includes/upload_img_Products.php?link=" + link + "&src=main",
            type: "post",
            data: fdata,
            contentType: false,
            processData: false,
            success: function (data) {
                if (!data) {
                    window.location.href = "Products.html";
                }
                else {
                    $("#sys_message").html(data);
                }
            }
        });
    }
}

/****** function to duplicate Products ******/
function duplicateProduct (field, value, link) {
    if ($("#" + field).val() == value) {
        var msg = "<span style='color: red;'>Duplicate entry! Please choose another size or color!</span>";
        $("#sys_message").html(msg);
    }
    else {
        
        $.post("includes/duplicate_products_" + field + ".php", {
            field: field,
            new_value: $("#" + field).val(),
            link: link
            }, function(data) {
                $("#sys_message").html(data);
        });
    }
}