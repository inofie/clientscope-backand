@if( count($records) )
    @if( $records->total() > 1 )
        <nav aria-label="Page navigation">
            <ul class="pagination float-right">
                <li class="page-item"><a href="{{ $records->currentPage() == 1 ? 'javascript:void(0)' : $records->previousPageUrl() }}" class="page-link">Previous</a></li>
                @for($i=1; $i <= $records->total(); $i++)
                    <li class="page-item"><a class="page-link" href="?page={{ $i }}">{{ $i }}</a></li>
                @endfor
                <li class="page-item"><a href="{{ $records->currentPage() == $records->total() ? 'javascript:void(0)' : $records->previousPageUrl() }}" class="page-link">Next</a></li>
            </ul>
        </nav>
    @endif
@endif