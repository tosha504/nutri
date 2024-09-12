intFunc = function () {
  // Next button
  jQuery('#nextScience').click(function () {
    jQuery('.science-tnl__items-slider').slick('slickNext');
  });

  // Previous button
  jQuery('#prevScience').click(function () {
    jQuery('.science-tnl__items-slider').slick('slickPrev');
  });


  jQuery(".science-tnl__items-slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    arrows: false,
    infinite: false,
    swipe: true,

  });

};
if (window.acf) {
  acf.addAction("render_block_preview/type=actors", intFunc);
} else {
  intFunc();
}