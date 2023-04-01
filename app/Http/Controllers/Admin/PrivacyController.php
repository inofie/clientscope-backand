<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Validator;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $data['records'] = PrivacyPolicy::orderBy('id','asc')->get();
        return view('admin.privacy-policy.index',$data);
    }
}