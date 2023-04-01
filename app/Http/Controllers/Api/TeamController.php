<?php

namespace App\Http\Controllers\Api;

use App\Models\Team;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\RestController;

class TeamController extends RestController
{
    public $_request,$_apiResource ;

    public function __construct(Request $request)
    {
        parent::__construct('Team');
        $this->_request     = $request;
        $this->_apiResource = 'Team';
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
                    'title'       => 'required',
                    'image_url'   => 'image',
                    'description' => 'string',
                ]);
                break;
            case 'PUT':
                $validator = Validator::make($this->_request->all(), [
                    '_method'     => 'required|in:PUT',
                    'title'       => 'required',
                    'image_url'   => 'image',
                    'description' => 'string',
                    'token'    => [
                        Rule::exists('team')->where(function($query) use ($id){
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
        $checkRecord = Team::where('user_id',$request['user']->id)
                            ->where('title',$request['title'])
                            ->count();
        if( $checkRecord ){
            $this->__is_error = true;
            return $this->__sendError('Validation Error',['message' => 'Title has already been taken'], 400);
        }
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
    public function beforeUpdateLoadModel($request,$id)
    {
        $checkRecord = Team::where('user_id',$request['user']->id)
            ->where('title',$request['title'])
            ->where('id','!=',$id)
            ->count();
        if( $checkRecord ){
            $this->__is_error = true;
            return $this->__sendError('Validation Error',['message' => 'Title has already been taken'], 400);
        }
    }

    /**
     * @param $request
     */
    public function beforeDestroyLoadModel($request,$id)
    {
        $checkRecord = Team::where('user_id',$request['user']->id)
                        ->where('id',$id)
                        ->count();
        if( $checkRecord == 0 ){
            $this->__is_error = true;
            return $this->__sendError('Validation Error',['message' => 'Invalid team id'], 400);
        }
    }
}