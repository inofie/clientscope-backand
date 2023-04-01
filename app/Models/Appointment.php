<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes, RestModel;

    /**
     * The attributes is used for define database table.
     *
     * @var string
     */
    protected $table = 'appointment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'creator_user_id', 'user_pin_id', 'title', 'assignee_user_id', 'start_datetime', 'end_datetime', 'duration', 'notes', 'status_id',
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function creatorUser()
    {
        return $this->belongsTo('App\Models\User','creator_user_id','id');
    }

    public function assigneeUser()
    {
        return $this->belongsTo('App\Models\User','assignee_user_id','id');
    }

    public function userPin()
    {
        return $this->belongsTo('App\Models\UserPin','user_pin_id','id')
            ->select('user_pin.*')
            ->selectRaw('ups.title AS pin_status_title')
            ->leftJoin('user_pin_status AS ups','ups.id','=','user_pin.pin_status_id');
    }

    /*
   | ----------------------------------------------------------------------
   | Hook for manipulate query of index result
   | ----------------------------------------------------------------------
   | @query   = current sql query
   | @request = laravel http request class
   |
   */
    public function hook_query_index(&$query,$request, $id = '')
    {
        //Your code here
        $query->with('userPin','assigneeUser','creatorUser');
        $query->select('appointment.*');
		$query->join('user_pin AS up','up.id','=','appointment.user_pin_id');
        if( empty($id) ){
            if( !empty($request['user_id']) ){
                $query->whereIn('appointment.assignee_user_id', explode(',', $request['user_id']));
            }else{
                $query->where('appointment.assignee_user_id',$request['user']->id);
            }
        }
        if( !empty($request['date']) ){
            $date = date('Y-m-d', strtotime($request['date']));
            $query->whereRaw("DATE(appointment.start_datetime) = '$date' ");
        }
        //$query->orderBy('appointment.start_datetime','asc');
		$query->whereNull('up.deleted_at');
        $query->groupBy('appointment.id');
    }

    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate data input before add data is execute
    | ----------------------------------------------------------------------
    | @arr
    |
    */
    public function hook_before_add(&$postdata)
    {
        $postdata['creator_user_id']    = $postdata['user']->id;
        $postdata['title']              = $postdata['appointment_title'];
        $postdata['assignee_user_id']   = $postdata['assign_to_calender'];
        $postdata['notes']              = $postdata['appointment_notes'];
        $postdata['start_datetime']     = date('Y-m-d H:i:s',strtotime($postdata['start_datetime']));
        $postdata['end_datetime']       = date('Y-m-d H:i:s',strtotime($postdata['end_datetime']));
        $postdata['status_id']          = get_status_id('active');
        $postdata['created_at']         = Carbon::now();
    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after add public static function called
    | ----------------------------------------------------------------------
    | @record
    |
    */
    public function hook_after_add($record)
    {
        //Your code here
    }

    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate data input before update data is execute
    | ----------------------------------------------------------------------
    | @request  = http request object
    | @postdata = input post data
    | @id       = current id
    |
    */
    public function hook_before_edit($request, $id, &$postData)
    {
        $postData['title']              = $postData['appointment_title'];
        $postData['assignee_user_id']   = $postData['assign_to_calender'];
        $postData['notes']              = $postData['appointment_notes'];
        $postData['start_datetime']     = $postData['start_datetime'];
        $postData['end_datetime']       = $postData['end_datetime'];
        $postData['updated_at']         = Carbon::now();
    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after edit public static function called
    | ----------------------------------------------------------------------
    | @request      = Http request object
    | @$record      = update record
    |
    */
    public function hook_after_edit($request, $record) {
        //Your code here
    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command before delete public static function called
    | ----------------------------------------------------------------------
    | @request  = Http request object
    | @id       = current id
    |
    */
    public function hook_before_delete($request, $id) {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after delete public static function called
    | ----------------------------------------------------------------------
    | @$request       = Http request object
    | @record         = Current record
    |
    */
    public function hook_after_delete($id,$record) {
        //Your code here
    }

    public static function createAppointment($params)
    {
        if( !empty($params['appointment_title'][0]) )
        {
            //delete old appointment
            self::where('user_pin_id',$params['user_pin_id'])->forceDelete();
            //add new appointment
            for($i=0; $i < count($params['appointment_title']); $i++)
            {
                $data[] = [
                    'creator_user_id'  => $params['user']->id,
                    'user_pin_id'      => $params['user_pin_id'],
                    'title'            => $params['appointment_title'][$i],
                    'assignee_user_id' => $params['assign_to_calender'][$i],
                    'start_datetime'   => date('Y-m-d H:i:s',strtotime($params['start_datetime'][$i])),
                    'end_datetime'     => date('Y-m-d H:i:s',strtotime($params['end_datetime'][$i])),
                    'duration'         => $params['duration'][$i],
                    'notes'            => $params['appointment_notes'][$i],
                    'status_id'        => get_status_id('active'),
                    'created_at'       => Carbon::now(),
                ];
            }
            self::insert($data);
        }
    }
}