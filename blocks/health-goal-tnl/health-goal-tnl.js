intFunc = function () {
  // Next button
  jQuery('#next').click(function () {
    jQuery('.health-goal-tnl__items-slider').slick('slickNext');
  });

  // Previous button
  jQuery('#prev').click(function () {
    jQuery('.health-goal-tnl__items-slider').slick('slickPrev');
  });


  jQuery(".health-goal-tnl__items-slider").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    dots: true,
    arrows: false,
    infinite: false,
    swipe: true,
    responsive: [
      {
        breakpoint: 1199,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          swipe: true,
        },
      },
      {
        breakpoint: 575,
        settings: {
          slidesToShow: 1,
          swipe: true,
        },
      }]
  });

};
if (window.acf) {
  acf.addAction("render_block_preview/type=actors", intFunc);
} else {
  intFunc();
}