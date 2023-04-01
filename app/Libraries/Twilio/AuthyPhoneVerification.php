<?php


namespace App\Libraries\Twilio;


use App\Http\Middleware\LoginAuth;
use Illuminate\Http\Request;

class AuthyPhoneVerification
{
    /**
     * @param $params
     * @return message
     */
    public static function verifyPhone($params)
    {
        //Call the "phoneVerification" method from the Authy API and pass the phone number, country code and verification channel(whether sms or call) as parameters to this method.
        $data = [];
        $via = isset($params['via']) ? $params['via'] : 'sms';

        $authy = new \Authy\AuthyApi(env('TWILIO_PRODUCTION_API_KEY'));
        $response = $authy->phoneVerificationStart($params['phone'], $params['country_code'], $via);

        if ($response->ok()) {
            $data = ["message" => $response->message(),"response_code" => 200];
        } else {
            $data = ["message" => $response->message(),"response_code" => 400];
        }

        return $data;
    }

    /**
     * @param $params
     * @return message
     */
    public static function verifyCode($params)
    {
        // Call the method responsible for checking the verification code sent.
        $data = [];
        $authy = new \Authy\AuthyApi(env('TWILIO_PRODUCTION_API_KEY'));
        $response = $authy->phoneVerificationCheck($params['phone'], $params['country_code'], $params['code']);
        if ($response->ok()) {
            $data = ["message" => $response->message(),"response_code" => 200];
        } else {
            $data = ["message" => $response->message(),"response_code" => 400];
        }

        return $data;
    }
}