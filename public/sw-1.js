const cacheName = 'v1';
const cacheAsset = [
    'index.php',
    '/css/app.css',
    '/css/app2.min.css',
    '/css/welani.css',
    '/js/app.js',
    '/js/uikit-icons.min.js',
    '/js/uikit.min.js',
    '/../resources/views/home.blade.php',
    '/../resources/views/welcome.blade.php',
]

self.addEventListener('install', e => {
    console.log('SW:installed');
    e.waitUntil(
        caches
        .open(cacheName)
        .then(cache => {
            console.log('SW: caching files');
            cache.addAll(cacheAsset);
        })
        .then(() => self.skipWaiting())
    );
});

self.addEventListener('activate', e => {
    console.log('SW:activated');
    e.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cache => {
                    if (cache !== cacheName) {
                        console.log('SW:clearing old cache');
                        return caches.delete(cache);
                    }
                })
            )
        })
    )
});

self.addEventListener('fetch', e => {
    console.log('SW:fetching');
    e.respondWith(
        fetch(e.request).catch(() => caches.match(e.request))
    )
});