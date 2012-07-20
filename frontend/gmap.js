var markers = [];
var map;
var infoWindow = new google.maps.InfoWindow;

function MyMarker (marker,set,info) {
    this.marker = marker;
    this.set = set;
    this.info = info;
    this.Show = function(){marker.setVisible(true);}
    this.Hide = function(){marker.setVisible(false);}
}

function downloadUrl(url,callback)
{
    var request = window.ActiveXObject ? new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest;

    request.onreadystatechange = function() 
    {
        if (request.readyState == 4)
        {
            callback(request, request.status);
        }
 };

    request.open('GET', url, true);
    request.send(null);
}

function ChangeState(set)
{
    for(var i = 0;i<markers.length;i++)
        {
            if(markers[i].set == set.value)
            {
                if(set.checked)
                    markers[i].Show();
                else
                    markers[i].Hide();
            }
            
        }
}

function ShowMap()
{
   map = new google.maps.Map(document.getElementById('map'), {
   zoom: 7,
   center: new google.maps.LatLng(50.009063, 14.407082),
   mapTypeId: google.maps.MapTypeId.ROADMAP});
    
}

function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        //document.getElementById('markerText').textContent = html;
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

function LoadMarkers(data)
{
  var xml = data.responseXML;
  var markersXML = xml.documentElement.getElementsByTagName("marker");
  for (var i = 0; i < markersXML.length; i++)
  {
    var title = markersXML[i].getAttribute("title");
    var set = markersXML[i].getAttribute("set");
    var icon = markersXML[i].getAttribute("icon");
    var coords = new google.maps.LatLng(parseFloat(markersXML[i].getAttribute("lat")),
                                        parseFloat(markersXML[i].getAttribute("lng")));
                                        
    var text =  markersXML[i].hasChildNodes() ? markersXML[i].childNodes[0].nodeValue : " ";
    
    var marker = new google.maps.Marker({
      map: map,
      position: coords,
      icon: icon
    });
    markers[i] = new MyMarker(marker,set,title);
    bindInfoWindow(markers[i].marker,map,infoWindow,text);
    if(!document.getElementById('set'+set).checked)
        markers[i].Hide();
  }
    
}


