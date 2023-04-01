<?php

namespace App\Models;

trait RestModel
{
    protected $__is_paginate = true;
    /**
     * This function is used for save record
     *
     * @param  {array} $data
     * @param  {object} $request
     * @return Response
     */
    public function createRecord($request,$data = [])
    {
        if(!empty($data)){
            //before create record request hook
            if(method_exists($this,'hook_before_add'))
                $this->hook_before_add($data);
            // get the table columns
            $data = $this->checkValues($this->fillable,$data);
            //check empty values
            if(!empty($data) && is_array($data)){
                foreach($data as $key => $value){
                    //ignore empty values
                    if(!isset($value) && empty($value)){
                        unset($data[$key]);
                    }
                }
            }
            //create record
            $record = self::create($data);
            //after create record request hook
            if(method_exists($this,'hook_after_add'))
                $this->hook_after_add($record);
            //set response
            return self::getRecordById($request,$record->{$this->primaryKey});
        }
    }

    private function checkValues($db_column,$post_data)
    {
        $data = [];
        foreach ($post_data as $key => $val){
            if(in_array($key,$db_column)){
                $data[$key] = $val;
            }
        }
        return $data;
    }

    /**
     * This function is used for get record
     *
     * @param {object} $request
     * @param {array} $filterParams (optional)
     * @return Response
     */
    public function getRecords($request)
    {
        $query = self::select();
        if(method_exists($this,'hook_query_index'))
            $this->hook_query_index($query,$request);

        $limit = $request->input('limit',config('constants.PAGINATION_LIMIT'));
        if( isset($this->__is_paginate) && $this->__is_paginate != false)
            $data = $query->orderBy($request->input('sort_column',$this->table . '.' .$this->primaryKey),$request->input('sort_order','desc'))->paginate($limit);
        else
            $data = $query->orderBy($request->input('sort_column',$this->table . '.' .$this->primaryKey),$request->input('sort_order','desc'))->take(1000)->get();
            
        return $data;
    }

    /**
     * This function is used for get record by id
     *
     * @param {object} $request
     * @param  {int} $id = (optional)
     * @return Response
     */
    public function getRecordById($request, $id = '')
    {
        $query = self::select();
        if(method_exists($this,'hook_query_index'))
            $this->hook_query_index($query,$request,$id);

        $data = $query->where($this->table . '.id',$id)->first();
        return $data;
    }

    /**
     * This function is used for update record
     *
     * @param {object} $request
     * @param {int} $id
     * @param {array} $data
     * @return Response
     */
    public function updateRecord($request, $id, $data=[])
    {
        if(!empty($data)){
            //before update record request hook
            if(method_exists($this,'hook_before_edit'))
                $this->hook_before_edit($request, $id, $data);
            // get the table columns
            $data = $this->checkValues($this->fillable,$data);
            //check empty values
            if(!empty($data) && is_array($data)){
                foreach($data as $key => $value){
                    //ignore empty values
                    if(!isset($value) && empty($value)){
                        unset($data[$key]);
                    }
                }
            }
            //update record
            self::where('id',$id)->update($data);
            //get record
            $query = self::select();
            if(method_exists($this,'hook_query_index'))
                $this->hook_query_index($query,$request, $id);

            $record = $query->where($this->table . '.id',$id)->first();
            //after create record request hook
            if(method_exists($this,'hook_after_edit'))
                $this->hook_after_edit($request, $record);
        }

        return self::getRecordById($request,$id);
    }

    /**
     * This function is used for delete record
     *
     * @param  {int} $id
     * @return Response
     */
    public function deleteRecord($request, $id)
    {
        //before request hook
        if(method_exists($this,'hook_before_delete'))
            $this->hook_before_delete($request, $id);
        //get record
        $records = self::whereIn('id',explode(',',$id))->get();
        //delete record
        self::whereIn('id',explode(',',$id))->delete();
        //after request hook
        if(method_exists($this,'hook_after_delete'))
            $this->hook_after_delete($request, $records);

        return true;
    }
}
