<style>
.tableFixHead
{
    overflow: auto;
    height: 300px !important;
    margin-top: 10px !important;
    display: inherit;
}
.tableFixHead thead th
{
    position: sticky;
    top: 0; z-index: 1;
    background-color:white;
}
table.table.tableFixHead thead tr th {
    border-top: none;
}
.tableFixHead tbody
{
    margin-top:40px;
}
</style>
<table class="table tableFixHead">
    <thead>
    <tr>
        <th>Rank</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Sales</th>
    </tr>
    </thead>
    <tbody>
    @if( count($data) )
        @foreach( $data as $results )
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $results->name }}</td>
                <td>{{ $results->email }}</td>
                <td>{{ $results->total_sale }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="4">No Data Found</td>
        </tr>
    @endif
    </tbody>
</table>