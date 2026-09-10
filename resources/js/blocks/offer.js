document.querySelectorAll('.b-offer .offer-grid-container').forEach(function (container) {
  var cards = Array.from(container.querySelectorAll('.offer-card'));
  if (!cards.length) return;

  var desktopQuery = window.matchMedia('(min-width: 640px)');

  function syncHeight() {
    // Na desktopie widoczny jest tylko tekst aktywnej karty (pozostałe są
    // wąskimi kolumnami z ukrytym tekstem) — liczenie po wszystkich kartach
    // zawyżałoby wysokość, bo ich tekst zawija się w wąskiej kolumnie.
    var selector = desktopQuery.matches
      ? '.offer-card.is-active .offer-card-body'
      : '.offer-card-body';
    var bodies = container.querySelectorAll(selector);
    var maxNeeded = 380;

    bodies.forEach(function (body) {
      var wrap = body.closest('.offer-card-content-wrap');
      if (!wrap) return;

      var wrapTop = wrap.getBoundingClientRect().top;
      var bodyBottom = body.getBoundingClientRect().bottom;
      var paddingBottom = parseFloat(getComputedStyle(wrap).paddingBottom) || 0;
      var needed = Math.ceil(bodyBottom - wrapTop + paddingBottom);

      maxNeeded = Math.max(maxNeeded, needed);
    });

    container.style.setProperty('--offer-row-height', maxNeeded + 'px');
  }

  var syncTimeout = null;

  function setActive(index) {
    cards.forEach(function (card, i) {
      var isActive = i === index;
      card.classList.toggle('is-active', isActive);

      var image = card.querySelector('.offer-card-image-wrap');
      var content = card.querySelector('.offer-card-content-wrap');

      if (image) image.classList.toggle('is-active', isActive);
      if (content) content.classList.toggle('is-active', isActive);
    });

    // Kolumny siatki (grid-template-columns) animują się przez 0.7s, więc
    // pomiar zaraz po zmianie klasy widziałby jeszcze starą (wąską)
    // szerokość aktywnej karty. Czekamy, aż animacja się ustabilizuje.
    clearTimeout(syncTimeout);
    syncTimeout = setTimeout(syncHeight, 720);
  }

  cards.forEach(function (card, index) {
    card.addEventListener('mouseenter', function () {
      setActive(index);
    });
  });

  syncHeight();
  window.addEventListener('resize', syncHeight);
});
