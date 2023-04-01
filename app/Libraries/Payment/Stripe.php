<?php

namespace App\Libraries\Payment;


class Stripe
{
    private $_stripe_obj,$_response;

    public function __construct()
    {
        $this->_response = [
            'code'    => 200, //status code
            'message' =>'success', //message
            'data' => [] //data
        ];
    }

    /**
     * This function is used for create customer on stripe
     * @param string $email
     * @return array
     */
    public function createCustomer($data)
    {
        try{
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $customer = \Stripe\Customer::create($data);
        }catch (\Exception $e){
            return $this->_response = [
                'code'    => 400, //status code
                'message' => $e->getMessage(), //message
            ];
        }
        return $this->_response = [
            'code'    => 200, //status code
            'message' =>'Customer added successfully', //message
            'data' => [
                'customer_id' => $customer->id
            ] //data
        ];
    }

    /**
     * This function is used for update customer card on stripe
     * @param string $customer_id
     * @param string $card_token
     * @return array
     */
    public function updateCustomerCard($customer_id,$card_token)
    {
        try{
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $customer = \Stripe\Customer::update(
                $customer_id,
                [
                    'default_source' => $card_token,
                ]
            );
        }catch (\Exception $e){
            return $this->_response = [
                'code'    => 400, //status code
                'message' => $e->getMessage(), //message
            ];
        }
        return $this->_response = [
            'code'    => 200, //status code
            'message' =>'Customer updated successfully', //message
            'data' => [
                'customer' => $customer
            ] //data
        ];
    }

    /**
     * This function is used for create stripe account
     * @param {array} $data
     * @return array
     */
    public function createConnectAccount($data)
    {
        try{
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
//            $connectAccount = \Stripe\Account::create([
//              "type"  => "custom",
//              "email" => $data['email'],
//              "business_type" => 'individual', //company or individual
//              "individual"    => [
//                 'first_name' => $data['first_name'],
//                 'last_name'  => $data['last_name'],
//                 'email'      => $data['email'],
//                 'dob'        => [
//                     'day'    => $data['day'],
//                     'month'  => $data['month'],
//                     'year'   => $data['year']
//                 ],
//                 'address'    => [
//                     "line1"       => $data['street'],
//                     "city"        => $data['city'],
//                     "postal_code" => $data['postal_code'],
//                     "state"       => $data['state'],
//                 ],
//                 'ssn_last_4' => $data['ssn_last_4'],
//                 'phone'      => $data['phone'],
//              ],
//              'business_profile' => [
//                  'mcc'             => '7542',
//                  'name'            => $data['name'],
//                  'support_email'   => $data['email'],
//                  'support_phone'   => $data['phone'],
//                  'url' => 'https://360cubes.com/'
//              ],
//              "requested_capabilities" => ["card_payments"],
//              "tos_acceptance" => [
//                  'date' => time(),
//                  'ip' => $_SERVER['REMOTE_ADDR'],
//                ],
//            ]);
            $connectAccount = \Stripe\Account::create($data);
        }catch(\Exception $e){
            return $this->_response = [
                'code'    => 400, //status code
                'message' => $e->getMessage(), //message
            ];
        }
        return $this->_response = [
            'code'    => 200, //status code
            'message' => 'Connect account created successfully', //message
            'data' => [
                'connect_account' => $connectAccount
            ] //data
        ];
    }

    public function updateConnectAccount($connect_account_id, $data)
    {
        try{
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $connectAccount = \Stripe\Account::update($connect_account_id,$data);
        }catch(\Exception $e){
            return $this->_response = [
                'code'    => 400, //status code
                'message' => $e->getMessage(), //message
            ];
        }
        return $this->_response = [
            'code'    => 200, //status code
            'message' => 'Connect account updated successfully', //message
            'data' => [
                'connect_account' => $connectAccount
            ] //data
        ];
    }

    public function makeDefaultExternalAccount($connect_account_id, $external_account_id)
    {
        try{
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $connectAccount = \Stripe\Account::updateExternalAccount(
                $connect_account_id,
                $external_account_id,
                ['default_for_currency' => true]
            );
        }catch(\Exception $e){
            return $this->_response = [
                'code'    => 400, //status code
                'message' => $e->getMessage(), //message
            ];
        }
        return $this->_response = [
            'code'    => 200, //status code
            'message' => 'External account updated successfully', //message
            'data' => [
                'connect_account' => $connectAccount
            ] //data
        ];
    }

    /**
     * This function is used for create bank token
     * @param $data
     * @return array
     */
    public function createBankToken($data)
    {
        try{
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $bank_account = \Stripe\Token::create([
                'bank_account' => [
                    'country' => $data['country'],
                    'currency' => env('STRIPE_CHARGE_CURRENCY'),
                    'account_holder_name' => $data['name'],
                    'account_holder_type' => 'individual',
                    'routing_number' => $data['routing_number'],
                    'account_number' => $data['account_number']
                ]
            ]);
        }catch(\Exception $e){
            return $this->_response = [
                'code'    => 400, //status code
                'message' => $e->getMessage(), //message
            ];
        }
        return $this->_response = [
            'code'    => 200, //status code
            'message' =>'Bank token created successfully', //message
            'data' => [
                'bank_account' => $bank_account
            ] //data
        ];
    }

    /**
     * This function is used for add bank or debit card in stripe connect account
     * @param $connect_account_id
     * @param $token
     * @return array
     */
    public function createExternalAccount($connect_account_id,$token, $make_default = false)
    {
        try{
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $account = \Stripe\Account::createExternalAccount(
                $connect_account_id,
                [
                    'external_account' => $token,
                    'default_for_currency' => $make_default,
                ]
            );
        }catch(\Exception $e){
            return $this->_response = [
                'code'    => 400, //status code
                'message' => $e->getMessage(), //message
            ];
        }
        return $this->_response = [
            'code'    => 200, //status code
            'message' => 'Connect external account created successfully', //message
            'data' => [
                'connect_account' => $account
            ] //data
        ];
    }

    /**
     * This function is used for update external back account
     * @param {string} $customer_id
     * @param {string} $bank_id
     * @param {array} $data
     * @return {array} $response
     */
    public function updateExternalBankAccount($connect_account_id,$bank_id,$data)
    {
        try{
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $account = \Stripe\Account::updateExternalAccount($connect_account_id,$bank_id,$data);
        }catch(\Exception $e){
            return $this->_response = [
                'code'    => 400, //status code
                'message' => $e->getMessage(), //message
            ];
        }
        return $this->_response = [
            'code'    => 200, //status code
            'message' => 'Bank account deleted successfully', //message
            'data' => [
                'bank_account' => $account
            ] //data
        ];
    }

    /**
     * This function is used for delete external back account
     * @param {string} $customer_id
     * @param {string} $external_account_id
     * @return {array} $response
     */
    public function deleteExternalBankAccount($connect_account_id,$external_account_id)
    {
        try{
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $account = \Stripe\Account::deleteExternalAccount($connect_account_id,$external_account_id);
        }catch(\Exception $e){
            return $this->_response = [
                'code'    => 400, //status code
                'message' => $e->getMessage(), //message
            ];
        }
        return $this->_response = [
            'code'    => 200, //status code
            'message' => 'Payout deleted successfully', //message
            'data' => [
                'bank_account' => $account
            ] //data
        ];
    }

    /**
     * This function is used for create strip card
     * @param $card_token
     * @return array
     */
    public function createSource($card_token)
    {
        try{
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $source = \Stripe\Source::create([
                "type" => "card",
                "token" => $card_token
            ]);
        }catch(\Exception $e){
            return $this->_response = [
                'code'    => 400, //status code
                'message' => $e->getMessage(), //message
            ];
        }
        return $this->_response = [
            'code'    => 200, //status code
            'message' =>'Customer updated successfully', //message
            'data' => [
                'source_id' => $source->id
            ] //data
        ];
    }

    /**
     * This function is used for delete customer source
     * @param $customer_id
     * @param $source_id
     * @return array
     */
    public function deleteSource($customer_id,$source_id)
    {
        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $source = \Stripe\Customer::deleteSource($customer_id, $source_id);
        }catch(\Exception $e){
            return $this->_response = [
                'code'    => 400, //status code
                'message' => $e->getMessage(), //message
            ];
        }
        return $this->_response = [
            'code'    => 200, //status code
            'message' =>'Source deleted successfully', //message
            'data' => $source //data
        ];

    }

    /**
     * This function is used for add multiple user card
     * @param {string} $stripe_customer_id
     * @param {string} $card_token
     */
    public function createCustomerNewCard($stripe_customer_id,$card_token)
    {
        try{
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $card = \Stripe\Customer::createSource(
                $stripe_customer_id,
                [
                    'source' => $card_token,
                ]
            );
        }catch (\Exception $e){
            return $this->_response = [
                'code'    => 400, //status code
                'message' => $e->getMessage(), //message
            ];
        }
        return $this->_response = [
            'code'    => 200, //status code
            'message' =>'Card added successfully', //message
            'data' => [
                'card' => $card
            ] //data
        ];
    }

    public function getUserStripeCardList($strip_customer_id)
    {
        try{
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $cards = \Stripe\Customer::allSources(
                $strip_customer_id,
                [
                    'limit' => 10,
                    'object' => 'card',
                ]
            );
        }catch(\Exception $e){
            return $this->_response = [
                'code'    => 400, //status code
                'message' => $e->getMessage(), //message
            ];
        }
        return $this->_response = [
            'code'    => 200, //status code
            'message' =>'Cards retrieved successfully', //message
            'data' => [
                'cards' => $cards
            ] //data
        ];
    }

    /**
     * This function is used for create charge
     * @param {array} $data
     * @return {array}
     */
    public function createCharge($data)
    {
        try{
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $charge = \Stripe\Charge::create([
                "amount"      => round($data['amount'] * 100, 2),
                "currency"    => env('STRIPE_CHARGE_CURRENCY'),
                "source"      => $data['token'],
                "description" => $data['description']
            ]);
        }catch(\Exception $e){
            return $this->_response = [
                'code'    => 400, //status code
                'message' => $e->getMessage(), //message
            ];
        }
        return $this->_response = [
            'code'    => 200, //status code
            'message' =>'Transaction completed successfully', //message
            'data' => [
                'charge' => $charge
            ] //data
        ];
    }

    public function createCustomerCharge($data)
    {
        try{
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $charge = \Stripe\Charge::create(array(
                "amount"         => round($data['amount'] * 100, 2),
                "currency"       => env('STRIPE_CHARGE_CURRENCY'),
                "customer"       => $data['stripe_customer_id'],
                "description"    => $data['description'],
            ));
        }catch (\Exception $e){
            return $this->_response = [
                'code'    => 400, //status code
                'message' => $e->getMessage(), //message
            ];
        }
        return $this->_response = [
            'code'    => 200, //status code
            'message' =>'Transaction completed successfully', //message
            'data' => [
                'charge' => $charge
            ] //data
        ];
    }

    public function transfer($data)
    {
        try{
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $transfer = \Stripe\Transfer::create(array(
                "amount"             => round($data['amount'] * 100, 2),
                "currency"           => env('STRIPE_CHARGE_CURRENCY'),
                "source_transaction" => $data['charge_id'],
                "destination"        => $data['destination'],//'acct_1EdE1NLBq37AWvff',
            ));
        }catch(\Exception $e){
            return $this->_response = [
                'code'    => 400, //status code
                'message' => $e->getMessage(), //message
            ];
        }
        return $this->_response = [
            'code'    => 200, //status code
            'message' =>'Transaction completed successfully', //message
            'data' => [
                'transfer' => $transfer
            ] //data
        ];
    }

}