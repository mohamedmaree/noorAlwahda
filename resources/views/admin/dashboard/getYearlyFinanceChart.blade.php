<div id="finance-chart"></div>

    <script>

        //finance chart
        var options = {
          series: [{
          name: '{{ __('admin.carFinanceCount') }}',
          data: @json($carFinanceCount)
        },{
          name: '{{ __('admin.carFinanceRequiredSum') }}',
          data: @json($carFinanceRequiredSum)
        },{
          name: '{{ __('admin.carFinancePaidSum') }}',
          data: @json($carFinancePaidSum)
        }
        ],
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
          categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9','10','11','12'],
        },
        yaxis: {
          title: {
            text: ''
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "" + val + ""
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#finance-chart"), options);
        chart.render();
    </script>
    