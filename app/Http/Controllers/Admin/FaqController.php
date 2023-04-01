<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Validator;

class FaqController extends Controller
{
    public function index()
    {
        $data['records'] = Faq::orderBy('id','asc')->get();
        return view('admin.faq.index',$data);
    }
}