
$(document).ready(function(){

    $('#submit').click(function(){
        var selectedDomain = [];
        $('#domainBox :selected').each(function(i, selected) {
            selectedDomain[i] = $(selected).val();
        });
        var selectedEsfriType = [];
        $('#esfriTypeBox :selected').each(function(i, selected) {
            selectedEsfriType[i] = $(selected).val();
        });
        var selectedCoordcountry = [];
        $('#countryBox :selected').each(function(i, selected) {
            selectedCoordcountry[i] = $(selected).val();
        });
        var selectedType = [];
        $('#typeBox :selected').each(function(i, selected) {
            selectedType[i] = $(selected).val();
        });

// Returns successful data submission message when the entered information is stored in database.
// AJAX Code To Submit Form.
$.ajax({
    type: "POST",
    url: "/app_2_2/php/esfriFilterSubmit.php",
    data: {'selectedDomain':JSON.stringify(selectedDomain),'selectedEsfri_type':JSON.stringify(selectedEsfriType), 'selectedType':JSON.stringify(selectedType),'selectedCoordinating_country':JSON.stringify(selectedCoordcountry)},
    cache: false,
    success: function (result) {
                // alert(result);
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
        center: {lat: 48.3230999, lng: 16.5774999},
        zoom: 5
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
        var coord = total[4];
        var hq = total[5]
        var domain = total[6];
        var partners = total[8];
        var location = total[7];
        var members = total[9];
        var entry = total[10];
        var start = total[11];
        var prepcost = total[12];
        var constcost = total[13];
        var opercost = total[14];
        var description = total[15];
        var back = total[16];
        var steps = total[17];
        var activity = total[18];
        var impact = total[19];
        var esfri_type=total[20];
        var myLatlng = new google.maps.LatLng(lat, lon);
        var finalLatLng = myLatlng;
        var contentString = 
        '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h1 id="firstHeading" class="firstHeading">'+name+'</h1>'+'<br>'+
        '<h2 id="secondHeading" class="secondHeading">'+domain+'    [ESFRI '+esfri_type+']</h2>'+
        '<div id="bodyContent">'+
        '<p><b>URL: </b><a href="'+url+'">'+
        name+'</a>'+
        '<p><b>Coordinates:</b> ['+lat+' , '+lon+'] </p>'+
        '<p><b>Location:</b>'+location+'</p>'+
        '<p><b>Coordinator Country:</b>'+coord+'</p>'+
        '<p><b>Headquarters:</b>'+hq+'</p>'+
        '<p><b>Partner Countries:</b>'+partners+'</p>'+
        '<p><b>Member Countries:</b>'+members+'</p>'+
        '<p><b>ESFRI Roadmap Entry:</b>'+entry+'</p>'+ 
        '<p><b>Operation Start:</b>'+start+'</p>'+                
        '<p><b>Description: </b>'+members+'</p>'+
        '<p><b>Preparation Cost: </b>'+prepcost+'</p>'+
        '<p><b>Construction Cost: </b>'+constcost+'</p>'+
        '<p><b>Operational Cost: </b>'+opercost+'</p>'+
        '<p><b>Description: </b>'+description+'</p>'+
        '<p><b>Background: </b>'+back+'</p>'+
        '<p><b>Steps: </b>'+steps+'</p>'+
        '<p><b>Activity: </b>'+activity+'</p>'+
        '<p><b>Impact: </b>'+impact+'</p>'+
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
