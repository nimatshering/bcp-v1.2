<script src="https://code.highcharts.com/maps/highmaps.js"></script>
{{-- <script src="https://code.highcharts.com/mapdata/countries/bt/bt-all.js"></script> --}}
 <script src="{{ asset('js/bt-all.js') }}"></script> 

<script type="text/javascript">

// Prepare demo data
var disaster = {!! json_encode($disaster) !!};
var year = {!! json_encode($year) !!};
var type = {!! json_encode($disaster_name) !!};
var data = disaster;
console.log(data);
// Create the chart
Highcharts.mapChart('bhutanmap', {
    chart: {
        map: 'countries/bt/bt-all'
    },

    title: {
        text: 'Number of Disasters ('+type+') - ' + year
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
        name: 'Disaster(s)',
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
                window.location = 'http://127.0.0.1:8000/'    
            }
        }
    }]
});

  </script>