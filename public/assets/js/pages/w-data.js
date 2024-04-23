'use strict';
document.addEventListener('DOMContentLoaded', function () {
  var lightboxModal = new bootstrap.Modal(document.getElementById('lightboxModal'));
  var elem = document.querySelectorAll('[data-lightbox]');
  for (var j = 0; j < elem.length; j++) {
    elem[j].addEventListener('click', function () {
      var images_path = event.target;
      if (images_path.tagName == 'DIV') {
        images_path = images_path.parentNode;
      }
      if (images_path.tagName == 'I') {
        images_path = images_path.parentNode.parentNode;
      }
      var recipient = images_path.getAttribute('data-lightbox');
      var image = document.querySelector('.modal-image');
      image.setAttribute('src', recipient);
      lightboxModal.show();
    });
  }

  function removeClassByPrefix(node, prefix) {
    for (let i = 0; i < node.classList.length; i++) {
      let value = node.classList[i];
      if (value.startsWith(prefix)) {
        node.classList.remove(value);
      }
    }
  }

  new SimpleBar(document.querySelector('.customer-scroll'));
  new SimpleBar(document.querySelector('.incomeing-scroll'));
  new SimpleBar(document.querySelector('.product-scroll'));
  new SimpleBar(document.querySelector('.sale-scroll'));
  new SimpleBar(document.querySelector('.revenue-scroll'));
  new SimpleBar(document.querySelector('.chat-scroll'));
  new SimpleBar(document.querySelector('.chat1-scroll'));
  new SimpleBar(document.querySelector('.stock-scroll'));
  new SimpleBar(document.querySelector('.subject-scroll'));
  new SimpleBar(document.querySelector('.app-scroll'));
  new SimpleBar(document.querySelector('.user-scroll'));
  new SimpleBar(document.querySelector('.full-scroll'));
  new SimpleBar(document.querySelector('.recent-scroll'));
  new SimpleBar(document.querySelector('.cust-scroll'));
  new SimpleBar(document.querySelector('.pro-scroll'));
  new SimpleBar(document.querySelector('.contact-scroll'));
  new SimpleBar(document.querySelector('.performance-scroll'));
  new SimpleBar(document.querySelector('.test-scroll'));
  new SimpleBar(document.querySelector('.dash-scroll'));
  new SimpleBar(document.querySelector('.activity-scroll'));
  new SimpleBar(document.querySelector('.campaign-scroll'));
  new SimpleBar(document.querySelector('.feed-scroll'));
  new SimpleBar(document.querySelector('.new-scroll'));
  new SimpleBar(document.querySelector('.latest-scroll'));
});
