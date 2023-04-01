<?php

namespace App\Libraries\Notification;

class PushNotification
{
    /**
     * PushNotification constructor.
     * @param {string} $type = andriod | ios
     * @param {string} $device_token
     * @param {array} $notification_data
     */
    public function __construct($type,$notification_data)
    {
        if($type == 'ios')
            $this->sendPushToIos($notification_data);
        else
            $this->sendPushToAndriod($notification_data);
    }

    /**
     * This function is used for send push notification to andriod
     * @param {string} $device_token
     * @param {array} $notification_data
     *
     * reference link = https://laravelcode.com/post/laravel-56-google-firebase-notification-in-android
     */


    public function sendPushtoAndriod($notification_data)
    {      
        $fcmUrl = env('FCM_URL');
        $headers = [
            'Authorization: key=' . env('FCM_LEGACY_SERVER_KEY'),
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notification_data));
        $result = curl_exec($ch);
        if ($result === FALSE)
        {
            file_put_contents(base_path('andriod-notification.txt'),$result);
        }
        $result = json_decode($result,true);
        curl_close( $ch );
        return $result;
    }


    /**
     * This function is used for send push notification to andriod
     * @param {string} $device_token
     * @param {array} $notification_data
     *
     * reference link = https://ahex.co/send-push-notification-to-android-and-ios-app-part-1/
     */
    public function sendPushToIos($notification_data)
    {
        $url =  $fcmUrl = env('FCM_URL');
        $json = json_encode($notification_data);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. env('FCM_LEGACY_SERVER_KEY');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //Send the request
        $result = curl_exec($ch);
        if ($result === FALSE)
        {
            file_put_contents(base_path('ios-notification.txt'),curl_error($ch));
        }
        curl_close( $ch );
        return $result;
    }
}