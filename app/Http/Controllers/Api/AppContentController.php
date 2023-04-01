<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlaceAnOffer;
use App\Models\Trip;
use Illuminate\Http\Request;
use Validator;

class AppContentController extends Controller
{

    public function __construct()
    {

    }

    public function index($identifier)
    {
        $data['content'] = \DB::table('app_content')
                                ->where('identifier',$identifier)
                                ->whereNull('deleted_at')
                                ->first();
        return view('app-content',$data);
    }
}