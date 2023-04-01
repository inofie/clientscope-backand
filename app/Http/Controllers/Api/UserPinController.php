<?php

namespace App\Http\Controllers\Api;

use App\Models\UserCompanyMapping;
use App\Models\UserCompanyPinMapping;
use App\Models\UserPin;
use App\Models\UserRole;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\RestController;

class UserPinController extends RestController
{
    public $_request,$_apiResource ;

    public function __construct(Request $request)
    {
        parent::__construct('UserPin');
        $this->_request     = $request;
        $this->_apiResource = 'UserPin';
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
        $custom_messages = [
            'duration.*.regex'   => 'Duration format is invalid',
            'latitude.required'  => 'Kindly enter a valid address',
        ];
        switch ($action){
            case 'POST':
                $validator = Validator::make($this->_request->all(), [
                    'pin_status_id'     => 'required',
                    'assignee_user_id'  => 'required',
                    'latitude'        => 'required',
                    'duration.*'      => [
                        'nullable',
                        'regex:/^([0-9]{1,9})$/'
                    ],
                ],$custom_messages);
                break;
            case 'PUT':
                $validator = Validator::make($this->_request->all(), [
                    '_method'           => 'required|in:PUT',
                    'pin_status_id'     => 'required',
                    'assignee_user_id'  => 'required',
                    'latitude'          => 'required',
                    'duration.*'      => [
                        'nullable',
                        'regex:/^([0-9]{1,9})$/'
                    ],
                ],$custom_messages);
                break;
        }
        return $validator;
    }

    /**
     * @param $request
     */
    public function beforeIndexLoadModel($request)
    {
        if( $request['date_filter'] == 'custom' )
        {
            $param_rules['from_date'] = 'required';
            $param_rules['to_date']   = 'required';

            $response = $this->__validateRequestParams($request->all(),$param_rules);

            if( $this->__is_error )
                return $response;

            if( strtotime($request['from_date']) > strtotime($request['to_date']) ){
                $this->__is_error = true;
                return $this->__sendError('Validation Message',['message' => 'From date is not valid'], 400);
            }

        }
    }

    /**
     * @param $request
     */
    public function beforeStoreLoadModel($request)
    {
        $current_datetime   = date('Y-m-d H:i:s');
        $appointment_title  = $request['appointment_title'];
        $assign_to_calender = $request['assign_to_calender'];
        $start_datetime     = $request['start_datetime'];
        $end_datetime       = $request['end_datetime'];
        $duration           = $request['duration'];
        $appointment_notes  = $request['appointment_notes'];
        $house_address      = $request['house_address'];

        $checkUserPinAddress = UserPin::checkUserPinAddress($request['user']->id,$request['latitude'],$request['longitude']);
        if( $checkUserPinAddress ){
            $this->__is_error = true;
            $error_messages['message'] = 'Pin has already dropped at this location. Kindly select another address.';
            return $this->__sendError(__('app.validation_msg'),$error_messages,400);
        }

        if( !empty($appointment_title[0]) || !empty($assign_to_calender[0]) || !empty($start_datetime[0]) ||
            !empty($end_datetime[0]) || !empty($duration[0]) )
        {
            if( empty($appointment_title[0]) ){
                $this->__is_error = true;
                $error_messages['appointment_title'] = 'Appointment title field is required';
            }
            if( empty($assign_to_calender[0]) ){
                $this->__is_error = true;
                $error_messages['assign_to_calendar'] = 'Assign to calendar field is required';
            }
            if( empty($start_datetime[0]) ){
                $this->__is_error = true;
                $error_messages['start_datetime'] = 'Start date time field is required';
            }else{
                if( strtotime($current_datetime) > strtotime($start_datetime[0]) ){
                    $this->__is_error = true;
                    return $this->__sendError('Validation Error',['message' => 'Invalid start date time']);
                }    
            }
            if( empty($end_datetime[0]) ){
                $this->__is_error = true;
                $error_messages['end_datetime'] = 'End date time field is required';
            }else{
                if( strtotime($start_datetime[0]) > strtotime($end_datetime[0]) ){
                    $this->__is_error = true;
                    return $this->__sendError('Validation Error',['message' => 'Invalid end date time']);
                }
            }
            if( $this->__is_error  ){
                return $this->__sendError(__('app.validation_msg'),$error_messages,400);
            }
        }

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
        $checkRecord = UserCompanyPinMapping::where('company_user_id',$company_id)->count();
        if( $checkRecord == 0 ){
            $this->__is_error = true;
            return $this->__sendError('Validation Error',['message' => 'Invalid user pin id' ],400);
        }
    }
}