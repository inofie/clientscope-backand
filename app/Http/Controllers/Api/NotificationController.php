<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\NotificationSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class NotificationController extends Controller
{
    public $_apiResource ;

    public function __construct()
    {
        $this->_apiResource = 'Notification';
    }

    public function index(Request $request)
    {
        $records = Notification::getNotifications($request->all());
        return $this->__sendResponse($records,200,__('app.success_listing_message'));
    }

    public function getNotificationSetting(Request $request)
    {
        $record = NotificationSetting::getNotificationSetting($request['user']->id);

        $this->__is_paginate   = false;
        $this->__collection = false;

        return $this->__sendResponse($record,200,'Notification setting retrieved successfully');
    }

    public function notificationSetting(Request $request)
    {
        $param_rules['add_user_pin']      = 'required|in:1,0';
        $param_rules['add_territory']     = 'required|in:1,0';
        $param_rules['send_chat_message'] = 'required|in:1,0';

        $response = $this->__validateRequestParams($request->all(), $param_rules);

        if($this->__is_error == true)
            return $response;

        $record = NotificationSetting::saveNotificationSetting($request->all());

        $this->__is_paginate   = false;
        $this->__collection = false;

        return $this->__sendResponse($record,200,'Notification setting saved successfully');
    }

    public function deleteNotification(Request $request, $notitification_id)
    {
        //delete notification
        Notification::deleteNotification($notitification_id,$request['user']->id);
        //get notification
        $records = Notification::getNotifications($request->all());
        return $this->__sendResponse($records,200,'Notification setting saved successfully');
    }
}