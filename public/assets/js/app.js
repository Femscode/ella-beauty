// Plain browser version of app.js (no imports, no Vite)
// - Ensures axios is available and configures default headers
// - Ensures Alpine.js is available and starts it
(function () {
    var csrfToken = (document.querySelector('meta[name="csrf-token"]') || {}).content;

    function loadScript(src, opts, callback) {
        var s = document.createElement('script');
        s.src = src;
        if (opts && opts.defer) s.defer = true;
        if (opts && opts.async) s.async = true;
        s.onload = function () { callback && callback(); };
        document.head.appendChild(s);
    }

    function ensureAxios(next) {
        if (window.axios) {
            return next();
        }
        loadScript('https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js', { defer: false }, next);
    }

    function ensureAlpine(next) {
        if (window.Alpine) {
            return next();
        }
        loadScript('https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js', { defer: true }, next);
    }

    ensureAxios(function () {
        try {
            window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
            if (csrfToken) {
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
            }
        } catch (e) {
            console.warn('Axios defaults could not be set:', e);
        }

        ensureAlpine(function () {
            try {
                window.Alpine && window.Alpine.start();
            } catch (e) {
                console.warn('Alpine could not start:', e);
            }
        });
    });
})();
