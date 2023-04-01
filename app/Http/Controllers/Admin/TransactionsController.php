<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Validator;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index(Request $request)
    {
        $data['transactions'] = Transaction::getTransaction($request->all());
        return view('admin.transaction.index',$data);
    }
}