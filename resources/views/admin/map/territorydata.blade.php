                <div class="d-flex flex-row justify-content-between pt-4 territorE-border">
                            <h5 class="font-weight-bold mb-0 color-3f3d56">Territories
                                ({{ $totalcount }})
                            </h5>
                            <div class="add_territory"><span class="fa fa-plus color-3f3d56"></span></div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" checked name="select_all_territory" value="1"
                                    class="select_all_territory form-check-input">
                                <label class="form-check-label">Select All Territories</label>
                            </div>
                        </div>
                        @if (count($territories))
                        @foreach ($territories as $territory)
                        <div class="d-flex flex-row justify-content-between mb-3 ft-14">
                            <div>
                                <div class="form-check">
                                    <input type="checkbox" checked id="territory_id" name="territory_id[]" value="{{ $territory->id }}"
                                        class="select_territory form-check-input">
                                    <label class="form-check-label color-c840e9">{{ $territory->title }}</label>
                                </div>
                            </div>
                            <div class="dropdown territory-edit-dropdown">
                                <span class="fa fa-cog" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                </span>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item edit_territory" data-record="{{ json_encode($territory) }}"
                                        href="javascript:void(0)">Edit Territory</a>
                                    <a class="dropdown-item move_territory" data-record="{{ json_encode($territory) }}"
                                        href="javascript:void(0)">Move Map To Territory</a>
                                    <a class="dropdown-item delete_territory" id="{{ $territory->id }}"
                                        href="javascript:void(0)">Delete Territory</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif


<script>
var user_pin = `{!! !empty($user_pin) ? json_encode($user_pin) : '' !!}`;
user_pin = user_pin.length > 0 ? JSON.parse(user_pin) : '';
</script>

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
<script defer
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=places,drawing&callback=initMap">
</script>

<script src="{{ asset('assets/admin/js/map.js') }}"></script>