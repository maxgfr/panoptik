@extends('layouts.app')

@section('content')

    <div class="my-3 my-md-5">
      <div class="container">
          <div class="col-lg-12 col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Our sensors</h3>
              </div>
              <div class="card-body">
                <div class="map">
                  <div class="map-content" id="panomap"></div>
                </div>
                <div class="form-group">
                  <div class="form-label">More information</div>
                  <div class="custom-controls-stacked">
                      <label for="mag_id" class="col-sm-3 col-form-label">Tracker Id</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control form-control-sm col-form-label-sm" id="mag_id" placeholder="Module Id">
                      </div>
                  </div>
                  <div class="custom-controls-stacked">
                      <label for="from_date" class="col-sm-1 col-form-label col-form-label-sm">From</label>
                      <div class="col-sm-12">
                        <input type="date" class="form-control form-control-sm" id="from_date" placeholder="col-form-label-sm" required>
                      </div>
                  </div>
                  <div class="custom-controls-stacked">
                      <label for="to_date" class="col-sm-1 col-form-label col-form-label-sm">to</label>
                      <div class="col-sm-12">
                        <input type="date" class="form-control form-control-sm" id="to_date" placeholder="col-form-label-sm" required>
                      </div>
                  </div>
              </div>

                <div class="card-footer text-right">
                  <button type="submit" id="calculate_btn" class="btn btn-primary">Make request</button>
                </div>
            </div>
          </div>

        </div>

    </div>

    <script>

        var map = L.map('panomap', {

        }).setView([48.848356, 2.395893], 6);

        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1Ijoic3VwZXJib3Vub3UiLCJhIjoiY2pjMWl6Nm1kMzkwcDJxbTkxZm50cnUyYSJ9.7YWqMVXpaMXhmVbsXefrHg', {
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
            maxZoom: 22,
            id: 'mapbox.streets',
            accessToken: 'pk.eyJ1Ijoic3VwZXJib3Vub3UiLCJhIjoiY2pjMWl6Nm1kMzkwcDJxbTkxZm50cnUyYSJ9.7YWqMVXpaMXhmVbsXefrHg'
        }).addTo(map);

        //===== reload the map to avoid issue on tiles
        setTimeout(function(){
            map.invalidateSize();
        },
        500);

        var latlngs = [
            [45.51, -122.68],
            [37.77, -122.43],
            [34.04, -118.2]
        ];

        path_container = new L.polyline(latlngs, {color: 'red'}).addTo(map);
        containerLayer = new L.marker([0,0]).addTo(map);
        //define styles for asset marker
        var dotStyleDefault = {
            radius: 5,
            fillColor: "#004143",
            color: "#000",
            weight: 0,
            opacity: 1,
            fillOpacity: 0.9
        };

        //define styles for site marker
        var dotStyleRed = {
            radius: 5,
            fillColor: "blue",
            color: "#000",
            weight: 0,
            opacity: 1,
            fillOpacity: 0.9
        };

        //_Style de point lorsque surligné
        var dotStyleHighlight = {
            radius: 6,
            //fillColor: "#20a0ff",
            //color: "#22c",
            weight: 1,
            opacity: 1,
            fillOpacity: 0.9
            };

            $('#calculate_btn').click(function() {
            mag_id = $('#mag_id').val();
            from_date = $('#from_date').val();
            to_date = $('#to_date').val();


            get_positions(mag_id, from_date, to_date);
            get_path(mag_id, from_date, to_date);

        });

        function get_positions(mag_id, from_date, to_date) {
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
          $.ajax({
              type: 'POST',
              url: '/map/position/',
              data: {},
              success: function(data){
                  console.log('Success:', data);
                  map.removeLayer(containerLayer);
                  set_markers(data);
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });
        }

        function get_path(mag_id, from_date, to_date){
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/map/path/',
                data: {},
                success: function(data){
                    console.log('Success:', data);
                    if(typeof path_container != "undefined"){
                      map.removeLayer(path_container);
                    }
                    // create a red polyline from an array of LatLng points
                    console.log(data);
                    path_container = new L.polyline(data, {color: 'red'}).addTo(map);
                    // zoom the map to the polyline
                    map.fitBounds(path_container.getBounds());
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }

        function set_markers(geojson){
            containerLayer = new L.GeoJSON(geojson, {
              pointToLayer: function(feature, latlng) {
                return L.circleMarker(latlng, dotStyleDefault);
              },
              onEachFeature: onEachDot
            });
            map.addLayer(containerLayer);
        }

        //functions to attach styles and popups to the marker layer
        function highlightDot(e) {
          var layer = e.target;

          layer.setStyle(dotStyleHighlight);

          if (!L.Browser.ie && !L.Browser.opera) {
            layer.bringToFront();
          }
        }

        function resetDotHighlight(e) {
          var layer = e.target;
          layer.setStyle(dotStyleDefault);
        }

        //_Fonction permettant d'afficher une pop-up pour les contenants

        function onEachDot(feature, layer) {
          layer.on({
            mouseover: highlightDot,
            mouseout: resetDotHighlight
          });
          layer.bindPopup('<table style="width:150px"><tbody><tr><td><div><b>ID:</b></div></td><td><div>' + feature.properties.id + '</div></td></tr><tr class><td><div><b>Date:</b></div></td><td><div>' + feature.properties.timestamp + '</div></td></tr></tbody></table>');
        }

    </script>
@endsection
