<?php

namespace App\Http\Controllers\Admin;

use App\Models\CompanySalesPlan;
use App\Models\KpiGroups;
use App\Http\Controllers\Controller;
use App\Models\Metric;
use Illuminate\Http\Request;
use Validator;

class CompanySalesController extends Controller
{
    public function index(Request $request)
    {
        if( $request->isMethod('post') )
            return self::_saveCompanySalesPlan($request);

        $data['metrices']        = Metric::getMetrices(get_user()->userCompany->id);
        $data['companySalePlan'] = CompanySalesPlan::getCompanySalePlan();
        $data['kpi_groups']      = KpiGroups::getKpiGroup();
        return view('admin.company_sales.index',$data);
    }

    private function _saveCompanySalesPlan($request)
    {
        CompanySalesPlan::saveCompanyPlan($request->all());
        return redirect()->back()->with('success','Company Sales Plan added successfully');
    }
}