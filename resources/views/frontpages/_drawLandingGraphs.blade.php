<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
{{-- <script src="https://code.highcharts.com/modules/exporting.js"></script> --}}
{{-- <script src="https://code.highcharts.com/modules/export-data.js"></script> --}}
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
{{-- <script src="//rawgithub.com/phpepe/highcharts-regression/master/highcharts-regression.js?8"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine-ie11.min.js"
    integrity="sha512-Atu8sttM7mNNMon28+GHxLdz4Xo2APm1WVHwiLW9gW4bmHpHc/E2IbXrj98SmefTmbqbUTOztKl5PDPiu0LD/A=="
    crossorigin="anonymous"></script>

<script type="text/javascript">
    
  $(document).ready(function() {
        // var slideIndex = 0;
        // showSlides();
        load_Disaster_data();
        load_MinMaxTemp_data();
        load_GHG_data();
  });

//Slide show
  function showSlides() {
          var i;
          var slides = document.getElementsByClassName("gallerySlides");
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
          }
          slideIndex++;
          if (slideIndex > slides.length) { slideIndex = 1 }
          slides[slideIndex - 1].style.display = "block";
          setTimeout(showSlides, 2000); // Change image every 2 seconds
          };

          var slideIndex = 1;
          // showSlides1(slideIndex);
          // Next/previous controls
          function plusSlides(n) {
            showSlides1(slideIndex += n);
          }
          // Thumbnail image controls
          function currentSlide(n) {
          showSlides1(slideIndex = n);
    }

  //Slider 1
  function showSlides1(n) {
    var i;
    var slides = document.getElementsByClassName("dataSlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
  }
  
  //function to load data
  function load_MinMaxTemp_data(){//start_year,end_year,station,parameter,chartType) {
      $.ajax({
          url: '/report/fetch_minmax_climate_data',
          method:"POST",
          data: {
              "_token": "{{ csrf_token() }}",
              //start_year:start_year,
              //end_year:end_year,
              //station:station,
              //parameter:parameter
          },
          
          dataType: "JSON",
          error: function(req, err){ 
            console.log('my message :' + err); 
          },
          success:function(data) {
            //console.log(data);
            renderTempChart(data,'line');

          } 
      });
  }

  //function to load Disaster data
  function load_Disaster_data(){
      $.ajax({
          url: '/report/fetch_disaster_data',
          method:"POST",
          data: {
              "_token": "{{ csrf_token() }}",
              //start_year:start_year,
              //end_year:end_year,
              //station:station,
              //parameter:parameter
          },
          
          dataType: "JSON",
          error: function(req, err){ 
            console.log('my message :' + err); 
          },
          success:function(data) {
            console.log(data);
            renderDisasterChart(data);

          } 
      });
      
  }

  //function to load GHG data
  function load_GHG_data(){
      $.ajax({
          url: '/report/fetch_landing_ghg_data',
          method:"POST",
          data: {
              "_token": "{{ csrf_token() }}",
              //start_year:start_year,
              //end_year:end_year,
              //station:station,
              //parameter:parameter
          },
          
          dataType: "JSON",
          error: function(req, err){ 
            console.log('my message :' + err); 
          },
          success:function(data) {
            //console.log(data);
            renderGHG(data);

          } 
      });
      
  }

  //function render temperature chart
  function renderTempChart(data,chartType) {
    Highcharts.chart('container-temp', {
      chart: {
          type: chartType
      },
      title: {
          text: 'Average Temperature'
      },
      xAxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          title: {
            text: 'Months'
        }
      },
      yAxis: {
          title: {
              text: 'Temperature (°C)'
          }
      },
      credits: {
        enabled: false
        },
      plotOptions: {
          line: {
              dataLabels: {
                  enabled: false
              },
              enableMouseTracking: false
          }
      },
      series: data
  });
  }

  //Render GHG chart
  function renderGHG(data){
    Highcharts.chart('container-ghg', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Sectoral GHG Emission'
        },
        xAxis: {
            categories: ['GHG Emissions']
        },
        credits: {
            enabled: false
        },
        series: data /*[{
            name: 'Agriculture',
            data: [0.52]
        }, {
            name: 'Industry',
            data: [0.33]
        }, {
            name: 'Waste',
            data: [0.08]
        },{
            name: 'Other Fuel Combustion',
            data: [0.45]
        },{
            name: 'Land-use change and Forestry',
            data: [-3.78]
        }]*/
    });
  }
  
  //Render Disaster Char
  function renderDisasterChart(data){
    Highcharts.chart('container-disaster', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Disaster Types'
        },

          credits: {
            enabled: false
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
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Number of Disasters',
            colorByPoint: true,
            data: data /*[{
                name: 'Earthquake',
                y: 5250,
                sliced: true,
                selected: true
            }, {
                name: 'Flashflood',
                y: 823
            }, {
                name: 'Windstorm',
                y: 5018
            }, {
                name: 'Landslides',
                y: 366
            }, {
                name: 'Hailstorm',
                y: 2313
            }, {
                name: 'Other',
                y: 1420
            }]*/
        }]
    });
  }
</script>