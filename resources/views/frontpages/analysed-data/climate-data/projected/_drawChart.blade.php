<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="//rawgithub.com/phpepe/highcharts-regression/master/highcharts-regression.js?8"></script>

<script type="text/javascript">
    //button click function
  $(document).ready(function() {
      $('#btnGen').click(function() {
        //console.log(document.getElementById("start_year").value);
          var start_year = document.getElementById("start_year").value;
          var end_year = document.getElementById("end_year").value;
          var station = document.getElementById("station").value;
          var parameter = document.getElementById("parameter").value;
          var model = document.getElementById("model").value;
          var scenerio = document.getElementById("scenerio").value;
          var chartType = document.getElementById("statistic").value;
          var month = "Jan";
          var parameterType = '';
        if(parameter == 1)
          parameterType = 'Precipitation (mm)';
        else
          parameterType = 'Temperature (Deg C)';
        if(chartType == "boxplot"){
          load_boxplot_data(start_year, end_year, station,parameter,chartType, model, scenerio);
        }else if(chartType == "linear"  || chartType == "polynomial")
        {
            //renderRegression(chartType);
            month = document.getElementById("month").value;
            load_regression_data(start_year, end_year, station,parameter,chartType,month,model, scenerio);
        }
        else{
          load_data(start_year, end_year, station,parameter,chartType,model, scenerio, parameterType);
        }
          
      });
  });

  
 
 //function to load data
  function load_data(start_year,end_year,station, parameter,chartType,model, scenerio,parameterType) {
      $.ajax({
          url: '/report/fetch_climate_data',
          method:"POST",
          data: {
              "_token": "{{ csrf_token() }}",
              start_year:start_year,
              end_year:end_year,
              station:station,
              parameter:parameter,
              model:model,
              scenerio:scenerio
          },
          
          dataType: "JSON",
          error: function(req, err){ 
            $("p.error").html("Something went wrong. Please check parameters and try again !!!");
            Highcharts.chart('container',"");
            console.log('my message :' + err); 
          },
          success:function(data) {
            $("p.error").html("");
            console.log(data);
            renderChart(data,chartType,parameterType);

          } 
      });
      
  }

  //function to load data for boxplot
  function load_boxplot_data(start_year,end_year,station, parameter,chartType,model, scenerio) {
      $.ajax({
          url: '/report/fetch_climate_data_boxplot',
          method:"POST",
          data: {
              "_token": "{{ csrf_token() }}",
              start_year:start_year,
              end_year:end_year,
              station:station,
              parameter:parameter,
              model:model,
              scenerio:scenerio
          },
          
          dataType: "JSON",
          error: function(req, err){ 
            console.log('my message :' + err); 
          },
          success:function(data) {
            //console.log(data);
            renderBoxPlot(data);

          } 
      });
      
  }

  //function to load data for regression
  function load_regression_data(start_year,end_year,station, parameter,chartType, month,model, scenerio) {
      $.ajax({
          url: '/report/fetch_climate_projected_data_regression',
          method:"POST",
          data: {
              "_token": "{{ csrf_token() }}",
              start_year:start_year,
              end_year:end_year,
              station:station,
              parameter:parameter,
              month:month,
              model:model,
              scenerio:scenerio
          },
          
          dataType: "JSON",
          error: function(req, err){ 
            console.log('my message :' + err); 
          },
          success:function(data) {
            //console.log(data);
            renderRegression(data[0],chartType,month,data[1],data[2], data[3]);

          } 
      });
      
  }

//function render chart
  function renderChart(data,chartType,parameterType) {
    Highcharts.chart('container', {
      chart: {
          type: chartType
      },
      title: {
          text: 'Monthly Observsation'
      },
      subtitle: {
          text: 'Source: National Center for Hydology and Meteorological'
      },
      xAxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
      },
      yAxis: {
          title: {
              text: parameterType //'Precipitation (mm)/ Temperature (Deg C)'
          }
      },
       credits: {
        enabled: false
        },
      plotOptions: {
          line: {
              dataLabels: {
                  enabled: true
              },
              enableMouseTracking: false
          }
      },
      series: data
  });

}

function renderBoxPlot(data)
{
  //BoxPlot
    Highcharts.chart('container', {
    chart: {
        type: 'boxplot'
    },

    title: {
        text: 'Box Plot'
    },

    legend: {
        enabled: false
    },

    credits: {
        enabled: false
        },

    xAxis: {
        categories: ['Jan','Feb','Mar','Apl','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        title: {
            text: 'Months'
        }
    },

    yAxis: {
        title: {
            text: 'Precipitation/ Temperature'
        },
        plotLines: []
    },

    series: [{
        name: 'Climate Data',
        data: data,
        tooltip: {
            headerFormat: '<em> {point.key}</em><br/>'
        }
    }, {
        name: 'Outliers',
        color: Highcharts.getOptions().colors[0],
        type: 'scatter',
        data: [ // x, y positions where 0 is the first category
            /*[0, 644],
            [4, 718],
            [4, 951],
            [4, 969]*/
        ],
        marker: {
            fillColor: 'white',
            lineWidth: 1,
            lineColor: Highcharts.getOptions().colors[0]
        },
        tooltip: {
            pointFormat: 'Observation: {point.y}'
        }
    }]

    });
}

function renderRegression(data,chartType,month, mean, variance, std_deviation) {
  $('#container').highcharts({
    chart: {
      type: 'scatter',
      zoomType: 'xy'
    },
    title: {
      text: chartType + ' Regression for the Month of ' + month
    },
    subtitle: {
      text: 'Variance: ' + variance + '; Standard Deviation: ' + std_deviation
    },

    credits: {
        enabled: false
        },

    xAxis: {
      title: {
        enabled: true,
        text: 'Year'
      },
      startOnTick: true,
      endOnTick: true,
      showLastLabel: true
    },
    yAxis: {
      title: {
        text: 'Observation Value'
      },
      plotLines: [{
            value: mean,
            color: 'green',
            width: 1,
            label: {
                text: 'Mean: ' + mean,
                align: 'center',
                style: {
                    color: 'gray'
                }
            }
        }]
    },
    legend: {
      layout: 'vertical',
      align: 'left',
      verticalAlign: 'top',
      x: 100,
      y: 70,
      floating: true,
      backgroundColor: '#FFFFFF',
      borderWidth: 1
    },
    plotOptions: {
      scatter: {
        marker: {
          radius: 5,
          states: {
            hover: {
              enabled: true,
              lineColor: 'rgb(100,100,100)'
            }
          }
        },
        states: {
          hover: {
            marker: {
              enabled: false
            }
          }
        },
        tooltip: {
          headerFormat: '<b>{series.name}</b><br>',
          pointFormat: '{point.x} Year, {point.y} Value'
        }
      }
    },
    series: [{
      regression: true,
      regressionSettings: {
      	name : 'Trend Value',
        type: chartType,
        color: 'rgba(223, 183, 83, .9)',
        dashStyle: 'solid'
      },
      name: 'Observation value',
      color: 'rgba(223, 83, 83, .5)',
      data: data /* [
        [2006, 21.8],
        [2007, 22.1],
        [2008, 19.7],
        [2009, 20.4],
        [2010, 22.7],
       
      ] */
    }]
  });
}
</script>