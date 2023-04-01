<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;

class UserTrackController extends Controller
{
    public function index()
    {
		$user = get_user();
        if( $user->UserRole->slug == 'company' ){
            $user_company_id = $user->UserRole->user_id;
        }else{
            $user_company_id = $user->userCompany->id;
        }
		$this->_data['salesRepresentative']    = $this->getCompanyUsers($user_company_id);
        return view('admin.tracking.index',$this->_data);
    }
	
	public function getCompanyUsers($company_id,$user_role = '')
    {
        $data = [];
        $user_token = get_user()->token;
        $params = [
            'company_user_id' => $company_id
        ];
		if( !empty($user_role) )
			$params['user-role'] = 'sales-representative,team-lead';	
		
        $responses = $this->internalCall('api/user','GET',$params,$user_token);
        if( $responses->code == 200){
            $data = $responses->data;
        }
        return $data;
    }
	
	public function getUserTrackingData(Request $request)
	{
		$params = $request->all();
		$user_token = get_user()->token;
		$responses = $this->internalCall('api/user-tracking','GET',$params,$user_token);
        return response()->json($responses->data);
	}

    public function getTrackingDates(Request $request)
    {
        $params = $request->all();
		$user_token = get_user()->token;
		$responses = $this->internalCall('api/user-tracking/dates','GET',$params,$user_token);
        return response()->json($responses->data);
    }
}