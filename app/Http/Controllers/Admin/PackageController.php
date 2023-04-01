<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPackage;
use Illuminate\Support\Facades\URL;
use Validator;

class PackageController extends Controller
{
    public function index()
    {
        $data['packages'] = SubscriptionPackage::getAllPackages();
        return view('admin.package.index',$data);
    }
}