<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row g-5 mb-5">
            <div class="col-lg-7 wow fadeInUp" data-wow-delay=".3s">
              <div id="googleMap" style="width:100%;height:550px;"></div>
            </div>
            <div class="col-lg-5 wow fadeInUp" data-wow-delay=".5s">
                <div class="rounded contact-form">
                    <div class="mb-4">
                      <input type="text" class="form-control" placeholder="Enter your latitude" id="latitude" name="latitude">
                    </div>
                    <div class="mb-4">
                      <input type="text" class="form-control" placeholder="Enter your longitude" id="longitude" name="longitude">
                    </div>
                    <button class="btn btn-primary border-0 py-3 px-4 rounded-pill" type="button" onclick="findByLatLong()">Find by coordinates</button>

                    <div class="mb-5"></div>

                    <div class="mb-4">
                      <input type="text" class="form-control" placeholder="Enter your address" id="address" name="address">
                      <!-- value="66-68 Hai Bà Trưng, Bến Nghé, Quận 1, Thành phố Hồ Chí Minh" -->
                    </div>
                    <button class="btn btn-primary border-0 py-3 px-4 rounded-pill" type="button" onclick="findByAddress()">Find by address</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  var map, geocoder;

  function showMap() {
    geocoder = new google.maps.Geocoder();
    var stores = <?php echo $data['stores']; ?>;
    var mapProp= {
      center: new google.maps.LatLng(10.791648236467045,106.67286048349753),
      zoom: 13,
      // mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    var icon = {
      url: "https://uxwing.com/wp-content/themes/uxwing/download/location-travel-map/flag-green-icon.png",
      scaledSize: new google.maps.Size(50, 50),
    }
    var infoWin = new google.maps.InfoWindow();

    stores.forEach(store => {
      var content = document.createElement('div');
      var strong = document.createElement('strong');
      strong.textContent = store.name
      content.appendChild(strong);

      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(store.latitude, store.longitude),
        icon: icon,
        map: map
      });

      marker.addListener('click', function () {
        infoWin.setContent(content);
        infoWin.open(map, marker);
      });
    });
  }

  function findByLatLong() {
    var lat = document.getElementById('latitude').value;
    var long = document.getElementById('longitude').value;
    var position = new google.maps.LatLng(lat, long);

    map.setCenter(position);
    var marker = new google.maps.Marker({
        position: position,
        map: map
      });
  }

  function findByAddress() {
    var address = document.getElementById('address').value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
      } else {
        alert('Find address failed for the following reason: ' + status);
      }
    });
  }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHddOxqJjEJZE1BOXyTL41uTH5ibLmRjA&callback=showMap"></script>