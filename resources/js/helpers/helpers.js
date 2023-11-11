import hljs from 'highlight.js';
import Choices from 'choices.js';
import { capitalize } from 'lodash';

window.choices = (element) => {
  return new Choices(element, { maxItemCount: 3, removeItemButton: true });
};

window.capitalize = capitalize;

window.highlightCode = (element) => {
  element.querySelectorAll('pre code').forEach((block) => {
    hljs.highlightBlock(block);
  });
};

window.formatMoney = (amount) => {
  return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'XAF' }).format(amount);
};

const share = function () {
  function popupCenter (url, title, width, height) {
    const popupWidth = width || 640;
    const popupHeight = height || 440;
    const windowLeft = window.screenLeft || window.screenX;
    const windowTop = window.screenTop || window.screenY;
    const windowWidth = window.innerWidth || document.documentElement.clientWidth;
    const windowHeight = window.innerHeight || document.documentElement.clientHeight;
    const popupLeft = windowLeft + windowWidth / 2 - popupWidth / 2;
    const popupTop = windowTop + windowHeight / 2 - popupHeight / 2;
    window.open(url, title, 'scrollbars=yes, width=' + popupWidth + ', height=' + popupHeight + ', top=' + popupTop + ', left=' + popupLeft);
  }

  const twitter = document.querySelector('.share_twitter');
  if (twitter) {
    twitter.addEventListener('click', function (e) {
      e.preventDefault();
      const url = this.getAttribute('data-url');
      const shareUrl = 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + '&via=laravelcm' + '&url=' + encodeURIComponent(url);
      popupCenter(shareUrl, 'Partager sur Twitter');
    });
  }

  const facebook = document.querySelector('.share_facebook');
  if (facebook) {
    facebook.addEventListener('click', function (e) {
      e.preventDefault();
      const url = this.getAttribute('data-url');
      const shareUrl = 'https://facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url);
      popupCenter(shareUrl, 'Partager sur Facebook');
    });
  }

  const linkedin = document.querySelector('.share_linkedin');
  if (linkedin) {
    linkedin.addEventListener('click', function (e) {
      e.preventDefault();
      const url = this.getAttribute('data-url');
      const shareUrl = 'https://www.linkedin.com/shareArticle?url=' + encodeURIComponent(url);
      popupCenter(shareUrl, 'Partager sur LinkedIn');
    });
  }
};

share();