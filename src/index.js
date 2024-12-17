

(function () {
  console.log('ready');
  const burger = jQuery(".burger"),
    burgerSpan = jQuery(".burger span"),
    nav = jQuery('.main-navigation'),
    body = jQuery('body');

  burger.on("click", function () {
    burgerSpan.toggleClass("active");
    nav.toggleClass("active");
    body.toggleClass("fixed-page");
  });

  jQuery(body).on('click', '.search-header', function (e) {
    e.preventDefault()
    jQuery(this).toggleClass('active');
    jQuery('.search-form-tnl').toggleClass('active')
    jQuery(body).toggleClass("fixed-page");
    jQuery('html').toggleClass("dode");
  })

  function mobNavMenu() {

    jQuery(document).on("click", ".menu-item-has-children", function (e) {

      console.log(jQuery(e.target));
      jQuery(e.target).children().siblings("ul .sub-menu").slideToggle(500);

      if (
        jQuery(e.target)
          // .parent()
          .children()
          .siblings("ul .sub-menu")
          .css("display") == "block"
      ) {
        jQuery(e.target)
          // .parent()
          .siblings()
          .children("ul .sub-menu")
          .slideUp(500);

        jQuery(e.target)
          // .parent()
          .siblings()
          .children("a")
          .removeClass("active");
      }

      if (!jQuery(this).hasClass("active")) {
        jQuery(this).toggleClass("active");
        jQuery(this).siblings('.menu-item-has-children.active').toggleClass("active");
      } else {
        jQuery(this).removeClass("active");
      }

      // if (!jQuery(this).parent().hasClass("active")) {
      //   jQuery(this).parent().toggleClass("active");
      //   jQuery(this).parent().siblings('.menu-item-has-children.active').toggleClass("active");
      // } else {
      //   jQuery(this).parent().removeClass("active");
      // }
    });
  }
  if (jQuery(window).width() < 1200) {
    mobNavMenu();
  }

  jQuery('.slider-product-wrap__slider img').on('click', function name() {
    changeImage(jQuery(this).attr('src'))
  })

  function changeImage(imageSrc) {
    console.log(jQuery('#mainImage').attr('src'));
    jQuery('#mainImage').attr('src', imageSrc)
    jQuery('#mainImage').attr('srcset', imageSrc);

    // Optionally, you can reset sizes attribute if needed
    jQuery('#mainImage').attr('sizes', '(max-width: 128px) 100vw, 128px');
  }


  jQuery('.slider-product-wrap__show').slick({
    slidesToShow: 1, // Number of thumbnails visible
    slidesToScroll: 1,
    asNavFor: '.slider-product-wrap__slider', // Sync with the main slider
    dots: false,
    arrows: true,
    centerMode: false,
    focusOnSelect: true,
    infinite: false,

  });
  jQuery(window).on("load", function () {
    jQuery('.slider-product-wrap__slider').slick({
      slidesToShow: 4, // Number of thumbnails visible
      slidesToScroll: 1,
      asNavFor: '.slider-product-wrap__show',
      dots: false,
      arrows: false,
      centerMode: false,
      focusOnSelect: true,
      infinite: false,
      vertical: true,
      verticalSwiping: true,
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1,
            dots: true,
            vertical: false,
            verticalSwiping: false,
          }
        },
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: true,
            vertical: false,
            verticalSwiping: false,
          }
        },
      ]
    });

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

  //single-page woo
  jQuery(document).on("click", '.cart-qty.plus, .cart-qty.minus', function (e) {
    e.preventDefault();

    const input = jQuery(this).parent().find('.input-text.qty.text');
    const input_val = parseInt(input.val());
    if (jQuery(this).hasClass('plus')) {
      input.val(input_val + 1);
      input.attr('value', input_val + 1)
    }
    else {
      const new_val = input_val - 1;
      if (new_val > 0) {
        input.val(input_val - 1);
        input.attr('value', input_val - 1)
      }
    }

    input.trigger("change");
  });
  let timeout;
  jQuery('.woocommerce').on('change', 'input.qty', function () {
    if (timeout !== undefined) {
      clearTimeout(timeout);
    }
    timeout = setTimeout(function () {
      jQuery("[name='update_cart']").trigger("click"); // trigger cart update
    }, 100); // 1 second delay, half a second (500) seems comfortable too
  });



  if (jQuery('.cross-sells .products li').length > 2) {
    // jQuery('.cross-sells .products').slick({
    //   slidesToShow: 3,
    //   slidesToScroll: 1,
    //   dots: true,
    //   arrows: false,
    //   infinite: false,
    //   swipe: true,
    // })
  }

  jQuery(document).ready(function () {
    jQuery('#checkout_apply_coupon').click(function (ev) {
      ev.preventDefault();
      var code = jQuery('#checkout_coupon_code').val();
      var data = {
        action: 'ajaxapplucoupon',
        coupon_code: code
      };

      jQuery.post(wc_checkout_params.ajax_url, data, function (returned_data) {
        if (returned_data.result == 'error') {
          alert('error');
          jQuery('p.resoult-coupon').html(returned_data.message);
        } else {
          setTimeout(function () {
            jQuery(document.body).trigger('update_checkout');
          }, 500);
        }
      })
    });
  });

  jQuery('.arrow-down').on('click', function () {
    jQuery('html, body').animate({
      scrollTop: jQuery(window).scrollTop() + jQuery(window).height() - jQuery('header').height() - 50
    }, 500);
  })

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

  body.on('click', '.megaMenu__menu-mg_link', function (e) {
    e.preventDefault();
    console.log(jQuery(this).parent());

    if (jQuery(this).siblings().hasClass('active')) {
      jQuery(this).siblings().removeClass('active')
      jQuery(this).addClass('active')
    }
    const number = jQuery(this).attr('data-key-link');
    jQuery('.megaMenu__item').removeClass('active');
    jQuery(`.megaMenu__item[data-key="${number}"]`).addClass('active');
  })

})(jQuery);
window.addEventListener("load", (event) => {

  jQuery(window).scroll(function () {

    if (jQuery('.slider-product-wrap')) {
      jQuery('.slider-product-wrap').css({ 'top': `${document.querySelector(".header").clientHeight + 20}px` })
    }
  });

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

