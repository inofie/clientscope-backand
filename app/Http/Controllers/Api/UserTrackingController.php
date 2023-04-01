<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\RestController;
use App\Models\UserTracking;

class UserTrackingController extends RestController
{
    public $_request,$_apiResource ;

    public function __construct(Request $request)
    {
        parent::__construct('UserTracking');
        $this->_request     = $request;
        $this->_apiResource = 'UserTracking';
    }

    /**
     * This function is used for validate restfull request
     * @param $action
     * @param int $id
     * @return array
     */
    public function validation($action,$id=0)
    {
        $validator = [];
        switch ($action){
            case 'POST':
                $validator = Validator::make($this->_request->all(), [
                    'latitude'  => 'required',
                    'longitude' => 'required',
                ]);
                break;
            case 'PUT':
                $validator = Validator::make($this->_request->all(), [
                    '_method'      => 'required|in:PUT',
                    'attribute'     => 'required',
                    'token'    => [
                        Rule::exists('table_name')->where(function($query) use ($id){
                            $query->where('id',$id);
                        })
                    ]
                ]);
                break;
        }
        return $validator;
    }

    /**
     * @param $request
     */
    public function beforeIndexLoadModel($request)
    {
        $this->__is_paginate = false;
    }

    /**
     * @param $request
     */
    public function beforeStoreLoadModel($request)
    {

    }

    /**
     * @param $request
     */
    public function beforeShowLoadModel($request)
    {

    }

    /**
     * @param $request
     */
    public function beforeUpdateLoadModel($request)
    {

    }

    /**
     * @param $request
     */
    public function beforeDestroyLoadModel($request)
    {

    }

    public function getTrackingDates()
    {
        $request = $this->_request;
        $param_rules['user_id'] = 'required|numeric';

        $response = $this->__validateRequestParams($request->all(), $param_rules);

        if($this->__is_error == true)
            return $response;
        
        $records = UserTracking::getTrackingDates($request->all());    
        
        $this->__is_paginate = false;
        $this->__collection  = false;

        return $this->__sendResponse($records, 200, __('success_listing_msg'));
    }
}