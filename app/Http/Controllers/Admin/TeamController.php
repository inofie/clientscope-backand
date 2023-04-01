<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TeamController extends Controller
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
        $companyStatuses   = $this->internalCall('/api/team','GET',$params,$user_token);
        if($companyStatuses->code == 200){
            $view_data['teams'] = $companyStatuses->data;
        }
        return view('admin.team.index', $view_data);
    }

    public function addTeam(Request $request)
    {
        if( $request->isMethod('post') )
            return self::_saveTeam($request);

        $html = view('admin.modal.add-team')->render();
        $data = [
            'html' => $html
        ];
        return response()->json($data);
    }

    private function _saveTeam($request)
    {
        $user_token             = get_user()->token;
        $params                 = $request->all();
        $response   = $this->internalCall('/api/team','POST',$params,$user_token);
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

    public function editTeam(Request $request)
    {
        if(isset($request->all()['_method']) && $request->all()['_method'] == 'delete')
            return self::_deleteTeam($request);

        if( $request->isMethod('post') )
            return self::_updateTeam($request);

        $user_token = get_user()->token;
        $params     = $request->all();

        $responsePin = $this->internalCall('/api/team/'.$request->id,'GET',$params,$user_token);
        if($responsePin->code == 200){
            $view_data['team'] = $responsePin->data;
        }
        $html = view('admin.modal.edit-team', $view_data)->render();
        $data = [
            'html' => $html
        ];

        return response()->json($data);
    }

    private function _updateTeam($request)
    {
        $user_token          = get_user()->token;
        $params              = $request->all();
        $params['_method']   = 'PUT';
        $response   = $this->internalCall("/api/team/" . $params['id'],'POST',$params,$user_token);
        if( $response->code != 200 ){
            $this->_ajax_response['error']   = 1;
            $this->_ajax_response['message'] = $response->message;
            $this->_ajax_response['data']    = $response->data;
        }else{
            $this->_ajax_response['error']        = 0;
            $this->_ajax_response['message']      = $response->message;
            $this->_ajax_response['data']         = $response->data;
            $this->_ajax_response['redirect']     = true;
            $this->_ajax_response['redirect_url'] = route('admin.team');
        }
        return response()->json($this->_ajax_response);
    }

    private function _deleteTeam($request)
    {
        $user_token                     = get_user()->token;
        $params                         = $request->all();
        $params['_method']              = "DELETE";
        $response   = $this->internalCall("/api/team/$request->id",'DELETE',$params,$user_token);
        if( $response->code != 200 ){
            return redirect('admin/team')->with('message', $response->message);
        }else{
            return redirect('admin/team')->with('message', $response->message);
        }
    }
}