'use strict';
var map,
    marker,
	  infowindow,
    markerArr=[],
    userPath = '';

function initMap()
{
    let myLatLng = { lat:37.09024, lng:-95.712891};
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: myLatLng,
        mapTypeControlOptions: {
          position: google.maps.ControlPosition.TOP_CENTER,
        },
        zoomControlOptions: {
          position: google.maps.ControlPosition.RIGHT_TOP,
        },
        streetViewControlOptions: {
          position: google.maps.ControlPosition.LEFT_TOP,
        }
	});
}

$('select[name="user_id"]').change(function(){
    let user_id = $(this).val();
    ajax_request( base_url + '/admin/user-track/dates','GET',{user_id:user_id})
      .then( function(res){
          if( res.length > 0 ){
            let options = '';
            for( var i=0; i < res.length; i++ ){
                options += '<option value="'+ res[i].tracking_date +'">'+ res[i].tracking_date +'</option>';
            }
            $('#tracking_date').html(options);
          } else {
            alert('No tracking activity found');
          }
      })
})

$('#search_pin_form').submit( function(e){
	e.preventDefault();
  
  if( userPath != ''){
     clearOverlays();
     userPath.setMap(null);  
  }
	let params = $(this).serialize();
	ajax_request(base_url + '/admin/user-track/data','GET',params)
		.then( (response) => {
			if( response.length > 0 ){
				let userCoordinates = []
				infowindow = new google.maps.InfoWindow();
				for(var i=0; i < response.length; i++ ){
					userCoordinates.push(
						{ 
							lat: parseFloat(response[i].latitude), 
							lng: parseFloat(response[i].longitude)
						}
					);
					//set market
					marker = new google.maps.Marker({
                        position: new google.maps.LatLng(parseFloat(response[i].latitude), parseFloat(response[i].longitude)),
                        map: map,
                        icon: base_url + '/images/tracking-img.png',
						            record:response[i]
                    });	
					
          markerArr.push(marker);
          
					google.maps.event.addListener(marker, 'click', (function (marker, i) {
						return function () {
              var username   = response[i].user.name;
							var created_at = moment(response[i].created_at).format('MMMM, DD YYYY') + ' at ' + moment(response[i].created_at).format('h:mm A');
							infowindow.setContent(`
										  <div style="width:200px;">
                        <p><b>${username}</b></p>
                        <p>${created_at}</p>
                      </div>
								   `)
									infowindow.open(map, marker);
								}
					})(marker, i));
					  
				}
				let mapCenterPoint = calculateCenterPoint(userCoordinates);
				map.setCenter({lat:mapCenterPoint.latitude, lng:mapCenterPoint.longitude});
				userPath = new google.maps.Polyline({
						path: userCoordinates,
						geodesic: true,
						strokeColor: "#f58719 ",
						strokeOpacity: 1.0,
						strokeWeight: 5,
					});
					userPath.setMap(map);
          map.setZoom(17);
			} else {
				alert('No Data Found');
			}
		})
})

function clearOverlays() {
    for (var i = 0; i < markerArr.length; i++ ) {
      markerArr[i].setMap(null);
    }
    markerArr = [];
}

function calculateCenterPoint( points=[] )
{
    let latitude = 0;
    let longitude = 0;
    const n = points.length;
    for (const point of points) {
        latitude += point.lat;
        longitude += point.lng;
    }
    return {
        latitude: parseFloat(latitude / n), longitude: parseFloat(longitude / n)
    }
}