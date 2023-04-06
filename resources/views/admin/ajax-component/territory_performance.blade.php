<style>
    .requires-no-scroll{
    position:absolute;
    top: 0.5px;  
}
/* .tableFixHead
{
    overflow: auto;
    height: 100px;
}
.tableFixHead thead th
{
    position: sticky;
    top: 0; z-index: 1;
    background-color:white;
} */
</style>
@if( count($territoryData) )
    @foreach( $territoryData as $territory_name => $results)
        @php
            $total_pins = [];
            $kpi_groups = [];
        @endphp
        <div class="row territory_container">
            <div class="col-12 col-md-12 col-lg-6  col-xl-3 mb-3" id="territory_kpi_group_datatable">
                <div class="filter-box2" style="height:380px;overflow-y: auto;">
                <div class="requires-no-scroll">
                    <p class="font-semi-bold font-18 color-black">{{ $territory_name }}</p>
                </div>
                    <table class="table tableFixHead">
                        <thead>
                        <tr>
                            <th scope="col">Universe {{ $results['universe'][0] }}</th>
                            <th scope="col">Converage Rate <span class="converage_rate"></span>%</th>
                            <th scope="col">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $results['data'] as $territory_data )
                            @php
                                $total_pins[] = $territory_data->total_pin;
                                $kpi_groups[$territory_data->kpi_group_slug] = $territory_data->total_pin;
                            @endphp
                            <tr>
                                <td colspan="2">
                                    <img style="width: 15px; height:15px; object-fit:contain;" src="{{ URL::to('assets/images/icon-'.basename($territory_data->image_url)) }}">
                                    {{-- <img src="{{ asset('assets/images/map-icon.png')}}" alt="" class="map-icon">     --}}
                                  <span>{{ $territory_data->kpi_group }}</span>
                                </td>
                                <td>{{ $territory_data->total_pin }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" class="converage_rate_value" value="{{ !empty($results['universe'][0]) ? round(array_sum($total_pins) / $results['universe'][0],2) : 0 }}">
                </div>
            </div>
            @php
                extract($kpi_groups);
            @endphp
            <div class="col-12 col-md-12 col-lg-6  col-xl-3 mb-3" id="territory_metric_data_table">
                <div class="filter-box2" style="height:380px;overflow-y: auto;">
                <div class="requires-no-scroll">
                    <p class="font-semi-bold font-18 color-black">{{ $territory_name }}</p>
                </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Universe {{ $results['universe'][0] }}</th>
                            <th scope="col">Converage Rate <span class="converage_rate"></span>%</th>
                            <th scope="col">Area Goal</th>
                            <th scope="col">Area Actual</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if( count($userMetric) )
                            @foreach( $userMetric as $metric )
                                <tr>
                                    <td colspan="2">
                                        <!-- <span class="fa fa-map-marker pr-2"></span>  -->
                                        <img class="pr-2" src="{{ asset('assets/images/map-icon.png') }}" alt="{{ get_user()->name }}">
                                        <span>{{ !empty($metric->custom_metric_title) ? $metric->custom_metric_title : $metric->title }}</span></td>
                                    <td>{{ $metric->value }}%</td>
                                    @if( $metric->title == 'Reach Rate' )
                                        <td>{{ !empty($contact) && !empty($attempts) ? round( ($contact/$attempts) * 100 ) : '0'  }}%</td>
                                    @elseif( $metric->title == 'Inspection Close Rate')
                                        <td>{{ !empty($leads) && !empty($contact) ? round( ($leads/$contact) * 100 ) : '0'  }}%</td>
                                    @elseif( $metric->title == 'Damage Rate')
                                        <td>{{ !empty($prospects) && !empty($leads) ? round( ($prospects/$leads) * 100 ) : '0'  }}%</td>
                                    @elseif( $metric->title == 'No Damage Rate')
                                        <td>{{ !empty($not_qualified) && !empty($prospects) ? round( ($not_qualified/$prospects) * 100 ) : '0'  }}%</td>
                                    @elseif( $metric->title == 'File Rate')
                                        <td>{{ !empty($pre_qualified) && !empty($prospects) ? round( ($pre_qualified/$prospects) * 100 ) : '0'  }}%</td>
                                    @elseif( $metric->title == 'Buy Rate')
                                        <td>{{ !empty($approved) && !empty($pre_qualified) ? round( ($approved/$pre_qualified) * 100 ) : '0'  }}%</td>
                                    @elseif( $metric->title == 'Denied Rate')
                                        <td>{{ !empty($not_approved) && !empty($pre_qualified) ? round( ($not_approved/$pre_qualified) * 100 ) : '0'  }}%</td>
                                    @elseif( $metric->title == 'Lost Rate')
                                        <td>{{ !empty($lost_opportunity) && !empty($approved) && !empty($pre_qualified) ? round( ($lost_opportunity/($approved + $pre_qualified)) * 100 ) : '0'  }}%</td>
                                    @elseif( $metric->title == 'Contract Close Rate')
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
                <div class="requires-no-scroll">
                    <p class="font-semi-bold font-18 color-black">{{ $territory_name }}</p>
                </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Universe {{ $results['universe'][0] }}</th>
                            <th scope="col">Coverage Rate <span class="converage_rate"></span>%</th>
                        </tr>
                        </thead>
                        <tbody>      
                            @if( count($userAnnualKpiTarget) )
                                @foreach( $userAnnualKpiTarget as $kpiTarget )
                                    <tr>
                                        <td>
                                            @if( !empty($kpiTarget->status_image_url) )
                                                <img class="pr-2" src="{{ asset('assets/images/icon-'.basename($kpiTarget->status_image_url)) }}" alt="{{ get_user()->name }}">
                                                <!-- <span class="fa fa-map-marker pr-2"></span> -->
                                            @else
                                                <img class="pr-2" src="{{ asset('assets/images/map-icon.png') }}" alt="{{ get_user()->name }}">
                                                <!-- <span class="fa fa-map-marker pr-2"></span> -->
                                            @endif    
                                            <span class="ft-12">{{ $kpiTarget->title }}</span></td>
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
                <div class="requires-no-scroll">
                    <p class="font-semi-bold font-18 color-black">{{ $territory_name }}</p>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Universe {{ $results['universe'][0] }}</th>
                            <th scope="col">Coverage Rate <span class="converage_rate"></span>%</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if( count($userMetric) )
                            @foreach( $userMetric as $metric )
                                <tr>
                                    <td>
                                    <img class="pr-2" src="{{ asset('assets/images/map-icon.png') }}" alt="{{ get_user()->name }}">
                                        <!-- <span class="fa fa-map-marker pr-2"></span>  -->
                                        <span>{{ !empty($metric->custom_metric_title) ? $metric->custom_metric_title : $metric->title }}</span></td>
                                    <td>
                                        @if( $metric->title == 'Reach Rate' )
                                            <div data-toggle="tooltip" data-placement="top" title="{{ !empty($contact) && !empty($attempts) ? round( ($contact/$attempts) * 100 ) : '0'  }}%" class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width:{{ !empty($contact) && !empty($attempts) ? round( ($contact/$attempts) * 100 ) : '0'  }}%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        @elseif($metric->title == 'Inspection Close Rate')
                                            <div data-toggle="tooltip" data-placement="top" title="{{ !empty($leads) && !empty($contact) ? round( ($leads/$contact) * 100 ) : '0'  }}%" class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width:{{ !empty($leads) && !empty($contact) ? round( ($leads/$contact) * 100 ) : '0'  }}%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        @elseif( $metric->title == 'Damage Rate')
                                            <div data-toggle="tooltip" data-placement="top" title="{{ !empty($prospects) && !empty($leads) ? round( ($prospects/$leads) * 100 ) : '0'  }}%" class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width:{{ !empty($prospects) && !empty($leads) ? round( ($prospects/$leads) * 100 ) : '0'  }}%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        @elseif( $metric->title == 'No Damage Rate')
                                            <div data-toggle="tooltip" data-placement="top" title="{{ !empty($not_qualified) && !empty($prospects) ? round( ($not_qualified/$prospects) * 100 ) : '0'  }}%" class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width:{{ !empty($not_qualified) && !empty($prospects) ? round( ($not_qualified/$prospects) * 100 ) : '0'  }}%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        @elseif( $metric->title == 'File Rate')
                                            <div data-toggle="tooltip" data-placement="top" title="{{ !empty($pre_qualified) && !empty($prospects) ? round( ($pre_qualified/$prospects) * 100 ) : '0'  }}%" class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width:{{ !empty($pre_qualified) && !empty($prospects) ? round( ($pre_qualified/$prospects) * 100 ) : '0'  }}%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        @elseif( $metric->title == 'Buy Rate')
                                            <div data-toggle="tooltip" data-placement="top" title="{{ !empty($approved) && !empty($pre_qualified) ? round( ($approved/$pre_qualified) * 100 ) : '0'  }}%" class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width:{{ !empty($approved) && !empty($pre_qualified) ? round( ($approved/$pre_qualified) * 100 ) : '0'  }}%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        @elseif( $metric->title == 'Denied Rate')
                                            <div data-toggle="tooltip" data-placement="top" title="{{ !empty($not_approved) && !empty($pre_qualified) ? round( ($not_approved/$pre_qualified) * 100 ) : '0'  }}%" class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width:{{ !empty($not_approved) && !empty($pre_qualified) ? round( ($not_approved/$pre_qualified) * 100 ) : '0'  }}%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        @elseif( $metric->title == 'Lost Rate')
                                            <div data-toggle="tooltip" data-placement="top" title="{{ !empty($lost_opportunity) && !empty($approved) && !empty($pre_qualified) ? round( ($lost_opportunity/($approved + $pre_qualified)) * 100 ) : '0'  }}%" class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width:{{ !empty($lost_opportunity) && !empty($approved) && !empty($pre_qualified) ? round( ($lost_opportunity/($approved + $pre_qualified)) * 100 ) : '0'  }}%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        @elseif( $metric->title == 'Contract Close Rate')
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