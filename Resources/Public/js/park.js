;(function( $ ) {
    $(document).ready(function(e){
        var img = document.getElementById('tx-intpark-image');
        if(img) {
            var h = img.height;
            var w = img.width;
            var map = L.map('map', {
                crs: L.CRS.Simple,
                minZoom: 1,
                maxZoom: 4,
                zoom: 3,
            });
            // converting pixels to latlng and then setting it in center of the view
            map.setView(map.unproject(L.point(w/2, h/2)));
            var southWest = map.unproject([0, h], map.getMaxZoom()-1);
            var northEast = map.unproject([w, 0], map.getMaxZoom()-1);
            var bounds = new L.LatLngBounds(southWest, northEast);
            L.imageOverlay(img.src, bounds).addTo(map);
            map.setMaxBounds(bounds);
            for (i = 0; i < parkMarkers.length; i++) {
                var marker = parkMarkers[i];
                var x = marker.x*w;
                var y = marker.y*h;
                var pointXY = L.point(x, y);
                
                // convert to lat/lng space
                var pointlatlng = map.unproject(pointXY);
                // creating a a div with marker in bg and icon inside
                var Icon = L.divIcon({
                    className: 'marker',
                    html: '<div class="marker" style="background-image: url(\'typo3conf/ext/int_park/Resources/Public/lib/images/marker-icon.png\');background-repeat: no-repeat; margin-top: -'+(marker.pinH/2)+'px; width: '+marker.pinW+'px;height: '+marker.pinH+'px;"><i></i></div>',
                    iconSize: [marker.pinW, marker.pinH],
                    popupAnchor: [0, marker.pinH*-1]
                    });
                if(marker.note.trim() != '') {
                    mk = L.marker(pointlatlng, {icon: Icon}).addTo(map).bindPopup(marker.note, {
                        className: 'ap-infowindow'
                    });
                    mk.on('popupopen', function (popup) {
                        map.setMaxBounds(null);
                    });
                    mk.on('popupclose', function (popup) {
                        map.setMaxBounds(bounds);
                    });
                } else {
                    L.marker(pointlatlng, {icon: Icon}).addTo(map);
                }
            }
            map.setZoom(zoomLevel);
        }
    });
})(jQuery);