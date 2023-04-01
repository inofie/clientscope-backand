<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Validator;

class AdminFaqController extends Controller
{
    public function index()
    {
        $data['faqs'] = Faq::orderBy('id','desc')->take(100)->get();    
        return view('admin.admin-faq.index',$data);
    }

    public function store(Request $request)
    {
        $faq = Faq::createFaq($request->all());
        return redirect()->back();
    }

    public function faqDelete(Request $request)
    {
        \DB::table('faq')->where('id',$request['faq_id'])->delete();
        return response()->json(['code' => 200]);
    }
}