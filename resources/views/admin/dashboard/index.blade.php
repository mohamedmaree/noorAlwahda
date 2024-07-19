@extends('admin.layout.master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/charts/apexcharts.css')}}">
@endsection
@section('content')
{{--        <div class="row">--}}
{{--            <div class="col-lg-6 col-md-12 col-sm-12">--}}
{{--                <div class="card bg-analytics text-white">--}}
{{--                    <div class="card-content">--}}
{{--                        <div class="card-body text-center">--}}
{{--                            <img src="{{asset('admin/app-assets/images/elements/decore-left.png')}}" class="img-left" alt="card-img-left">--}}
{{--                            <img src="{{asset('admin/app-assets/images/elements/decore-right.png')}}" class="img-right" alt="card-img-right">--}}
{{--                            <div class="text-center">--}}
{{--                                <h1 class="mb-2 text-white">{{__('admin.welcome')}} {{auth('admin')->user()->name}}</h1>--}}
{{--                                <p class="m-auto w-75">{{  date('d-m-Y', strtotime(\Carbon\Carbon::now())) }} </p>--}}
{{--                                <p class="m-auto w-75">{{  date('h:i A', strtotime(\Carbon\Carbon::now())) }} </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-6 col-md-12 weatherWidgetInner">--}}
{{--                <a class="weatherwidget-io" href="https://forecast7.com/{{lang()}}/24d7146d68/riyadh/" data-label_1="{{__('admin.riyadh')}}" data-label_2="{{__('admin.weather')}}" data-font="en-us"  data-icons="Climacons" data-theme="original" data-basecolor="rgb(16 22 58)" ></a>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="row align-center">
            @foreach($menus as $key => $menu)
                @php $color = $colores[array_rand($colores)] @endphp
                <a href="{{$menu['url']}}" class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-{{$color}} p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="feather {!! $menu['icon'] !!} text-{!! $color !!} font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{$menu['count']}}</h2>
                                <p class="mb-0 line-ellipsis" style="color: #6e6a6a">{{$menu['name']}}</p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        {{-- <div class="row">

            <h3 class="col-12 d-flex  mb-2">{{__('admin.induction_Statistics')}}</h3>

            @foreach($introSiteCards as $key => $menu)
                @php $color = $colores[array_rand($colores)] @endphp
                <a href="{{$menu['url']}}" class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-{{$color}} p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="feather {!! $menu['icon'] !!} text-{!! $color !!} font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{$menu['count']}}</h2>
                                <p class="mb-0 line-ellipsis" style="color: #6e6a6a">{{$menu['name']}}</p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div> --}}
        <div class="row hight-card">
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <h4 class="card-title">{{__('admin.users')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body py-0">
                            <div id="customer-chart"></div>
                        </div>
                        <ul class="list-group list-group-flush customer-info">
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-primary"></i>
                                    <span class="text-bold-600">{{__('site.active_users')}}</span>
                                </div>
                                <div class="product-result">
                                    <span>{{$activeUsers}}</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-warning"></i>
                                    <span class="text-bold-600">{{__('site.not_active_users')}}</span>
                                </div>
                                <div class="product-result">
                                    <span>{{$notActiveUsers}}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <h4 class="card-title">{{__('admin.cars')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body py-0">
                            <div id="cars-chart"></div>
                        </div>
                        <ul class="list-group list-group-flush customer-info">
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-primary"></i>
                                    <span class="text-bold-600">{{__('admin.new_cars')}}</span>
                                </div>
                                <div class="product-result">
                                    <span>10</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-warning"></i>
                                    <span class="text-bold-600">{{__('admin.delivered_cars')}}</span>
                                </div>
                                <div class="product-result">
                                    <span>50</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <h4 class="card-title">{{__('admin.cars_status')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body py-0">
                            <div id="cars-chart-status"></div>
                        </div>
                        <ul class="list-group list-group-flush customer-info">
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-primary"></i>
                                    <span class="text-bold-600">{{__('admin.new_cars')}}</span>
                                </div>
                                <div class="product-result">
                                    <span>10</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-primary"></i>
                                    <span class="text-bold-600">{{__('admin.on_way')}}</span>
                                </div>
                                <div class="product-result">
                                    <span>10</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-primary"></i>
                                    <span class="text-bold-600">{{__('admin.picked_up')}}</span>
                                </div>
                                <div class="product-result">
                                    <span>10</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-primary"></i>
                                    <span class="text-bold-600">{{__('admin.loaded')}}</span>
                                </div>
                                <div class="product-result">
                                    <span>10</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-primary"></i>
                                    <span class="text-bold-600">{{__('admin.shipped')}}</span>
                                </div>
                                <div class="product-result">
                                    <span>10</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-warning"></i>
                                    <span class="text-bold-600">{{__('admin.delivered_cars')}}</span>
                                </div>
                                <div class="product-result">
                                    <span>50</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <h4 class="card-title">{{__('admin.cars_online')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body py-0">
                            <div id="cars-online-chart"></div>
                        </div>
                        <ul class="list-group list-group-flush customer-info">
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-primary"></i>
                                    <span class="text-bold-600">{{__('admin.online_cars')}}</span>
                                </div>
                                <div class="product-result">
                                    <span>10</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-primary"></i>
                                    <span class="text-bold-600">{{__('admin.owned_cars')}}</span>
                                </div>
                                <div class="product-result">
                                    <span>10</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-primary"></i>
                                    <span class="text-bold-600">{{__('admin.customers_cars')}}</span>
                                </div>
                                <div class="product-result">
                                    <span>10</span>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between ">
                                <div class="series-info">
                                    <i class="fa fa-circle font-small-3 text-warning"></i>
                                    <span class="text-bold-600">{{__('admin.sold_cars')}}</span>
                                </div>
                                <div class="product-result">
                                    <span>50</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-6 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-end">
                        <h4 class="card-title">{{__('admin.cars')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body pb-0">
                            <div id="revenue-chart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-6 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-end">
                        <h4 class="card-title">{{__('admin.financial')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body pb-0">
                            <div id="columns-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
                  
        </div>
@endsection
@section('js')
    <script>
        !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
    </script>

    <script src="{{asset('admin/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
    <script src="{{asset('admin/charts_functions.js')}}"></script>
    
    <script>

        //customer-chart
        new ApexCharts(
            document.querySelector("#customer-chart"),
            pieChartFunction(['active', 'not active'] , [ Number('{{$activeUsers}}'), Number('{{$notActiveUsers}}')] , ['#7367F0', '#FF9F43'])
        ).render();
        //cars-chart
        new ApexCharts(
            document.querySelector("#cars-chart"),
            pieChartFunction(['new', 'delivered'] , [ Number('10'), Number('50')] , ['#7367F0', '#FF9F43'])
        ).render();
        //cars-chart-status
        new ApexCharts(
            document.querySelector("#cars-chart-status"),
            pieChartFunction(['new','on_way','picked_up','loaded','shipped', 'delivered'] , [ Number('10'), Number('10'), Number('10'), Number('10'), Number('10'), Number('50')] ,['#A5978B', '#F9CE1D','#4CAF50', '#EA3546','#1CAF20','#A5776B'])
        ).render();

        //cars-online-chart
        new ApexCharts(
            document.querySelector("#cars-online-chart"),
            pieChartFunction(['online cars','owned cars','customers cars','sold cars'] , [ Number('10'), Number('10'), Number('10'), Number('10')] ,['#A5978B', '#F9CE1D','#4CAF50', '#EA3546'])
        ).render();


        var revenueChartoptions = {
            chart: {
            height: 270,
            toolbar: { show: false },
            type: 'line',
            },
            stroke: {
            curve: 'smooth',
            dashArray: [0, 8],
            width: [4, 2],
            },
            grid: {
            borderColor: '#e7e7e7',
            },
            legend: {
            show: false,
            },
            colors: ['#f29292', '#b9c3cd'],

            fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                inverseColors: false,
                gradientToColors: ['#7367F0', '#b9c3cd'],
                shadeIntensity: 1,
                type: 'horizontal',
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100, 100, 100]
            },
            },
            markers: {
            size: 0,
            hover: {
                size: 5
            }
            },
            xaxis: {
            labels: {
                style: {
                colors: '#b9c3cd',
                }
            },
            axisTicks: {
                show: false,
            },
            categories: ['1', '2', '3', '4', '5', '6', '7', '8' ,'9','10','11','12'],
            axisBorder: {
                show: false,
            },
            tickPlacement: 'on',
            },
            yaxis: {
            tickAmount: 5,
            labels: {
                style: {
                color: '#b9c3cd',
                },
                formatter: function (val) {
                return val > 999 ? (val / 1000).toFixed(1) + 'k' : val;
                }
            }
            },
            tooltip: {
            x: { show: false }
            },
            series: [{
            name: "{{__('admin.cars')}}",
            data: @json($carsArray)
            }
            ],

        }

        var revenueChart = new ApexCharts(
            document.querySelector("#revenue-chart"),
            revenueChartoptions
        ).render();
        //columns chart
        var options = {
          series: [{
          name: 'Net Profit',
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, {
          name: 'Revenue',
          data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }, {
          name: 'Free Cash Flow',
          data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
          title: {
            text: '$ (thousands)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands"
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#columns-chart"), options);
        chart.render();
    </script>
    
@endsection