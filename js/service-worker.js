// Definir una lista de recursos para cachear
const resourcesToCache = [
    '../img/christina-wocintechchat-com-glRqyWJgUeY-unsplash.jpg',
    '../img/luke-peters-B6JINerWMz0-unsplash.jpg',
    '../img/DemurStart Technology logo.jpg'
    // Agrega aquí otros recursos que desees cachear
  ];
  
  // Nombre del caché
  const CACHE_NAME = 'ImagenesCache';
  
  // Instalación del Service Worker
  self.addEventListener('install', event => {
    event.waitUntil(
      caches.open(CACHE_NAME)
        .then(cache => {
          // Cachear los recursos definidos en resourcesToCache
          return cache.addAll(resourcesToCache);
        })
    );
  });
  
  // Activación del Service Worker
  self.addEventListener('activate', event => {
    event.waitUntil(
      caches.keys()
        .then(cacheNames => {
          // Eliminar cachés antiguos, si los hay
          return Promise.all(
            cacheNames.filter(cacheName => cacheName !== CACHE_NAME)
              .map(cacheName => caches.delete(cacheName))
          );
        })
    );
  });
  
  // Interceptando solicitudes y respondiendo desde el caché
  self.addEventListener('fetch', event => {
    event.respondWith(
      caches.match(event.request)
        .then(response => {
          // Si el recurso se encuentra en el caché, lo devuelve; de lo contrario, lo solicita al servidor
          return response || fetch(event.request);
        })
    );
  });
  