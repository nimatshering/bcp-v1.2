<script src="https://code.highcharts.com/maps/highmaps.js"></script>
 <script src="{{ asset('js/bt-all.js') }}"></script> 

<script type="text/javascript">
// Prepare demo data
var tempdata = {!! json_encode($data) !!};
var data = tempdata;
var year = {!! json_encode($year) !!};
//console.log(data);
// Create the chart
Highcharts.mapChart('bhutanmap', {
    chart: {
        map: 'countries/bt/bt-all'
    },

    title: {
        text: 'Annual Average Maximum Temperature (°C) Distribution - ' + year
    },

    mapNavigation: {
        enabled: true,
        buttonOptions: {
            verticalAlign: 'bottom'
        }
    },

    colorAxis: {
        accessibility: {
            enabled : true,
        },
        stops: [
            [0, '#f18888'],
            [0.5,'#ee5454'],
            [1, '#f30606']
        ],
        className: 'heatmaplegend',
        visible: true,
    },
    credits: {
            enabled: false
        },
    series: [{
        data: data,
        name: 'Avg. Max. Temp',
        states: {
            hover: {
                color: '#8a0909'
            }
        },
        dataLabels: {
            enabled: true,
            format: '{point.name}'
        },
        events: {
            click: function(){
                //window.location = 'http://127.0.0.1:8000/'    
            }
        }
    }]
});

  </script>