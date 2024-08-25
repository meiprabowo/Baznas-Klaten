@section('title',$title)
@extends('layout.app')
@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <!-- Load Leaflet JavaScript -->
  
  <style>
        #map {
            height: 650px;
        }
    </style>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Peta Persebaran Pendistribusian ZIS </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i> Proposal </a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Pendistribusian ZIS </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
               <!-- Display success message --> 
            <div class="container-fluid">

          
          

                  

                  



        
                <div class="row">
                    <div class="col-lg-12">


                    <div id="map"></div>
           

                    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-ajax/2.1.0/leaflet.ajax.min.js"></script>
  <script src="https://unpkg.com/jquery"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js"></script>

  <script>
    var map = L.map('map').setView([0, 0], 2);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      id: 'mapbox/streets-v11',
      tileSize: 512,
      zoomOffset: -1
    }).addTo(map);

    var markers = [
        <?php foreach($data as $key => $d):
            $koordinat_array = explode(',', $d->koordinat);
            ?>
      { "name": "<?php echo"$d->nama_kelurahan"; ?>", "lat": <?php echo"$koordinat_array[0]"; ?>, "lng": <?php echo"$koordinat_array[1]"; ?> },
     <?php endforeach; ?>
    ];

    for (var i = 0; i < markers.length; i++) {
      var marker = L.marker([markers[i].lat, markers[i].lng]).addTo(map);
      marker.bindPopup(markers[i].name);
    }
  </script>
                  


                    
                            
                        </div>
                    </div>
  
</div>
@endsection



