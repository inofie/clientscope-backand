<?php

namespace App\Http\Controllers\Api;

use App\Models\ChatMessage;
use App\Models\ChatRoom;
use App\Models\Notification;
use App\Models\User;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\RestController;

class ChatController extends RestController
{
    public $_request,$_apiResource ;

    public function __construct(Request $request)
    {
        parent::__construct('ChatMessage');
        $this->_request     = $request;
        $this->_apiResource = 'ChatMessage';
    }

    /**
     * This function is used for validate restfull request
     * @param $action
     * @param int $id
     * @return array
     */
    public function validation($action,$id=0)
    {
        $validator = [];
        switch ($action){
            case 'POST':
                $validator = Validator::make($this->_request->all(), [
                    'attribute'        => 'required',
                ]);
                break;
            case 'PUT':
                $validator = Validator::make($this->_request->all(), [
                    '_method'      => 'required|in:PUT',
                    'attribute'     => 'required',
                    'token'    => [
                        Rule::exists('table_name')->where(function($query) use ($id){
                            $query->where('id',$id);
                        })
                    ]
                ]);
                break;
        }
        return $validator;
    }

    /**
     * @param $request
     */
    public function beforeIndexLoadModel($request)
    {

    }

    /**
     * @param $request
     */
    public function beforeStoreLoadModel($request)
    {

    }

    /**
     * @param $request
     */
    public function beforeShowLoadModel($request)
    {

    }

    /**
     * @param $request
     */
    public function beforeUpdateLoadModel($request)
    {

    }

    /**
     * @param $request
     */
    public function beforeDestroyLoadModel($request)
    {

    }

    public function getRecentMessage(Request $request)
    {
        $recent_chat_users = ChatRoom::getRecentChatUser($request['user']->id);

        $this->__collection = false;
        return $this->__sendResponse($recent_chat_users,200, 'Recent Chat retrieved successfully');
    }

    public function loadChat(Request $request)
    {
        $param_rules['room_id'] = 'required|exists:chat_rooms,id,deleted_at,NULL';

        $response = $this->__validateRequestParams($request->all(),$param_rules);

        if( $this->__is_error )
            return $response;

        $recent_chat = ChatMessage::getRoomChat($request['room_id'],$request['user']->id);

        $this->__collection = false;
        return $this->__sendResponse($recent_chat,200, 'Recent Chat retrieved successfully');

    }

    public function sendNotification(Request $request)
    {
        $param_rules['actor_id']        = 'required|numeric';
        $param_rules['chat_room_id']    = 'required|numeric';
        $param_rules['chat_message_id'] = 'required|numeric';

        $response = $this->__validateRequestParams($request->all(),$param_rules);

        if( $this->__is_error )
            return $response;

        $device_types = ['ios','android','web'];
        $actor_user   = User::where('id',$request['actor_id'])->first();
        foreach( $device_types as $device_type ) {
            $getAllRoomUser = User::getAllRoomUsers($request['actor_id'], $request['chat_room_id'], $device_type);
            if (count($getAllRoomUser)) {
                $notification_data = [
                    'actor' => $actor_user,
                    'target' => $getAllRoomUser,
                    'title' => config('constants.APP_NAME'),
                    'message' => 'You have received a new message.',
                    'reference_id' => $request['chat_message_id'],
                    'reference_module' => 'chat_messages',
                    'redirect_link' => \URL::to('admin/chat'),
                ];
                $custom_data = [
                    'actor_id'       => $request['actor_id'],
                    'chat_room_id'   => $request['chat_room_id'],
                    'chat_room_type' => $getAllRoomUser[0]->chat_room_type,
                    'target_name'    => $getAllRoomUser[0]->chat_room_type == 'single' ? $getAllRoomUser[0]->name : $getAllRoomUser[0]->chat_room_title
                ];
                Notification::sendPushNotification('add_chat_message', $notification_data, $custom_data, true);
            }
        }
        $this->__is_paginate = false;
        $this->__collection  = false;

        return $this->__sendResponse([],200,'Notification has been sent successfully');
    }
}