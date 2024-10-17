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
           $('#users').select2({
               placeholder: 'Select Users', // Placeholder untuk select
               allowClear: true, // Izinkan penghapusan pilihan
               width: '100%', // Lebar select
               minimumResultsForSearch: 0 // Tampilkan kotak pencarian
           });
       });
   </script>



   </body>

   </html>