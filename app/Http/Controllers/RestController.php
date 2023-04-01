<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestController extends Controller
{
    public $_model, $_apiResource;

    function __construct($model)
    {
        $this->_model = $model;
    }

    /**
     * This function is used for get listing
     * @param {object} Request $request
     * @return {json} response
     */
    public function index(Request $request)
    {
        //validation hook
        if(method_exists($this,'validation')){
            $validator = $this->validation('INDEX');
            if (!empty($validator) && $validator->fails()) {
                foreach($validator->errors()->getMessages() as $key => $value){
                    $error_messages[$key] = $value[0];
                }
                return $this->__sendError(__('app.validation_msg'),$error_messages,400);
            }
        }
        //before load modal hook
        if(method_exists($this,'beforeIndexLoadModel')){
            $response = $this->beforeIndexLoadModel($request);
            if(  $this->__is_error ){
                return $response;
            }
        }
        $record = $this->loadModel()->getRecords($request);
        $message = isset($this->success_listing_message) ? __('app.'.$this->success_listing_message) : __('app.success_listing_message');
        return $this->__sendResponse($record,200,$message);
    }

    /**
     * This function is used for create record
     * @param {object} Request $request
     * @return {json} response
     */
    public function store(Request $request)
    {
        //validation hook
        if(method_exists($this,'validation')){
            $validator = $this->validation('POST');
            if (!empty($validator) && $validator->fails()) {
                foreach($validator->errors()->getMessages() as $key => $value){
                    $error_messages[$key] = $value[0];
                }
                return $this->__sendError(__('app.validation_msg'),$error_messages,400);
            }
        }
        //before load modal hook
        if(method_exists($this,'beforeStoreLoadModel')){
            $response = $this->beforeStoreLoadModel($request);
            if(  $this->__is_error ){
                return $response;
            }
        }
        $data    = $request->all();
        $record  = $this->loadModel()->createRecord($request,$data);
        $message = isset($this->success_store_message) ? __('app.'.$this->success_store_message) : __('app.success_store_message');
        $this->__is_paginate   = false;
        $this->__is_collection = false;
        return $this->__sendResponse($record,200,$message);
    }

    /**
     * This function is used for get record by id
     * @param {object} Request $request
     * @param {int} $id
     * @return {json} response
     */
    public function show(Request $request, $id)
    {
        //before load modal hook
        if(method_exists($this,'beforeShowLoadModel')){
            $response = $this->beforeShowLoadModel($request,$id);
            if(  $this->__is_error ){
                return $response;
            }
        }
        $record = $this->loadModel()->getRecordById($request,$id);
        $message = isset($this->success_show_message) ? __('app.'.$this->success_show_message) : __('app.success_show_message');
        $this->__is_paginate   = false;
        $this->__is_collection = false;
        return $this->__sendResponse($record,200,$message);
    }

    /**
     * This function is used for update record by id
     * @param {object} Request $request
     * @param {int} $id
     * @return {json} response
     */
    public function update(Request $request, $id)
    {
        if(method_exists($this,'validation')){
            $validator = $this->validation('PUT',$id);
            if (!empty($validator) && $validator->fails()) {
                foreach($validator->errors()->getMessages() as $key => $value){
                    $error_messages[$key] = $value[0];
                }
                return $this->__sendError(__('app.validation_msg'),$error_messages,400);
            }
        }
        //before load modal hook
        if(method_exists($this,'beforeUpdateLoadModel')){
            $response = $this->beforeUpdateLoadModel($request,$id);
            if(  $this->__is_error ){
                return $response;
            }
        }
        $data    = $request->all();
        $record  = $this->loadModel()->updateRecord($request,$id,$data);
        $message = isset($this->success_update_message) ? __('app.'.$this->success_update_message) : __('app.success_update_message');
        $this->__is_paginate   = false;
        $this->__is_collection = false;
        return $this->__sendResponse($record,200,$message);
    }

    /**
     * This function is used for delete record by id
     * @param {object} Request $request
     * @param {int} $id
     * @return {json} response
     */
    public function destroy(Request $request, $id)
    {
        if(method_exists($this,'validation')){
            $validator = $this->validation('DELETE',$id);
            if (!empty($validator) && $validator->fails()) {
                foreach($validator->errors()->getMessages() as $key => $value){
                    $error_messages[$key] = $value[0];
                }
                return $this->__sendError(__('app.validation_msg'),$error_messages,400);
            }
        }
        //before load modal hook
        if(method_exists($this,'beforeDestroyLoadModel')){
            $response = $this->beforeDestroyLoadModel($request,$id);
            if(  $this->__is_error ){
                return $response;
            }
        }
        $this->loadModel()->deleteRecord($request,$id);
        $this->__is_paginate = false;
        $message = isset($this->success_delete_message) ? __('app.'.$this->success_delete_message) : __('app.success_delete_message');
        $this->__is_paginate = false;
        $this->__collection  = false;
        return $this->__sendResponse([],200,$message);
    }

    /**
     * This function is user for load model
     * return object
     */
    public function loadModel()
    {
        $model = '\App\Models\\' . $this->_model;
        return new $model;
    }
}