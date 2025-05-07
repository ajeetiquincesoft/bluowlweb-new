// public/firebase-messaging-sw.js

importScripts('https://www.gstatic.com/firebasejs/9.22.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.22.0/firebase-messaging-compat.js');

// Your Firebase config
firebase.initializeApp({
    apiKey: "AIzaSyBYKwxAi3gRg8Vh6gbfHN56inKG_m5CDFM",
    authDomain: "blueowl-c5879.firebaseapp.com",
    projectId: "blueowl-c5879",
    storageBucket: "blueowl-c5879.appspot.com",
    messagingSenderId: "902164999109",
    appId: "1:902164999109:web:af67af0db05aa4f6cb39ac",
    measurementId: "G-HWQX2YENS2"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);

    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: 'https://www.iconpacks.net/icons/2/free-user-icon-3296-thumb.png' // optional
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});
