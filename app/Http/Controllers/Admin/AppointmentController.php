<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;

class AppointmentController extends Controller
{
    public function index()
    {
        $params['user_id'] = get_user()->id;
        $user_token = get_user()->token;
        $params['company_user_id'] = get_user()->toArray()['user_company']['company_user_id'];
        $responseAppointments   = $this->internalCall('/api/appointment','GET',$params,$user_token);
        $responseUsers   = $this->internalCall('/api/user','GET',$params,$user_token);

        if($responseAppointments->code == 200){
            $view_data['events'] = array_map(function ($appointment){
                return [
                    'id' => $appointment->id,
                    'title' => $appointment->title,
                    'description' => $appointment->user_pin->house_address,
                    'start' => $appointment->start_datetime,
                    'end' => $appointment->end_datetime
                ];
            }, (array) $responseAppointments->data);
        }
        if($responseUsers->code == 200){
            if(count($responseUsers->data) > 0)
                $view_data['users'] = $responseUsers->data;
            else
                $view_data['users'] = [];
        }

        // echo '<pre>';
        // echo json_encode($view_data['events']); die;
        // print_r($view_data['events']); die;

        return view('admin.calendar.index', $view_data);
    }

    public function addAppointment(Request $request)
    {
        if( $request->isMethod('post') ){
            return self::_saveAppointment($request);
        }

        $user_token = get_user()->token;
        $params['company_user_id'] = get_user()->userCompany->id;
        
        $responseUsers   = $this->internalCall('/api/user','GET',$params,$user_token);
        $responsePins   = $this->internalCall('/api/user-pin','GET',$params,$user_token);
            
        if($responseUsers->code == 200){
            if(count($responseUsers->data) > 0)
                $view_data['users'] = $responseUsers->data;
            else
                $view_data['users'] = [];
        }

        if($responsePins->code == 200){
            if(count($responsePins->data) > 0)
                $view_data['pins'] = $responsePins->data;
            else
                $view_data['pins'] = [];
        }

        $html = view('admin.modal.add-appointment', $view_data)->render();
        $data = [
            'html' => $html
        ];
        return response()->json($data);
    }

    private function _saveAppointment($request)
    {
        $user_token               = get_user()->token;
        $params                   = $request->all();
        $params['start_datetime'] = date('Y-m-d H:i:s', strtotime($params['start_datetime']));
        $params['end_datetime']   = date('Y-m-d H:i:s', strtotime($params['end_datetime']));

        $response   = $this->internalCall('/api/appointment','POST',$params,$user_token);
        if( $response->code != 200 ){
            $this->_ajax_response['error']   = 1;
            $this->_ajax_response['message'] = $response->message;
            $this->_ajax_response['data']    = $response->data;
        }else{
            $this->_ajax_response['error']        = 0;
            $this->_ajax_response['message']      = $response->message;
            $this->_ajax_response['data']         = $response->data;
            $this->_ajax_response['redirect']     = true;
            $this->_ajax_response['redirect_url'] = route('admin.calender');
        }
        return response()->json($this->_ajax_response);
    }

    public function editAppointment(Request $request){
        if( $request->isMethod('post') ){
            return self::_updateAppointment($request);
        }
        $user_token = get_user()->token;

        $params['company_user_id'] = get_user()->toArray()['user_company']['id'];
        
        $responseUsers   = $this->internalCall('/api/user','GET',$params,$user_token);
        $responsePins   = $this->internalCall('/api/user-pin','GET',$params,$user_token);
        $appointmentDetails   = $this->internalCall("/api/appointment/$request->appointment_id",'GET',$params,$user_token);
        if($responseUsers->code == 200){
            if(count($responseUsers->data) > 0)
                $view_data['users'] = $responseUsers->data;
            else
                $view_data['users'] = [];
        }

        if($responsePins->code == 200){
            if(count($responsePins->data) > 0)
                $view_data['pins'] = $responsePins->data;
            else
                $view_data['pins'] = [];
        }

        if($appointmentDetails->code == 200){
            if(!empty($appointmentDetails->data))
                $view_data['appointment'] = $appointmentDetails->data;
            else
                $view_data['appointment'] = [];
        }
        
        $html = view('admin.modal.edit-appointment', $view_data)->render();
        $data = [
            'html' => $html
        ];
        return response()->json($data);
    }

    private function _updateAppointment($request)
    {
        $user_token                     = get_user()->token;
        $params                         = $request->all();
        $params['_method']              = 'PUT';
        $params['duration']             = 3;
        $params['start_datetime']       = date('Y-m-d H:i:s', strtotime($params['start_datetime']));
        $params['end_datetime']         = date('Y-m-d H:i:s', strtotime($params['end_datetime']));
    
        $response   = $this->internalCall("/api/appointment/$request->appointment_id",'POST',$params,$user_token);
        if( $response->code != 200 ){
            $this->_ajax_response['error']   = 1;
            $this->_ajax_response['message'] = $response->message;
            $this->_ajax_response['data']    = $response->data;
        }else{
            $this->_ajax_response['error']        = 0;
            $this->_ajax_response['message']      = $response->message;
            $this->_ajax_response['data']         = $response->data;
            $this->_ajax_response['redirect']     = true;
            $this->_ajax_response['redirect_url'] = route('admin.calender');
        }
        return response()->json($this->_ajax_response);
    }
}