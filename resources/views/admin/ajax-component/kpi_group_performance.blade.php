<style>
.tableFixHead
{
    overflow: auto;
    height: 300px !important;
    margin-top: 40px;
    display: inherit;
}
.tableFixHead thead th
{
    position: sticky;
    top: 0; z-index: 1;
    background-color:white;
}
.tableFixHead tbody
{
    margin-top:40px;
}
</style>
<table class="table tableFixHead">
    <thead>
    <tr>
        <th scope="col">Universe <span id="kpi_group_universe">{{ $universe }}</span></th>
        <th scope="col">Coverage Rate <span id="kpi_group_converage_rate">{{ $converage_rate }}%</span></th>
        <th scope="col">Target</th>
    </tr>
    </thead>
    <tbody>
    @if( count($data) )
        @foreach( $data as $record )
            <tr>
                <td> 
                  <img class="user_pin_image" src="{{ URL::to('assets/images/icon-'.basename($record->image_url)) }}">
                  <!-- <span class="fa fa-map-marker pr-2"></span> -->
                  {{-- <img class="pr-2" src="{{ asset('assets/images/map-icon.png') }}" alt="{{ get_user()->name }}"> --}}
                  <span>{{ $record->title }}</span>
              </td>
                <td></td>
                <td>{{ $record->total_pin }}</td>
            </tr>
        @endforeach
    @else 
        <tr>
            <td class="alert alert-info" colspan="3">No Data Found</td>
        </tr>
    @endif
    </tbody>
</table>