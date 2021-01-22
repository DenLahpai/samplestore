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
    var Cat1 = $("#Cat1");
    var Size = $("#Size");
    var Price = $("#Price");
    var Color = $("#Color");

    var error = false;
    ProductsCode.removeClass("input-error");
    BrandsId.removeClass("input-error");
    Name.removeClass("input-error");
    Size.removeClass("input-error");
    Price.removeClass("input-error");

    if (ProductsCode.val() == "" || ProductsCode.val() == " " || ProductsCode.val() == null) {
        error = true;
        ProductsCode.addClass("input-error");
        alert("Prdcode");
    }

    if (BrandsId.val() == "") {
        error = true;
        BrandsId.addClass("input-error");
        alert("BId1");
    }

    if (Name.val() == "" ||  Name.val() == " " || Name.val() == null) {
        error = true;
        Name.addClass("input-error");
        alert("Name");
    }

    if (Cat1.val() == "" || Cat1.val() == " " || Cat1.val() == null) {
        error = true;
        Cat1.addClass("input-error");
        alert("Ca1");
    }
    
    if (Price.val() == "") {
        error = true;
        Price.addClass("input-error");
        alert("Price");
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
    else if ($("#" + field).val() == "") {
        var msg = "<span style='color: red'>Please input a color!</span>";
        $("#sys_message").html(msg);
    }
    else {
        
        $.post("includes/duplicate_products_" + field + ".php", {
            field: field,
            new_value: $("#" + field).val(),
            link: link
            }, function(data) {
                if (!data) {
                    location.reload();
                }
                else {
                    $("#sys_message").html(data);
                }
        });
    }
}

/****** function to remove Img ******/
function removeImg (Img) {
    $.post("includes/remove_img.php", {
        Img: Img
        }, function (data) {
            if (!data) {
                var msg = "The image has been removed!";
                location.reload();
                alert(msg);
            }
            else {
                alert(data);
            }
        }        
    );
}

/****** function to check if a product is in a showcase */
function checkShowcases (link) {
    //checking in Showcase1
    $.post("includes/check_Showcases.php", {
        link: link,
        table: 1
        }, function (data) {
            if (data == 1) {
                $("#Showcase1").prop("checked", true);
                
            }
            else {
                $("#Showcase1").prop("checked", false);
            }
        }    
    );

    $.post("includes/check_Showcases.php", {
        link: link,
        table: 2,
        }, function (data) {
            if (data == 1) {
                $("#Showcase2").prop("checked", true);
                
            }
            else {
                $("#Showcase2").prop("checked", false);
            }
        }
    );
}


/****** function to rowCount a Showcase ******/
function rowCountShowcase (num) {
    $.post("includes/check_Showcases.php", {
        table: num,
        }, function (data) {
            $("label[for='Showcase1']").append(" (" + data + " spots remain.)");
        }
    );
}

/****** function to change Showcase  ******/
function updateShowcase (num, link) {
    var showcase = document.getElementById('Showcase' + num);
    if (showcase.checked == true) {
        var task = 'insert';        
    }
    else {
        var task = 'remove';        
    }
    $.post("includes/update_Showcase.php", {
        num: num,
        task: task,
        link: link
        }, function (data) {
            if (!data) {
                location.reload();
            }
            else {
                $("#sys_message").html(data);   
            }
        }
    );    
}

/****** function to change status Soldout ******/
function updateSoldout (link) {
    var Soldout = document.getElementById('Soldout');
    if (Soldout.checked == true) {
        var Status = "Soldout";
    }
    else {
        var Status = 'Available';
    }

    $.post("includes/update_Status.php", {
        link: link, 
        Status: Status
    }, function (data) {
        if (!data) {
            location.reload();
        }
        else {
            alert(data);
        }
    });
}

/****** function to check Status Soldout or not ******/
function check_Soldout (link) {
    $.post("includes/check_Soldout.php", {
        link: link
    }, function (data) {
        if (data == 1) {
            $("#Soldout").prop("checked", true);
        }

        else {
            $("#Soldout").prop("checked", false);
        }
    });
}

/****** function to select Targets ******/
function selectTargets (selected) {
    $.post ("includes/select_Targets.php", {
        selected: selected
        }, function(data) {
            // alert(data);
            $("#TargetsId").html(data);
        }
    );
}


function setTwoNumberDecimal(num, Id) {
    num = parseFloat(num).toFixed(2);
    document.getElementById(Id).value = num;
}

// function to update Users 
function updateUsers() {
    var Name = $("#Name");
    var Mobile = $("#Mobile");
    var Email = $("#Email");
    var StoresName = $("#StoresName");
    var Password = $("#Password");

    Name.removeClass('input-error');
    Mobile.removeClass('input-error');
    Email.removeClass('input-error');
    StoresName.removeClass('input-error');
    Password.removeClass('input-error');
    var error = false;

    if (Name.val() == "" || Name.val() == " " || Name.val() == null) {
        error = true;
        Name.addClass('input-error');
    }

    if (Mobile.val() == "" || Mobile.val() == " " || Mobile.val() == null) {
        error = true;
        Mobile.addClass('input-error');
    }

    if (Email.val() == "" || Email.val() == " " || Email.val() == null) {
        error = true;
        Email.addClass('input-error');
    }

    if (Password.val() == "" || Password.val() == " " || Password.val() == null) {
        error = true;
        Password.addClass('input-error');
    }

    if (error == true) {
        var msg = "<span style='color: red;'>Please fill out all the field(s) in red!</span>";
        $("#sys_message").html(msg);
    }

    if (error == false) {
        $.ajax({
            url: "includes/updating_Users.php",
            method: 'post',
            data: $("#Users-form").serialize(),
            success: function (data) {
                $("#sys_message").html(data);
            }
        });
    }
}

//function to update payment status
function updatePayments () {
    var Status = $("#Status");
    var Method = $("#Method");
    var PaidOn = $("#PaidOn");
    var error = false;
    
    if (Status.val() == "" || Status.val() == " " || Status.val() == null) {
        Status.attr("input-error");
        error = true;
        var msg  = "<span style='color: red;'>The filed Status cannot be blank!</span>";
        $("#sys_message").html(msg);
    }

    if (error == false) {
        $.ajax({
            url: "includes/updating_Payments.php",
            method: "post",
            data: $("#payments-form").serialize(),
            success: function (data) {
                if (!data) {
                    location.reload();
                }
                else {
                    $("#sys_message").html(data);
                }
            }
        });
    }
}

//function to update Delivery_Fees
function updateDelivery_Fees () {
    var Town = $("#Town");
    var Fees = $("#Fees");
    var Remark = $("#Remark");
    var error = false;

    if (Town.val() == "" || Town.val() == " " || Town.val() == null) {
        error = true;
        var msg1 = "<span style='color: red;'>Please enter a town or city where you deliver!</span>";
		$("#sys_message").append(msg1);
	}

    if (Fees.val() == "" || Fees.val() == " ") {
        error = true;
        document.getElementById('Fees').value = 0;
        var msg2 = "<br><span style='color: red'>No delivery fees provided! Are you sure?</span>";
        $("#sys_message").append(msg2);
    }

    if (Remark.val() == "" || Remark.val() == " " || Remark.val() == null) {
        error = true; 
        var msg3 = "<br><span style='color: red'>Please precise whether you deliver directly to home or only to bus station!</span>";
        $("#sys_message").append(msg3);
    }

    $.ajax ({
        url: "includes/updating_DeliveryZones.php",
        type: "post",
        data: $("#myform").serialize(),
        success: function (data) {
            if (!data) {
                location.reload();
            }
            else {
                alert(data);
            }
        }
    });
}
