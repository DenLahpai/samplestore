<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="test.css">
    <title>Document</title>
</head>
<body>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <!-- card -->
                <div class="card">
                    <div class="sliderText" onclick="alert('hi');">
                        <h3>Slide One</h3>
                    </div>
                    <div class="content">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur ad, neque obcaecati, facere nesciunt delectus quasi eos? Unde earum non commodi consequatur illum corrupti totam, deleniti, quod maiores, similique eaque illo? Exercitationem nemo, facilis ullam autem magnam. Beatae sint placeat maiores unde esse atque sit impedit eius, est porro animi ipsa aspernatur exercitationem recusandae, reiciendis illum sequi voluptate architecto voluptatibus.
                        </p>
                        <a href="#">Read More</a>
                    </div>
                </div>
                <!-- end of card -->                
            </div>
            <div class="swiper-slide">
                <!-- card -->
                <div class="card">
                    <div class="sliderText">
                        <h3>Slide Two</h3>
                    </div>
                    <div class="content">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur ad, neque obcaecati, facere nesciunt delectus quasi eos? Unde earum non commodi consequatur illum corrupti totam, deleniti, quod maiores, similique eaque illo? Exercitationem nemo, facilis ullam autem magnam. Beatae sint placeat maiores unde esse atque sit impedit eius, est porro animi ipsa aspernatur exercitationem recusandae, reiciendis illum sequi voluptate architecto voluptatibus.
                        </p>
                        <a href="#">Read More</a>
                    </div>
                </div>
                <!-- end of card -->                
            </div>
        </div>
    </div>
    
</body>
<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper('.swiper-container', {
      effect: 'coverflow',
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: 'auto',
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
      },
      pagination: {
        el: '.swiper-pagination',
      },
    });
  </script>
</html>