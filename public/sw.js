const cacheName = 'v1';


self.addEventListener('install', e => {
    // console.log('SW:installed');
});

self.addEventListener('activate', e => {
    // console.log('SW:activated');
    e.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cache => {
                    if (cache !== cacheName) {
                        // console.log('SW:clearing old cache');
                        return caches.delete(cache);
                    }
                })
            )
        })
    )
});

self.addEventListener('fetch', e => {
    e.respondWith(
        fetch(e.request)
        .then(res => {
            const resClone = res.clone();
            caches.open(cacheName)
                .then(cache => {
                    if (e.request.method !== 'POST') {
                        cache.put(e.request, resClone);
                    }
                });
            return res;
        }).catch(err => caches.match(e.request).then(res => res))
    )
});