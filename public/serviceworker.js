var staticCacheName = "pwa-v" + new Date().getTime();
var filesToCache = [
    '/offline',
    '/css/app.css',
    '/js/app.js',
    "/storage/01JGDYSG13NKS6W0RVSAYDVVCZ.png",
    "/storage/01JGDYSG1BRNAZA29PRNA3YFYR.png",
    "/storage/01JGDYSG1HPQ767EWAE0DG53JD.png",
    "/storage/01JGDYSG1QKAGW033H1VS0H214.png",
    "/storage/01JGDYSG1X8PKFVYB1KJ59ZS2Y.png",
    "/storage/01JGDYSG24ATQNPJ6SK26P02C8.png",
    "/storage/01JGDYSG29N7QDCHZ0XNRXYMZX.png",
    "/storage/01JGDYSG2F1VYNHPFQVY9YYFFW.png"
];

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("pwa-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match('offline');
            })
    )
});
