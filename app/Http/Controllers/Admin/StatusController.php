<?php

namespace App\Http\Controllers\Admin;

use App\Models\KpiGroups;
use App\Models\Metric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\User;

class StatusController extends Controller
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
        $params['user_id'] = get_user()->id;
        $user_token = get_user()->token;
        $companyStatuses   = $this->internalCall('/api/status','GET',$params,$user_token);
        if($companyStatuses->code == 200){
            $view_data['company_statuses'] = $companyStatuses->data;
        }
        $view_data['kpi_groups'] = KpiGroups::getKpiGroup();
        $view_data['metrices']   = Metric::getMetrices();
        return view('admin.statuses.index', $view_data);
    }

    public function addStatus(Request $request)
    {
        if( $request->isMethod('post') )
            return self::_saveStatus($request);

        $view_data['kpi_groups'] = KpiGroups::getKpiGroup();
        $view_data['metrices']   = Metric::getMetrices();
        $html = view('admin.modal.add-status',$view_data)->render();
        $data = [
            'html' => $html
        ];
        return response()->json($data);
    }

    private function _saveStatus($request)
    {
        $user_token             = get_user()->token;
        $params                 = $request->all();
        $pin_status_image       = explode('|',$params['image_url']);
        $params['color']        = $pin_status_image[0];
        $params['image_url']    = !empty($pin_status_image[1]) ? $pin_status_image[1] : NULL;
        $params['territory_id'] = 0;
        $response   = $this->internalCall('/api/status','POST',$params,$user_token);
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

    public function editStatus(Request $request)
    {
        if(isset($request->all()['_method']) && $request->all()['_method'] == 'delete')
            return self::_deleteStatus($request);

        if( $request->isMethod('post') )
            return self::_updateStatus($request);

        $user_token = get_user()->token;
        $params     = $request->all();

        $responsePin = $this->internalCall('/api/status/'.$request->id,'GET',$params,$user_token);
        if($responsePin->code == 200){
            $view_data['pin'] = $responsePin->data;
        }
        $view_data['kpi_groups'] = KpiGroups::getKpiGroup($request->id);
        $view_data['metrices']   = Metric::getMetrices();
        $html = view('admin.modal.edit-status', $view_data)->render();
        $data = [
            'html' => $html
        ];

        return response()->json($data);
    }

    private function _updateStatus($request)
    {
        $user_token          = get_user()->token;
        $params              = $request->all();
        $params['_method']   = 'PUT';
        $pin_status_image    = explode('|',$params['image_url']);
        $params['color']     = $pin_status_image[0];
        $params['image_url'] = !empty($pin_status_image[1]) ? $pin_status_image[1] : NULL;

        $response   = $this->internalCall("/api/status/" . $params['id'],'POST',$params,$user_token);
        if( $response->code != 200 ){
            $this->_ajax_response['error']   = 1;
            $this->_ajax_response['message'] = $response->message;
            $this->_ajax_response['data']    = $response->data;
        }else{
            $this->_ajax_response['error']        = 0;
            $this->_ajax_response['message']      = $response->message;
            $this->_ajax_response['data']         = $response->data;
            $this->_ajax_response['redirect']     = true;
            $this->_ajax_response['redirect_url'] = route('admin.statuses');
        }
        return response()->json($this->_ajax_response);
    }

    private function _deleteStatus($request){
        $user_token                     = get_user()->token;
        $params                         = $request->all();
        $params['_method']              = "DELETE";
        $response   = $this->internalCall("/api/status/$request->id",'DELETE',$params,$user_token);
        if( $response->code != 200 ){
            return redirect('admin/statuses')->with('message', $response->message);
        }else{
            return redirect('admin/statuses')->with('message', $response->message);
        }
    }
}