<?php

namespace App\Http\Controllers\Admin;

use App\Models\KpiGroups;
use App\Models\Metric;
use App\Models\Territory;
use App\Models\User;
use App\Models\UserSalesPlan;
use App\Models\SubscriptionPackage;
use App\Models\UserRole;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
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

    public function companyListing(Request $request)
    {
        $data['companies'] = User::getAllCompany($request->all());
        $data['subscriptionPackages'] = SubscriptionPackage::all();
        return view('admin.user.company-list',$data);
    }

    public function teamLeadListing(Request $request)
    {
        $data['teamleads'] = User::getAllTeamLeads($request->all());
        return view('admin.user.team-lead-list',$data);
    }

    public function saleRepsListing(Request $request)
    {
        $data['salesReps'] = User::getAllSalesReps($request->all());
        return view('admin.user.sale-reps-list',$data);
    }

    public function updateAllUser(Request $request)
    {
        \DB::table('users')
            ->where('id',$request['user_id'])
            ->update([
                'status_id' => $request['status']
            ]);
        return redirect(url()->previous());
    }

    public function addUser(Request $request)
    {
        if( $request->isMethod('post') )
            return self::_saveUser($request);

        $user = get_user();
        if( $user->UserRole->slug == 'company' ){
            $user_company_id = $user->UserRole->user_id;
        }else{
            $user_company_id = $user->userCompany->id;
        }
        $view_data['companyUsers'] = $this->getCompanyUsers($user_company_id);
        $view_data['companyTeams'] = $this->getCompanyTeam();
        $view_data['kpi_groups']   = KpiGroups::getKpiGroup();
        $view_data['metrices']     = Metric::getUserMetrices($user->id,$user_company_id);
        $html = view('admin.modal.add-user',$view_data)->render();
        $data = [
            'html' => $html
        ];
        return response()->json($data);
    }

    public function getCompanyUsers($company_id)
    {
        $data = [];
        $user_token = get_user()->token;
        $params = [
            'company_user_id' => $company_id,
            'user_type'       => 'administrator'
        ];
        $responses = $this->internalCall('/api/user','GET',$params,$user_token);
        if( $responses->code == 200){
            $data = $responses->data;
        }
        return $data;
    }

    public function getCompanyTeam()
    {
        $data = [];
        $user_token = get_user()->token;
        $responses = $this->internalCall('/api/team','GET',[],$user_token);
        if( $responses->code == 200){
            $data = $responses->data;
        }
        return $data;
    }

    private function _saveUser($request)
    {
        $user_token = get_user()->token;
        $params     = $request->all();
        $params['user_role'] = 'sales-representative';
        $response   = $this->internalCall('/api/user','POST',$params,$user_token);
        if( $response->code != 200 ){
            $this->_ajax_response['error']   = 1;
            $this->_ajax_response['message'] = $response->message;
            $this->_ajax_response['data']    = $response->data;
        }else{
            $this->_ajax_response['error']        = 0;
            $this->_ajax_response['message']      = $response->message;
            $this->_ajax_response['data']         = $response->data;
            $this->_ajax_response['redirect']     = true;
            $this->_ajax_response['redirect_url'] = url()->previous();
        }
        return response()->json($this->_ajax_response);
    }

    public function editUser(Request $request,$id)
    {
        if( $request->ajax() ){
            $user = get_user();
            if( $user->UserRole->slug == 'company' ){
                $user_company_id = $user->UserRole->user_id;
            }else{
                $user_company_id = $user->userCompany->id;
            }
            $view_data['user_sale_plan'] = UserSalesPlan::getUserSalePlan($id);
            $view_data['edit_user']      = User::getUserByID($id)->toArray();
            $view_data['companyUsers']   = $this->getCompanyUsers($user_company_id);
            $view_data['companyTeams']   = $this->getCompanyTeam();
            $view_data['kpi_groups']     = KpiGroups::getKpiGroup();
            $view_data['metrices']       = Metric::getUserMetrices($id);
            $html = view('admin.modal.edit-user',$view_data)->render();
            $data = [
                'html' => $html
            ];
            return response()->json($data);
        } else {
            return redirect()->route('admin.dashboard');
        }
        return response()->json($this->_ajax_response);
    }

    public function updateUser(Request $request,$id)
    {
        $user_token = get_user()->token;
        $params     = $request->all();
        $params['_method']   = 'PUT';
        $params['user_role'] = 'sales-representative';
        $response   = $this->internalCall('/api/user/' . $id,'POST',$params,$user_token);
        if( $response->code != 200 ){
            $this->_ajax_response['error']   = 1;
            $this->_ajax_response['message'] = $response->message;
            $this->_ajax_response['data']    = $response->data;
        }else{
            $this->_ajax_response['error']        = 0;
            $this->_ajax_response['message']      = $response->message;
            $this->_ajax_response['data']         = $response->data;
            $this->_ajax_response['redirect']     = true;
            $this->_ajax_response['redirect_url'] = url()->previous();
        }
        return response()->json($this->_ajax_response);
    }

    public function addCompany()
    {
        $this->_data['companies'] = User::getUserByRoles(['company']);
        return view('admin.user.company-list',$this->_data);
    }

    public function saveCompany(Request $request)
    {
        $user_token = Auth::user()->token;
        $params     = $request->all();
        $params['user_role'] = 'company';
        $response = $this->internalCall('api/user','POST',$params,$user_token);
        if( $response->code != 200){
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

    public function userSuggestion(Request $request)
    {
        $data  = [];
        $users = User::userSuggestion($request['string']);
        if( count($users) )
        {
            foreach ( $users as $user )
            {
                $user_image = !empty($user->image_url) ? $user->image_url : URL::to('images/user-placeholder.png');
                $data[] = [
                    'value' => $user->id,
                    'text'  => $user->name,
                    'html'  => '<div class="search_user" data-userImage="'.$user_image.'" data-username="'. $user->name .'" data-userId="'. $user->id .'">'. $user->name .'</div>'
                ];
            }
        }
        return response()->json($data);
    }

    public function leaderBoard(Request $request)
    {
        if( $request->ajax() ){
            return self::loadLeaderBoard($request);
        }
        $data['kpi_groups'] = $this->getKpiGroups();
        return view('admin.settings.leader-board',$data);
    }

    public function getKpiGroups()
    {
        $user_token  = get_user()->token;
        $apiResponse = $this->internalCall('api/kpi-group','GET',[],$user_token);
        return $apiResponse->data;
    }

    public function loadLeaderBoard($request)
    {
        $user_token  = get_user()->token;
        $apiResponse = $this->internalCall('api/user/leader-board','GET',$request->all(),$user_token);
        if( $apiResponse->code == 200){
            $view = view('admin.ajax-component.leader-board',['data' => $apiResponse->data])->render();
            return $view;
        }
    }

    public function manageUser(Request $request)
    {
        if( $request->ajax() ){
            return self::loadManageUsers($request);
        }
        return view('admin.settings.manage-user');
    }

    public function loadManageUsers($request)
    {
        $user_token  = get_user()->token;
        //$apiResponse = $this->internalCall('api/user/manage-users','GET',[],$user_token);
        $users = User::getReportingUsers(get_user()->id);
        $view = view('admin.ajax-component.manage-user',['data' => $users])->render();
        return $view;

    }

    public function accountDetail(Request $request)
    {
        $current_user         = get_user()->toArray();
        $data['user_package'] = $request['user_package']->toArray();
        $data['total_users']  = \DB::table('user_company_mapping')->where('company_user_id',$current_user['user_company']['company_user_id'])->count();
        $data['subscriptionPackages'] = \DB::table('subscription_packages')->get();
        return view('admin.settings.account-details',$data);
    }

    public function companyStore(Request $request)
    {
        $param_rules['subscription_packages_id'] = 'required';
        $param_rules['name']                = 'required|min:2|max:100';
        $param_rules['email']               = 'required|unique:users,email,'.$request->email;
        $param_rules['mobile_no']           = 'required|unique:users,mobile_no,'.$request->email;
        $param_rules['password']            = 'required|min:6';
        $param_rules['confirm_password']    = 'required|same:password';
        $param_rules['expire_date']         = 'required| after:'. date('Y-m-d');
        $param_rules['subscription_status'] = 'required|in:expired,active';

        $response = $this->__validateRequestParams($request->all(), $param_rules);

        if($this->__is_error == true){
            $response = json_decode($response->getContent());
            $this->_ajax_response['error']   = 1;
            $this->_ajax_response['message'] = $response->message;
            $this->_ajax_response['data']    = $response->data;
        } else {
            $params = $request->all();
            $params['user_role'] = 'company';    
            $response = $this->internalCall('/api/user','POST',$params,get_user()->token);
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
        }
        return response()->json($this->_ajax_response);

    }
}