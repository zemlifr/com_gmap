var map;
var marker;

function SetLatLog(event)
{
    document.getElementById('latitude').value = event.latLng.lat().toFixed(8);
    document.getElementById('longitude').value = event.latLng.lng().toFixed(8);
    
    var coords = new google.maps.LatLng(event.latLng.lat(),event.latLng.lng());
    
    if(!marker)
        {                               
          marker = new google.maps.Marker({map: map, position: coords});
          marker.setClickable(false);
        }
    else
        {
            marker.setPosition(coords);
        }
}

function ShowMap()
{
   map = new google.maps.Map(document.getElementById('map'), {
   zoom: 7,
   center: new google.maps.LatLng(50.009063, 14.407082),
   mapTypeId: google.maps.MapTypeId.ROADMAP});

   google.maps.event.addListener(map,'click',SetLatLog);
    
}


