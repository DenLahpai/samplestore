<div class="glider-contain multiple">
<button class="glider-prev">
                            <
                        </button>
    <div class="glider">        
        <div>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sunt, sint a, et ipsa facilis doloremque unde voluptates iusto quo, placeat nulla quisquam magnam exercitationem laboriosam maiores provident. Quod, eaque iure?</p>
        </div>
        <div>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veritatis corrupti illo sint cumque recusandae vel aliquid odit, optio, odio doloremque totam. Laudantium nisi, animi incidunt autem placeat veritatis soluta facilis.</p>
        </div>
        <div>
            <p>fdsafdsf;l</p>
        </div>
    </div>
    <button>></button>
    <div id="dots" class="glider-dots"></div>
</div>

<!-- <script src="scripts/jquery.js"></script> -->
<script src="scripts/glider.js"></script>
<script src="scripts/main.js"></script>
<script>
$(document).ready(function () {
	$.post("incl/header.php", function (data) {
        $("header").html(data);
    });

    // $.post("incl/test.php", function (data) {
    //     $(".glider").html(data);
    // });

    new Glider(document.querySelector('.glider'), {
        slidesToShow: 1,
        dots: '#dots',
        draggable: true,
        arrows: {
        prev: '.glider-prev',
        next: '.glider-next'
        }
    });
});


</script>