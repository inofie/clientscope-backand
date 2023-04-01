<?php

namespace App\Http\Controllers\Api;

use App\Models\Appointment;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\RestController;

class AppointmentController extends RestController
{
    public $_request,$_apiResource ;

    public function __construct(Request $request)
    {
        parent::__construct('Appointment');
        $this->_request     = $request;
        $this->_apiResource = 'Appointment';
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
                    'user_pin_id'        => 'required',
                    'appointment_title'  => 'required',
                    'assign_to_calender' => 'required',
                    'start_datetime'     => 'required',
                    'end_datetime'       => 'required',
                    'duration'      => [
                        'nullable',
                        'regex:/^([0-9]{1,9})$/'
                    ],
                ]);
                break;
            case 'PUT':
                $validator = Validator::make($this->_request->all(), [
                    '_method'            => 'required|in:PUT',
                    'appointment_title'  => 'required',
                    'assign_to_calender' => 'required',
                    'start_datetime'     => 'required',
                    'end_datetime'       => 'required',
                    'duration'      => [
                        'nullable',
                        'regex:/^([0-9]{1,9})$/'
                    ],
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
        $start_datetime = $request['start_datetime'];
        $end_datetime   = $request['end_datetime'];

        $current_datetime = date('Y-m-d H:i:s');

        if( strtotime($current_datetime) > strtotime($start_datetime) ){
            $this->__is_error = true;
            return $this->__sendError('Validation Error',['message' => 'Invalid start date time']);
        }

        if( strtotime($start_datetime) >= strtotime($end_datetime) ){
            $this->__is_error = true;
            return $this->__sendError('Validation Error',['message' => 'Invalid end date time']);
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
        $start_datetime = $request['start_datetime'];
        $end_datetime   = $request['end_datetime'];

        $current_datetime = date('Y-m-d H:i:s');

        if( strtotime($current_datetime) > strtotime($start_datetime) ){
            $this->__is_error = true;
            return $this->__sendError('Validation Error',['message' => 'Invalid start date time']);
        }

        if( strtotime($start_datetime) >= strtotime($end_datetime) ){
            $this->__is_error = true;
            return $this->__sendError('Validation Error',['message' => 'Invalid end date time']);
        }
    }

    /**
     * @param $request
     */
    public function beforeDestroyLoadModel($request)
    {
        $cehckRecord = Appointment::where('creator_user_id',$request['user']->id)->count();
        if( $cehckRecord == 0 ){
            $this->__is_error = true;
            return $this->__sendError('Validation message',['message' => 'invalid record id'],400);
        }
    }
}