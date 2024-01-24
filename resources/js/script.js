import $ from 'jquery';
$(function () {

  $('[data-slick-carousel]').slick({
    dots: true,
  });

  $('[data-accordion]').each(function () {
    let $accordion = $(this);
    let isOpen = $accordion.data('active') !== undefined;

    let $accordionToggle = $accordion.find('[data-accordion-toggle]');
    let $accordionNoActiveItem = $accordion.find('[data-accordion-not-active]');
    let $accordionActiveItem = $accordion.find('[data-accordion-active]');
    let $accordionContent = $accordion.find('[data-accordion-details]');

    $accordionToggle.on('click', function () {
      if (isOpen) {
        $accordionNoActiveItem.show();
        $accordionActiveItem.hide();
        $accordionContent.slideUp();
      } else {
        $accordionNoActiveItem.hide();
        $accordionActiveItem.show();
        $accordionContent.slideDown();
      }

      isOpen = !isOpen;
    })
  })
})

$(function () {
    $('[data-slick-carousel-detail]').each(function () {
      let $carousel = $(this);

      $carousel.find('[data-slick-carousel-detail-items]').slick({
        dots: true,
        arrows: false,
        appendDots: $carousel.find('[data-slick-carousel-detail-pager]'),
        rows: 0,
        customPaging: function (slick, index) {
          let imageSrc = slick.$slides[index].src;

          return `
<div class="relative">
<svg xmlns="http://www.w3.org/2000/svg" class="active-arrow absolute -top-6 left-2/4 -ml-3 text-orange h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
</svg>
<span class="inline-block border rounded cursor-pointer"><img class="h-20 w-40 object-cover" src="${imageSrc}" alt="" title=""></span>
</div>`;
        }
      })
    })
  })
