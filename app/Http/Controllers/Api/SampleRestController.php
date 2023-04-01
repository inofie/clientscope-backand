<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\RestController;

class SampleRestController extends RestController
{
    public $_request,$_apiResource ;

    public function __construct(Request $request)
    {
        parent::__construct('Model');
        $this->_request     = $request;
        $this->_apiResource = 'Resource';
    }

    /**
     * This function is used for validate restfull request
     * @param $action
     * @param int $id
     * @return array
     */
    public function validation($action,$id=0)
    {
        $validator = [];
        switch ($action){
            case 'POST':
                $validator = Validator::make($this->_request->all(), [
                    'attribute'        => 'required',
                ]);
                break;
            case 'PUT':
                $validator = Validator::make($this->_request->all(), [
                    '_method'      => 'required|in:PUT',
                    'attribute'     => 'required',
                    'token'    => [
                        Rule::exists('table_name')->where(function($query) use ($id){
                            $query->where('id',$id);
                        })
                    ]
                ]);
                break;
        }
        return $validator;
    }

    /**
     * @param $request
     */
    public function beforeIndexLoadModel($request)
    {

    }

    /**
     * @param $request
     */
    public function beforeStoreLoadModel($request)
    {

    }

    /**
     * @param $request
     */
    public function beforeShowLoadModel($request)
    {

    }

    /**
     * @param $request
     */
    public function beforeUpdateLoadModel($request)
    {

    }

    /**
     * @param $request
     */
    public function beforeDestroyLoadModel($request)
    {

    }
}