# samplestore

/****** function to get data from the table  ******/
function pagination (table) {
    var limit = 10;    
    var page = Number($("#current_page").val());
    var Search = $("#Search").val();

    if (!Search) {
        var source = "row_count.php";
    }    
    else {
        var source = "search_row_count.php";
    }

    getData(table);

    $.post("includes/" + source, {  
        Table: table,
        Search: Search
        }, function (data) {
            var numRows = data;
            //calculating number of pages
            // var totalPages = Math.ceil(numRows / limit);
            var totalPages = 25; DUMMY to test pagination
                     
            if (page == 1) {
                var page1 = Number(page);
                var page2 = Number(page + 1);
                var page3 = Number(page + 2);
                var page4 = Number(page + 3);
                var page5 = Number(page + 4);
                var page6 = Number(page + 5);
                //hiding previous button
                $("#previous").hide();
            }

            else {
                var page1 = Number(page - 1);
                var page2 = Number(page);
                var page3 = Number(page + 1);
                var page4 = Number(page + 2);
                var page5 = Number(page + 3);
                var page6 = Number(page + 4);   
                // showing previous button
                $("#previous").show();             
            } 

            if (page == totalPages) {
                //hiding next button
                $("#next").hide();
            }
            else {
                //showing next button
                $("#next").show();
            }

            // setting up the page numbers
            $("#page1").val(page1);
            $("#page2").val(page2);
            $("#page3").val(page3);
            $("#page4").val(page4);
            $("#page5").val(page5);
            $("#page6").val(page6);

            var i = 1;
            while (i <= 6) {
                var page_num = $("#page" + i).val();
                if (page_num > totalPages) {
                    $("#page" + i).hide();
                }
                else {
                    $("#page" + i).show();  
                }
                if (page_num == page) {
                    $("#page" + i).css({"background": "#FFFFFF", "color": "rgba(0, 104, 255, 1)"});                    
                }
                else {
                    $("#page" + i).css({"background": "rgba(0, 104, 255, 1)", "color": "#FFFFFF"});
                }
                i++;
            }           
        }    
    );
    //getting data
}


<!-- boxes -->
	<div class="boxes">
		<!-- box -->
		<div class="box">
			<div class="box-img">
				<div style="font-size: 6em;">+</div>
			</div>
			<div class="box-label">
				Add New 
			</div>
		</div>
		<!-- end of box -->
		<!-- box -->
		<div class="box">
			<div class="box-img">
				<div>
					<img src="../logos/thumbnails/test.jpeg" alt="">
				</div>
			</div>
			<div class="box-label">
				Add
			</div>
		</div>
		<!-- end of box -->
		<?php foreach($rows_Brands as $row_Brands): ?>
		<!-- box -->
		<div class="box">
			
		</div>
		<!-- end of box -->
		<?php endforeach; ?>	
	</div>
<!-- end of boxes -->

<!-- cards -->
	<div class="cards">
		<!-- card -->
		<div class="card" id="Brands-card" onclick="window.location.href='Brands.html';">
			<div class="card-title">
				<h2>Gentlemen's Glass</h2>
				<div>
					
				</div>
			</div>
			<div class="card-body">
				<img src="../logos/thumbnails/test.jpeg" alt="">
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
		<!-- end of card -->