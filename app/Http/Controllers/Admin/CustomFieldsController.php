<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomField;
use Illuminate\Http\Request;
use Validator;

class CustomFieldsController extends Controller
{
    public function index()
    {
        $data['custom_fields'] = CustomField::getCustomFields(get_user()->userCompany->id);
        return view('admin.custom_fields.index',$data);
    }

    public function addCustomField(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'field_type.*' => 'required|in:text,textarea',
            'label.*'      => 'required|min:3|max:100',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        CustomField::addCustomFields($request->all());
        return redirect()->route('admin.custom-fields')->with('success','Custom field added successfully');

    }

    public function deleteCustomField(Request $request)
    {
        $params = $request->all();
        if( empty($params['id']) ){
            return response()->json([
                'error'   => 1,
                'message' => 'Something went wrong',
            ]);
        }
        $checkRecord = CustomField::checkRecord(get_user()->userCompany->id,$params['id']);
        if( !isset($checkRecord->id) ){
            return response()->json([
                'error'   => 1,
                'message' => 'Invalid record id',
            ]);
        }
        //delete record
        $checkRecord->forceDelete();
        return response()->json([
            'error'   => 0,
            'message' => 'Record has been deleted successfully',
        ]);
    }
}