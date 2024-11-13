

(function () {
  console.log('ready');
  const burger = jQuery(".burger"),
    burgerSpan = jQuery(".burger span"),
    nav = jQuery('.header__nav'),
    body = jQuery('body');

  burger.on("click", function () {
    burgerSpan.toggleClass("active");
    nav.toggleClass("active");
    body.toggleClass("fixed-page");
  });


  jQuery('.slider-product-wrap__slider img').on('click', function name() {
    changeImage(jQuery(this).attr('src'))
  }

  )

  // const swiper = new Swiper('.slider-product-wrap__slider', {
  //   // Optional parameters
  //   direction: 'vertical',
  //   loop: true,

  //   // If we need pagination
  //   pagination: {
  //     el: '.swiper-pagination',
  //   },

  //   // Navigation arrows
  //   navigation: {
  //     nextEl: '.swiper-button-next',
  //     prevEl: '.swiper-button-prev',
  //   },

  //   // And if we need scrollbar
  //   scrollbar: {
  //     el: '.swiper-scrollbar',
  //   },
  // });

  // jQuery('.slider-product-wrap__show').slick({
  //   slidesToShow: 1, // Number of thumbnails visible
  //   slidesToScroll: 1,
  //   // asNavFor: '.slider-product-wrap__slider', // Sync with the main slider
  //   dots: false,
  //   arrows: false,
  //   centerMode: false,
  //   focusOnSelect: true,
  //   infinite: false,
  //   vertical: true, // Makes the slider vertical
  //   verticalSwiping: true
  // });


  // jQuery('.slider-product-wrap__slider').slick({
  //   slidesToShow: 3, // Number of thumbnails visible
  //   slidesToScroll: 1,
  //   asNavFor: '.slider-product-wrap__show', // Sync with the main slider
  //   dots: false,
  //   arrows: false,
  //   centerMode: false,
  //   focusOnSelect: true,
  //   infinite: false,
  //   vertical: true, // Makes the slider vertical
  //   verticalSwiping: true
  // });


  function changeImage(imageSrc) {
    console.log(jQuery('#mainImage').attr('src'));
    jQuery('#mainImage').attr('src', imageSrc)
    jQuery('#mainImage').attr('srcset', imageSrc);

    // Optionally, you can reset sizes attribute if needed
    jQuery('#mainImage').attr('sizes', '(max-width: 128px) 100vw, 128px');
  }

  jQuery(window).on("load", function () {

    jQuery('.flex-control-nav').slick({
      slidesToShow: 3, // Number of thumbnails visible
      slidesToScroll: 1,
      // asNavFor: '.slider-for', // Sync with the main slider
      dots: false,
      arrows: false,
      centerMode: false,
      focusOnSelect: true,
      infinite: false,
      vertical: true, // Makes the slider vertical
      verticalSwiping: true
    });

  });


  setTimeout(function () {
    if (getCookie('popupCookie') != 'submited') {
      jQuery('.cookies').css("display", "block").hide().fadeIn(2000);
    }

    jQuery('a.submit').click(function () {
      jQuery('.cookies').fadeOut();
      //sets the coookie to five minutes if the popup is submited (whole numbers = days)
      setCookie('popupCookie', 'submited', 7);
    });
  }, 5000);

  function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

  function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

  if (getCookie('ageVerification') !== 'submited') {
    jQuery('.age-verefication').css('display', 'block')
  }

})(jQuery);
window.addEventListener("load", (event) => {



  jQuery('.goals-qa-tnl__left_wrap-links a').on("click", function (e) {
    var target = jQuery(this).attr("href");
    jQuery("html, body").animate({
      scrollTop: jQuery(target).offset().top - jQuery('header').height()
    }, 200);
  });
  if (window.innerWidth < 769) {
  }
  // Observe object for changes in blocks (if you are tracking changes in some state)
  let blockState = {
    currentBlock: null,
  };

  let blockObserver = new Proxy(blockState, {
    set(target, property, value) {
      if (property === 'currentBlock' && target[property] !== value) {
        // Change image in the left column
        changeImage(value);
      }
      target[property] = value;
      return true;
    }
  });

  // Function to change the image in the left column based on the block's data-url
  function changeImage(blockElement) {

    const newImageUrl = blockElement.getAttribute('data-src');
    const imageElement = document.getElementById('mainImage');
    imageElement.src = newImageUrl;

    imageElement.classList.add('fade-out');

    // Once fade-out is complete, change the image and fade it back in
    setTimeout(function () {
      imageElement.src = newImageUrl;
      imageElement.classList.remove('fade-out');
      imageElement.classList.add('fade-in');

      // Remove fade-in class after the animation completes
      setTimeout(function () {
        imageElement.classList.remove('fade-in');
      }, 500); // Matches the transition duration
    }, 500); // Matches the transition duration
  }

  // Scroll event listener
  window.addEventListener('scroll', function () {
    const blocks = document.querySelectorAll('.content-goal');
    let foundBlock = null;

    blocks.forEach(function (block) {
      const rect = block.getBoundingClientRect();

      if (rect.top >= 0 && rect.bottom - 260 <= window.innerHeight) {
        foundBlock = block;
      }
    });

    if (foundBlock) {

      blockObserver.currentBlock = foundBlock;
    }
  });


})

document.addEventListener('DOMContentLoaded', function () {

  const gallery = document.querySelector('.slider-product-wrap__slider');
  const images = JSON.parse(gallery.getAttribute('data-img-dot'));
  console.log(images);
  const swiper = new Swiper('.slider-product-wrap__slider', {
    // direction: 'vertical',
    slidesPerView: 1,
    // spaceBetween: 10,
    // slidesPerGroup: 1,
    loop: false,
    autoHeight: true,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
      renderBullet: function (index, className) {

        return `<span class="${className}" style="background-image:url(${images[index]})"></span>`;
      },
    },
    on: {

      slideChange: function () {
        updateVisibleDots();
      }
    }
    // breakpoints: {
    //   // when window width is >= 320px
    //   320: {
    //     slidesPerView: 2,
    //     spaceBetween: 20
    //   },
    //   // when window width is >= 480px
    //   769: {
    //     slidesPerView: 3,
    //     spaceBetween: 30
    //   },
    //   // when window width is >= 640px
    //   1020: {
    //     slidesPerView: 4,
    //     spaceBetween: 40
    //   }
    // },

  });
  function updateVisibleDots() {
    const bullets = document.querySelectorAll('.swiper-pagination .swiper-pagination-bullet');
    const maxVisibleDots = 4;
    const activeIndex = swiper.activeIndex;

    // Hide all bullets initially
    bullets.forEach((bullet, i) => bullet.style.display = 'none');

    // Determine which bullets to show
    let start = Math.max(0, activeIndex - Math.floor(maxVisibleDots / 2));
    let end = Math.min(bullets.length, start + maxVisibleDots);

    // Ensure that you show only maxVisibleDots at a time
    if (end === bullets.length) {
      start = Math.max(0, bullets.length - maxVisibleDots);
    }

    // Show the appropriate bullets
    for (let i = start; i < end; i++) {
      bullets[i].style.display = 'inline-block';
    }
  }

  updateVisibleDots()
  // document.querySelector('.custom-prev').addEventListener('click', function () {
  //   console.log(1);

  //   swiper.slidePrev();  // Move to the previous slide
  // });

  // // Custom trigger for 'Next' button
  // document.querySelector('.custom-next').addEventListener('click', function () {
  //   swiper.slideNext();  // Move to the next slide
  // });

});