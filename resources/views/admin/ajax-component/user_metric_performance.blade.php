<table class="table">
    <thead>
    <tr>
        <th scope="col">Universe <span id="metric_universe"></span></th>
        <th scope="col">Coverage Rate <span id="metric_converage_rate"></span></th>
    </tr>
    </thead>
    <tbody>
    @if( count($metrics) )
        @foreach( $metrics as $metric )
            <tr>
                <td>
                <img class="pr-2" src="{{ asset('assets/images/map-icon.png') }}" alt="{{ get_user()->name }}">
                    <!-- <span class="fa fa-map-marker pr-2"></span>  -->
                    <span>{{ !empty($metric->custom_metric_title) ? $metric->custom_metric_title : $metric->title }}</span></td>
                <td style="width:70%">
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
                        <div data-toggle="tooltip" data-placement="top" title="{{ !empty($sales) && !empty($approved) && !empty($sales_opportunities) ? round( ($sales/($approved-$sales_opportunities)) * 100 ) : '0'  }}%" class="progress" style="height: 10px;">
                            <div class="progress-bar" role="progressbar" style="width:{{ !empty($sales) && !empty($approved) && !empty($sales_opportunities) ? round( ($sales/($approved-$sales_opportunities)) * 100 ) : '0'  }}%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @else
                        <div data-toggle="tooltip" data-placement="top" title="0%" class="progress" style="height: 10px;">
                            <div class="progress-bar" role="progressbar" style="width:0%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @endif
                </td>
            </tr>
        @endforeach
     @endif
    </tbody>
</table>