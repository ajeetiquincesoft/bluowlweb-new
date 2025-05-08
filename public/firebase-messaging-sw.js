// public/firebase-messaging-sw.js

importScripts('https://www.gstatic.com/firebasejs/9.22.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.22.0/firebase-messaging-compat.js');

// Your Firebase config
firebase.initializeApp({
    apiKey: "{{ getenv('FIREBASE_API_KEY') }}",
    authDomain: "{{ getenv('FIREBASE_AUTH_DOMAIN') }}",
    projectId: "{{ getenv('FIREBASE_PROJECT_ID') }}",
    storageBucket: "{{ getenv('FIREBASE_STORAGE_BUCKET') }}",
    messagingSenderId: "{{ getenv('FIREBASE_MESSAGING_SENDER_ID') }}",
    appId: "{{ getenv('FIREBASE_APP_ID') }}",
    measurementId: "{{ getenv('FIREBASE_MEASUREMENT_ID') }}"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);

    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: 'https://blueowl.stagingweb3.net/assets/images/blue-owl.png' // optional
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});
