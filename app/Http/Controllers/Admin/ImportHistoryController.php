<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImportHistory;
use App\Models\Status;
use App\Models\User;
use App\Models\UserCompanyMapping;
use App\Models\UserCompanyPinMapping;
use App\Models\UserPin;
use App\Models\UserPinUpdateHistory;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Excel;
use Validator;

class ImportHistoryController extends Controller
{

    public function index()
    {
        return view('admin.settings.import-history');
    }

    public function history()
    {
        $company_user_id        = get_user()->userCompany->id;
        $data['import_history'] = ImportHistory::getImportHistory($company_user_id);
        return view('admin.settings.history-data',$data);
    }

    public function getImportData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'import_pin' => 'required|mimetypes:text/csv,text/plain',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error'   => 1,
                'message' => $validator->errors()->first()
            ]);
        }
        //get file data
        $results = $this->loadImportData($request['import_pin']);
        if( !empty($results) ){
            $results              = $results->toArray();
            $default_columns      = $this->getColumns();
            $upload_sheet_columns = array_keys($results[0]);
            $checkSheetColumns    = array_diff($default_columns,$upload_sheet_columns);
            if( count($checkSheetColumns) ){
                return response()->json([
                    'error'   => 1,
                    'message' => 'Invalid csv column heading'
                ]);
            } else {
                foreach( $results as $row ){
                   foreach( $row as $key => $value ){
                       $data[$key][] = $value;
                   }
                }
                $html = view('admin.ajax-component.import-step2',['data' => $data])->render();
                return response()->json([
                    'error'   => 0,
                    'message' => 'Data retrieved successfully',
                    'data'    => $html
                ]);
            }
        } else {
            return response()->json([
                'error'   => 1,
                'message' => 'Invalid import file'
            ]);
        }
    }

    public function getImportStep3(Request $request)
    {
        $params  = $request->all();
        $html = view('admin.ajax-component.import-step3',['data' => $params])->render();
        return response()->json([
            'error'   => 0,
            'message' => 'Data retrieved successfully',
            'data'    => $html
        ]);
    }

    public function getImportStep4(Request $request)
    {
        $pin_data               = [];
        $current_user           = get_user();
        $params                 = $request->all();
        $users                  = $this->getCompanyUsers();
        $statuses               = $this->getCompanyStatus();
        $user_pins              = $this->getCompanyPins();
        $getLastRow             = UserPin::orderBy('id','desc')->first();
        $userPinCurrentInsertId = !isset($getLastRow->id) ? 1 : ( $getLastRow->id + 1 );
        $current_datetime       = Carbon::now();
        //user pin and company mapping
        $userRole    = UserRole::getUserRoleByUserId(get_user()->id);
        $userCompany = UserCompanyMapping::getCompanyByEmployeeID(get_user()->id);

        for($i=0; $i < count($params['current_status']); $i++)
        {
            if( !empty($params['address'][$i]) )
            {
                if( empty($user_pins[$params['address'][$i]]) )
                {
                    $getGeoCodeUrl  = "https://maps.googleapis.com/maps/api/geocode/json?address=". urlencode($params['address'][$i]) ."&key=" . env('GOOGLE_API_KEY');
                    $getGeoCodeData = file_get_contents($getGeoCodeUrl);
                    $getGeoCodeData = json_decode($getGeoCodeData,true);
                    $latitude       = $getGeoCodeData['results'][0]['geometry']['location']['lat'];
                    $longitude      = $getGeoCodeData['results'][0]['geometry']['location']['lng'];
                    $pin_status     = str_slug($params['current_status'][$i]);

                    if( !empty($users[$params['assign_to'][$i]]) && !empty($statuses[$pin_status]) )
                    {
                        $pin_data[] = [
                            'id'               => $userPinCurrentInsertId,
                            'creator_user_id'  => $current_user->id,
                            'assignee_user_id' => $users[$params['assign_to'][$i]],
                            'pin_status_id'    => $statuses[$pin_status],
                            'house_number'     => $params['house_number'][$i],
                            'house_address'    => $params['address'][$i],
                            'unit'             => $params['unit'][$i],
                            'state'            => $params['state'][$i],
                            'city'             => $params['city'][$i],
                            'zipcode'          => $params['zipcode'][$i],
                            'latitude'         => round($latitude,7),
                            'longitude'        => round($longitude,7),
                            'name'             => $params['name'][$i],
                            'phone'            => $params['phone'][$i],
                            'email'            => $params['email'][$i],
                            'status_id'        => get_status_id('active'),
                            'created_at'       => $current_datetime
                        ];
                        //user company mapping data
                        if( $userRole->slug == 'company' ){
                            $user_company_mapping_data[] = [
                                'company_user_id'  => get_user()->id,
                                'user_pin_id'      => $userPinCurrentInsertId,
                                'created_at'       => $current_datetime,
                            ];
                        }else{
                            $user_company_mapping_data[] = [
                                'company_user_id'  => $userCompany->id,
                                'user_pin_id'      => $userPinCurrentInsertId,
                                'created_at'       => $current_datetime,
                            ];
                        }
                        //pin status history
                        $pin_history_data[] = [
                            'user_id'     => get_user()->id,
                            'user_pin_id' => $userPinCurrentInsertId,
                            'status_id'   => $statuses[$pin_status],
                            'record_json' => NULL,
                            'created_at'  => $current_datetime,
                        ];
                        $userPinCurrentInsertId++;
                    }
                }
            }
        }
        if( count($pin_data) )
        {
            //insert user pin data
            UserPin::insert($pin_data);
            //insert user company mapping data
            UserCompanyPinMapping::insert($user_company_mapping_data);
            //insert pin status history
            UserPinUpdateHistory::insert($pin_history_data);
            //insert import history data
            ImportHistory::insert([
                'company_user_id'  => get_user()->userCompany->id,
                'employee_user_id' => get_user()->id,
                'filename'         => $request['filename'],
                'total_pin'        => count($pin_data),
                'created_at'       => $current_datetime,
            ]);
        }

        return response()->json([
            'error'   => 0,
            'message' => "Data imported successfully",
        ]);
    }

    public function loadImportData($file)
    {
        $data = Excel::load($file, function($reader) {
            return $reader->get();
        });
        return $data;
    }

    public function getColumns()
    {
        return [
            'current_status',
            'assign_to',
            'address',
            'house_number',
            'unit',
            'city',
            'state',
            'zipcode',
            'name',
            'phone',
            'email',
        ];
    }

    public function getCompanyUsers()
    {
        $data  = [];
        $users = User::getCompanyUsers(get_user()->id);
        if( count($users) ){
            foreach($users as $user){
               $data[$user->email] = $user->id;
            }
        }
        return $data;
    }

    public function getCompanyStatus()
    {
        $data = [];
        $statuses = Status::getCompanyStatuses(get_user()->id);
        if( count($statuses) ){
            foreach($statuses as $status){
                $data[str_slug($status->title)] = $status->id;
            }
        }
        return $data;
    }
  
    public function getCompanyPins()
    {
        $data = [];
        $user_pins = UserPin::getAllCompanyPins();
        if( count($user_pins) ){
            foreach($user_pins as $user_pin){
                $data[$user_pin->house_address] = $user_pin->id;
            }
        }
        return $data;
    }
}