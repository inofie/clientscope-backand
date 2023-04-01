<table class="table">
    <thead>
    <tr>
        <th scope="col">KPI Group</th>
        <th scope="col"></th>
        <th scope="col">Target</th>
    </tr>
    </thead>
    <tbody>
    @if( count($data) )
        @foreach( $data as $result )
            <tr>
                <td style="width:50%">
                    @if( !empty($result->status_image_url) )
                       <img style="width: 15px; height:15px; object-fit:contain;" src="{{ URL::to('assets/images/icon-'.basename($result->status_image_url ))}}"> 
                        <!-- <span class="fa fa-map-marker pr-2"></span> -->
                        {{-- <img class="pr-2" src="{{ asset('assets/images/map-icon.png') }}" alt="{{ get_user()->name }}"> --}}
                    @else
                        <span class="fa fa-map-marker pr-2"></span>
                    @endif    
                    <span class="ft-12">{{ $result->title }}</span></td>
                <td style="width:30%">
                    <div data-toggle="tooltip" data-placement="top" title="{{ $result->kpi_percent }}%" class="progress" style="height: 10px;">
                        <div class="progress-bar" role="progressbar" style="width: {{ $result->kpi_percent }}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </td>
                <td style="width:20%" class="ft-12">{{ round($result->target_value) }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="3">No Data Found</td>
        </tr>
    @endif
    </tbody>
</table>

