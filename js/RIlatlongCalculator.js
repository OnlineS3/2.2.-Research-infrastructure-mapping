document.getElementById("location").addEventListener("input", RIcalc);

function RIcalc() {
    var geocoder = new google.maps.Geocoder();
    var address = document.getElementById("location").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK)
        {
            document.getElementById("lng").value = results[0].geometry.location.lng();
            document.getElementById("lat").value  = results[0].geometry.location.lat();
         }
    });
}