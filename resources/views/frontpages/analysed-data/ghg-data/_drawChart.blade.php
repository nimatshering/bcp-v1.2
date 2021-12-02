<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
      $('#btnGen').click(function() {
        // console.log(document.getElementById("start_year").value);
        // console.log(document.getElementById("end_year").value);
          var start_year = document.getElementById("start_year").value;
          var end_year = document.getElementById("end_year").value;
          load_data(start_year, end_year)
      });
  });


 //function to load data
  function load_data(start_year,end_year) {
      $.ajax({
          url: '/report/fetch_ghg_data',
          method:"POST",
          data: {
              "_token": "{{ csrf_token() }}",
              start_year:start_year,
              end_year:end_year
          },
          
          dataType: "JSON",
          error: function(req, err){ 
            console.log('my message :' + err); 
          },
          success:function(data) {
            console.log(data);
            renderChart(data);
          } 
      });
  }

//function render chart
  function renderChart(chartData) {

  var label = chartData[0];
  var dataset = chartData['dataset'];


  Highcharts.chart('ghgchart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Greenhouse Gases'
    },
    xAxis: {
        categories: label
    },
    yAxis: {
        title: {
            text: 'CO2-e'
        },
        stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: ( // theme
                    Highcharts.defaultOptions.title.style &&
                    Highcharts.defaultOptions.title.style.color
                ) || 'gray'
            }
        }
    },
    legend: {
        align: 'right',
        x: -30,
        verticalAlign: 'top',
        y: 25,
        floating: true,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || 'white',
        borderColor: '#CCC',
        borderWidth: 1,
        shadow: false
    },
    tooltip: {
        headerFormat: '<b>{point.x}</b><br/>',
        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
    },
    credits: {
    enabled: false
    },
    plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: true
            }
        }
    },
    series: dataset
});

}
</script>