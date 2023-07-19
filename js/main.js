//verificar si el navegador admite Service Workers

if('serviceWorker' in navigator){
    //registrar el service worker en la raíz de tu sitio

    navigator.serviceWorker.register('./js/service-worker.js')
    .then(registration =>{
        console.log('Service worker registration exitosamente',registration);
    })
    .catch(error =>{
        console.error('Service worker registration error',error);
    })
}