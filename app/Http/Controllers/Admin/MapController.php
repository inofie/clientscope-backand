<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserPin;
use App\Models\Territory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;

class MapController extends Controller
{
    private $_ajax_response,$_data;

    public function __construct()
    {
        $this->_ajax_response = [
            'error'        => false,
            'message'      => '',
            'data'         => [],
            'redirect'     => false,
            'redirect_url' => '',
        ];
        $this->_data = [];
    }

    public function index(Request $request)
    {
        $user = get_user();
        if( $user->UserRole->slug == 'company' ){
            $user_company_id = $user->UserRole->user_id;
        }else{
            $user_company_id = $user->userCompany->id;
        }
        $user_pin_id = $request->input('user_pin_id',0);
        if( !empty($user_pin_id) ){
            $this->_data['user_pin'] = UserPin::find($user_pin_id);
        }else{
            $this->_data['user_pin'] = [];
        }
        $this->_data['companyUsers']    = $this->getCompanyUsers($user_company_id);
        $this->_data['companyStatuses'] = $this->getCompanyStatuses();
        $this->_data['territories']     = $this->getTerritory($request);
        $this->_data['getTerritories'] = Territory::getTerritories($user_company_id);
        return view('admin.map.index',$this->_data);
    }

    public function getCompanyUsers($company_id)
    {
        $data = [];
        $user_token = get_user()->token;
        $params = [
            'company_user_id' => $company_id
        ];
        $responses = $this->internalCall('api/user','GET',$params,$user_token);
        if( $responses->code == 200){
            $data = $responses->data;
        }
        return $data;
    }

    public function getCompanyStatuses()
    {
        $data = [];
        $user_token = get_user()->token;
        $responses = $this->internalCall('api/status','GET',[],$user_token);
        if( $responses->code == 200){
            $data = $responses->data;
        }
        return $data;
    }

    public function getTerritory(Request $request)
    {
        $user_token = get_user()->token;
        $params = $request->all();
        $responses = $this->internalCall('api/territory','GET',$params,$user_token);
        if( $request->ajax() ){
            return response()->json($responses);
        }
        return $responses;
    }

    public function getPins(Request $request)
    {
        $data       = [];
        $params     = $request->all();
        if( !empty($params['pin_status_id']) ){
            $params['pin_status_id'] = implode(',',$params['pin_status_id']);
        }
        if( !empty($params['assignee_user_id']) ){
            $params['assignee_user_id'] = implode(',',$params['assignee_user_id']);
        }
        $user_token = get_user()->token;
        $responses  = $this->internalCall('api/user-pin','GET',$params,$user_token);
//        if( $responses->code == 200){
//            $data = $responses->data;
//        }
        return response()->json($responses);
    }

    public function saveTerritory(Request $request)
    {
        $params = $request->all();
        $params['assignee_user_id'] = implode(',',$params['assignee_user_id']);
        $user_token = get_user()->token;
        $responses  = $this->internalCall('api/territory','POST',$params,$user_token);
        return response()->json($responses);
    }

    public function updateTerritory(Request $request)
    {
        $params = $request->all();
        $params['_method'] = 'PUT';
        $params['assignee_user_id'] = implode(',',$params['assignee_user_id']);
        $user_token = get_user()->token;
        $responses  = $this->internalCall('api/territory/' . $params['territory_id'],'POST',$params,$user_token);
        return response()->json($responses);
    }

    public function territoryDelete(Request $request)
    {
        $user_token  = get_user()->token;
        $territory_id = $request->input('id');
        $responses   = $this->internalCall('api/territory/' . $territory_id, 'DELETE', [], $user_token);
        return response()->json($responses);
    }

}