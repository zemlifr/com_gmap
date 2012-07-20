var map;

function SetLatLog(event)
{
    document.getElementById('latitude').value = event.latLng.lat().toFixed(8);
    document.getElementById('longitude').value = event.latLng.lng().toFixed(8);
    
}

function ShowMap()
{
   map = new google.maps.Map(document.getElementById('map'), {
   zoom: 7,
   center: new google.maps.LatLng(50.009063, 14.407082),
   mapTypeId: google.maps.MapTypeId.ROADMAP});

   google.maps.event.addListener(map,'click',SetLatLog);
    
}


