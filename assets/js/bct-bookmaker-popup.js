(function ($) {
  $(document).ready(function () {
    var modal = $('#popup-modal');
    var popup = $('.bct-bookmaker-popup-btn');
    var popupCloseModal = $('.close-modal');
    var popupCloseBtn = $('.close-popup');
    var prevScrollpos = window.pageYOffset;

    popup.on('click', function (e) {
      modal.css('display', 'block');
    });

    popupCloseModal.on('click', function () {
      modal.hide();
    });

    $('body').on('click', function (event) {
      if ($(event.target).is(modal)) {
        modal.hide();
      }
    });

    function showDisplayBtn() {
      var currentScrollPos = window.pageYOffset;

      if (prevScrollpos > currentScrollPos) {
        // popup.addClass('sticky');
        // popup.css('width', $(window).width() - 10);
        popup.css('visibility', 'visible');
      } else if (prevScrollpos <= currentScrollPos) {
        // popup.removeClass('sticky');
        popup.css('visibility', 'hidden');
      }

      prevScrollpos = currentScrollPos;
    }

    // if ($(window).width() < 768) {
    //   showDisplayBtn()
    // }
    //
    // window.addEventListener('scroll', showDisplayBtn);

    popupCloseBtn.on('click', function (e) {
      e.stopPropagation();
      popup.hide();
      setCookie('bet_popup_closed', 'true', 1);
    });

    function setCookie(cname, cvalue, exdays) {
      var d = new Date();
      d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
      var expires = "expires=" + d.toUTCString();
      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
      var name = cname + '=';
      var ca = document.cookie.split(';');
      for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return '';
    }

    function checkViewport() {
      var offsetTop = 0;

      $('[scroll-offset]').each(function (_index, elem) {
        offsetTop += elem.clientHeight;
      });

      sticky.css('top', offsetTop);
    }

    var sticky = $('.bct-bookmaker-popup-btn.sticky');

    if (sticky.length) {
      checkViewport();

      $(window).on('resize', checkViewport);
    }

    if (getCookie('bet_popup_closed') !== 'true') {
      popup.css('display', 'block');
    }
  });
})(jQuery);
