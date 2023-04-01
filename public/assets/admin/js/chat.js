let socket,user;

function validateUrl(value)
{
    var expression = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi
    var regexp = new RegExp(expression);
    return regexp.test(value);
}

var loadDefaultDataInit = () => {
    user = {
        id: currentUser.id,
        name: currentUser.name,
        username: currentUser.username,
        email: currentUser.email,
        mobile_no: currentUser.mobile_no,
        image_url: currentUser.image_url,
        device_type: currentUser.device_type,
        device_token: currentUser.device_token,
        token: currentUser.token,
        socket_id:socket.id,
        created_at: currentUser.created_at,
    }

    let recent_chat_param = {
        user_id:currentUser.id
    };
    socket.emit('_loadRecentChat',recent_chat_param);
    
    socket.emit('_getGroup',recent_chat_param);    
}

var userOnlineHandler = (data) => {
    var online_Status = $('._load_chat[data-targetuserid="'+ data.id +'"]').find('#online_Status');
    if( online_Status.length > 0 ){
      online_Status.addClass('online').removeClass('offline');
    }
}

var userOfflineHandler = (data) => {
    var online_Status = $('._load_chat[data-targetuserid="'+ data.id +'"]').find('#online_Status');
    if( online_Status.length > 0 ){
        online_Status.addClass('offline').removeClass('online');
    }
}

var recentChatHandler = (data) => {  
    if( data.code == 200 ) {
        let recent_chat_html = '';
        let records = data.data;
        if( records.length > 0 ) {
            for( let i=0; i < records.length; i++)
            {
                recent_chat_html += recentChatHtml(records[i]);
            }
            $('#recent_chat').html(recent_chat_html);
        }
    }
}

var getGroupHandler = (data) => {
  if( data.code == 200 ) {
        let recent_group_html = '';
        let records = data.data;
        if( records.length > 0 ) {
            for( let i=0; i < records.length; i++)
            {
                recent_group_html += recentChatHtml(records[i]);
            }
            $('#recent_group').html(recent_group_html);
        }
    }
}

var loadChat = (actor_user_id,target_user_id,chat_room_id) => {
    $('#overlay').show();
    $('.chat-box').html('');
    let load_chat_data = {
        user_id:parseInt(actor_user_id),
        target_user_id:parseInt(target_user_id),
        chat_room_id:chat_room_id,
    };
    socket.emit('_loadChatHistory', load_chat_data);
}

var loadChatHistoryHandler = (data) => {  
    $('#overlay').hide();
    if( data.code == 200 )
    {
        let records = data.data;
        if( records.length > 0 )
        {
            records = records.reverse();
            let messages_html = '';
            for( let i=0; i < records.length; i++)
            {
                if( records[i].user_id == currentUser.id ){
                    messages_html += sendMessageHtml(records[i])
                } else {
                    messages_html += receiveMessageHtml(records[i]);
                }
            }
            $('.chat-box').html(messages_html);
            bottomScrollBar();
        }
    }
}

var startTypingHandler = (data) => {
    var chat_room_id = $('.chat-box').attr('data-roomid');
    if( data.id == chat_room_id )
    {
        let start_typing_html = '<div class="col-md-12"><p class="ft-14 p-2">'+ data.user.name +' is typing</p></div>';
        $('#start_typing').html(start_typing_html);
    }
}

var stopTypingHandler = (data) => {
    var chat_room_id = $('.chat-box').attr('data-roomid');
    if( data.id == chat_room_id )
    {
        $('#start_typing').html('');
    }
}

var sendMessage = (user_id,target_id,message_type,message,file_data = {}) => {

    let chat_room_id = $('.chat-box').attr('data-roomId');
    if( typeof chat_room_id == 'undefined' || chat_room_id == '' ){
        alert("Kindly select a user or room.");
        return false;
    }

    socket.emit('_stopTyping',{ id:chat_room_id, user:user });
    if( message != '')
    {
        if( message.length > 1000 ){
            alert("Message is too long. Message max length is 1000.");
            return false;
        }

        $('.chat_message').val('');
        let data = {
            chat_room_id: chat_room_id,
            user_id: parseInt(user_id),
            target_id: parseInt(target_id),
            message: message_type == 'image' ? '' : message,
            file_url: message_type == 'image' ? message : '',
            message_type:message_type,
            file_data:JSON.stringify(file_data),
        }
        socket.emit('_sendMessage', data);
    }
}

var receiveMessageHandler = (data) => {
    if( data.code == 200 )
    {
        let record         = data.data;
        let chat_room_id   = $('.chat-box').attr('data-roomid');
        let target_user_id = record.target_id == user.id ? record.user_id : record.target_id;
        let receiver_id    = $('.chat-box').attr('data-receiver');
        if( chat_room_id == record.chat_room_id || target_user_id == receiver_id)
        {
            let message_html = '';
            $('.chat-box').attr('data-roomid',record.chat_room_id);
            if( record.user_id == user.id ){
                message_html = sendMessageHtml(record)
            } else {
                message_html = receiveMessageHtml(record)
            }
            $('.chat-box').append(message_html);
            //message read flag
            socket.emit("_readRecentChatWithCb" , {
                "chat_room_id" : record.chat_room_id,
                "user_id" : user.id,
            },(data) =>{
                //console.log("receiveMessageHandler data",data)
            })  
          
            bottomScrollBar();
            socket.emit('forceDisconnect');
        }
        //load recent chat or group
        let recent_chat_param = {
            user_id:currentUser.id
        }
        if( record.room_type == 'single' ){
            socket.emit('_loadRecentChat',recent_chat_param);
        } else {
            socket.emit('_getGroup',recent_chat_param);   
        }          
    }
}

var deleteMessageById = () => {

    socket.emit("_deleteMessageByIDWithCb",{
        "user_id" : localStorage.getItem("user_id"),
        "message_id" : message_id,
        "target_id" : localStorage.getItem("target_id"),
        "chat_room_id" : 1,
    }, (callback_response) => {

    });

}

var deleteMessageHistory = () => {
  socket.emit("_deleteRecentChatWithCb",{
        "user_id" : localStorage.getItem("user_id"),
        "chat_room_id" : 1,
        "target_id" : localStorage.getItem("target_id"),
    }, (callback_response) => {
        //console.log(data_set);
    });
}

var recentChatHtml = (data) => {
    
   let last_chat_message      = '';
   let last_chat_message_time = ''; 
   let receiver_user_id       = 0; 
   let online_status_class    = ''; 
   let room_icon              = '';  
   let room_title             = '';  
   let circle_class           = '';
   let delete_option_html     = '';  
  
   if( Object.entries(data.last_chat_message).length != 0 ){
        if( data.last_chat_message.message_type == 'image' ){
            last_chat_message      = '<i class="fa fa-image"></i> Photo';
        } else {
            last_chat_message = data.last_chat_message.message;
            last_chat_message = last_chat_message.length > 35 ? last_chat_message.substr(0,30) + '...' : last_chat_message;
        }
        last_chat_message_time = moment(data.last_chat_message.created_at).calendar();
    }
  
    if( data.type == 'group' ){
        if( data.created_by == currentUser.id ){
            delete_option_html = '<div class="dropdown text-right">\n' +
            '                              <span class="fa fa-ellipsis-h" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n' +
            '                              </span>\n' +
            '                              <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">\n' +
            '                                 <a class="dropdown-item _delete_room" id="'+ data.id +'" href="#">Delete Group</a>\n' +
            '                              </div>\n' +
            '                           </div>';  
        } else {
            delete_option_html = '';
        }
        receiver_user_id = 0;  
    } else {
        receiver_user_id = currentUser.id == data.created_by ? data.target_user_data.id : data.created_by;
    }
    
    if( data.type == 'group' ){
        online_status_class = '';
        circle_class = '';
    } else {
        online_status_class = data.target_user_data.online_status == 1 ? 'online' : 'offline';
        circle_class = 'fa fa-circle';
    }
  
    if( data.type == 'group' ){
      if( data.image_url == '' || data.image_url == null ){
          room_icon = base_url + '/assets/group-icon.jpg';
      } else {
          room_icon = data.image_url;
      }
       room_title = data.title;
    } else {
       room_icon = data.target_user_data.image_url;
       room_title = data.target_user_data.name;
    }
   
    let unread_count        =  data.unread_message_counts > 0 ? '<span class="count">'+ data.unread_message_counts +'</span>'  : '';
    let recent_chat_html    = '<div data-roomId="'+ data.id +'" data-targetUserId="'+ receiver_user_id +'" style="cursor:pointer;" class="_load_chat d-flex justify-content-between mb-3">\n' +
        '                        <div>\n' +
        '                           <div class="media mb-3">\n' +
        '                              '+ unread_count +'\n' +
        '                              <div id="online_Status" class="'+ online_status_class +'">\n' +
        '                                 <span class="'+ circle_class +'"></span>\n' +
        '                                 <img src="'+ room_icon +'" class="mr-2 inbox-user" title="'+ room_title +'" alt="'+ room_title +'">\n' +
        '                              </div>\n' +
        '                              <div class="media-body">\n' +
        '                                 <p id="chat_username" class="mb-0 ft-14">'+ room_title +'</p>\n' +
        '                                 <p class="ft-12 mb-0">'+ last_chat_message +'</p>\n' +
        '                              </div>\n' +
        '                           </div>\n' +
        '                        </div>\n' +
        '                        <div>\n' + delete_option_html +
        '                           <p class="ft-12 mb-0">'+ last_chat_message_time +'</p>\n' +
        '                        </div>\n' +
        '                     </div>';

    let recent_chat_html2 = `<div data-roomId="${ data.id }" data-image="${room_icon}" data-username="${room_title}" data-targetUserId="${receiver_user_id}" class="_load_chat chat-user user-active d-flex align-items-center">
                                <div>
                                    <div class="other-chat-img">
                                        <img
                                            src="${room_icon}"
                                            alt="user-profile"
                                        />
                                        ${ data.type != 'group' && data.target_user_data.online_status == 1 ? 
                                            `<div class="icon">
                                                <img
                                                    src="${ base_url + '/assets/images/online-icon.png' }"
                                                    alt="user-profile"
                                                    class="on-icon"
                                                />
                                            </div>` : '' 
                                        }
                                    </div>
                                </div>
                                <div class="other-user-names ml-3">
                                    <h2 class="font-18 color-black">${room_title}</h2>
                                    <ul class="chat-time">
                                        <li>
                                            <p class="ft-12">${last_chat_message}</p>
                                        </li>
                                        <li>
                                            <p class="ft-12">${last_chat_message_time}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>`    

    return recent_chat_html2;
}

var sendMessageHtml = (record) => {

    let message       = record.message_type == 'text' ? isValidHttpUrl(record.message) : '<a target="_blank" href="'+ record.file_url +'"><img style="width:100px;height:100px;object-fit:contain;" src="'+ record.file_url +'" /></a>';
    let message_class = record.message_type == 'text' ? 'bg-orange' : '';
    let text_align    = record.message_type == 'text' ? '' : 'text-right';
    let message_html  = '<div class="row send-message">\n' +
                        '     <div class="col-md-6 offset-md-6 '+ text_align +' ">\n' +
                        '          <p class="ft-14 mb-0">'+ moment(record.created_at).calendar() +'</p>\n' +
                        '          <p class="ft-14 '+ message_class +' p-2 white">'+ message +'</p>\n' +
                        '     </div>\n' +
                        '</div>';
    
    let message_html2 = `<div class="row">
                            <div class="col-12 col-md-6 offset-md-6">
                                <div class="mine-chats">
                                    <div class="mine-chat">
                                        <p>${message}</p>
                                    </div>
                                    <span class="ft-12 color-9095a4 text-end">${ moment(record.created_at).calendar() }</span>
                                </div>
                            </div>    
                        </div>`;                    
    return message_html2;
}

var receiveMessageHtml = (record) => {
    
    let message             = record.message_type == 'text' ? isValidHttpUrl(record.message) : '<a target="_blank" href="'+ record.file_url +'"><img style="width:100px;height:100px;object-fit:contain;" src="'+ record.file_url +'" /></a>';
    let message_class       = record.message_type == 'text' ? 'bg-gray' : '';
    let text_align          = record.message_type == 'text' ? '' : 'text-left';
    let online_status_class = record.user_data.online_status == 1 ? 'online' : 'offline';
    let message_html =  '<div class="row received-message">\n' +
                        '     <div class="col-md-6 '+ text_align +'">\n' +
                        '         <div class="media">\n' +
                        '               <div class="'+ online_status_class +'">\n' +
                        '                     <span class="fa fa-circle"></span>\n' +
                        '                     <img src="'+ record.user_data.image_url +'" class="mr-2 inbox-user" title="'+ record.user_data.name +'" alt="'+ record.user_data.name +'">\n' +
                        '                </div>\n' +
                        '                <div class="media-body">\n' +
                        '                      <p class="ft-14 mb-0"><b>' + record.user_data.name + '</b> <span class="pull-right">' + moment(record.created_at).calendar() +'</span></p>\n' +
                        '                      <p class="ft-14 '+ message_class +' p-2">'+ message +'</p>\n' +
                        '                </div>\n' +
                        '          </div>\n' +
                        '     </div>\n' +
                        '</div>';

    let message_html2 = `<div class="row">
                            <div class="col-12 col-md-6">
                                <span class="ft-12 color-9095a4">${ moment(record.created_at).calendar() }</span>
                                <div class="aposite-chat">
                                    <p>${message}</p>
                                </div>
                            </div>    
                        </div>`                    
    return message_html2;
}

var isValidHttpUrl = (string) => {
    let checkURl = validateUrl(string);
    return checkURl == true ? '<a style="color:#fff;" target="_blank" href="'+ string +'">'+ string +'</a>' : string;
}

var bottomScrollBar = () => {
    var messageBody = document.querySelector('.chat-box');
    messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
}

var uploadFile = (file,type = 'image') => {
    return new Promise( function (resolve, reject) {

        var form_data = new FormData();
        form_data.append('file',file);
        $.ajax({
            url: node_chat_url + '/api/file_upload',
            type: 'POST',
            data: form_data,
            contentType: false,
            processData: false,
            success: function(response){
                if( response.code == 200 ){
                    resolve(response.data)
                } else {
                    reject(response.message);
                }
            },
        });

    })
}

(function() {
    //connect socket to server
    socket = io(node_chat_url, {
        transports: [ 'websocket' ],
        query: {
            authorization: currentUser.token
        }
    });
    //socket successfully connected event
    socket.on( 'connect', loadDefaultDataInit)
    //user online
    socket.on('_online',userOnlineHandler);
    //recent chat listener
    socket.on('_loadRecentChat',recentChatHandler);
    //load groups
    socket.on("_getGroup",getGroupHandler)
    //load chat listener
    socket.on('_loadChatHistory',loadChatHistoryHandler);
    //receive message from server
    socket.on('_receivedMessage',receiveMessageHandler)
    //start typing listener
    socket.on('_startTyping',startTypingHandler);
    //stop typing listener
    socket.on('_stopTyping',stopTypingHandler);
    //user offline
    socket.on('_offline',userOfflineHandler);
    //manually reconnect
    socket.on("connect_error", () => {
        console.log('connect_error');
        setTimeout(() => {
          socket.connect();
        }, 1000);
    });

    socket.on('disconnect', (reason) => {
        console.log('disconnect',reason);
        socket.connect();
    });

    socket.on('error', (error) => {
       alert(error)
    });

    //load chat history by search bar
    $(document).on('click','.search_user',function(){

        let target_user_id    = $(this).attr('data-userId');
        let target_username   = $(this).attr('data-username');
        let target_user_image = $(this).attr('data-userImage');

        $('#chat_room_title p').html('Chat is loading....');
        //check room
        let get_room_param = {
            user_id: currentUser.id,
            target_id: target_user_id
        };
        socket.emit('getRoomId',get_room_param).on('getRoomId',(data) => {
            let chat_room_id = data.data.chat_room_id;
            $('#active_chat_user_name').html(`
                <div class="other-chat-img">
                    <img
                        src="${ target_user_image }"
                        alt="user-profile"
                    />
                    <div class="icon">
                        <img
                            src="${ base_url + '/assets/images/online-icon.png' }"
                            alt="user-profile"
                            class="on-icon"
                        />
                    </div>
                </div>
            `);
            $('#chat_room_title p').html(target_username);
            $('.chat-box').attr('data-receiver',target_user_id)
            $('.chat-box').attr('data-roomid',chat_room_id)
            loadChat(currentUser.id,target_user_id,chat_room_id);
        });
    })

    //load chat history by recent chat
    $(document).on('click','._load_chat',function(){

        let user_id         = currentUser.id;
        let target_user_id  = $(this).attr("data-targetUserId");
        let chat_room_id    = $(this).attr("data-roomId");
        let chat_username   = $(this).attr('data-username');
        let chat_user_image = $(this).attr('data-image');

        $('#active_chat_user_name').html(`
            <div class="other-chat-img">
                <img
                    src="${ chat_user_image }"
                    alt="user-profile"
                />
                <div class="icon">
                    <img
                        src="${ base_url + '/assets/images/online-icon.png' }"
                        alt="user-profile"
                        class="on-icon"
                    />
                </div>
            </div>
        `);
        $('#chat_room_title p').html(chat_username);
        $('.chat-box').attr('data-receiver',target_user_id)
        $('.chat-box').attr('data-roomid',chat_room_id)

        $(this).find('.count').remove();
        loadChat(user_id,target_user_id,chat_room_id);
    })

    //send message to server
    $('.chat_message').on('keyup', function(e){

        let message      = $(this).val();
        let chat_room_id = $('.chat-box').attr('data-roomid');

        if( message == '' ){
            socket.emit('_stopTyping',{ id:chat_room_id, user:user });
        } else {
            socket.emit('_startTyping',{ id:chat_room_id, user:user });
        }

        if( e.keyCode === 13 ){
            let actor_user_id  = user.id;
            let target_user_id = $('.chat-box').attr('data-receiver');
            sendMessage(actor_user_id,target_user_id,'text',message);
            return;
        }

    })

    //send message to server
    $('.send_message').click(function(e){
        e.preventDefault()
        let actor_user_id  = user.id;
        let target_user_id = $('.chat-box').attr('data-receiver');
        let message        = $('.chat_message').val();
        sendMessage(actor_user_id,target_user_id,'text',message);
        $('.chat_message').focus();
        return;
    })

    // open file upload screen
    $('.selectAttachment').click( function(e){
        e.preventDefault();
        let check_room = $('.chat-box').attr("data-roomid");
        if( typeof check_room == 'undefined' || check_room == '' ){
            alert("Kindly select a user or room.");
            return false;
        }
        $('#attachment').trigger('click');
    })

    //upload file to server
    $('#attachment').on('change',function(e){
        e.preventDefault();

        let check_room     = $('.chat-box').attr("data-roomid");
        let target_user_id = $('.chat-box').attr('data-receiver');;
        let file_data = {};
        if( typeof check_room != 'undefined' && check_room != '' ){
            var reader    = new FileReader();  
            var form_data = new FormData();
          
            var files     = $('#attachment')[0].files;
            reader.readAsDataURL(files[0]);
            reader.onload = function (e) {
                var image = new Image();
                //Set the Base64 string return from FileReader as source.
                image.src = e.target.result; 
                image.onload = function () {
                  var height    = this.height;
                  var width     = this.width;
                  file_data = {"height":height,"width":width}; 
                }
            }
            if(files.length > 0 ){
                $('#ajaxLoader').show();
                $('#overlay').show();
                form_data.append('file',files[0]);
                $.ajax({
                    url: node_chat_url + '/api/file_upload',
                    type: 'POST',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if( response.code == 200 ){
                            $('#overlay').hide();
                            $('#ajaxLoader').hide();
                            sendMessage(user.id,target_user_id,'image',response.data.file_url,file_data)
                        } else {
                            $('#overlay').hide();
                            $('#ajaxLoader').hide();
                            alert(response.message);
                            return false;
                        }
                    },
                });
            }else{
                alert("Please select a file.");
            }
        }
    })

    $('#_add_chat_group').submit(async function(e){      
        e.preventDefault();
        var group_title = $('#group_title');
        var group_users = $('#group_users');
        var group_image = $('#group_image');

        if( group_title.val() == '' ){
            alert('Group Title field is required');
        } else if( group_users.val() == '' ){
            alert('Group users field is required');
        } else {
            $('#overlay').show();
            $('#ajaxLoader').show();
            var group_title_val = group_title.val();
            var group_users_val = group_users.val();
            var group_image_val = '';
            var files = group_image[0].files;
            var file_upload_error = false;
            if(files.length > 0 ){
                try{
                   var file_response = await uploadFile(files[0]);
                   file_upload_error = false;
                   group_image_val   = file_response.file_url
                } catch (err){
                    $('#overlay').hide();
                    $('#ajaxLoader').hide();
                    file_upload_error = true;
                    alert(err);
                }
            }
            if( file_upload_error == false ){
               var _create_group_params = {
                   user_id: currentUser.id,
                   group_type:'group',
                   group_title:group_title_val,
                   group_users:group_users_val,
                   group_image: group_image_val,
               };
               socket.emit( '_createGroup',_create_group_params)
              
               $('#_add_chat_group')[0].reset();
               $('#overlay').hide();
               $('#ajaxLoader').hide();
               $('#addGroup').modal('hide');
            }
        }

    })
  
    $(document).on('click','._delete_room',function(e){
        e.preventDefault();
        var msg     = confirm("Are you sure you want to delete this room?");
        if( msg ){
             $('#overlay').show();
            var room_id = $(this).attr('id');
            let delete_room_params = {
               user_id: currentUser.id,
               chat_room_id:room_id
            };
            socket.emit('_deleteRoomCb',delete_room_params,function(res){
                $('#overlay').hide();
            })
        }
        return false;
    })
  
    //update user online status when user leave window
    window.onbeforeunload = function() {
        socket.emit("_logoutUser",{user_id:currentUser.id,status:0});
        return "Are you sure you wat to leave this window?";
    };
    //search auto complete user
    autoComplete('.autocomplete',base_url + '/admin/user/suggestion');

})();
