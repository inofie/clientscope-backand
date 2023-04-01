<?php

namespace App\Http\Controllers\Api;

use App\Models\Status;
use App\Models\UserCompanyMapping;
use App\Models\UserPinStatus;
use App\Models\UserRole;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\RestController;

class StatusController extends RestController
{
    public $_request,$_apiResource ;

    public function __construct(Request $request)
    {
        parent::__construct('UserPinStatus');
        $this->_request     = $request;
        $this->_apiResource = 'Status';
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
                    'title'       => [
                        'required',
                        'min:2',
                        'max:100',
//                        Rule::unique('status')->where(function($query){
//                            $query->where('company_user_id');
//                        })
                    ],
                    'image_url'   => 'required|url',
                    'kpi_group_id'=> 'required',
                    //'metric_id'   => 'required|numeric',
                    //'custom_metric_title' => 'min:3|max:100',
                    'color'       => 'required',
                ]);
                break;
            case 'PUT':
                $validator = Validator::make($this->_request->all(), [
                    '_method'      => 'required|in:PUT',
                    'title'       => [
                        'required',
                        'min:2',
                        'max:100',
                        //Rule::unique('status')->ignore($id)
                    ],
                    'image_url'   => 'required|url',
                    'kpi_group_id'=> 'required',
                    //'metric_id'   => 'required|numeric',
                    //'custom_metric_title' => 'min:3|max:100',
                    'color'       => 'required',
                    'token'    => [
                        Rule::exists('users')->where(function($query) use ($id){
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

    }

    /**
     * @param $request
     */
    public function beforeStoreLoadModel($request)
    {
        $userRole = UserRole::getUserRoleByUserId($request['user']->id);
        if( $userRole->slug == 'company' ){
            $company_id = $request['user']->id;
        }else{
            $userCompany = UserCompanyMapping::getCompanyByEmployeeID($request['user']->id);
            $company_id  = $userCompany->id;
        }
        //$checkMetricKpiGroup = UserPinStatus::checkMetricKpiGroup($company_id,$request['user']->id,$request->all());
        // if( $checkMetricKpiGroup > 0 ){
        //     $this->__is_error = true;
        //     $error_message['message'] = 'This Kpi group has already associated to another company metric';
        //     return $this->__sendError('Validation Error',$error_message,400);
        // }
        // $CheckCustomMetricTitle = UserPinStatus::CheckCustomMetricTitle($company_id,$request->all());
        // if( $CheckCustomMetricTitle > 0 ){
        //     $this->__is_error = true;
        //     $error_message['message'] = 'Custom matric title has already associated to another company metric';
        //     return $this->__sendError('Validation Error',$error_message,400);
        // }
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
        $userRole = UserRole::getUserRoleByUserId($request['user']->id);
        if( $userRole->slug == 'company' ){
            $company_id = $request['user']->id;
        }else{
            $userCompany = UserCompanyMapping::getCompanyByEmployeeID($request['user']->id);
            $company_id  = $userCompany->id;
        }
        $checkRecord = UserPinStatus::where('company_user_id',$company_id)->count();
        if( $checkRecord == 0 ){
            $this->__is_error = true;
            return $this->__sendError('Validation Error',['message' => 'Invalid status id' ],400);
        }
    }
}