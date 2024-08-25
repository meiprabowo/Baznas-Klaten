<div class="col-xxl-12 mb-25">

    <div class="card border-0 h-100">
      <div class="card-header">
        <h6>Sebaran Perkara</h6>
     
      </div>
      <div class="card-body pt-sm-30 pb-sm-50 pb-30">
        <div class="tab-content">
          <div class="tab-pane active show" id="se_region-today" role="tabpanel" aria-labelledby="se_region-today-tab">
            <div class="row">
              <div class="col-md-4">

                <div class="table-responsive table-top-regions">
                  <table class="table table--default table-borderless">
                    <thead>
                      <tr>
                        <th>Lokasi</th>
                        <th>Jumlah Perkara</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($lokasi as $key => $l)
                    @if (Auth::user()->tingkatan == 'ADMIN') 
                      <tr>
                        <td>{{ $l->provinsi }}</td>
                        <td>{{ $l->jml }}</td>
                      </tr>
                    @else
                    <tr>
                        <td>{{ $l->kabupaten }}</td>
                        <td>{{ $l->jml }}</td>
                      </tr>

                    @endif
                    @endforeach

                    </tbody>
                  </table>
                </div>

              </div>
              <div class="col-md-8 d-flex align-items-center justify-content-center">
              <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
                                <style>
        #map {
            width: 100%; /* Mengatur lebar peta agar memenuhi seluruh lebar kolom */
            height: 100%;
        }
    </style>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <div id="map"></div>

    <script>
            var map = L.map('map').setView([-2.548926, 118.014863], 5); // Koordinat pusat Indonesia dan tingkat zoom

            L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map); // Menambahkan layer peta OpenStreetMap


        @foreach($data as $key => $d)
         // Menambahkan pin pertama
    L.marker([  {{ $d->titik_koordinat }}]).addTo(map)
        .bindPopup('<a href="{{ route('perkara.detail', $d->id) }}" target="_blank">{{ $d->nomor_perkara }}</a>'); // Anda dapat menambahkan popup untuk pin ini
        @endforeach


    </script>
              </div>
            </div>
          </div>
          
          
      </div>
    </div>

  </div>