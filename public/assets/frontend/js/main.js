
//For Section Animation
function reveal() {
  var reveals = document.querySelectorAll(".reveal");

  for (var i = 0; i < reveals.length; i++) {
    var windowHeight = window.innerHeight;
    var elementTop = reveals[i].getBoundingClientRect().top;
    var elementVisible = 150;

    if (elementTop < windowHeight - elementVisible) {
      reveals[i].classList.add("active");
    } else {
      reveals[i].classList.remove("active");
    }
  }
}

window.addEventListener("scroll", reveal); 

//Category Box Slider

$('.cat_slider').slick({
  dots: true,
  arrows:false,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  autoplay: true,
  autoplaySpeed: 2000,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

//FOR SLIDE MENU
$(document).ready(function(){
  $('.menu-tab').click(function(){
    $('.main_menu').toggleClass('show');
  });
  $('.menu-close').click(function(){
    $('.main_menu').toggleClass('show');
  });
});

//video Grid Slider
$('.most_popular_slider').slick({
  dots: false,
  arrows:true,
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 3,
  autoplay: false,
  autoplaySpeed: 2000,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        infinite: true,
        dots: false,
        arrows:true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

$('.video_grid_slider').slick({
  dots: false,
  arrows:true,
  infinite: true,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  autoplay: true,
  autoplaySpeed: 2000,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        infinite: true,
        dots: false,
        arrows:true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

$($('.type-blog .post').find('article.post-inner')).each(function(){
$(this).append($('<div class="social-networks"></div>'));
});

var socNetwButtons = '<div class="addthis_toolbox addthis_default_style"> \
  <span>Share : </span>\
  <a class="addthis_button_preferred_1"></a> \
  <a class="addthis_button_preferred_2"></a> \
  <a class="addthis_button_preferred_3"></a> \
  <a class="addthis_button_preferred_4"></a> \
  <a class="addthis_button_preferred_8"></a> \
  </div>';

var scriptSocNetw = '<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-520f899c0828146c">'
  
$('.social-networks').html(socNetwButtons + scriptSocNetw);