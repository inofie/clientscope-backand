var placeSearch, autocomplete;
function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete( document.getElementById('autocomplete') );
    autocomplete.addListener('place_changed', fillInAddress);
}
function fillInAddress()
{
    var place = autocomplete.getPlace();
    var lat = place.geometry.location.lat();
    var long = place.geometry.location.lng();
    $('input[name="longitude"]').val(long);
    $('input[name="latitude"]').val(lat);
    //get place detail
    if ( place.address_components ) {
        for( var index in place.address_components ){
            if( place.address_components[index].types[0] == 'administrative_area_level_1' ){
                $('input[name="state"]').val(place.address_components[index].short_name)
            }
            if( place.address_components[index].types[0] == 'locality' ){
                $('input[name="city"]').val(place.address_components[index].short_name)
            }
            if( place.address_components[index].types[0] == 'postal_code' ){
                $('input[name="zipcode"]').val(place.address_components[index].short_name)
            }
        }
    }
}