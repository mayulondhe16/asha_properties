<footer class="footer py-4  ">
  <div class="container-fluid">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="copyright text-center text-sm text-muted text-lg-start">
          © <script>
            document.write(new Date().getFullYear())
          </script>,
          made with <i class="fa fa-heart"></i> by
          <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Sumago Infotech</a>
          for a better web.
        </div>
      </div>
    </div>
  </div>
</footer>
</div>
</main>
 <!--   Core JS Files   -->
 <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
 <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
 <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
 <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
 <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
 <script src="{{asset('assets/js/jquery.js')}}"></script>
 <script src="{{asset('assets/js/parsley-2.9.2.min.js')}}"></script>
 <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>

 <script>
  new DataTable('#example');
  //  var ctx = document.getElementById("chart-bars").getContext("2d");

  //  new Chart(ctx, {
  //    type: "bar",
  //    data: {
  //      labels: ["M", "T", "W", "T", "F", "S", "S"],
  //      datasets: [{
  //        label: "Sales",
  //        tension: 0.4,
  //        borderWidth: 0,
  //        borderRadius: 4,
  //        borderSkipped: false,
  //        backgroundColor: "rgba(255, 255, 255, .8)",
  //        data: [50, 20, 10, 22, 50, 10, 40],
  //        maxBarThickness: 6
  //      }, ],
  //    },
  //    options: {
  //      responsive: true,
  //      maintainAspectRatio: false,
  //      plugins: {
  //        legend: {
  //          display: false,
  //        }
  //      },
  //      interaction: {
  //        intersect: false,
  //        mode: 'index',
  //      },
  //      scales: {
  //        y: {
  //          grid: {
  //            drawBorder: false,
  //            display: true,
  //            drawOnChartArea: true,
  //            drawTicks: false,
  //            borderDash: [5, 5],
  //            color: 'rgba(255, 255, 255, .2)'
  //          },
  //          ticks: {
  //            suggestedMin: 0,
  //            suggestedMax: 500,
  //            beginAtZero: true,
  //            padding: 10,
  //            font: {
  //              size: 14,
  //              weight: 300,
  //              family: "Roboto",
  //              style: 'normal',
  //              lineHeight: 2
  //            },
  //            color: "#fff"
  //          },
  //        },
  //        x: {
  //          grid: {
  //            drawBorder: false,
  //            display: true,
  //            drawOnChartArea: true,
  //            drawTicks: false,
  //            borderDash: [5, 5],
  //            color: 'rgba(255, 255, 255, .2)'
  //          },
  //          ticks: {
  //            display: true,
  //            color: '#f8f9fa',
  //            padding: 10,
  //            font: {
  //              size: 14,
  //              weight: 300,
  //              family: "Roboto",
  //              style: 'normal',
  //              lineHeight: 2
  //            },
  //          }
  //        },
  //      },
  //    },
  //  });


  //  var ctx2 = document.getElementById("chart-line").getContext("2d");

  //  new Chart(ctx2, {
  //    type: "line",
  //    data: {
  //      labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
  //      datasets: [{
  //        label: "Mobile apps",
  //        tension: 0,
  //        borderWidth: 0,
  //        pointRadius: 5,
  //        pointBackgroundColor: "rgba(255, 255, 255, .8)",
  //        pointBorderColor: "transparent",
  //        borderColor: "rgba(255, 255, 255, .8)",
  //        borderColor: "rgba(255, 255, 255, .8)",
  //        borderWidth: 4,
  //        backgroundColor: "transparent",
  //        fill: true,
  //        data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
  //        maxBarThickness: 6

  //      }],
  //    },
  //    options: {
  //      responsive: true,
  //      maintainAspectRatio: false,
  //      plugins: {
  //        legend: {
  //          display: false,
  //        }
  //      },
  //      interaction: {
  //        intersect: false,
  //        mode: 'index',
  //      },
  //      scales: {
  //        y: {
  //          grid: {
  //            drawBorder: false,
  //            display: true,
  //            drawOnChartArea: true,
  //            drawTicks: false,
  //            borderDash: [5, 5],
  //            color: 'rgba(255, 255, 255, .2)'
  //          },
  //          ticks: {
  //            display: true,
  //            color: '#f8f9fa',
  //            padding: 10,
  //            font: {
  //              size: 14,
  //              weight: 300,
  //              family: "Roboto",
  //              style: 'normal',
  //              lineHeight: 2
  //            },
  //          }
  //        },
  //        x: {
  //          grid: {
  //            drawBorder: false,
  //            display: false,
  //            drawOnChartArea: false,
  //            drawTicks: false,
  //            borderDash: [5, 5]
  //          },
  //          ticks: {
  //            display: true,
  //            color: '#f8f9fa',
  //            padding: 10,
  //            font: {
  //              size: 14,
  //              weight: 300,
  //              family: "Roboto",
  //              style: 'normal',
  //              lineHeight: 2
  //            },
  //          }
  //        },
  //      },
  //    },
  //  });

  //  var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

  //  new Chart(ctx3, {
  //    type: "line",
  //    data: {
  //      labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
  //      datasets: [{
  //        label: "Mobile apps",
  //        tension: 0,
  //        borderWidth: 0,
  //        pointRadius: 5,
  //        pointBackgroundColor: "rgba(255, 255, 255, .8)",
  //        pointBorderColor: "transparent",
  //        borderColor: "rgba(255, 255, 255, .8)",
  //        borderWidth: 4,
  //        backgroundColor: "transparent",
  //        fill: true,
  //        data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
  //        maxBarThickness: 6

  //      }],
  //    },
  //    options: {
  //      responsive: true,
  //      maintainAspectRatio: false,
  //      plugins: {
  //        legend: {
  //          display: false,
  //        }
  //      },
  //      interaction: {
  //        intersect: false,
  //        mode: 'index',
  //      },
  //      scales: {
  //        y: {
  //          grid: {
  //            drawBorder: false,
  //            display: true,
  //            drawOnChartArea: true,
  //            drawTicks: false,
  //            borderDash: [5, 5],
  //            color: 'rgba(255, 255, 255, .2)'
  //          },
  //          ticks: {
  //            display: true,
  //            padding: 10,
  //            color: '#f8f9fa',
  //            font: {
  //              size: 14,
  //              weight: 300,
  //              family: "Roboto",
  //              style: 'normal',
  //              lineHeight: 2
  //            },
  //          }
  //        },
  //        x: {
  //          grid: {
  //            drawBorder: false,
  //            display: false,
  //            drawOnChartArea: false,
  //            drawTicks: false,
  //            borderDash: [5, 5]
  //          },
  //          ticks: {
  //            display: true,
  //            color: '#f8f9fa',
  //            padding: 10,
  //            font: {
  //              size: 14,
  //              weight: 300,
  //              family: "Roboto",
  //              style: 'normal',
  //              lineHeight: 2
  //            },
  //          }
  //        },
  //      },
  //    },
  //  });
   function preview_image(event,id) 
    {   
     
        var input_id = event.target.id
        var fileInput = document.getElementById(input_id);
        //var filePath = event.path[0].files[0].name;
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if(!allowedExtensions.exec(filePath))
        {
            fileInput.value = '';
            $("#error_imagepath"+id).text('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
            
            $('#output_image'+id).attr("src",'');
            return false;
        }
        else
        {
            //Image preview
            var reader = new FileReader();
            reader.onload = function()
            {
                var output = document.getElementById('output_image'+id);
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    }
 </script>
 <script>
   var win = navigator.platform.indexOf('Win') > -1;
   if (win && document.querySelector('#sidenav-scrollbar')) {
     var options = {
       damping: '0.5'
     }
     Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
   }
 </script>
 <!-- Github buttons -->
 <script async defer src="https://buttons.github.io/buttons.js"></script>
 <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
 <script src="{{asset('assets/js/material-dashboard.min.js?v=3.1.0')}}"></script>
 
</body>

</html>