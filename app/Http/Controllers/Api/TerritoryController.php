<?php

namespace App\Http\Controllers\Api;

use App\Models\TerritoryCompanyMapping;
use App\Models\UserCompanyMapping;
use App\Models\UserRole;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\RestController;

class TerritoryController extends RestController
{
    public $_request,$_apiResource ;

    public function __construct(Request $request)
    {
        parent::__construct('Territory');
        $this->_request     = $request;
        $this->_apiResource = 'Territory';
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
                    'assignee_user_id' => 'required',
                    'title'            => 'required',
                    'geofence_detail'  => 'required|json',
                ]);
                break;
            case 'PUT':
                $validator = Validator::make($this->_request->all(), [
                    '_method'          => 'required|in:PUT',
                    'assignee_user_id' => 'required',
                    'title'            => 'required',
                    'geofence_detail'  => 'required|json',
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
        $userRole = UserRole::getUserRoleByUserId($request['user']->id);
        if( $userRole->slug == 'company' ){
            $company_id = $request['user']->id;
        }else{
            $userCompany = UserCompanyMapping::getCompanyByEmployeeID($request['user']->id);
            $company_id  = $userCompany->id;
        }
        $checkRecord = TerritoryCompanyMapping::where('company_user_id',$company_id)->count();
        if( $checkRecord == 0 ){
            $this->__is_error = true;
            return $this->__sendError('Validation Error',['message' => 'Invalid territory id' ],400);
        }
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
        $checkRecord = TerritoryCompanyMapping::where('company_user_id',$company_id)->count();
        if( $checkRecord == 0 ){
            $this->__is_error = true;
            return $this->__sendError('Validation Error',['message' => 'Invalid territory id' ],400);
        }
    }
}