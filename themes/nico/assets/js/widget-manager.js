document.addEventListener("DOMContentLoaded", function () {
  /* -------------------------- CONFIG -------------------------- */
  const STACK_GAP = 40;               // px between the two widgets
  const MAX_POLL_TIME = 8000;         // stop trying after 8 s
  const POLL_INTERVAL = 400;          // check every 400 ms
  /* ----------------------------------------------------------- */

  /* ---- 1. Load Tawk.to ---- */
  function loadTawkTo() {
    window.Tawk_API = window.Tawk_API || {};
    window.Tawk_LoadStart = new Date();
    const s1 = document.createElement("script");
    const s0 = document.getElementsByTagName("script")[0];
    s1.async = true;
    s1.src = 'https://embed.tawk.to/682269579e297219134755f2/1ir36n0d6';
    s1.charset = 'UTF-8';
    s1.setAttribute('crossorigin', '*');
    s0.parentNode.insertBefore(s1, s0);
  }

  /* ---- 2. Load Beamer ---- */
  function loadBeamer() {
    window.beamer_config = {
      product_id: 'PSxWctdh77089',
      user_id: "52c8d38f-5e87-4288-9b7c-30e5e661b9e5",
    };
    const s = document.createElement("script");
    s.type = "text/javascript";
    s.src = "https://app.getbeamer.com/js/beamer-embed.js";
    s.defer = true;
    document.head.appendChild(s);
  }

  /* ---- 3. Stack the widgets ---- */
  function stackWidgets() {
    // ---- Tawk.to (bottom-most) ----
    const tawk = document.querySelector('#tawkchat-minified-wrapper') ||
                 document.querySelector('#tawkchat-minified-container') ||
                 document.querySelector('[id*="tawk"]');   // fallback

    // ---- Beamer (above Tawk) ----
    const beamer = document.querySelector('.bm-launcher') ||
                   document.querySelector('#beamer-launcher') ||
                   document.querySelector('[data-beamer-launcher]') ||
                   document.querySelector('[class*="beamer"]'); // fallback

    if (!tawk && !beamer) return false;   // nothing to position yet

    const right = '20px';

    if (tawk) {
      tawk.style.cssText += `
        position:fixed !important;
        bottom:${STACK_GAP}px !important;
        right:${right} !important;
        z-index:9998 !important;
      `;
    }

    if (beamer) {
      const beamerBottom = tawk
        ? (tawk.offsetHeight + STACK_GAP * 2) + 'px'   // stack above Tawk
        : (STACK_GAP + 70) + 'px';                    // fallback if Tawk missing
      beamer.style.cssText += `
        position:fixed !important;
        bottom:${beamerBottom} !important;
        right:${right} !important;
        z-index:9999 !important;
      `;
    }

    return tawk && beamer;   // true → both found → stop polling
  }

  /* ---- 4. Polling loop ---- */
  const pollId = setInterval(() => {
    if (stackWidgets()) {
      clearInterval(pollId);
    }
  }, POLL_INTERVAL);

  /* ---- 5. Safety timeout ---- */
  setTimeout(() => clearInterval(pollId), MAX_POLL_TIME);

  /* ---- 6. Kick-off ---- */
  loadTawkTo();
  loadBeamer();
});
