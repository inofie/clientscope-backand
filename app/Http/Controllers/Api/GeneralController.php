<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlaceAnOffer;
use App\Models\Trip;
use Illuminate\Http\Request;
use Validator;

class GeneralController extends Controller
{

    public function __construct()
    {

    }

    public function getCountries(Request $request)
    {
        $params = $request->all();
        $query = \DB::table('country')->orderBy('name','asc');
        if(!empty($params['name']))
        {
            $name = $params['name'];
            $query->where('name','like',"$name%");
        }
        $countries = $query->get();

        $this->__is_paginate = false;
        $this->__collection  = false;

        return $this->__sendResponse($countries,200, __('app.success_listing_message'));
    }

    public function getStates(Request $request)
    {
        $params = $request->all();
        $param_rules['country_id'] = 'required';

        $response = $this->__validateRequestParams($request->all(), $param_rules);

        if($this->__is_error == true)
            return $response;

        $query = \DB::table('state')->orderBy('name','asc');
        if(!empty($params['name']))
        {
            $name = $params['name'];
            $query->where('name','like',"$name%");
        }
        $states = $query->where('country_id',$params['country_id'])->get();

        $this->__is_paginate = false;
        $this->__collection  = false;

        return $this->__sendResponse($states,200, __('app.success_listing_message'));
    }

    public function getCities(Request $request)
    {
        $params = $request->all();
        $param_rules['state_id'] = 'required';

        $response = $this->__validateRequestParams($request->all(), $param_rules);

        if($this->__is_error == true)
            return $response;

        $query = \DB::table('city')->orderBy('name','asc');
        if(!empty($params['name']))
        {
            $name = $params['name'];
            $query->where('name','like',"$name%");
        }
        $cities = $query->where('state_id',$params['state_id'])->get();

        $this->__is_paginate = false;
        $this->__collection  = false;

        return $this->__sendResponse($cities,200, __('app.success_listing_message'));
    }

    public function appData()
    {
        $kpi_status = config('constants.KPI_STATUSES');
        foreach($kpi_status as $value){
            $kpi_status_group[] = [
                'title' => $value
            ];
        }

        $data = [
            'kpi_status_group' => $kpi_status_group
        ];

        $this->__is_paginate = false;
        $this->__collection  = false;

        return $this->__sendResponse($data,200, __('app.success_listing_message'));
    }

    public function truncateAllData(Request $request)
    {
        if(  $request['password'] != 'admin@123' ){
            return $this->__sendError('Validation Error',['message' => 'Password is required'],400);
        }
        \DB::table('activity_logging')->truncate();
        \DB::table('appointment')->truncate();    
        \DB::table('chat_message_delete')->truncate();
        \DB::table('chat_message_status')->truncate();
        \DB::table('chat_messages')->truncate();
        \DB::table('chat_room_users')->truncate();
        \DB::table('chat_rooms')->truncate();
        \DB::table('company_kpi_target_sale')->truncate();
        \DB::table('company_metric_target')->truncate();
        \DB::table('company_sales_plan')->truncate();
        \DB::table('custom_field')->truncate();
        \DB::table('import_history')->truncate();
        \DB::table('media')->truncate();    
        \DB::table('notification')->truncate();
        \DB::table('notification_setting')->truncate();
        \DB::table('team')->truncate();
        \DB::table('territory')->truncate();
        \DB::table('territory_company_maping')->truncate();
        \DB::table('territory_latlong')->truncate();
        \DB::table('user_company_mapping')->truncate();
        \DB::table('user_company_pin_mapping')->truncate();
        \DB::table('user_kpi_target_sale')->truncate();
        \DB::table('user_meta')->truncate();
        \DB::table('user_metric_target')->truncate();
        \DB::table('user_password_reset')->truncate();
        \DB::table('user_pin')->truncate();
        \DB::table('user_pin_custom_field')->truncate();
        \DB::table('user_pin_status')->truncate();
        \DB::table('user_pin_update_history')->truncate();
        \DB::table('user_reporting')->truncate();
        \DB::table('user_role')->where('user_id','!=',1)->delete();
        \DB::table('user_sales_plan')->truncate();
        \DB::table('user_subscription')->truncate();
        \DB::table('user_team')->truncate();
        \DB::table('user_tracking')->truncate();
        \DB::table('users')->where('id','!=',1)->delete();

        $this->__is_paginate = false;
        $this->__collection  = false;

        return $this->__sendResponse([],200, 'Data has been deleted successfully');
    }
  
    public function truncateChatData(Request $request)
    {
        if(  $request['password'] != 'admin@123' ){
              return $this->__sendError('Validation Error',['message' => 'Password is required'],400);
          }
          \DB::table('chat_messages')->truncate();
          \DB::table('chat_message_delete')->truncate();
          \DB::table('chat_message_status')->truncate();
          \DB::table('chat_rooms')->truncate();
          \DB::table('chat_room_users')->truncate();

          $this->__is_paginate = false;
          $this->__collection  = false;

          return $this->__sendResponse([],200, 'Data has been deleted successfully');
    }
  
}