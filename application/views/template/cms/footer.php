   <!-- Scroll to Top Button-->
   <a class="scroll-to-top rounded" href="#page-top">
       <i class="fas fa-angle-up"></i>
   </a>

   <!-- Logout Modal-->
   <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">×</span>
                   </button>
               </div>
               <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
               <div class="modal-footer">
                   <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                   <a class="btn btn-primary" href="<?= site_url('login/logout') ?>">Logout</a>
               </div>
           </div>
       </div>
   </div>

   <!-- Bootstrap core JavaScript-->
   <script src="<?= base_url('assets/cms') ?>/vendor/jquery/jquery.min.js"></script>
   <script src="<?= base_url('assets/cms') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

   <!-- Core plugin JavaScript-->
   <script src="<?= base_url('assets/cms') ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

   <!-- Custom scripts for all pages-->
   <script src="<?= base_url('assets/cms') ?>/js/sb-admin-2.min.js"></script>

   <!-- Page level plugins -->
   <script src="<?= base_url('assets/cms') ?>/vendor/chart.js/Chart.min.js"></script>

   <!-- Page level custom scripts -->
   <script src="<?= base_url('assets/cms') ?>/js/demo/chart-area-demo.js"></script>
   <script src="<?= base_url('assets/cms') ?>/js/demo/chart-pie-demo.js"></script>
   <!-- Page level plugins -->
   <script src="<?= base_url('assets/cms') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
   <script src="<?= base_url('assets/cms') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

   <!-- Page level custom scripts -->
   <script src="<?= base_url('assets/cms') ?>/js/demo/datatables-demo.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

   <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>

   <!-- <script>
       $(document).ready(function() {
           $('#summernote').summernote({
               height: 300 // Set editor height
           });
       });
   </script> -->

   <script>
       $(document).ready(function() {
           $('#summernote').summernote({
               height: 300, // Set editor height
               toolbar: [
                   // Customize toolbar without the video button
                   ['style', ['bold', 'italic', 'underline']],
                   ['fontsize', ['fontsize']],
                   ['color', ['color']],
                   ['para', ['ul', 'ol']]
               ],
               callbacks: {
                   onImageUpload: function(files) {
                       uploadImage(files[0]);
                   }
               }
           });
       })
   </script>




   <script>
       $(document).ready(function() {
           <?php foreach ($reports as $report) : ?>
               $('#summernote1<?= $report['id']; ?>').summernote({
                   height: 300 // Set editor height
               });
           <?php endforeach; ?>
       });
   </script>


   <script>
       // Cek jika ada flashdata dengan key 'success'
       <?php if ($this->session->flashdata('success')): ?>
           Swal.fire({
               icon: 'success',
               title: 'Success',
               text: '<?= $this->session->flashdata('success'); ?>',
               showConfirmButton: false,
               timer: 2000
           });
       <?php endif; ?>

       // Cek jika ada flashdata dengan key 'error'
       <?php if ($this->session->flashdata('error')): ?>
           Swal.fire({
               icon: 'error',
               title: 'Error',
               text: '<?= $this->session->flashdata('error'); ?>',
               showConfirmButton: false,
               timer: 2000
           });
       <?php endif; ?>
   </script>

   <script>
       $(document).ready(function() {
           $('.select2').select2({
               placeholder: "Select options", // Tambahkan placeholder jika perlu
               allowClear: true // Agar bisa di-clear pilihan
           });
       });
   </script>

   <script>
       $(document).ready(function() {
           // Inisialisasi Select2 pada elemen dengan class username
           $('.username').select2({
               placeholder: "Pilih Users", // Placeholder
               allowClear: true // Opsi untuk menghapus pilihan
           });

           // Event ketika username berubah
           $('#username').change(function() {
               var username = $(this).val();

               if (username) {
                   $.ajax({
                       url: '<?= site_url("admin/user/get_email_by_username") ?>',
                       type: 'POST',
                       data: {
                           username: username
                       },
                       dataType: 'json',
                       success: function(response) {
                           $('#email').val(response.email); // Isi email berdasarkan username
                       },
                       error: function() {
                           $('#email').val(''); // Kosongkan jika ada error
                       }
                   });
               } else {
                   $('#email').val(''); // Kosongkan jika tidak ada username
               }
           });
       });
   </script>

   <script>
       $(document).ready(function() {
           $('#users').select2({
               placeholder: 'Select Users', // Placeholder untuk select
               allowClear: true, // Izinkan penghapusan pilihan
               width: '100%', // Lebar select
               minimumResultsForSearch: 0 // Tampilkan kotak pencarian
           });
       });
   </script>

   <script>
       // Extract data from PHP to JavaScript
       var pdfCounts = <?php echo json_encode($report_counts['pdf']); ?>;
       var articleCounts = <?php echo json_encode($report_counts['article']); ?>;
       var videoCounts = <?php echo json_encode($report_counts['videos']); ?>;

       // Prepare the data for the chart
       var categories = ["Mobile", "Fixed", "Digital Insight", "Global"];
       var pdfData = categories.map(category => pdfCounts[category] || 0);
       var articleData = categories.map(category => articleCounts[category] || 0);
       var videoData = categories.map(category => videoCounts[category] || 0);

       var ctx = document.getElementById("myDoughnutChart").getContext("2d");

       // Create the doughnut chart
       var myDoughnutChart = new Chart(ctx, {
           type: 'doughnut',
           data: {
               labels: categories,
               datasets: [{
                   label: 'PDF Reports',
                   data: pdfData,
                   backgroundColor: 'rgba(255, 0, 0, 0.6)', // Red with opacity
                   hoverBackgroundColor: 'rgba(255, 0, 0, 0.8)',
               }, {
                   label: 'Article Reports',
                   data: articleData,
                   backgroundColor: 'rgba(0, 255, 0, 0.6)', // Green with opacity
                   hoverBackgroundColor: 'rgba(0, 255, 0, 0.8)',
               }, {
                   label: 'Videos',
                   data: videoData,
                   backgroundColor: 'rgba(0, 0, 255, 0.6)', // Blue with opacity
                   hoverBackgroundColor: 'rgba(0, 0, 255, 0.8)',
               }],
           },
           options: {
               maintainAspectRatio: false,
               tooltips: {
                   backgroundColor: "rgb(255,255,255)",
                   bodyFontColor: "#858796",
                   borderColor: '#dddfeb',
                   borderWidth: 1,
                   xPadding: 15,
                   yPadding: 15,
                   displayColors: true,
                   caretPadding: 10,
               },
               legend: {
                   display: true
               },
               cutoutPercentage: 80,
           },
       });
   </script>

   <script>
       // Data jumlah thread per bulan dari PHP
       var threadsByMonth = <?php echo json_encode($threads_by_month); ?>;

       var ctx = document.getElementById("myThreadChart").getContext('2d');
       var myThreadChart = new Chart(ctx, {
           type: 'line',
           data: {
               labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
               datasets: [{
                   label: "Total", // Mengubah label menjadi Forum Thread Trends
                   lineTension: 0.3,
                   backgroundColor: "rgba(128, 0, 0, 0.05)", // Light maroon
                   borderColor: "rgba(128, 0, 0, 1)", // Maroon
                   pointRadius: 3,
                   pointBackgroundColor: "rgba(128, 0, 0, 1)", // Maroon
                   pointBorderColor: "rgba(128, 0, 0, 1)", // Maroon
                   pointHoverRadius: 3,
                   pointHoverBackgroundColor: "rgba(128, 0, 0, 1)", // Maroon
                   pointHoverBorderColor: "rgba(128, 0, 0, 1)", // Maroon
                   pointHitRadius: 10,
                   pointBorderWidth: 2,
                   data: threadsByMonth,
               }],
           },
           options: {
               maintainAspectRatio: false,
               layout: {
                   padding: {
                       left: 10,
                       right: 25,
                       top: 25,
                       bottom: 0
                   }
               },
               scales: {
                   xAxes: [{
                       time: {
                           unit: 'date'
                       },
                       gridLines: {
                           display: false,
                           drawBorder: false
                       },
                       ticks: {
                           maxTicksLimit: 7
                       }
                   }],
                   yAxes: [{
                       ticks: {
                           maxTicksLimit: 5,
                           padding: 10,
                           callback: function(value, index, values) {
                               return value; // tidak perlu dollar sign untuk jumlah thread
                           }
                       },
                       gridLines: {
                           color: "rgb(234, 236, 244)",
                           zeroLineColor: "rgb(234, 236, 244)",
                           drawBorder: false,
                           borderDash: [2],
                           zeroLineBorderDash: [2]
                       }
                   }],
               },
               legend: {
                   display: true // Menampilkan legend
               },
               tooltips: {
                   backgroundColor: "rgb(255,255,255)",
                   bodyFontColor: "#858796",
                   titleMarginBottom: 10,
                   titleFontColor: '#6e707e',
                   titleFontSize: 14,
                   borderColor: '#dddfeb',
                   borderWidth: 1,
                   xPadding: 15,
                   yPadding: 15,
                   displayColors: false,
                   intersect: false,
                   mode: 'index',
                   caretPadding: 10,
                   callbacks: {
                       label: function(tooltipItem, chart) {
                           var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                           return datasetLabel + ' : ' + tooltipItem.yLabel + ' Threads'; // tampilkan jumlah thread
                       }
                   }
               }
           }
       });
   </script>

   <script>
       // Sample data for the pie chart showing specific events this month
       var eventAttendance = [40, 30, 20]; // Attendance or importance level

       var ctx = document.getElementById("monthlyEventChart").getContext('2d');
       var monthlyEventChart = new Chart(ctx, {
           type: 'pie',
           data: {
               labels: ["MWC Las Vegas", "Tech Expo 2024", "Developer Summit"], // Event names
               datasets: [{
                   data: eventAttendance,
                   backgroundColor: [
                       "rgba(255, 99, 132, 0.6)", // Color for MWC Las Vegas
                       "rgba(54, 162, 235, 0.6)", // Color for Tech Expo 2024
                       "rgba(75, 192, 192, 0.6)" // Color for Developer Summit
                   ],
                   hoverBackgroundColor: [
                       "rgba(255, 99, 132, 0.8)",
                       "rgba(54, 162, 235, 0.8)",
                       "rgba(75, 192, 192, 0.8)"
                   ],
                   borderWidth: 1,
               }],
           },
           options: {
               maintainAspectRatio: false,
               legend: {
                   display: false
               }
           }
       });
   </script>


   <script>
       var ctx = document.getElementById("activityChart");

       // Create a gradient
       var gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
       gradient.addColorStop(0, 'maroon'); // Start color
       gradient.addColorStop(1, 'white'); // End color

       var myBarChart = new Chart(ctx, {
           type: 'bar',
           data: {
               labels: [
                   "Jan", "Feb", "Mar", "Apr",
                   "May", "Jun", "Jul", "Aug",
                   "Sep", "Oct", "Nov", "Dec"
               ],
               datasets: [{
                   label: "Visitor Activity",
                   backgroundColor: gradient, // Use the gradient for the background
                   hoverBackgroundColor: gradient, // You can use the same gradient on hover
                   borderColor: "#4e73df",
                   data: [
                       <?php
                        for ($i = 1; $i <= 12; $i++) {
                            echo (isset($activity_by_month[$i]) ? $activity_by_month[$i] : 0) . ', ';
                        }
                        ?>
                   ],
               }],
           },
           options: {
               maintainAspectRatio: false,
               layout: {
                   padding: {
                       left: 10,
                       right: 25,
                       top: 25,
                       bottom: 0
                   }
               },
               scales: {
                   xAxes: [{
                       gridLines: {
                           display: false,
                           drawBorder: false
                       },
                       ticks: {
                           maxTicksLimit: 12
                       },
                       maxBarThickness: 25,
                   }],
                   yAxes: [{
                       ticks: {
                           min: 0,
                           max: Math.max(...<?php echo json_encode(array_values($activity_by_month)); ?>) + 10,
                           maxTicksLimit: 5,
                           padding: 10,
                           callback: function(value) {
                               return value; // Display count directly
                           }
                       },
                       gridLines: {
                           color: "rgb(234, 236, 244)",
                           zeroLineColor: "rgb(234, 236, 244)",
                           drawBorder: false,
                           borderDash: [2],
                           zeroLineBorderDash: [2]
                       }
                   }],
               },
               legend: {
                   display: false
               },
               tooltips: {
                   titleMarginBottom: 10,
                   titleFontColor: '#6e707e',
                   titleFontSize: 14,
                   backgroundColor: "rgb(255,255,255)",
                   bodyFontColor: "#858796",
                   borderColor: '#dddfeb',
                   borderWidth: 1,
                   xPadding: 15,
                   yPadding: 15,
                   displayColors: false,
                   caretPadding: 10,
                   callbacks: {
                       label: function(tooltipItem, chart) {
                           var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                           return datasetLabel + ': ' + tooltipItem.yLabel; // Display the count
                       }
                   }
               },
           }
       });
   </script>


   </body>

   </html>