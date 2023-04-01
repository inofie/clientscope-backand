<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\Payment\Stripe;

class CompanyController extends Controller
{
    private $_stripe;
    public function __construct()
    {   
        $this->_stripe = new Stripe;
    }

    public function register(Request $request)
    {
        $param_rules['package_slug'] = 'required|exists:subscription_packages,slug';
        $param_rules['first_name'] = 'required|min:2|max:50';
        $param_rules['last_name']  = 'required|min:2|max:50';
        $param_rules['mobile_no']  = [
            'required',
            Rule::unique('users')->whereNull('deleted_at')
        ];
        $param_rules['email'] = [
            'required',
            'email',
            Rule::unique('users')->whereNull('deleted_at')
        ];
        $param_rules['company_name']     = 'required|min:2|max:50';
        $param_rules['num_of_sale_reps'] = 'required|min:2|max:50';
        $param_rules['description']      = 'required|min:2|max:1000';
        $param_rules['payment_token']    = 'required|max:250';

        $response = $this->__validateRequestParams($request->all(), $param_rules);

        if($this->__is_error == true)
            return $response;

        $gatewayCustomer    = $this->_stripe->createCustomer(['email' => $request['email']]);    
        $createCustomerCard = $this->_stripe->createCustomerNewCard($gatewayCustomer['data']['customer_id'],$request['payment_token']);
        if( $createCustomerCard['code'] != 200 ){
            return $this->__sendError('Gateway Error',['message' => $createCustomerCard['message']], 400);
        }
        $request['gateway_customer_id'] = $gatewayCustomer['data']['customer_id'];
        $request['gateway_default_card_id']   = $createCustomerCard['data']['card']->id;
        $request['gateway_default_card_json'] = json_encode($createCustomerCard['data']['card']);
        $company = User::createCompany($request->all());
        
        $this->__is_paginate = false;
        $this->__collection  = false;
        
        return $this->__sendResponse($company, 200, 'Account has been created successfully. Panel detail link has been sent to your email address'); 
    }


}