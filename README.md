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
            var totalPages = Math.ceil(numRows / limit);
           // var totalPages = 25; //DUMMY to test pagination
                     
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

