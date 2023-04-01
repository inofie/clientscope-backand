<table class="table">
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