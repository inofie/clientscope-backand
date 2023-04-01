<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Validator;

class AjaxController extends Controller
{
    private $_data;

    public function __construct()
    {
        $this->_data = [
            'error'        => 1,
            'message'      => 'Validation Message',
            'data'         => [],
            'redirect'     => false,
            'redirect_url' => '',
        ];
    }

    public function _init(Request $request)
    {
        if( !empty($request['module']) ){

            switch ($request['module']) {
                case "user_registration":
                    return self::_userRegistration($request);
                    break;
                case "user_login":
                    return self::_userLogin($request);
                    break;
                case "forgot_password":
                    return self::_forgotPassword($request);
                    break;
                case "profile":
                    return self::_profile($request);
                    break;
                case "change_password":
                    return self::_changePassword($request);
                    break;
                case "load_content":
                    return self::_loadContent($request);
                    break;
                case "user-favourite":
                    return self::_userFavourite($request);
                    break;
                case "contact_us":
                    return self::_contactUs($request);
                    break;
                default:
                    $this->_data['data'] = ['message' => 'Invalid Request'];
                    return response()->json($this->_data);
            }
        }else{
            $this->_data['data'] = ['message' => 'Invalid Request'];
            return response()->json($this->_data);
        }
    }

    private function _userRegistration($request)
    {
        $response = $this->internalCall('/api/user','POST',$request->all());
        if($response->code == 200){
            $this->_data['redirect']     = true;
            $this->_data['redirect_url'] = route('home');
        }
        $this->_data['error']   = $response->code != 200 ? 1 : 0;
        $this->_data['message'] = $response->message;
        $this->_data['data']    = $response->data;
        return response()->json($this->_data);
    }

    private function _userLogin($request)
    {
        $response = $this->internalCall('/api/user/login','POST',$request->all());
        if($response->code == 200){
            Auth::loginUsingId($response->data->id);
            $this->_data['redirect']     = true;
            $this->_data['redirect_url'] = route('home');
        }
        $this->_data['error']   = $response->code != 200 ? 1 : 0;
        $this->_data['message'] = $response->message;
        $this->_data['data']    = $response->data;
        return response()->json($this->_data);
    }

    private function _forgotPassword($request)
    {
        $response = $this->internalCall('/api/user/forgot-password','POST',$request->all());
        $this->_data['error']   = $response->code != 200 ? 1 : 0;
        $this->_data['message'] = $response->message;
        $this->_data['data']    = $response->data;
        return response()->json($this->_data);
    }

    private function _profile($request)
    {
        $user     = Auth::user();
        $params   = [
            '_method'   => 'PUT',
            'name'      => $request->input('name'),
            'mobile_no' => $request->input('mobile_no'),
        ];
        $response = $this->internalCall('/api/user/' . $user->id,'POST',$params,$user->token);
        if($response->code == 200){
            $this->_data['redirect']     = true;
            $this->_data['redirect_url'] = route('profile');
        }
        $this->_data['error']   = $response->code != 200 ? 1 : 0;
        $this->_data['message'] = $response->message;
        $this->_data['data']    = $response->data;
        return response()->json($this->_data);
    }

    private function _changePassword($request)
    {
        $user     = Auth::user();
        $response = $this->internalCall('/api/user/change-password','POST',$request->all(),$user->token);
        if($response->code == 200){
            $this->_data['redirect']     = true;
            $this->_data['redirect_url'] = route('change-password');
        }
        $this->_data['error']   = $response->code != 200 ? 1 : 0;
        $this->_data['message'] = $response->message;
        $this->_data['data']    = $response->data;
        return response()->json($this->_data);
    }

    private function _contactUs($request)
    {
        $user     = Auth::user();
        $response = $this->internalCall('/api/contact-us','POST',$request->all(),$user->token);
        if($response->code == 200){
            $this->_data['redirect']     = true;
            $this->_data['redirect_url'] = route('contact-us');
        }
        $this->_data['error']   = $response->code != 200 ? 1 : 0;
        $this->_data['message'] = $response->message;
        $this->_data['data']    = $response->data;
        return response()->json($this->_data);
    }

    private function _loadContent($request)
    {
        $request['module'] = $request['ref_module'];
        $data['data'] =  $this->internalCall('/api/' . $request['request'],'GET',$request->all());
        $html = view('component.' . $request['component'],$data);
        return response()->json([
            'show_load_more' => $data['data']->pagination->meta->current_page != $data['data']->pagination->meta->last_page ? true : false,
            'page_no'        => ($data['data']->pagination->meta->current_page + 1 ),
            'data'           => htmlentities($html)
        ]);
    }

    private function _userFavourite($request)
    {
        $user     = Auth::user();
        $param    = [
            'module'    => $request['entity'],
            'module_id' => $request['id'],
        ];
        $response = $this->internalCall('/api/make-favourite','POST',$param,$user->token);
        $this->_data['error']   = $response->code != 200 ? 1 : 0;
        $this->_data['message'] = $response->message;
        $this->_data['data']    = $response->data;
        return response()->json($this->_data);
    }

    public function revealCode(Request $request)
    {
        $coupon = Coupon::getCouponByUniqueId($request);
        if( isset($coupon->id) ){
            $cuopon_html            = view('component.coupon-modal',['coupon' => $coupon])->render();
            $this->_data['error']   = 0;
            $this->_data['message'] = "success";
            $this->_data['data']    = $cuopon_html;

        }
        return response()->json($this->_data);
    }

    public function submitReview(Request $request)
    {
        $user     = Auth::user();
        $response = $this->internalCall('/api/rating-review','POST',$request->all(),$user->token);
        $this->_data['error']   = $response->code != 200 ? 1 : 0;
        $this->_data['message'] = $response->message;
        $this->_data['data']    = $response->data;
        return response()->json($this->_data);
    }
}