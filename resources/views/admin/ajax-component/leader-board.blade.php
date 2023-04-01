@if( count($data) )
    <div class="col-12">
        <div class="leader-header mt-5">
            <div>
                <div class="other-user-names ml-3 leader-time">
                    <p class="font-18 color-black">Out of <strong>{{ count($data) }}</strong></p>
                </div>
            </div>
            <div class="leader-time">
                <p class="font-18"># or %</p>
            </div>
        </div>
        <div class="leaderboard-text">
            @foreach( $data as $results )
                @php
                    if( $loop->iteration == 1 ){
                        $reward_image = asset('assets/images/first_place.png');
                    } else if($loop->iteration == 2){
                        $reward_image = asset('assets/images/silver.svg');
                    } else if($loop->iteration == 3){
                        $reward_image = asset('assets/images/bronze.svg');
                    } else {
                        $reward_image = asset('assets/images/rect.svg');
                    }
                @endphp
                <div class="leader-detail">
                    <div>
                        <div class="chat-detail table-deatil d-flex align-items-center">
                            <div>
                                <div class="">
                                    <img
                                        src="{{ asset('assets/images/first_place.png') }}"
                                        alt="user-profile"
                                    />
                                </div>
                            </div>
                            <div class="other-user-names ml-3 table-user-name">
                                <p class="font-18">{{ $results->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="board-number">
                        <p>{{ $results->total_sale }}</p>
                    </div>
                </div>
            @endforeach    
        </div>
    </div>
@else
<div class="col-12">
    <div class="alert alert-info">No Data Found</div>
</div>    
@endif     