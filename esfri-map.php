<!DOCTYPE html>

<html>
<head>
    <title>Online Template</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="An e-policy online platform augmented with applications and services, to assist authorities in the EU in elaborating their smart specialisation agenda."/>
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/layout.css" type="text/css">
    <link rel="stylesheet" href="css/base.css" type="text/css">
    <link rel="stylesheet" href="css/fonts.css" type="text/css">
    <link rel="stylesheet" href="css/social.css" type="text/css">
    <link rel="stylesheet" href="css/sidebar.css" type="text/css">
    <link rel="stylesheet" href="css/utils.css" type="text/css">
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="stylesheet" href="css/buttons.css" type="text/css">
    <script src="js/docxtemplater-latest.min.js" async defer></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/FileSaver.min.js"></script>
    <script src="js/jszip-utils.min.js"></script>
</head>

<body>
  <div id='mainpage' class='site'>
   <header id='mainheader' class='site-header'>
    <div class='header-top'>
        <img src='images/logo.png' class='logo-img' width='60'>
        <p class='online-title'>Online S3</p>
    </div>
    <div class='header-bottom'>
        <span class="step-header">
            2.2 Research Infrastructures Mapping
        </span>
    </div>
</header>

<!--top menu-->
<nav id='mainnav'>
   <ul>
      <li><a href='index.php'>PanEuropean</a></li>
      <li><a href='esfri-map.php'>ESFRI</a></li>
      <li><a href='add_esfri_main.php'>ESFRI Form</a></li>
      <li><a href='add_non_esfri_main.php'>RI Form</a></li>
      <li><a href='admin_tab.php'>Administrator</a></li>
  </ul>
</nav>
<!--site content-->
<div class='site-content'>
    <header id='appl-title' class='appl-title'>
        <h2>ESFRI Research Infrastructures</h2>
    </header>
   <?php
    include "./php/esfri_filtering.php";
    $results = esfriUnfiltered();
    $locations = array();
    if (mysqli_num_rows($results) > 0) {
       while ($row = mysqli_fetch_row($results)) {
           $location = array("$row[0]", "$row[1]", "$row[2]" , "$row[3]" , "$row[4]" , "$row[5]" ,"$row[6]", "$row[7]", "$row[8]", "$row[9]","$row[10]","$row[11]","$row[12]","$row[13]","$row[14]", "$row[15]","$row[16]", "$row[17]","$row[18]","$row[19]","$row[20]");
           array_push($locations, $location);
       }
   }
   ?>
   <div id="map"></div>
   <script src="js/markerclusterer.js"></script>
   <script>
     var map;
     function initMap() {
       map = new google.maps.Map(document.getElementById('map'), {
         center: {lat: 48.3230999, lng: 16.5774999},
         zoom: 4
     });
       var js_var = <?php echo json_encode($locations); ?>;
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
        var contentString = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h1 id="firstHeading" class="firstHeading">'+name+'</h1>'+'<br>'+
        '<div><h1><i>'+domain+'</i> [ESFRI '+esfri_type+']</h1></div>'+
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
    </script>
   <aside id='sidebar' class='sidebar'>
        <header id='appl-title' class='appl-title'>
            <h2>Map Filtering</h2>
        </header>
        <div class="r-menu">
            <form id="filtersForm"  method="post">
                <div><p> Select the RI's Domain</p></div>
                <select id="domainBox">
                    <?php
                    $options = getOptionsFor('idimitriad_1','esfris','domain');
                    foreach ($options as $option){
                        ?>
                        <option value="<?=$option?>"><?=$option?></option>
                        <?php
                    }
                    ?>
                </select>
                <div><p> Select the RI's ESFRI Type</p></div>
                <select id="esfriTypeBox">
                    <?php
                    $options = getOptionsFor('idimitriad_1','esfris','esfri_type');
                    foreach ($options as $option){
                        ?>
                        <option value="<?=$option?>"><?=$option?></option>
                        <?php
                    }
                    ?>
                </select>
                <div><p> Select the coordinator country</p></div>
                <select id="countryBox">
                    <?php
                    $options = getOptionsFor('idimitriad_1','esfris','coordinating_country');
                    foreach ($options as $option){
                        ?>
                        <option value="<?=$option?>"><?=$option?></option>
                        <?php
                    }
                    ?>
                </select>
                <div><p> Select the RI's Type</p></div>
                <select id="typeBox">
                    <?php
                    $options = getOptionsFor('idimitriad_1','esfris','type');
                    foreach ($options as $option){
                        ?>
                        <option value="<?=$option?>"><?=$option?></option>
                        <?php
                    }
                    ?>
                </select>
                <div><br></div>
                <input id="submit" type="submit" class="button btn-primary" value="Submit">
                <div><br></div>
                <input id="export-doc-esfri" type="submit" class="button btn-primary" value="Export Doc">
            </form>
        </div>
    </aside>
</div>
<!--main footer-->
<footer id='mainfooter' class='site-footer'>
    <!--social share buttons-->
    <div class='social-share'>
        <h3 class='social-title'>Share this:</h3>
        <div class='social-btns'>
            <div class='twitter-btn'></div>
            <div class='gplus-btn'></div>
        </div>
    </div>
    <?php include 'templates/footermain.html'; ?>
</footer>
</div>
 <script src="https://maps.googleapis.com/maps/api/js?key=p" async defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
         <script type="text/javascript" src="js/esfriFormProcessor.js"></script> <!-- load our javascript file -->
          <script type="text/javascript" src="js/exportToDocESFRI.js"></script>
</body>