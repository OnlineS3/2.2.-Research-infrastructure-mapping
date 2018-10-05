$(document).ready(function(){

    $('#submit').click(function(){
        var selectedDomain = [];
        $('#domainBox :selected').each(function(i, selected) {
            selectedDomain[i] = $(selected).val();
        });
        var selectedType = [];
        $('#typeBox :selected').each(function(i, selected) {
            selectedType[i] = $(selected).val();
        });
        var selectedCoordcountry = [];
        $('#countryBox :selected').each(function(i, selected) {
            selectedCoordcountry[i] = $(selected).val();
        });

// Returns successful data submission message when the entered information is stored in database.
// AJAX Code To Submit Form.
$.ajax({
    type: "POST",
    url: "/app_2_2/php/filterSubmit.php",
    data: {'selectedDomain':JSON.stringify(selectedDomain), 'selectedType':JSON.stringify(selectedType),'selectedCoordcountry':JSON.stringify(selectedCoordcountry)},
    cache: false,
    success: function (result) {
        var js_var =  JSON.parse(result);
        updateMap(js_var);
    }
});
return false;
});

});

var map;
function updateMap(locations) {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 49.38803, lng: 8.70952},
        zoom: 4
    });
    var js_var = locations;
    var markers = [];
    for (var i = 0; i < js_var.length; i++) {
        var total = JSON.stringify(js_var[i]);
        total = JSON.parse(total);
        var lat = total[0];
        var lon = total[1];
        var name = total[2];
        var url = total[3];
        var status = total[4];
        var host = total[5];
        var location = total[6];
        var description = total[7];
        var domain = total[8];
        var contact = total[9];
        var ric = total[10];
        var coord = total[11];
        var type = total[12];
        var myLatlng = new google.maps.LatLng(lat, lon);
        var finalLatLng = myLatlng;
        var contentString =  '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h1>'+name+'</h1>'+
        '<div><h1><i>'+domain+'</i></h1></div>'+
        '<div id="bodyContent">'+
        '<p><b>Type of Facility:</b> '+type+' </p>'+
        '<p><b>Coordinates:</b> '+lat+' , '+lon+' </p>'+
        '<p><b>Location:</b>'+location+'</p>'+
        '<p><b>URL: </b><a href="'+url+'">'+
        name+'</a>'+
        '<p><b>Hosting Organization:</b>'+host+'</p>'+
        '<p><b>Coordinator Country:</b>'+coord+'</p>'+
        '<p><b>Status:</b>'+status+'</p>'+
        '<p><b>Category: </b>'+ric+'</p>'+
        '<p><b>Description: </b>'+description+'</p>'+
        '<p><b>Contact Person: </b>'+contact+'</p>'+
        '</div>'+
        '</div>';
        if (markers.length != 0) {
            for (i=0; i < markers.length; i++) {
                var pos = markers[i].getPosition();

                if (myLatlng.equals(pos)) {

                        //update the position of the coincident marker by applying a small multipler to its coordinates
                        var newLat = lat * (Math.random() * (0.999999 - 0.999988) + 0.999988);
                        var newLng = lon * (Math.random() * (0.999999 - 0.999988) + 0.999988);
                        finalLatLng = new google.maps.LatLng(newLat,newLng);
                    }
                }
            }
            var marker = new google.maps.Marker({
                position: finalLatLng,
                map: map,
                icon:'images/blue-pin.png',
            });
            
            marker.info = new google.maps.InfoWindow({
                content: contentString,
                position: myLatlng
            });
            markers.push(marker);

            google.maps.event.addListener(marker, 'click', function() {
                var marker_map = this.getMap();
                this.info.open(marker_map,this);
            });

        }
        var options = {imagePath: 'images/m' };
        var markerCluster = new MarkerClusterer(map, markers, options);}