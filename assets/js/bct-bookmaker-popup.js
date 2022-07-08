(function ($) {
  $(document).ready(function () {
    const modal = $('#popup-modal');
    const popup = $('.bct-bookmaker-popup-btn');
    const popupCloseModal = $('.close-modal');
    const popupCloseBtn = $('.close-popup');

    popup.on('click', function (e) {
      console.log('here');
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

    if (getCookie('bet_popup_closed') !== 'true') {
      popup.css('display', 'block');
    }

    popupCloseBtn.on('click', function (e) {
      e.stopPropagation();
      popup.hide();
      setCookie('bet_popup_closed', 'true', 1);
    });

    function setCookie(cname, cvalue, exdays) {
      const d = new Date();
      d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
      const expires = "expires=" + d.toUTCString();
      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
      const name = cname + '=';
      const ca = document.cookie.split(';');
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
  });
})(jQuery);
