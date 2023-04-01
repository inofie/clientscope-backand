<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppContent;
use Illuminate\Http\Request;
use Validator;

class AdminContentController extends Controller
{
    public function index()
    {
        $data['getContents'] = AppContent::getContent();    
        return view('admin.admin-app-content.index',$data);
    }

    public function update(Request $request)
    {
        \DB::table('app_content')
            ->where('id',$request['content_id'])
            ->update([
                'content' => $request['content']
            ]);
        return redirect()->back();    
    }

    public function editContent(Request $request)
    {
        $data['record'] = AppContent::getContentByID($request['content_id']);  
        $view = view('admin.modal.edit-admin-content',$data)->render();
        return response()->json($view);
    }
}