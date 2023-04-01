@if( count($teamPerformanceData) )
    @foreach( $teamPerformanceData as $team_name => $results)
        @php
            $total_pins = [];
            $kpi_groups = [];
        @endphp
        <div class="row territory_container">
            <div class="col-12 col-md-12 col-lg-6  col-xl-3 mb-3" id="territory_kpi_group_datatable">
                <div class="filter-box2" style="height:380px;overflow-y: auto;">
                    <p class="text-uppercase ft-14">{{ $team_name }}</p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Universe {{ $results['kpi_group_chart'][0]->universe }}</th>
                            <th scope="col">Converage Rate <span class="converage_rate"></span>%</th>
                            <th scope="col">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $results['kpi_group_chart'] as $team_data )
                            @php
                                $total_pins[] = $team_data->total;
                                $kpi_groups[$team_data->kpi_group] = $team_data->total;
                            @endphp
                            <tr>
                                <td colspan="2">
                                <img class="pr-2" src="{{ URL::to('assets/images/icon-'.basename($territory_data->image_url)) }}" alt="{{ get_user()->name }}">
                                  <!-- <span class="fa fa-map-marker pr-2"></span> -->
                                  <span>{{ $team_data->kpi_group }}</span>
                                </td>
                                <td>{{ $team_data->total }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" class="converage_rate_value" value="{{ round(array_sum($total_pins) / $results['kpi_group_chart'][0]->universe,2) }}">
                </div>
            </div>
            @php
                extract($kpi_groups);
            @endphp
            <div class="col-12 col-md-12 col-lg-6  col-xl-3 mb-3" id="territory_metric_data_table">
                <div class="filter-box2" style="height:380px;overflow-y: auto;">
                    <p class="text-uppercase ft-14">{{ $team_name }}</p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Universe {{ $results['kpi_group_chart'][0]->universe }}</th>
                            <th scope="col">Converage Rate <span class="converage_rate"></span>%</th>
                            <th scope="col">Area Goal</th>
                            <th scope="col">Area Actual</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if( count($results['matric_chart']) )
                            @foreach( $results['matric_chart'] as $metric )
                                <tr>
                                    <td colspan="2">
                                    <img class="pr-2" src="{{ asset('assets/images/map-icon.png') }}" alt="{{ get_user()->name }}">
                                        <!-- <span class="fa fa-map-marker pr-2"></span>  -->
                                        <span>{{ !empty($metric->custom_metric_title) ? $metric->custom_metric_title : $metric->metric_title }}</span></td>
                                    <td>{{ $metric->value }}%</td>
                                    @if( $metric->metric_title == 'Reach Rate' )
                                        <td>{{ !empty($contact) && !empty($attempts) ? round( ($contact/$attempts) * 100 ) : '0'  }}%</td>
                                    @elseif( $metric->metric_title == 'Inspection Close Rate')
                                        <td>{{ !empty($leads) && !empty($contact) ? round( ($leads/$contact) * 100 ) : '0'  }}%</td>
                                    @elseif( $metric->metric_title == 'Damage Rate')
                                        <td>{{ !empty($prospects) && !empty($leads) ? round( ($prospects/$leads) * 100 ) : '0'  }}%</td>
                                    @elseif( $metric->metric_title == 'No Damage Rate')
                                        <td>{{ !empty($not_qualified) && !empty($prospects) ? round( ($not_qualified/$prospects) * 100 ) : '0'  }}%</td>
                                    @elseif( $metric->metric_title == 'File Rate')
                                        <td>{{ !empty($pre_qualified) && !empty($prospects) ? round( ($pre_qualified/$prospects) * 100 ) : '0'  }}%</td>
                                    @elseif( $metric->metric_title == 'Buy Rate')
                                        <td>{{ !empty($approved) && !empty($pre_qualified) ? round( ($approved/$pre_qualified) * 100 ) : '0'  }}%</td>
                                    @elseif( $metric->metric_title == 'Denied Rate')
                                        <td>{{ !empty($not_approved) && !empty($pre_qualified) ? round( ($not_approved/$pre_qualified) * 100 ) : '0'  }}%</td>
                                    @elseif( $metric->metric_title == 'Lost Rate')
                                        <td>{{ !empty($lost_opportunity) && !empty($approved) && !empty($pre_qualified) ? round( ($lost_opportunity/($approved + $pre_qualified)) * 100 ) : '0'  }}%</td>
                                    @elseif( $metric->metric_title == 'Contract Close Rate')
                                        <td>
                                            {{ !empty($sales) && !empty($approved) && !empty($sales_opportunities) && !empty($approved-$sales_opportunities) ? round( ($sales/($approved-$sales_opportunities)) * 100 ) : '0'  }}%
                                        </td>
                                    @else
                                        <td>0%</td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">No Data Found</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6  col-xl-3 mb-3" id="territory_kpi_group_bar_chart">
                <div class="filter-box2" style="height:380px;overflow-y: auto;">
                    <p class="text-uppercase ft-14">{{ $team_name }}</p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Universe {{ $results['kpi_group_chart'][0]->universe }}</th>
                            <th scope="col">Coverage Rate <span class="converage_rate"></span>%</th>
                        </tr>
                        </thead>
                        <tbody>      
                            @if( count($results['kpi_group_chart']) )
                                @foreach( $results['kpi_group_chart'] as $kpiTarget )
                                    <tr>
                                        <td>
                                            @if( !empty($kpiTarget->image_url) )
                                                <!-- <span class="fa fa-map-marker pr-2"></span> -->
                                                <img class="pr-2" src="{{ asset('assets/images/icon-'.basename($kpiTarget->image_url)) }}" alt="{{ get_user()->name }}">
                                            @else
                                            <img class="pr-2" src="{{ asset('assets/images/map-icon.png') }}" alt="{{ get_user()->name }}">
                                                <!-- <span class="fa fa-map-marker pr-2"></span> -->
                                            @endif    
                                            <span class="ft-12">{{ $kpiTarget->kpi_group }}</span>
                                        </td>
                                        <td style="width:60%">
                                            <div data-toggle="tooltip" data-placement="top" title="{{ $kpiTarget->kpi_percent }}%" class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width: {{ $kpiTarget->kpi_percent }}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2">No Data Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6  col-xl-3 " id="territory_metric_bar_chart">
                <div class="filter-box2" style="height:380px;overflow-y: auto;">
                    <p class="text-uppercase ft-14">{{ $team_name }}</p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Universe {{ $results['kpi_group_chart'][0]->universe }}</th>
                            <th scope="col">Coverage Rate <span class="converage_rate"></span>%</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if( count($results['matric_chart']) )
                            @foreach( $results['matric_chart'] as $metric )
                                <tr>
                                    <td>
                                    <img class="pr-2" src="{{ asset('assets/images/map-icon.png') }}" alt="{{ get_user()->name }}">
                                        <!-- <span class="fa fa-map-marker pr-2"></span>  -->
                                        <span>{{ !empty($metric->custom_metric_title) ? $metric->custom_metric_title : $metric->metric_title }}</span></td>
                                    <td>
                                        @if( $metric->metric_title == 'Reach Rate' )
                                            <div data-toggle="tooltip" data-placement="top" title="{{ !empty($contact) && !empty($attempts) ? round( ($contact/$attempts) * 100 ) : '0'  }}%" class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width:{{ !empty($contact) && !empty($attempts) ? round( ($contact/$attempts) * 100 ) : '0'  }}%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        @elseif($metric->metric_title == 'Inspection Close Rate')
                                            <div data-toggle="tooltip" data-placement="top" title="{{ !empty($leads) && !empty($contact) ? round( ($leads/$contact) * 100 ) : '0'  }}%" class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width:{{ !empty($leads) && !empty($contact) ? round( ($leads/$contact) * 100 ) : '0'  }}%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        @elseif( $metric->metric_title == 'Damage Rate')
                                            <div data-toggle="tooltip" data-placement="top" title="{{ !empty($prospects) && !empty($leads) ? round( ($prospects/$leads) * 100 ) : '0'  }}%" class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width:{{ !empty($prospects) && !empty($leads) ? round( ($prospects/$leads) * 100 ) : '0'  }}%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        @elseif( $metric->metric_title == 'No Damage Rate')
                                            <div data-toggle="tooltip" data-placement="top" title="{{ !empty($not_qualified) && !empty($prospects) ? round( ($not_qualified/$prospects) * 100 ) : '0'  }}%" class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width:{{ !empty($not_qualified) && !empty($prospects) ? round( ($not_qualified/$prospects) * 100 ) : '0'  }}%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        @elseif( $metric->metric_title == 'File Rate')
                                            <div data-toggle="tooltip" data-placement="top" title="{{ !empty($pre_qualified) && !empty($prospects) ? round( ($pre_qualified/$prospects) * 100 ) : '0'  }}%" class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width:{{ !empty($pre_qualified) && !empty($prospects) ? round( ($pre_qualified/$prospects) * 100 ) : '0'  }}%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        @elseif( $metric->metric_title == 'Buy Rate')
                                            <div data-toggle="tooltip" data-placement="top" title="{{ !empty($approved) && !empty($pre_qualified) ? round( ($approved/$pre_qualified) * 100 ) : '0'  }}%" class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width:{{ !empty($approved) && !empty($pre_qualified) ? round( ($approved/$pre_qualified) * 100 ) : '0'  }}%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        @elseif( $metric->metric_title == 'Denied Rate')
                                            <div data-toggle="tooltip" data-placement="top" title="{{ !empty($not_approved) && !empty($pre_qualified) ? round( ($not_approved/$pre_qualified) * 100 ) : '0'  }}%" class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width:{{ !empty($not_approved) && !empty($pre_qualified) ? round( ($not_approved/$pre_qualified) * 100 ) : '0'  }}%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        @elseif( $metric->metric_title == 'Lost Rate')
                                            <div data-toggle="tooltip" data-placement="top" title="{{ !empty($lost_opportunity) && !empty($approved) && !empty($pre_qualified) ? round( ($lost_opportunity/($approved + $pre_qualified)) * 100 ) : '0'  }}%" class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width:{{ !empty($lost_opportunity) && !empty($approved) && !empty($pre_qualified) ? round( ($lost_opportunity/($approved + $pre_qualified)) * 100 ) : '0'  }}%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        @elseif( $metric->metric_title == 'Contract Close Rate')
                                            <div data-toggle="tooltip" data-placement="top" title="{{ !empty($sales) && !empty($approved) && !empty($sales_opportunities) && !empty($approved-$sales_opportunities) ? round( ($sales/($approved-$sales_opportunities)) * 100 ) : '0'  }}%" class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width:{{ !empty($sales) && !empty($approved) && !empty($sales_opportunities) && !empty($approved-$sales_opportunities) ? round( ($sales/($approved-$sales_opportunities)) * 100 ) : '0'  }}%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        @else
                                            <div data-toggle="tooltip" data-placement="top" title="0%" class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width:0%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">No Data Found</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-md-12">
        <div class="alert alert-info">
            No Data Found
        </div>
    </div>
@endif