<?php

namespace App\Http\Controllers\Admin;

use App\Models\Territory;
use App\Models\UserPin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Validator;
use Excel;

class UserPinController extends Controller
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
        $data['companyStatuses'] = $this->getCompanyStatuses();
        $data['companyUsers'] = $this->getCompanyUsers();
        return view('admin.user-pin.index',$data);
    }

    public function addPin(Request $request)
    {
        if( $request->isMethod('post') )
            return self::_savePin($request);

        $view_data['companyUsers']    = $this->getCompanyUsers();
        $view_data['companyStatuses'] = $this->getCompanyStatuses();
        $view_data['getCustomFields'] = $this->getCustomFields();
        $html = view('admin.modal.add-pin',$view_data)->render();
        $data = [
            'html' => $html
        ];
        return response()->json($data);
    }

    private function getTerritories()
    {
        $data = [];
        $territories = Territory::getTerritories(get_user()->userCompany->id);
        if( count($territories) ){
            foreach( $territories as $territory ){
                $data[] = [
                    'id'           => $territory->id,
                     'ploygon_arr' => json_decode($territory->geofence_detail)
                ];
            }
        }
        return $data;
    }

    private function _savePin($request)
    {
        $user_token             = get_user()->token;
        $params                 = $request->all();
        $response   = $this->internalCall('/api/user-pin','POST',$params,$user_token);
        if( $response->code != 200 ){
            $this->_ajax_response['error']   = 1;
            $this->_ajax_response['message'] = $response->message;
            $this->_ajax_response['data']    = $response->data;
        } else {
            $this->_ajax_response['error']        = 0;
            $this->_ajax_response['message']      = $response->message;
            $this->_ajax_response['data']         = $response->data;
            $this->_ajax_response['redirect']     = true;
            $this->_ajax_response['redirect_url'] = url()->previous();
        }
        return response()->json($this->_ajax_response);
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

    public function getCompanyUsers()
    {
        $data   = [];
        $params = [];
        $user = get_user();
        if( $user->UserRole->slug == 'company' ){
            $params['company_user_id'] = $user->UserRole->user_id;
        }else{
            $params['company_user_id'] = $user->userCompany->id;
        }
        $user_token = get_user()->token;
        $responses = $this->internalCall('api/user','GET',$params,$user_token);
        
        if( $responses->code == 200){
            $data = $responses->data;
        }
        return $data;
    }

    public function getCustomFields($user_pin_id = 0)
    {
        $data   = [];
        $user_token = get_user()->token;
        $responses = $this->internalCall('api/custom-fields','GET',['user_pin_id' => $user_pin_id ],$user_token);
        if( $responses->code == 200){
            $data = $responses->data;
        }
        return $data;
    }

    public function editPin(Request $request, $id)
    {
        if ($request->isMethod('post'))
            return self::_updatePin($request,$id);

        $user_token = get_user()->token;
        $responses = $this->internalCall('api/user-pin/' . $id, 'GET', [], $user_token);
        $data['record']          = $responses->data;
        $data['companyUsers']    = $this->getCompanyUsers();
        $data['companyStatuses'] = $this->getCompanyStatuses();
        $data['getCustomFields'] = $this->getCustomFields($id);
        $html = view('admin.modal.pin-detail', $data)->render();
        return $html;
    }

    private function _updatePin($request,$id)
    {
        $user_token = get_user()->token;
        $params     = $request->all();
        $params['_method'] = 'PUT';
        $response   = $this->internalCall('/api/user-pin/' . $id,'POST',$params,$user_token);
        if( $response->code != 200 ){
            $this->_ajax_response['error']   = 1;
            $this->_ajax_response['message'] = $response->message;
            $this->_ajax_response['data']    = $response->data;
        } else {
            $this->_ajax_response['error']        = 0;
            $this->_ajax_response['message']      = $response->message;
            $this->_ajax_response['data']         = $response->data;
            $this->_ajax_response['redirect']     = true;
            $this->_ajax_response['redirect_url'] = url()->previous();
        }
        return response()->json($this->_ajax_response);
    }

    public function ajaxListing(Request $request)
    {
        $filter_data                        = [];
        $params                             = $request->all();
        parse_str($params['custom_search'],$filter_data);
        $records["data"]                = array();
        $params['page']                 = (round( $params['start'] / $params['length'] ) + 1);
        $params["limit"]                = $params['length'];
        $params["assignee_user_id"]     = !empty($filter_data['assignee_user_id']) ? implode(',',$filter_data['assignee_user_id']) : NULL;
        $params["keyword"]              = $filter_data['keyword'];
        $params["pin_status_id"]        = !empty($filter_data['pin_status_id']) ? implode(',',$filter_data['pin_status_id'])  : '';
        $params["date_filter"]          = !empty($filter_data['date_filter']) ? $filter_data['date_filter'] : NULL;
        $params["from_date"]            = !empty($filter_data['from_date']) ? $filter_data['from_date'] : NULL;
        $params["to_date"]              = !empty($filter_data['to_date']) ? $filter_data['to_date'] : NULL;
		$params["updated_at"]		    = !empty($filter_data['updated_at']) ? $filter_data['updated_at'] : NULL;
		$params["territory"]		    = !empty($filter_data['territory']) ? $filter_data['territory'] : NULL;
		$params['status_modified_date'] = !empty($filter_data['status_modified_date']) ? $filter_data['status_modified_date'] : NULL;

        if( !empty($params['order'][0]) ){
            $sort_column = [
                'house_address','creator_name','assignee_name','status_title','territory_title','updated_by','house_number','unit','state','city','zipcode','latitude','longitude','name','phone','email','created_at','updated_at','appointment_title','notes','status_modified_date','num_of_status_changes'
            ];
            $params['sort_column'] = $sort_column[$params['order'][0]['column']];
            $params['sort_order']  = $params['order'][0]['dir'];
        }

        $records['data'] = [];
        $data    = [];
        $responses = $this->internalCall('/api/user-pin', 'GET', $params, get_user()->token);
        // set data grid output
        if(count($responses->data))
        {
            foreach($responses->data as $record){
                $records["data"][] = [
                    '<a href="'. route('admin.map') .'?user_pin_id='. $record->id .'">' . $record->house_address . '</a>',
                    $record->pin_status ? '<span style="color:'.$record->pin_status->color.'">'. $record->pin_status->title .'</span>' : '-',
                    $record->creator_user ? $record->creator_user->name : '-',
                    $record->created_at,
                    !empty($record->updated_by) ? $record->updated_by : '--',
                    !empty($record->updated_by) ? $record->updated_at : '--',
                    $record->assignee_user ? $record->assignee_user->name : '-',

                    // !empty($record->territory->title) ? $record->territory->title : '--',
                    // $record->house_number,
                    // $record->unit,
                    // $record->state,
                    // $record->city,
                    // $record->zipcode,
                    // $record->latitude,
                    // $record->longitude,
                    // $record->name,
                    // $record->phone,
                    // $record->email,
                    // $record->created_at,
                    // $record->updated_at,
                    // !empty($record->appointment->title) ? $record->appointment->title : '--',
                    // !empty($record->appointment->notes) ? $record->appointment->notes : '--',
                    // $record->status_modified_date,
                    // $record->num_of_status_changes
                ];
            }
            
        }
        $records["draw"] = (int)$request->input('draw');
        $records["recordsTotal"]    = $responses->pagination->meta->total;
        $records["recordsFiltered"] = $responses->pagination->meta->total;
        return response()->json($records);
    }

    public function deletePin(Request $request)
    {
        $user_token  = get_user()->token;
        $user_pin_id = $request->input('id');
        $responses   = $this->internalCall('api/user-pin/' . $user_pin_id, 'DELETE', [], $user_token);
        return response()->json($responses);
    }

    public function exportData(Request $request)
    {
        $filename = 'pin_' . rand(11111,99999) . time();
        $records = UserPin::exportData($request);
        if( count($records) ){
            Excel::create($filename, function($excel) use($records,$filename) {
                $excel->sheet($filename, function($sheet) use ($records) {
                    $sheet->fromArray($records);
                });
            })->store('csv',public_path($filename));
            return response()
                        ->json([
                            'error'   => 0,
                            'message' => 'Data export successfully',
                            'data'    => $filename
                        ]);
        } else {
            return response()
                ->json([
                    'error'   => 1,
                    'message' => 'No Data found'
                ]);
        }
    }

    public function exportDeleteFile(Request $request)
    {
        \File::deleteDirectory( public_path($request['filename']) );
        return response()->json([]);
    }
}