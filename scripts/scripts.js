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
    var page = Number($("#current_page").val());
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
            // var totalPages = Math.ceil(numRows / limit);
            var totalPages = 25; //DUMMY to test pagination
                     
            if (page == 1) {
                var page1 = Number(page);
                var page2 = Number(page + 1);
                var page3 = Number(page + 2);
                var page4 = Number(page + 3);
                // var page5 = Number(page + 4);
                // var page6 = Number(page + 5);
                //hiding previous button
                $("#previous").attr('disabled', true);
            }

            else if (page == totalPages) {
            	var page1 = Number(page - 3);
            	var page2 = Number(page -2);
            	var page3 = Number(page -1)
            	var page4 = Number(page);
            	//hiding next button
            	$("#next").attr('disabled', true); 
            }

            else {
                var page1 = Number(page - 1);
                var page2 = Number(page);
                var page3 = Number(page + 1);
                var page4 = Number(page + 2);
                // var page5 = Number(page + 3);
                // var page6 = Number(page + 4);   
                // showing previous button
                $("#previous").removeAttr('disabled');             
            } 

            if (page == totalPages) {
                //hiding next button
                $("#next").attr('disabled', true);
            }
            else {
                //showing next button
                $("#next").removeAttr('disabled');
            }

            // setting up the page numbers
            $("#page1").val(page1);
            $("#page2").val(page2);
            $("#page3").val(page3);
            $("#page4").val(page4);
            // $("#page5").val(page5);
            // $("#page6").val(page6);

            var i = 1;
            while (i <= 4) {
                var page_num = $("#page" + i).val();
                if (page_num > totalPages) {
                    $("#page" + i).attr('disabled', true);
                }
                else {
                    $("#page" + i).removeAttr('disabled');  
                }
                if (page_num == page) {
                    $("#page" + i).attr('disabled', true);                    
                }
                else {
                    $("#page" + i).removeAttr('disabled');
                }
                i++;
            }           
        }    
    );
    //getting data
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