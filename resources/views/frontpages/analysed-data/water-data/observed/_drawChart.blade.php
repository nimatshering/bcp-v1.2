<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="//rawgithub.com/phpepe/highcharts-regression/master/highcharts-regression.js?8"></script>
<script src="https://cdn.jsdelivr.net/npm/jstat@latest/dist/jstat.min.js"></script>

<script type="text/javascript">
    //button click function
  $(document).ready(function() {
      $('#btnGen').click(function() {
        //console.log(document.getElementById("start_year").value);
          var start_year = document.getElementById("start_year").value;
          var end_year = document.getElementById("end_year").value;
          var station = document.getElementById("station").value;
          var parameter = document.getElementById("parameter").value;
          var chartType = document.getElementById("statistic").value;
          var month = "Jan";
        if(chartType == "boxplot"){
          load_boxplot_data(start_year, end_year,station,parameter,chartType);
        }else if(chartType == "linear"  || chartType == "polynomial")
        {
            month = document.getElementById("month").value;
            load_regression_data(start_year,end_year,station,parameter,chartType,month);
        }
        else {//if(chartType == "line"  || chartType == "column"){
          load_data(start_year, end_year, station,parameter,chartType);
        }
      });
  });

  
 
 //function to load data
  function load_data(start_year,end_year,station, parameter,chartType) {
      $.ajax({
          url: '/report/fetch_water_data',
          method:"POST",
          data: {
              "_token": "{{ csrf_token() }}",
              start_year:start_year,
              end_year:end_year,
              station:station,
              parameter:parameter
          },
          
          dataType: "JSON",
          error: function(req, err){ 
            $("p.error").html("Something went wrong. Please check parameters and try again !!!");
            Highcharts.chart('container',"");
            console.log('my message :' + err); 
          },
          success:function(data) {
            $("p.error").html("");
            renderChart(data,chartType);

          } 
      });
      
  }

  //function to load data for boxplot
  function load_boxplot_data(start_year,end_year,station,parameter,chartType) {
      $.ajax({
          url: '/report/fetch_water_data_boxplot',
          method:"POST",
          data: {
              "_token": "{{ csrf_token() }}",
              start_year:start_year,
              end_year:end_year,
              station:station,
              parameter:parameter
          },
          
          dataType: "JSON",
          error: function(req, err){ 
            console.log('my message :' + err); 
          },
          success:function(data) {
            renderBoxPlot(data);
          } 
      });
      
  }

  //function to load data for boxplot
  function load_regression_data(start_year,end_year,station,parameter,chartType,month) {
      $.ajax({
          url: '/report/fetch_water_observed_data_regression',
          method:"POST",
          data: {
              "_token": "{{ csrf_token() }}",
              start_year:start_year,
              end_year:end_year,
              station:station,
              parameter:parameter,
              month:month
          },
          
          dataType: "JSON",
          error: function(req, err){ 
            console.log('my message :' + err); 
          },
          success:function(data) {
            renderRegression(data[0],month,data[1],data[2],data[3],data[4],data[5],data[6],data[7]);
            //renderRegressionNew(data[0],chartType,month,data[1],data[2],data[3]);
          } 
      });
      
  }

//function render chart
  function renderChart(data,chartType) {
    Highcharts.chart('container', {
      chart: {
          type: chartType
      },
      title: {
          text: 'Monthly Flow'
      },
      subtitle: {
          text: 'Source: National Center for Hydology and Meteorological'
      },
      xAxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          title: {
            text: 'Months'
        }
      },
      yAxis: {
          title: {
              text: 'Flow (Cumecs)'
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

//Function for boxplot 
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
            text: 'Flow (Cumecs)'
        },
        plotLines: []
    },

    series: [{
        name: 'Flow Observed Data',
        data: data,
        tooltip: {
            headerFormat: '<em> {point.key}</em><br/>'
        }
    }, {
        name: 'Outliers',
        color: Highcharts.getOptions().colors[0],
        type: 'scatter',
        data: [],
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

//Function - renderRegression
function renderRegression(data,month, mean, variance,std_deviation,reg_line,r,a,b) {
    let temp = [],
        tempValue = [],
        tempYear = [];
        for(let i=0;i<data.length;i++)
        {
            tempValue.push(data[i][1]);
            tempYear.push(data[i][0]);
            temp.push([parseFloat(data[i][0]),parseFloat(data[i][1])]);
        }
      
          //min year
        var minYr = tempYear.reduce(function(a, b) {
            return Math.min(a, b);
        });
        //max year
        var maxYr = tempYear.reduce(function(a, b) {
            return Math.max(a, b);
        });

        Highcharts.chart('container', {
        title: {
            text: 'For ' + month + ' Month, Trend Equation: '+'y = (' + b + ')x + ' + a 
        },
        subtitle: {
            text: "Variance: " + variance + "; Std. Deviation: " + std_deviation + "; correlation coefficient(r): " +r
            },
        xAxis: {
            min: minYr-2,
            max: maxYr+1,
            tickInterval: 2
        },
        yAxis: {
        },
        series: [{
            type: 'line',
            name: 'Regression Line',
            data: reg_line,
            marker: {
                enabled: true
            },
            states: {
                hover: {
                    lineWidth: 0
                }
            },
            enableMouseTracking: false
        }, {
            type: 'scatter',
            name: 'Observations',
            data: temp,
            marker: {
                radius: 4,
            }
        }]
    });
}
</script>