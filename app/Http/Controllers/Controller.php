<?php

namespace App\Http\Controllers;

use App\Models\DropzoneUploader;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected
        $__is_paginate   = true, // to control pagination object
        $__is_collection = true, // for item detail response
        $__is_error      = false, // for item detail response
        $__collection    = true;// to control general response

    protected function __validateRequestParams($input_params, $param_rules)
    {
        $this->__params = $input_params;
        $this->__customMessages = [];
        $validator = \Validator::make($input_params, $param_rules, $this->__customMessages);

        $errors = [];

        if($validator->fails()){
            foreach ($param_rules as $field => $value){
                $message = $validator->errors()->first($field);
                if(!empty($message)) {
                    $errors[$field] = $message;
                }
            }
            $this->__is_error = true;

            return $this->__sendError( __('app.validation_error'), $errors);
        }
    }

    /**
     * @param $data
     * @param $response_code
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function __sendResponse($data, $response_code, $message)
    {
        $paginate    = $this->_paginate($data);

        if( $this->__collection ){
            $apiResource = "\App\Http\Resources\\$this->_apiResource";
            if( !$this->__is_collection ){
                $response_data = new $apiResource($data);
            }else{
                $response_data = $apiResource::collection($data);
            }
        }else{
            $response_data = $this->__is_paginate ? $data->items() : $data;
        }

        $response = [
            'code'       => $response_code,
            'data'       => $response_data,
            'message'    => $message,
            'pagination' => $paginate,
        ];

        return response()->json($response, $response_code);
    }

    /**
     * @param $data
     * @return array
     */
    private function _paginate($obj_model)
    {
        if(!$this->__is_paginate){
            $response['links'] = [
                "first" => null,
                "last" => null,
                "prev" =>  null,
                "next" =>  null
            ];

            $response['meta'] = [
                "current_page" =>  1,
                "from" =>  1,
                "last_page" =>  0,
                "to" =>  0,
                "total" =>  is_object($obj_model) ? 1 : count($obj_model)
            ];

            return $response;
        }

        $response['links'] = [
            "first" => $obj_model->url($obj_model->firstItem()),
            "last" => $obj_model->url($obj_model->lastPage()),
            "prev" =>  $obj_model->previousPageUrl(),
            "next" =>  $obj_model->nextPageUrl()
        ];

        $response['meta'] = [
            "current_page" =>  $obj_model->currentPage(),
            "from" =>  $obj_model->firstItem(),
            "last_page" =>  $obj_model->lastPage(),
            "to" =>  $obj_model->lastItem(),
            "total" =>  $obj_model->total()
        ];

        return $response;

    }

    /**
     * @param $error
     * @param array $errorMessages
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function __sendError($error, $errorMessages = [], $code = 400)
    {
        $response = [
            'code'    => $code,
            'message' => $error,
            'data'    => $errorMessages
        ];

        return response()->json($response, $code);
    }

    /**
     * This function is used file upload using dropzone
     * @param Request $request
     */
    public function dropZoneUploader(Request $request)
    {
        if ($request->hasFile('file')) {
            $queue_id = $request->input('queue_id');
            // move upload file
            $filePath = uploadMedia('dropzone',$request->file('file'));
            $file = $request->file('file');
            $data = [
                'filename'    => explode('/',$filePath)[1],
                'original_filename' => $file->getClientOriginalName(),
                'file_url'    => Storage::url($filePath),
                'mime_type'   => $file->getClientMimeType(),
                'queue_id'    => $queue_id,
                'data_packet' => json_encode($_FILES),
                'created_at'  => Carbon::now()
            ];
            DropzoneUploader::create($data);
        }
    }

    /**
     * This function is used for delete dropzone file
     * @param Request $request
     */
    public function dropZoneDeleteFIle(Request $request)
    {
        $filename = $request->input('filename');
        $queue_id = $request->input('queue_id');
        DropzoneUploader::where('queue_id',$queue_id)->where('original_filename',$filename)->forceDelete();
        if(file_exists(base_path(config('constants.DROPZONE_FILE_PATH') . $filename ))){
            unlink(base_path(config('constants.DROPZONE_FILE_PATH') . $filename ));
        }
    }

    /**
     * This function is for delete entity record
     * @param {object} $request
     */
    public function deleteRecord(Request $request)
    {
        $table = $request->input('table');
        $id    = $request->input('id');
        DB::table($table)->where($table . '_id',$id)->delete();
        exit;
    }

    public function internalCall($url,$method,$params = [], $user_token = '')
    {
        $server  = $_SERVER;  
        $server['HTTP_HOST'] = \URL::to('/');
        $request = Request::create(\URL::to($url), $method, $params,[],[],$server);
        $request->headers->set('token', 'api.Pd*!(5675');
        $request->headers->set('user-token', $user_token);
        $response     = app()->handle($request);
        $responseBody = $response->getContent();
        return json_decode($responseBody);
    }
}
