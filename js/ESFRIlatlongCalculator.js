document.getElementById("locationESFRI").addEventListener("input", ESFRIcalc);

function ESFRIcalc() {
    var geocoder = new google.maps.Geocoder();
    var address = document.getElementById("locationESFRI").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK)
        {
            document.getElementById("lngESFRI").value = results[0].geometry.location.lng();
            document.getElementById("latESFRI").value  = results[0].geometry.location.lat();
         }
    });
}