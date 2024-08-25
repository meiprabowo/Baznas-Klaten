@section('title',$title)
@extends('layout.app')
@section('content')
<script src="{{ asset('assets/code/highcharts.js') }}"></script>
<script src="{{ asset('assets/code/modules/exporting.js') }}"></script>
<script src="{{ asset('assets/code/modules/export-data.js') }}"></script>
<script src="{{ asset('assets/code/modules/accessibility.js') }}"></script>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Beranda </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active"><a href="#"><i class="las la-home"></i>Beranda </a></li>
                                            
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

    <div class="row ">
                  


    
    <div class="col-xxl-2 col-sm-6  col-ssm-12 mb-25">
                     <!-- Card 1  -->
                     <div class="ap-po-details ap-po-details--luodcy  overview-card-shape radius-xl d-flex justify-content-between">
                        <div class=" ap-po-details-content d-flex flex-wrap justify-content-between w-100">
                         <a href="{{ route('proposal.proposal.all') }}"><div class="ap-po-details__titlebar">
                              <p>Total Porposal</p>
                              <?php
if (!empty($allproposal)) {
    $allproposal = $allproposal;
} else {
    $allproposal="0";
}
?>
                              <h1>{{ number_format($allproposal, 0, ',', '.')}}</h1>
                           </div>
                        </a>
                           <div class="ap-po-details__icon-area color-primary">
                              <i class="uil uil-database"></i>
                           </div>
                        </div>

                     </div>
                     <!-- Card 1 End  -->
                  </div>


                  

   
                  <div class="col-xxl-2 col-sm-6  col-ssm-12 mb-25">
                     <!-- Card 1  -->
                     <div class="ap-po-details ap-po-details--luodcy  overview-card-shape radius-xl d-flex justify-content-between">
                        <div class=" ap-po-details-content d-flex flex-wrap justify-content-between w-100">
                         <a href="{{ route('proposal.proposal.all') }}"><div class="ap-po-details__titlebar">
                              <p>Belum Di Proses</p>
                              <h1>{{ number_format($belum, 0, ',', '.')}}</h1>
                           </div>
                        </a>
                           <div class="ap-po-details__icon-area color-primary">
                              <i class="uil uil-analytics"></i>
                           </div>
                        </div>

                     </div>
                     <!-- Card 1 End  -->
                  </div>


                  

                  <div class="col-xxl-2 col-sm-6  col-ssm-12 mb-25">
                     <!-- Card 1  -->
                     <div class="ap-po-details ap-po-details--luodcy  overview-card-shape radius-xl d-flex justify-content-between">
                        <div class=" ap-po-details-content d-flex flex-wrap justify-content-between w-100">
                        <a href="{{ route('proposal.proposal.allonproses') }}">
                              <div class="ap-po-details__titlebar">
                              <p>On Proses</p>
                              <h1>{{ number_format($onproses, 0, ',', '.')}}</h1>
  
                           </div>
                        </a>
                           <div class="ap-po-details__icon-area color-primary">
                              <i class="uil uil-process"></i>
                           </div>
                        </div>

                     </div>
                     <!-- Card 1 End  -->
                  </div>


                  

              
                  <div class="col-xxl-2 col-sm-6  col-ssm-12 mb-25">
                     <!-- Card 1  -->
                     <div class="ap-po-details ap-po-details--luodcy  overview-card-shape radius-xl d-flex justify-content-between">
                        <div class=" ap-po-details-content d-flex flex-wrap justify-content-between w-100">
                           <div class="ap-po-details__titlebar">
                              <p>Diterima</p>

                              <h1>{{ number_format($terima, 0, ',', '.')}}</h1>
                    
                           </div>
                           <div class="ap-po-details__icon-area color-primary">
                              <i class="uil uil-tachometer-fast"></i>
                           </div>
                        </div>

                     </div>
                     <!-- Card 1 End  -->
                  </div>


                  <div class="col-xxl-2 col-sm-6  col-ssm-12 mb-25">
                     <!-- Card 1  -->
                     <div class="ap-po-details ap-po-details--luodcy  overview-card-shape radius-xl d-flex justify-content-between">
                        <div class=" ap-po-details-content d-flex flex-wrap justify-content-between w-100">
                           <div class="ap-po-details__titlebar">
                              <p>Ditolak</p>
                              <h1>{{ number_format($tolak, 0, ',', '.')}}</h1>
  
                           </div>
                           <div class="ap-po-details__icon-area color-primary">
                              <i class="uil uil-arrow-down"></i>
                           </div>
                        </div>

                     </div>
                     <!-- Card 1 End  -->
                  </div>


                  <div class="col-xxl-2 col-sm-6  col-ssm-12 mb-25">
                     <!-- Card 1  -->
                     <div class="ap-po-details ap-po-details--luodcy  overview-card-shape radius-xl d-flex justify-content-between">
                        <div class=" ap-po-details-content d-flex flex-wrap justify-content-between w-100">
                           <div class="ap-po-details__titlebar">
                              <p>Data Selesai</p>
                               <?php $totalok = $terima + $tolak; ?>
                              <h1>{{ number_format($totalok, 0, ',', '.')}}</h1>
                    
                           </div>
                           <div class="ap-po-details__icon-area color-primary">
                              <i class="uil uil-briefcase-alt"></i>
                           </div>
                        </div>

                     </div>
                     <!-- Card 1 End  -->
                  </div>


                  

              
                  

                  <div class="col-xxl-4 mb-25">
                  <div class="ap-po-details ap-po-details--luodcy  overview-card-shape radius-xl d-flex justify-content-between">
                        <div id="container" class=" ap-po-details-content d-flex flex-wrap justify-content-between w-100"></div>
                             
   

<?php

if (!empty($sudahtertasarufkan) && !empty($sudahtertasarufkan)) {
    $total = $sudahtertasarufkan + $belumtertasarufkan;
    
    $sudahtas = ($sudahtertasarufkan / $total) * 100;
    $belumtas = ($belumtertasarufkan / $total) * 100;
} else if (empty($sudahtertasarufkan) && !empty($sudahtertasarufkan)) {
    // Penanganan jika pembagian oleh nol terjadi
    $total = 0 + $belumtertasarufkan;

    $sudahtas = 0;
    $belumtas = ($belumtertasarufkan / $total) * 100;
} else {
    $sudahtas = 0;
    $belumtas = 0;
}

?>




                        <script type="text/javascript">
                           Highcharts.setOptions({
    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.7
            },
            stops: [
                [0, color],
                [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    })
});
// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Data Tasaruf',
        align: 'center'
    },

    accessibility: {
        announceNewData: {
            enabled: true
        },
        point: {
            valueSuffix: '%'
        }
    },

    plotOptions: {
        series: {
            borderRadius: 5,
            dataLabels: [{
                enabled: true,
                distance: 15,
                format: '{point.name}'
            }, {
                enabled: true,
                distance: '-30%',
                filter: {
                    property: 'percentage',
                    operator: '>',
                    value: 5
                },
                format: '{point.y:.1f}%',
                style: {
                    fontSize: '0.9em',
                    textOutline: 'none'
                }
            }]
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },

    series: [
        {
            name: 'Proses Tasaruf',
            colorByPoint: true,
            data: [
                {
                    name: 'Sudah Tertasarufkan',
                    y: {{ $sudahtas }}
                },
                {
                    name: 'Belum Tertasarufkan',
                    y: {{ $belumtas }}
                }
            ]
        }
    ]
   
});

		</script>         

</div>
</div>

<div class="col-xxl-4 mb-25">
<div class="row">
<div class="ap-po-details ap-po-details--luodcy  overview-card-shape radius-xl d-flex justify-content-between">
                        <div id="containerr" class=" ap-po-details-content d-flex flex-wrap justify-content-between w-100"></div>
</div>
<script type="text/javascript">
Highcharts.chart('containerr', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Penerimaan Proposal Tahun ini'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [
        @if ($belum != 0)
        {
            name: 'Belum di Proses',
            y: {{ $belum }},
        },
        @endif
        @if ($onproses != 0)
        {
            name: 'Dalam Pemrosesan',
            y: {{ $onproses }},
        },
        @endif
        @if ($totalok != 0)
        {
            name: 'Sudah Selesai',
            y: {{ $totalok }},
        }
        @endif
        ]
    }]
});
</script>

</div>
</div>
<div class="col-xxl-4 mb-25">
                  <div class="ap-po-details ap-po-details--luodcy  overview-card-shape radius-xl d-flex justify-content-between">
                        <div id="hasil" class=" ap-po-details-content d-flex flex-wrap justify-content-between w-100"></div>
                             
                        <?php
$hasilll = $terima +  $tolak ;

// Periksa apakah $hasilll tidak nol sebelum melakukan pembagian
if ($hasilll != 0) {
    $proter = ($terima / $hasilll) * 100 ;
    $protol = ($tolak / $hasilll) * 100 ;
} else {
    // Jika $hasilll nol, atur nilai $proter dan $protol menjadi 0
    $proter = 0;
    $protol = 0;
}
?>

                        <script type="text/javascript">
// Create the chart
Highcharts.chart('hasil', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Pengajuan Proposal',
        align: 'center'
    },

    accessibility: {
        announceNewData: {
            enabled: true
        },
        point: {
            valueSuffix: '%'
        }
    },

    plotOptions: {
        series: {
            borderRadius: 5,
            dataLabels: [{
                enabled: true,
                distance: 15,
                format: '{point.name}'
            }, {
                enabled: true,
                distance: '-30%',
                filter: {
                    property: 'percentage',
                    operator: '>',
                    value: 5
                },
                format: '{point.y:.1f}%',
                style: {
                    fontSize: '0.9em',
                    textOutline: 'none'
                }
            }]
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },

    series: [
        {
            name: 'Proposal',
            colorByPoint: true,
            data: [
                {
                    name: 'Diterima',
                    y: {{ $proter }}
                },
                {
                    name: 'Ditolak',
                    y: {{ $protol }}
                }
            ]
        }
    ]
   
});

		</script>         

</div>
</div>




<div class="col-xxl-12 mb-25">

<div class="card border-0 px-25 h-100">
   <div class="card-header px-0 border-0">
      <h6>Grafik Penerimaan</h6>
   </div>
   <div class="card-body p-0 pb-sm-25">
      <div class="tab-content">
        
        
         <div class="tab-pane  active show" id="salesgrowth3" role="tabpanel" aria-labelledby="salesgrowth3-tab">

            <div class="parentContainer">


                  <div id="pendapatan">
                  </div>
                
                  <script type="text/javascript">

var zakatDataRaw = {!! json_encode($zakatData) !!};
    // Menghapus tanda kutip dari angka dalam array
    var zakatData = zakatDataRaw.map(function(value) {
        return parseFloat(value);
    });
    var infaqData = {!! json_encode($infaqData) !!};
    // Menghapus tanda kutip dari angka dalam array
    var infaqData = infaqData.map(function(value) {
        return parseFloat(value);
    });


Highcharts.chart('pendapatan', {
    title: {
        text: ''
    },
    xAxis: {
        categories: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
    },
    labels: {
        items: [{
            html: '',
            style: {
                left: '50px',
                top: '18px',
                color: ( // theme
                    Highcharts.defaultOptions.title.style &&
                    Highcharts.defaultOptions.title.style.color
                ) || 'black'
            }
        }]
    },
    series: [


    {
        type: 'column',
        name: 'Zakat',
        data: zakatData
    },
     {
        type: 'column',
        name: 'Infaq',
        data: infaqData
    
    }



 




    ]
});

		</script>
                  

            </div>
         </div>
      </div>
   </div>
</div>

</div>
               
    </div>
</div>
@endsection