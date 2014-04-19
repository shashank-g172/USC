<head>
 <script>
$(document).ready(function () {
    var map;
    var myOptions = {
        zoom: 1,
        center: new google.maps.LatLng(0, 0),
        mapTypeId: 'terrain'
    };
    map = new google.maps.Map($('#map_canvas')[0], myOptions);

    var addresses = ['Norway', 'Africa', 'Asia','North America','South America'];

    for (var x = 0; x < addresses.length; x++) {
        $.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address='+addresses[x]+'&sensor=false', null, function (data) {
            var p = data.results[0].geometry.location
            var latlng = new google.maps.LatLng(p.lat, p.lng);
            new google.maps.Marker({
                position: latlng,
                map: map
            });

        });
    }

});
</script>
</head>
<body>
 <div id="map_canvas" style="width:100%; height:100%"> </div>
</body>
</html>