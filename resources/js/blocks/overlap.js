const { gsap, ScrollTrigger } = window;

if (gsap && ScrollTrigger) {
  gsap.registerPlugin(ScrollTrigger);

  gsap.matchMedia().add('(prefers-reduced-motion: no-preference)', () => {
    document.querySelectorAll('.b-overlap').forEach((section) => {
      const cards = [...section.querySelectorAll('.gsap__cards')];

      cards.slice(0, -1).forEach((wrapper, index) => {
        const card = wrapper.querySelector('.gsap__card');
        const stickyTop = () => parseFloat(getComputedStyle(wrapper).top) || 0;

        if (!card) return;

        // Animate the inner card so the sticky wrapper keeps its original geometry.
        gsap.fromTo(card, {
          scale: 1,
          filter: 'blur(0px) brightness(1)',
        }, {
          scale: 0.94,
          filter: 'blur(4px) brightness(0.75)',
          ease: 'none',
          scrollTrigger: {
            trigger: cards[index + 1],
            start: () => `top ${stickyTop() + wrapper.offsetHeight}px`,
            end: () => `top ${stickyTop()}px`,
            scrub: true,
            invalidateOnRefresh: true,
          },
        });
      });
    });
  });
}
