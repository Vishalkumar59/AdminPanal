<x-app-layout>

    <div class="container-fluid">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        <div class="layout-specing">
            <div class="d-flex align-items-center justify-content-between">
                 <h5 class="tx-uppercase tx-semibold ">Campaign</h5>
                
                 <a href="{{route('campaign-history', $id)}}" class="btn btn-primary">Show History</a>
            </div>

            <div class="row row-cols-xl-5 row-cols-md-2 row-cols-1">
                <div class="col mt-4">
                    <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon text-center rounded-pill">
                                <i class="uil uil-envelope fs-4 mb-0"></i>
                            </div>
                            <div class="flex-1 ms-3">
                                <h6 class="mb-0 text-muted">Total Message</h6>
                                <p class="fs-5 text-dark fw-bold mb-0">{{$msgcount}}</p>
                            </div>
                        </div>
                    </a>
                </div><!--end col-->
                
                <div class="col mt-4">
                    <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon text-center rounded-pill">
                                <i class="uil uil-envelope-send fs-4 mb-0"></i>
                            </div>
                            <div class="flex-1 ms-3">
                                <h6 class="mb-0 text-muted">Send Message</h6>
                                <p class="fs-5 text-dark fw-bold mb-0">{{$sendcount}}</p>
                            </div>
                        </div>
                    </a>
                </div><!--end col-->
                
                <div class="col mt-4">
                    <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon text-center rounded-pill">
                                <i class="uil uil-envelope-receive fs-4 mb-0"></i>
                            </div>
                            <div class="flex-1 ms-3">
                                <h6 class="mb-0 text-muted">Receive Message</h6>
                                <p class="fs-5 text-dark fw-bold mb-0">{{$receivecount}}</p>
                            </div>
                        </div>
                    </a>
                </div><!--end col-->
            </div><!--end row-->

            <div class="row">
                <div class="col-xl-12 col-lg-7 mt-4">
                    <div class="card shadow border-0 p-4 pb-0 rounded">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0 fw-bold">Campaign Overall</h6>
                            <div class="col-md-3">
                            <input type="hidden" id="id" value="{{$id}}"/>
                             <select class="form-select" name="month" id="month">
                                <option  value="0">Select Month</option>
                                <option  value="01">January</option>
                                <option  value="02">February</option>
                                <option  value="03">March</option>
                                <option  value="04">April</option>
                                <option  value="05">May</option>
                                <option  value="06">June</option>
                                <option  value="07">July</option>
                                <option  value="08">August</option>
                                <option  value="09">September</option>
                                <option  value="10">October</option>
                                <option  value="11">November</option>
                                <option  value="12">December</option>
                            </select>
                            </div>
                            <div class="col-md-3">
                              <select class="form-select" name="year" id="year">
                                  <option value="0">Select Year</option>
                                 @for ($i = $year; $i >= $year - 4; $i--)
                                    <option @if ($i == $year) selected @endif value="{{ $i }}">{{ $i }}</option>
                                 @endfor
                              </select>
                            </div>

                        </div>
                        <div  class="">
                           
                        </div>
                        <div id="campaginview" class="apex-chart"></div>
                        <div id="month-chart" class="apex-chart"></div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div>
    </div>
    <!--end container-->
    @push('scripts')
 
    <script>
        try {
            var options = {
                chart: {
                    height: 360,
                    type: 'area',
                    width: '100%',
                    stacked: false,
                    toolbar: {
                      show: false,
                      autoSelected: 'zoom'
                    },
                },
                colors: ['#2f55d4','#FF0000',' #00FF00','#FFA500'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: [1.5, 1.5],
                    dashArray: [0, 0],
                    lineCap: 'round',
                },
                grid: {
                  padding: {
                    left: 0,
                    right: 0
                  },
                  strokeDashArray: 3,
                },
                markers: {
                  size: 0,
                  hover: {
                    size: 0
                  }
                },
                series: [
                  {
                    name: 'Total Message',
                    data: ["{{$userArr['1']}}", "{{$userArr['2']}}", "{{$userArr['3']}}", "{{$userArr['4']}}", "{{$userArr['5']}}", "{{$userArr['6']}}", "{{$userArr['7']}}", "{{$userArr['8']}}", "{{$userArr['9']}}", "{{$userArr['10']}}", "{{$userArr['11']}}", "{{$userArr['12']}}"],
                },
                {
                    name: 'Total Sent',
                    data: ["{{$countsent['1']}}", "{{$countsent['2']}}", "{{$countsent['3']}}", "{{$countsent['4']}}", "{{$countsent['5']}}", "{{$countsent['6']}}", "{{$countsent['7']}}", "{{$countsent['8']}}", "{{$countsent['9']}}", "{{$countsent['10']}}", "{{$countsent['11']}}", "{{$countsent['12']}}"],
                },
                {
                    name: 'Total Received',
                    data: ["{{$countreceive['1']}}", "{{$countreceive['2']}}", "{{$countreceive['3']}}", "{{$countreceive['4']}}", "{{$countreceive['5']}}", "{{$countreceive['6']}}", "{{$countreceive['7']}}", "{{$countreceive['8']}}", "{{$countreceive['9']}}", "{{$countreceive['10']}}", "{{$countreceive['11']}}", "{{$countreceive['12']}}"],
                },
                {
                    name: 'Total User',
                    data: ["{{$numbercount['1']}}", "{{$numbercount['2']}}", "{{$numbercount['3']}}", "{{$numbercount['4']}}", "{{$numbercount['5']}}", "{{$numbercount['6']}}", "{{$numbercount['7']}}", "{{$numbercount['8']}}", "{{$numbercount['9']}}", "{{$numbercount['10']}}", "{{$numbercount['11']}}", "{{$numbercount['12']}}"],
                },
                ],
                xaxis: {
                    type: 'month',
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    axisBorder: {
                      show: true,
                    },  
                    axisTicks: {
                      show: true,
                    },
                },
                fill: {
                  type: "gradient",
                  gradient: {
                    shadeIntensity: 0.3,
                    opacityFrom: 0.4,
                    opacityTo: 0.2,
                    stops: [0, 80, 100]
                  }
                },
                
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
                legend: {
                  position: 'bottom',
                  offsetY: 0,
                },
              }
              var chart = new ApexCharts(
                document.querySelector("#campaginview"),
                options
              );
              
              chart.render();
        } catch (error) {
            
        }
    </script>
    <script>
      //Chart One
        
    </script>
    

    <script type="text/javascript">
      $(document).ready(function(){
        $("#month , #year").change(function(){
          var month = $("#month").val();
          var year = $("#year").val();
          var id = $("#id").val();
          $("#campaginview").hide();
        
          $.ajax({  
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: "post",
          url: "{{route('graph')}}",
          data: {
            year:year,
            month:month,
            id:id
          },
          success: function(data)
          {
            console.log(data);
            try {
                var options = {
                    chart: {
                        height: 360,
                        type: 'area',
                        width: '100%',
                        stacked: true,
                        toolbar: {
                          show: false,
                          autoSelected: 'zoom'
                        },
                    },
                    colors: ['#2f55d4','#FF0000',' #00FF00','#FFA500'],
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth',
                        width: [1.5, 1.5],
                        dashArray: [0, 4],
                        lineCap: 'round',
                    },
                    grid: {
                      padding: {
                        left: 0,
                        right: 0
                      },
                      strokeDashArray: 3,
                    },
                    markers: {
                      size: 0,
                      hover: {
                        size: 0
                      }
                    },
                    series: [{
                        name: 'Total',
                        data: data.total,
                    },{
                        name: 'Receive Messege',
                        data: data.receivemonth,
                    },{
                        name: 'Sent Messege',
                        data: data.sentmonth,
                    }],
                    xaxis: {
                        type: 'days',
                        categories:  data.days,
                        axisBorder: {
                          show: true,
                        },  
                        axisTicks: {
                          show: true,
                        },
                    },
                    fill: {
                      type: "gradient",
                      gradient: {
                        shadeIntensity: .8,
                        opacityFrom: 0.3,
                        opacityTo: 0.2,
                        stops: [0, 80, 100]
                      }
                    },
                    
                    tooltip: {
                        x: {
                            format: 'dd/MM/yy HH:mm'
                        },
                    },
                    legend: {
                      position: 'bottom',
                      offsetY: 0,
                    },
                  }
                  
                  var chart = new ApexCharts(
                    document.querySelector("#month-chart"),
                    options
                  );
                  
                  chart.render();
            } catch (error) {
                
            }
          }
          });
        });
      });
    </script>
  @endpush
</x-app-layout>