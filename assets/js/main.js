(function ($) {
    "use strict";

       /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    if (all) {
      select(el, all).forEach(e => e.addEventListener(type, listener))
    } else {
      select(el, all).addEventListener(type, listener)
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Scrolls to an element with header offset
   */
  const scrollto = (el) => {
    let header = select('#header')
    let offset = header.offsetHeight

    if (!header.classList.contains('header-scrolled')) {
      offset -= 10
    }

    let elementPos = select(el).offsetTop
    window.scrollTo({
      top: elementPos - offset,
      behavior: 'smooth'
    })
  }

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
      } else {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }
    

  /**
   * Mobile nav toggle
   */
   on('click', '.mobile-nav-toggle', function(e) {
    select('#navbar').classList.toggle('navbar-mobile')
    this.classList.toggle('bi-list')
    this.classList.toggle('bi-x')
  })

  /**
   * Mobile nav dropdowns activate
   */
  on('click', '.navbar .dropdown > a', function(e) {
    if (select('#navbar').classList.contains('navbar-mobile')) {
      e.preventDefault()
      this.nextElementSibling.classList.toggle('dropdown-active')
    }
  }, true)

  /**
   * Scrool with ofset on links with a class name .scrollto
   */
  on('click', '.scrollto', function(e) {
    if (select(this.hash)) {
      e.preventDefault()

      let navbar = select('#navbar')
      if (navbar.classList.contains('navbar-mobile')) {
        navbar.classList.remove('navbar-mobile')
        let navbarToggle = select('.mobile-nav-toggle')
        navbarToggle.classList.toggle('bi-list')
        navbarToggle.classList.toggle('bi-x')
      }
      scrollto(this.hash)
    }
  }, true)

  /**
   * Scroll with ofset on page load with hash links in the url
   */
  window.addEventListener('load', () => {
    if (window.location.hash) {
      if (select(window.location.hash)) {
        scrollto(window.location.hash)
      }
    }
  });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000
    });


 // Gallery isotope and filter
 var galleryIsotope = $('.gallery-container').isotope({
    itemSelector: '.gallery-item',
    layoutMode: 'fitRows'
});
$('#gallery-flters li').on('click', function () {
    $("#gallery-flters li").removeClass('active');
    $(this).addClass('active');

    galleryIsotope.isotope({filter: $(this).data('filter')});
});

// Initiate the wowjs
new WOW().init();



const portfolioLightbox = GLightbox({
    selector: '.gallery-lightbox'
  });



    new Swiper('.hero-slider', {
        speed: 400,
        loop: true,
        autoplay: false,
        // {
        //   delay: 5000,
        //   disableOnInteraction: false
        // },
        slidesPerView: 1,
        spaceBetween: 0,
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true
        },
      });





      /* client Slider - Swiper */
var cardSlider = new Swiper('.client-slider', {
	autoplay: false,
	// {
	// 	delay: 4000,
	// 	disableOnInteraction: false
	// },
	loop: true,
	// pagination: {
    //     el: '.swiper-pagination',
    //     type: 'bullets',
    //     clickable: true
    // },
	slidesPerView: 6,
	spaceBetween: 50,
	breakpoints: {
		 // when window width is >= 480px
         480: {
            slidesPerView: 2,
            spaceBetween: 30
        },
        // when window width is >= 640px
        600: {
            slidesPerView: 3,
            spaceBetween: 30
        },
        767: {
            slidesPerView: 3,
            spaceBetween: 30
        },
        // when window is <= 991px
        991: {
            slidesPerView: 6,
            spaceBetween: 50,
        },
	}
});


new Swiper('.ongkir-slider', {
    speed: 400,
    loop: true,
    autoplay: false,
    // {
    //   delay: 5000,
    //   disableOnInteraction: false
    // },
    slidesPerView: 1,
    spaceBetween: 0,
    pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true
    },
  });

      /* Testimoni Slider - Swiper */
var cardSlider = new Swiper('.testimoni-slider', {
	autoplay: false,
	// {
	// 	delay: 4000,
	// 	disableOnInteraction: false
	// },
	loop: true,
	pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true
    },
	slidesPerView: 3,
	spaceBetween: 20,
	breakpoints: {
		// when window width is >= 480px
        480: {
            slidesPerView: 1,
        },
        // when window width is >= 640px
        600: {
            slidesPerView: 1,
        },
        767: {
            slidesPerView: 2,
            spaceBetween: 30
        },
        // when window is <= 991px
        991: {
            slidesPerView: 2,
            spaceBetween: 30,
        },
	}
});


// $('.detail-layanan-slider a').click(function(){
//     var this_src = $(this).children('img').attr('src');
//     var this_title = $(this).find("h6").text();
//     var this_desk = $(this).find("small").text();
//     $('#img-layanan').attr('src',this_src);
//     $('#title-layanan').html(this_title);
//     $('#desk-layanan').html(this_desk);
//     return false;
//   });


   

})(jQuery);