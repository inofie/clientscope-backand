<?php
namespace App\Http\Controllers\Admin;

use App\Models\Territory;
use App\Models\User;
use App\Models\UserKpiTargetSale;
use App\Models\UserPin;
use App\Http\Controllers\Controller;
use App\Models\UserPinStatus;
use Illuminate\Http\Request;
use Validator;

class DashboardController extends Controller
{
    public function index()
    {
        $user = get_user()->toArray();
        if( !empty($user['user_company']) ){
            $data['territories'] = Territory::getTerritories($user['user_company']['company_user_id']);
        } else {
            $data['territories'] = [];
        }
        
        if( $user['user_role']['slug'] == 'super-admin' ){
            return view('admin.dashboard.master-admin-dashboard',$data);
        } else {
            return view('admin.dashboard.my-dashboard',$data);
        }
    }

    public function topWidget()
    {
        $totalAttempt     = UserPin::getTotalAttempts(get_user()->id);
        $getTotalContacts = UserPin::getTotalContacts(get_user()->id);
        $getTotalLeads    = UserPin::getTotalLeads(get_user()->id);
        $getTotalSales    = UserPin::getTotalSales(get_user()->id);
        $getReknock       = UserPin::getReknock(get_user()->id);
        $getTotalContacts = $getTotalContacts > 1 ? $getTotalContacts : 1;
        $getTotalLeads    = $getTotalLeads > 1 ? $getTotalLeads : 1;
        $getTotalSales    = $getTotalSales > 1 ? $getTotalSales : 1;

        $data['attempt_per_contact'] = $totalAttempt > 0 ? round( $totalAttempt / $getTotalContacts ) : '--';
        $data['attempt_per_lead']    = $totalAttempt > 0 ? round( $totalAttempt / $getTotalLeads ) : '--';
        $data['attempt_per_sale']    = $totalAttempt > 0 ? round( $totalAttempt / $getTotalSales ) : '--';
        $data['reknocked']           = !empty($getReknock->total) > 0 ? $getReknock->total : '--';
        return response()->json($data);
    }

    public function getSRKpiTargets()
    {
        $getUserAnnualKpiTarget  = UserKpiTargetSale::getUserAnnualKpiTarget(get_user()->id);
        $getUserMonthlyKpiTarget = UserKpiTargetSale::getUserMonthlyKpiTarget(get_user()->id);
        $getUserWeeklyKpiTarget  = UserKpiTargetSale::getUserWeeklyKpiTarget(get_user()->id);
        $data = [
            'annual_api_target'  => view('admin.ajax-component.kpi_annual_target_sale',['data' => $getUserAnnualKpiTarget])->render(),
            'monthly_api_target' => view('admin.ajax-component.kpi_monthly_target_sale',['data' => $getUserMonthlyKpiTarget])->render(),
            'weekly_api_target'  => view('admin.ajax-component.kpi_weekly_target_sale',['data' => $getUserWeeklyKpiTarget])->render(),
        ];
        return response()->json($data);
    }

    public function getLeaderBoard()
    {
        $getLeaderBoard = User::getLeaderBoard(get_user()->id,6);
        $view = view('admin.ajax-component.top-leader-board',['data' => $getLeaderBoard ])->render();
        return response()->json(['leader_board' => $view ]);
    }

    public function getUserKnockTime()
    {
        $data    = [];
        $records = UserPin::getUserPinCountByHours(get_user()->id,get_user()->userCompany->id);
        if( count($records) ){
            $max_number = 0;
            foreach($records as $record){
                if($record->total > $max_number) {
                    $max_number = $record->total;
                }
            }
            foreach($records as $record){
                $data['hours'][] = date( 'h:i A', strtotime($record->hour . ':00'));
                $data['total'][] = (int)(($record->total * 100)/$max_number);
            }
        }
        return response()->json($data);
    }

    public function getUserKnockDay()
    {
        $data    = [];
        $records = UserPin::getUserPinCountByDayName(get_user()->id,get_user()->userCompany->id);
        if( count($records) ){
            $max_number = 0;
            foreach($records as $record){
                if($record->total > $max_number) {
                    $max_number = $record->total;
                }
            }
            foreach($records as $record){
                $data['day_name'][] = $record->day_name;
                $data['total'][]    = (int)(($record->total * 100)/$max_number);
            }
        }
        return response()->json($data);
    }

    public function getKpiGroupPerformance(Request $request)
    {
        $totalUniverse = Territory::getTerritoryUniverseByUserId(get_user()->id);
        $totalUniverse = !empty($totalUniverse->universe) ? $totalUniverse->universe : 0;
        $records       = UserPin::getUserPinByKpiGroup(get_user()->id,$request->all());
        //sum of pin
        $sum_of_pin = [];
        if( count($records) ){
            foreach($records as $record){
                $sum_of_pin[] = $record->total_pin;
            }
        }
        $sum_of_pin       = count($sum_of_pin) ? array_sum($sum_of_pin) : 0;
        $converage_rate   = $sum_of_pin < 1 && $totalUniverse > 0 ? round( $sum_of_pin / $totalUniverse,2) : 0;
        $data['data']     = $records;
        $data['universe'] = $totalUniverse;
        $data['converage_rate'] = $converage_rate;
        $view             = view('admin.ajax-component.kpi_group_performance',$data)->render();
        return response()->json($view);
    }

    public function getMetricPerformance()
    {
        $data = User::getUserMetricByUserPin(get_user()->id);
        $data['metrics'] =  UserPinStatus::getCompanyMatrics();
        $view    = view('admin.ajax-component.user_metric_performance',$data)->render();
        return response()->json($view);
    }

    public function territoryPerforamance(Request $request)
    {
        $data['userMetric']           = User::getUserMetric(get_user()->id);
        $data['territoryData']        = $this->userTerritoryPerformance($request->all());
        $territory_ids= [];
        if( count( $data['territoryData']) ){
            foreach( $data['territoryData'] as $territory )
            {
                if( count($territory['data']) ){
                    $territory_ids[] = $territory['data'][0]->id;
                }
            }
        }
        $data['userAnnualKpiTarget']  = UserKpiTargetSale::getUserAnnualKpiTarget(get_user()->id,$territory_ids);
        $view = view('admin.ajax-component.territory_performance',$data)->render();
        return response()->json($view);
    }

    public function getTeamPerformance(Request $request)
    {
        $records = $this->userPinTeamPerformance($request->all());
        $data['teamPerformanceData']  = $records;
        $view    = view('admin.ajax-component.user_team_performance', $data)->render();
        return response()->json($view);
    }

    private function userPinTeamPerformance($params = [])
    {
        $data = [];
        $getTeamPerformance = UserPin::userPinTeamPerformance(get_user()->userCompany->id,$params);
        $getTeamMetricChart = UserPin::getTeamMetricChart(get_user()->userCompany->id,$params);
        if( count($getTeamPerformance) ){
            foreach($getTeamPerformance as $teamPerformance){
                $data[$teamPerformance->team_name]['kpi_group_chart'][] = $teamPerformance;
            }
            foreach( $getTeamMetricChart as $teamMetricChart ){
                $data[$teamPerformance->team_name]['matric_chart'][] = $teamMetricChart;
            }
        }
        return $data;
    }

    private function userTerritoryPerformance($params = [])
    {
        $data = [];
        $records = UserPin::userTerritoryPerformance(get_user()->id,$params);
        if( count($records) ) {
            foreach( $records as $record ){
                $data[$record->title]['universe'][] = $record->universe;
                $data[$record->title]['data'][] = $record;
            }
        }
        return $data;
    }
}