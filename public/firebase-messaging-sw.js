// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/8.2.7/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.2.7/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
firebase.initializeApp({
    apiKey: "AIzaSyBt3xwwnl8bC2ZQgg-ewj4gzKfkypsIDSM",
    authDomain: "research-hound.firebaseapp.com",
    projectId: "research-hound",
	databaseURL: 'https://research-hound.firebaseio.com',
    storageBucket: "research-hound.appspot.com",
    messagingSenderId: "157091951221",
    appId: "1:157091951221:web:9b69d9f4c824e61feb3e3c"
});

/**
 * Notification OnClick Event
 */
self.addEventListener('notificationclick', function(event) {
    event.notification.close();

/**
 * if exists open browser tab with matching url just set focus to it,
 * otherwise open new tab/window with sw root scope url
 */
 event.waitUntil(clients.matchAll({
    type: "window"
  }).then(function(clientList) {
    //redirect to entity  
    if (clients.openWindow) {
      return clients.openWindow(event.notification.data.link);
    }
  }));
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  let message_data = JSON.parse(payload.data.message);
  // Customize notification here
  const notificationTitle = message_data.title;
  const notificationOptions = {
    body: message_data.body,
    data:{
      user_badge: payload.data.user_badge,
      link: payload.data.redirect_link,
    },
  };
  self.registration.showNotification(notificationTitle,notificationOptions);
  
});