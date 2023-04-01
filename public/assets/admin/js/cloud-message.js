 // For Firebase JS SDK v7.20.0 and later, measurementId is optional
$(document).ready( function(){
    $(window).on( 'load',function(){
      
        var firebaseConfig = {
            apiKey: "AIzaSyBH-nGcSv7glOQhf9XkPShuSJGYisirzco",
            authDomain: "client-scope-web.firebaseapp.com",
            projectId: "client-scope-web",
            storageBucket: "client-scope-web.appspot.com",
            messagingSenderId: "222174039529",
            appId: "1:222174039529:web:a38a4c5973b44a72860f78",
            measurementId: "G-EC28Z5QTV3"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();
        //get device token
        messaging.requestPermission().then(function () {
            return messaging.getToken()
        }).then(function(token) {
             // print the token on the HTML page
             $.ajax({
                type:'POST',
                url: base_url + '/api/user/' + currentUser.id,
                data: { _method:'PUT', device_type:'web', device_token:token },
                success: function(data){
                  return true;
                }
             })
           })
           .catch(function (err) {
              console.log("Unable to get permission to notify.", err);
         });
      
      //   `messaging.onBackgroundMessage` handler.
      messaging.onMessage( (payload) => {        
          console.log('Message received. ', payload);
          let message_body = JSON.parse(payload.data.message);
          //play notification sound
          document.getElementById('_notification_sound').play()
          $.notify.defaults({globalPosition: 'left bottom'})
          $.notify(message_body.body,"info");
          //append notification in list
          let redirect_link = payload.data.redirect_link;
          let notification_html = '';
              notification_html += '<a class="dropdown-item" href="'+ redirect_link +'">'+ message_body.body +'</a>';
              notification_html += '<div class="dropdown-divider"></div>';
              $('#notification_list').prepend(notification_html)  
      });
     //end window load function
    })
   //end document ready function
})