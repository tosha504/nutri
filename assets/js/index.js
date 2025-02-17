/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/***/ (() => {

(function () {
  console.log('ready');
  var burger = jQuery(".burger"),
    burgerSpan = jQuery(".burger span"),
    nav = jQuery('.main-navigation'),
    body = jQuery('body');
  burger.on("click", function () {
    burgerSpan.toggleClass("active");
    nav.toggleClass("active");
    body.toggleClass("fixed-page");
  });
  jQuery(body).on('click', '.search-header', function (e) {
    e.preventDefault();
    jQuery(this).toggleClass('active');
    jQuery('.search-form-tnl').toggleClass('active');
    jQuery(body).toggleClass("fixed-page");
    jQuery('html').toggleClass("dode");
  });
  function mobNavMenu() {
    jQuery(document).on("click", ".menu-item-has-children", function (e) {
      console.log(jQuery(e.target));
      jQuery(e.target).children().siblings("ul .sub-menu").slideToggle(500);
      if (jQuery(e.target)
      // .parent()
      .children().siblings("ul .sub-menu").css("display") == "block") {
        jQuery(e.target)
        // .parent()
        .siblings().children("ul .sub-menu").slideUp(500);
        jQuery(e.target)
        // .parent()
        .siblings().children("a").removeClass("active");
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
    changeImage(jQuery(this).attr('src'));
  });
  function changeImage(imageSrc) {
    console.log(jQuery('#mainImage').attr('src'));
    jQuery('#mainImage').attr('src', imageSrc);
    jQuery('#mainImage').attr('srcset', imageSrc);

    // Optionally, you can reset sizes attribute if needed
    jQuery('#mainImage').attr('sizes', '(max-width: 128px) 100vw, 128px');
  }
  jQuery('.slider-product-wrap__show').slick({
    slidesToShow: 1,
    // Number of thumbnails visible
    slidesToScroll: 1,
    asNavFor: '.slider-product-wrap__slider',
    // Sync with the main slider
    dots: false,
    arrows: true,
    centerMode: false,
    focusOnSelect: true,
    infinite: false
  });
  jQuery(window).on("load", function () {
    jQuery('.slider-product-wrap__slider').slick({
      slidesToShow: 4,
      // Number of thumbnails visible
      slidesToScroll: 1,
      asNavFor: '.slider-product-wrap__show',
      dots: false,
      arrows: false,
      centerMode: false,
      focusOnSelect: true,
      infinite: false,
      vertical: true,
      verticalSwiping: true,
      responsive: [{
        breakpoint: 992,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
          dots: true,
          vertical: false,
          verticalSwiping: false
        }
      }, {
        breakpoint: 576,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          dots: true,
          vertical: false,
          verticalSwiping: false,
          infinite: true
        }
      }]
    });
    jQuery('.flex-control-nav').slick({
      slidesToShow: 3,
      // Number of thumbnails visible
      slidesToScroll: 1,
      // asNavFor: '.slider-for', // Sync with the main slider
      dots: false,
      arrows: false,
      centerMode: false,
      focusOnSelect: true,
      infinite: false,
      vertical: true,
      // Makes the slider vertical
      verticalSwiping: true
    });
  });

  //single-page woo
  jQuery(document).on("click", '.cart-qty.plus, .cart-qty.minus', function (e) {
    e.preventDefault();
    var input = jQuery(this).parent().find('.input-text.qty.text');
    var input_val = parseInt(input.val());
    if (jQuery(this).hasClass('plus')) {
      input.val(input_val + 1);
      input.attr('value', input_val + 1);
    } else {
      var new_val = input_val - 1;
      if (new_val > 0) {
        input.val(input_val - 1);
        input.attr('value', input_val - 1);
      }
    }
    input.trigger("change");
  });
  var timeout;
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
      });
    });
  });
  jQuery('.arrow-down').on('click', function () {
    jQuery('html, body').animate({
      scrollTop: jQuery(window).scrollTop() + jQuery(window).height() - jQuery('header').height() - 50
    }, 500);
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
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }
  if (getCookie('ageVerification') !== 'submited') {
    jQuery('.age-verefication').css('display', 'block');
  }
  body.on('click', '.megaMenu__menu-mg_link', function (e) {
    e.preventDefault();
    console.log(jQuery(this).parent());
    if (jQuery(this).siblings().hasClass('active')) {
      jQuery(this).siblings().removeClass('active');
      jQuery(this).addClass('active');
    }
    var number = jQuery(this).attr('data-key-link');
    jQuery('.megaMenu__item').removeClass('active');
    jQuery(".megaMenu__item[data-key=\"".concat(number, "\"]")).addClass('active');
  });
})(jQuery);
window.addEventListener("load", function (event) {
  jQuery(window).scroll(function () {
    if (jQuery('.slider-product-wrap')) {
      jQuery('.slider-product-wrap').css({
        'top': "".concat(document.querySelector(".header").clientHeight + 20, "px")
      });
    }
  });
  jQuery('.goals-qa-tnl__left_wrap-links a').on("click", function (e) {
    var target = jQuery(this).attr("href");
    jQuery("html, body").animate({
      scrollTop: jQuery(target).offset().top - jQuery('header').height()
    }, 200);
  });
  if (window.innerWidth < 769) {}
  // Observe object for changes in blocks (if you are tracking changes in some state)
  var blockState = {
    currentBlock: null
  };
  var blockObserver = new Proxy(blockState, {
    set: function set(target, property, value) {
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
    var newImageUrl = blockElement.getAttribute('data-src');
    var imageElement = document.getElementById('mainImage');
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
    var blocks = document.querySelectorAll('.content-goal');
    var foundBlock = null;
    blocks.forEach(function (block) {
      var rect = block.getBoundingClientRect();
      if (rect.top >= 0 && rect.bottom - 260 <= window.innerHeight) {
        foundBlock = block;
      }
    });
    if (foundBlock) {
      blockObserver.currentBlock = foundBlock;
    }
  });
});

/***/ }),

/***/ "./gutenberg-styles/goal-help-tnl.scss":
/*!*********************************************!*\
  !*** ./gutenberg-styles/goal-help-tnl.scss ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./gutenberg-styles/goals-qa-tnl.scss":
/*!********************************************!*\
  !*** ./gutenberg-styles/goals-qa-tnl.scss ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./gutenberg-styles/health-goal-tnl.scss":
/*!***********************************************!*\
  !*** ./gutenberg-styles/health-goal-tnl.scss ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./gutenberg-styles/image-text.scss":
/*!******************************************!*\
  !*** ./gutenberg-styles/image-text.scss ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./gutenberg-styles/science-tnl.scss":
/*!*******************************************!*\
  !*** ./gutenberg-styles/science-tnl.scss ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./gutenberg-styles/symptoms-tnl.scss":
/*!********************************************!*\
  !*** ./gutenberg-styles/symptoms-tnl.scss ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./gutenberg-styles/team-tnl.scss":
/*!****************************************!*\
  !*** ./gutenberg-styles/team-tnl.scss ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./gutenberg-styles/title-and-descr.scss":
/*!***********************************************!*\
  !*** ./gutenberg-styles/title-and-descr.scss ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./gutenberg-styles/two-col-img.scss":
/*!*******************************************!*\
  !*** ./gutenberg-styles/two-col-img.scss ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./sass/index.scss":
/*!*************************!*\
  !*** ./sass/index.scss ***!
  \*************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./gutenberg-styles/banner-calc-smpl-tnl.scss":
/*!****************************************************!*\
  !*** ./gutenberg-styles/banner-calc-smpl-tnl.scss ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./gutenberg-styles/banner-calc-tnl.scss":
/*!***********************************************!*\
  !*** ./gutenberg-styles/banner-calc-tnl.scss ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./gutenberg-styles/banner-tnl.scss":
/*!******************************************!*\
  !*** ./gutenberg-styles/banner-tnl.scss ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./gutenberg-styles/consultation-tnl.scss":
/*!************************************************!*\
  !*** ./gutenberg-styles/consultation-tnl.scss ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./gutenberg-styles/difference-tnl.scss":
/*!**********************************************!*\
  !*** ./gutenberg-styles/difference-tnl.scss ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/assets/js/index": 0,
/******/ 			"css-blocks/difference-tnl": 0,
/******/ 			"css-blocks/consultation-tnl": 0,
/******/ 			"css-blocks/banner-tnl": 0,
/******/ 			"css-blocks/banner-calc-tnl": 0,
/******/ 			"css-blocks/banner-calc-smpl-tnl": 0,
/******/ 			"src/index": 0,
/******/ 			"css-blocks/two-col-img": 0,
/******/ 			"css-blocks/title-and-descr": 0,
/******/ 			"css-blocks/team-tnl": 0,
/******/ 			"css-blocks/symptoms-tnl": 0,
/******/ 			"css-blocks/science-tnl": 0,
/******/ 			"css-blocks/image-text": 0,
/******/ 			"css-blocks/health-goal-tnl": 0,
/******/ 			"css-blocks/goals-qa-tnl": 0,
/******/ 			"css-blocks/goal-help-tnl": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css-blocks/difference-tnl","css-blocks/consultation-tnl","css-blocks/banner-tnl","css-blocks/banner-calc-tnl","css-blocks/banner-calc-smpl-tnl","src/index","css-blocks/two-col-img","css-blocks/title-and-descr","css-blocks/team-tnl","css-blocks/symptoms-tnl","css-blocks/science-tnl","css-blocks/image-text","css-blocks/health-goal-tnl","css-blocks/goals-qa-tnl","css-blocks/goal-help-tnl"], () => (__webpack_require__("./src/index.js")))
/******/ 	__webpack_require__.O(undefined, ["css-blocks/difference-tnl","css-blocks/consultation-tnl","css-blocks/banner-tnl","css-blocks/banner-calc-tnl","css-blocks/banner-calc-smpl-tnl","src/index","css-blocks/two-col-img","css-blocks/title-and-descr","css-blocks/team-tnl","css-blocks/symptoms-tnl","css-blocks/science-tnl","css-blocks/image-text","css-blocks/health-goal-tnl","css-blocks/goals-qa-tnl","css-blocks/goal-help-tnl"], () => (__webpack_require__("./gutenberg-styles/banner-calc-smpl-tnl.scss")))
/******/ 	__webpack_require__.O(undefined, ["css-blocks/difference-tnl","css-blocks/consultation-tnl","css-blocks/banner-tnl","css-blocks/banner-calc-tnl","css-blocks/banner-calc-smpl-tnl","src/index","css-blocks/two-col-img","css-blocks/title-and-descr","css-blocks/team-tnl","css-blocks/symptoms-tnl","css-blocks/science-tnl","css-blocks/image-text","css-blocks/health-goal-tnl","css-blocks/goals-qa-tnl","css-blocks/goal-help-tnl"], () => (__webpack_require__("./gutenberg-styles/banner-calc-tnl.scss")))
/******/ 	__webpack_require__.O(undefined, ["css-blocks/difference-tnl","css-blocks/consultation-tnl","css-blocks/banner-tnl","css-blocks/banner-calc-tnl","css-blocks/banner-calc-smpl-tnl","src/index","css-blocks/two-col-img","css-blocks/title-and-descr","css-blocks/team-tnl","css-blocks/symptoms-tnl","css-blocks/science-tnl","css-blocks/image-text","css-blocks/health-goal-tnl","css-blocks/goals-qa-tnl","css-blocks/goal-help-tnl"], () => (__webpack_require__("./gutenberg-styles/banner-tnl.scss")))
/******/ 	__webpack_require__.O(undefined, ["css-blocks/difference-tnl","css-blocks/consultation-tnl","css-blocks/banner-tnl","css-blocks/banner-calc-tnl","css-blocks/banner-calc-smpl-tnl","src/index","css-blocks/two-col-img","css-blocks/title-and-descr","css-blocks/team-tnl","css-blocks/symptoms-tnl","css-blocks/science-tnl","css-blocks/image-text","css-blocks/health-goal-tnl","css-blocks/goals-qa-tnl","css-blocks/goal-help-tnl"], () => (__webpack_require__("./gutenberg-styles/consultation-tnl.scss")))
/******/ 	__webpack_require__.O(undefined, ["css-blocks/difference-tnl","css-blocks/consultation-tnl","css-blocks/banner-tnl","css-blocks/banner-calc-tnl","css-blocks/banner-calc-smpl-tnl","src/index","css-blocks/two-col-img","css-blocks/title-and-descr","css-blocks/team-tnl","css-blocks/symptoms-tnl","css-blocks/science-tnl","css-blocks/image-text","css-blocks/health-goal-tnl","css-blocks/goals-qa-tnl","css-blocks/goal-help-tnl"], () => (__webpack_require__("./gutenberg-styles/difference-tnl.scss")))
/******/ 	__webpack_require__.O(undefined, ["css-blocks/difference-tnl","css-blocks/consultation-tnl","css-blocks/banner-tnl","css-blocks/banner-calc-tnl","css-blocks/banner-calc-smpl-tnl","src/index","css-blocks/two-col-img","css-blocks/title-and-descr","css-blocks/team-tnl","css-blocks/symptoms-tnl","css-blocks/science-tnl","css-blocks/image-text","css-blocks/health-goal-tnl","css-blocks/goals-qa-tnl","css-blocks/goal-help-tnl"], () => (__webpack_require__("./gutenberg-styles/goal-help-tnl.scss")))
/******/ 	__webpack_require__.O(undefined, ["css-blocks/difference-tnl","css-blocks/consultation-tnl","css-blocks/banner-tnl","css-blocks/banner-calc-tnl","css-blocks/banner-calc-smpl-tnl","src/index","css-blocks/two-col-img","css-blocks/title-and-descr","css-blocks/team-tnl","css-blocks/symptoms-tnl","css-blocks/science-tnl","css-blocks/image-text","css-blocks/health-goal-tnl","css-blocks/goals-qa-tnl","css-blocks/goal-help-tnl"], () => (__webpack_require__("./gutenberg-styles/goals-qa-tnl.scss")))
/******/ 	__webpack_require__.O(undefined, ["css-blocks/difference-tnl","css-blocks/consultation-tnl","css-blocks/banner-tnl","css-blocks/banner-calc-tnl","css-blocks/banner-calc-smpl-tnl","src/index","css-blocks/two-col-img","css-blocks/title-and-descr","css-blocks/team-tnl","css-blocks/symptoms-tnl","css-blocks/science-tnl","css-blocks/image-text","css-blocks/health-goal-tnl","css-blocks/goals-qa-tnl","css-blocks/goal-help-tnl"], () => (__webpack_require__("./gutenberg-styles/health-goal-tnl.scss")))
/******/ 	__webpack_require__.O(undefined, ["css-blocks/difference-tnl","css-blocks/consultation-tnl","css-blocks/banner-tnl","css-blocks/banner-calc-tnl","css-blocks/banner-calc-smpl-tnl","src/index","css-blocks/two-col-img","css-blocks/title-and-descr","css-blocks/team-tnl","css-blocks/symptoms-tnl","css-blocks/science-tnl","css-blocks/image-text","css-blocks/health-goal-tnl","css-blocks/goals-qa-tnl","css-blocks/goal-help-tnl"], () => (__webpack_require__("./gutenberg-styles/image-text.scss")))
/******/ 	__webpack_require__.O(undefined, ["css-blocks/difference-tnl","css-blocks/consultation-tnl","css-blocks/banner-tnl","css-blocks/banner-calc-tnl","css-blocks/banner-calc-smpl-tnl","src/index","css-blocks/two-col-img","css-blocks/title-and-descr","css-blocks/team-tnl","css-blocks/symptoms-tnl","css-blocks/science-tnl","css-blocks/image-text","css-blocks/health-goal-tnl","css-blocks/goals-qa-tnl","css-blocks/goal-help-tnl"], () => (__webpack_require__("./gutenberg-styles/science-tnl.scss")))
/******/ 	__webpack_require__.O(undefined, ["css-blocks/difference-tnl","css-blocks/consultation-tnl","css-blocks/banner-tnl","css-blocks/banner-calc-tnl","css-blocks/banner-calc-smpl-tnl","src/index","css-blocks/two-col-img","css-blocks/title-and-descr","css-blocks/team-tnl","css-blocks/symptoms-tnl","css-blocks/science-tnl","css-blocks/image-text","css-blocks/health-goal-tnl","css-blocks/goals-qa-tnl","css-blocks/goal-help-tnl"], () => (__webpack_require__("./gutenberg-styles/symptoms-tnl.scss")))
/******/ 	__webpack_require__.O(undefined, ["css-blocks/difference-tnl","css-blocks/consultation-tnl","css-blocks/banner-tnl","css-blocks/banner-calc-tnl","css-blocks/banner-calc-smpl-tnl","src/index","css-blocks/two-col-img","css-blocks/title-and-descr","css-blocks/team-tnl","css-blocks/symptoms-tnl","css-blocks/science-tnl","css-blocks/image-text","css-blocks/health-goal-tnl","css-blocks/goals-qa-tnl","css-blocks/goal-help-tnl"], () => (__webpack_require__("./gutenberg-styles/team-tnl.scss")))
/******/ 	__webpack_require__.O(undefined, ["css-blocks/difference-tnl","css-blocks/consultation-tnl","css-blocks/banner-tnl","css-blocks/banner-calc-tnl","css-blocks/banner-calc-smpl-tnl","src/index","css-blocks/two-col-img","css-blocks/title-and-descr","css-blocks/team-tnl","css-blocks/symptoms-tnl","css-blocks/science-tnl","css-blocks/image-text","css-blocks/health-goal-tnl","css-blocks/goals-qa-tnl","css-blocks/goal-help-tnl"], () => (__webpack_require__("./gutenberg-styles/title-and-descr.scss")))
/******/ 	__webpack_require__.O(undefined, ["css-blocks/difference-tnl","css-blocks/consultation-tnl","css-blocks/banner-tnl","css-blocks/banner-calc-tnl","css-blocks/banner-calc-smpl-tnl","src/index","css-blocks/two-col-img","css-blocks/title-and-descr","css-blocks/team-tnl","css-blocks/symptoms-tnl","css-blocks/science-tnl","css-blocks/image-text","css-blocks/health-goal-tnl","css-blocks/goals-qa-tnl","css-blocks/goal-help-tnl"], () => (__webpack_require__("./gutenberg-styles/two-col-img.scss")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css-blocks/difference-tnl","css-blocks/consultation-tnl","css-blocks/banner-tnl","css-blocks/banner-calc-tnl","css-blocks/banner-calc-smpl-tnl","src/index","css-blocks/two-col-img","css-blocks/title-and-descr","css-blocks/team-tnl","css-blocks/symptoms-tnl","css-blocks/science-tnl","css-blocks/image-text","css-blocks/health-goal-tnl","css-blocks/goals-qa-tnl","css-blocks/goal-help-tnl"], () => (__webpack_require__("./sass/index.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;