if ("serviceWorker" in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker
            .register('sw.js')
            .then(serviceWorker => {
                console.log("Service Worker registered");
            })
            .catch(error => {
                console.error("Error registering the Service Worker: ", error);
            });
    })
} else {
    console.log('wtf');
}