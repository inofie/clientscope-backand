<?php
namespace App\Helpers;

use App\Models\MailTemplate;
use Illuminate\Support\Facades\Mail;

class MailHelper
{
    static function sendMail($to, $identifier, $params)
    {
        $template = MailTemplate::where('identifier',$identifier)->first();

        if( isset($template->id) )
        {
            $mail_subject   = $template->subject;
            $mail_body      = $template->body;
            $mail_wildcards = explode(',', $template->wildcard);

            $mail_wildcard_values = [];
            foreach($mail_wildcards as $value) {
                $value = str_replace(['[',']'],'', $value);
                $mail_wildcard_values[] = $params[$value];
            }

            $mail_subject = str_replace($mail_wildcards, $mail_wildcard_values, $mail_subject);
            $mail_body    = str_replace($mail_wildcards, $mail_wildcard_values, $mail_body);

            $mail = Mail::send('email.default', ['content' => $mail_body], function ($m) use ($to,$mail_subject) {
                $m->from(env('MAIL_FROM_ADDRESS'), config('constants.APP_NAME'));
                $m->to($to)->subject($mail_subject);
            });
        }
    }
}