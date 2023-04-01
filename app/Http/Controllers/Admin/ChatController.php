<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Validator;

class ChatController extends Controller
{
    public function index()
    {
        $user_param = [
            'company_user_id' => get_user()->userCompany->company_user_id,
            'except_user_id'  => get_user()->id,
        ];
        $user_response = $this->internalCall('api/user','GET',$user_param,get_user()->token);
        $data['users'] = $user_response->data;
        return view('admin.chat.index',$data);
    }
}