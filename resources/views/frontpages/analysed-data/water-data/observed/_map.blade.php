<script src="https://code.highcharts.com/maps/highmaps.js"></script>
{{-- <script src="https://code.highcharts.com/mapdata/countries/bt/bt-all.js"></script> --}}
 <script src="{{ asset('js/bt-all.js') }}"></script> 

<script type="text/javascript">

// Prepare demo data
var tempdata = {!! json_encode($data) !!};
var data = tempdata;
var year = {!! json_encode($year) !!};
console.log(data);
// Create the chart
Highcharts.mapChart('bhutanmap', {
    chart: {
        map: 'countries/bt/bt-all'
    },

    title: {
        text: 'Annual Cumulative Flow (cubic meter / sec) - ' + year
    },

    mapNavigation: {
        enabled: true,
        buttonOptions: {
            verticalAlign: 'bottom'
        }
    },

    colorAxis: {
        min:0
    },
    
    series: [{
        data: data,
        name: 'Annual Flow',
        states: {
            hover: {
                color: '#BADA55'
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