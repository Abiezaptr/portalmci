     <!-- Begin Page Content -->
     <div class="container-fluid">

         <!-- DataTales Example -->
         <div class="card shadow mb-4">
             <div class="card-header py-3 d-flex justify-content-between align-items-center">
                 <!-- Title on the left -->
                 <h6 class="m-0 font-weight-bold" style="color: maroon;">Fixed Report</h6>

                 <!-- Add button on the right -->
                 <a href="<?= site_url('add/fixed-report') ?>" class="btn btn-danger btn-sm btn-icon-split">
                     <span class="icon text-white-50">
                         <i class="fas fa-plus"></i>
                     </span>
                     <span class="text">New Report</span>
                 </a>
             </div>

             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>#</th>
                                 <th>Report Title</th>
                                 <th>Image</th>
                                 <th>Category</th>
                                 <th>Type</th>
                                 <th>File</th>
                                 <th></th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php if (!empty($reports)) : ?>
                                 <?php $no = 1; ?>
                                 <?php foreach ($reports as $report) : ?>
                                     <tr>
                                         <td><?= $no++; ?></td>
                                         <td><?= $report['title']; ?></td>
                                         <td>
                                             <!-- Displaying image from uploads/image folder -->
                                             <?php if (!empty($report['image'])): ?>
                                                 <img src="<?= base_url('uploads/image/' . $report['image']); ?>" alt="Report Image" width="100">
                                             <?php else: ?>
                                                 No image available
                                             <?php endif; ?>
                                         </td>
                                         <td>
                                             <span class="badge badge-warning"><?= $report['category']; ?></span>
                                         </td>
                                         <td>
                                             <?php if ($report['type'] == 'pdf'): ?>
                                                 <i class="fas fa-file-pdf" style="color: red;"></i> PDF
                                             <?php elseif ($report['type'] == 'docx'): ?>
                                                 <i class="fas fa-file-word" style="color: blue;"></i> DOCX
                                             <?php elseif ($report['type'] == 'xlsx'): ?>
                                                 <i class="fas fa-file-excel" style="color: green;"></i> XLSX
                                             <?php else: ?>
                                                 <i class="fas fa-file" style="color: gray;"></i> <?= strtoupper($report['type']); ?>
                                             <?php endif; ?>
                                         </td>
                                         <td>
                                             <?php if (!empty($report['file'])): ?>
                                                 <a style="color: maroon;" href="<?= base_url('uploads/report/' . $report['file']); ?>" target="_blank">Open file</a>
                                             <?php else: ?>
                                                 No file available
                                             <?php endif; ?>
                                         </td>
                                         <td>
                                             <a href="<?= site_url('update/fixed-report/' . $report['id']); ?>" class="btn btn-sm"><i class="fa fa-pencil-alt" style="color: maroon;"></i></a>&nbsp;
                                             <?php if ($this->session->userdata('role') == 1) : ?>
                                                 <a href="<?= site_url('delete/fixed-report/' . $report['id']); ?>" class="btn btn-sm"><i class="fa fa-trash-alt" style="color: maroon;"></i></a>
                                             <?php endif; ?>
                                         </td>
                                     </tr>
                                 <?php endforeach; ?>
                             <?php else : ?>
                                 <tr>
                                     <td colspan="7" class="text-center">No reports found.</td>
                                 </tr>
                             <?php endif; ?>
                         </tbody>
                     </table>

                 </div>
             </div>
         </div>

     </div>
     <!-- /.container-fluid -->

     </div>
     <!-- End of Main Content -->

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


     <!-- <script>
         $(document).ready(function() {
             // Listen for checkbox changes
             $('.access-checkbox').change(function() {
                 var userId = $(this).data('user-id'); // Ambil user ID dari data-user-id
                 var permissionType = $(this).data('permission'); // Ambil tipe permission dari data-permission
                 var isChecked = $(this).is(':checked') ? 1 : 0; // Cek apakah checkbox dicentang

                 // Prepare data for the Ajax request
                 var postData = {
                     user_id: userId,
                     permission: permissionType, // Menggunakan data-permission untuk permission type
                     value: isChecked // 1 jika dicentang, 0 jika tidak
                 };

                 // Send the Ajax request to update permissions
                 $.ajax({
                     url: '<?= base_url("admin/role/update_permissions"); ?>', // URL controller
                     type: 'POST',
                     data: postData,
                     success: function(response) {
                         console.log("Permissions updated successfully", response); // Log respons dari server
                         if (response.status === 'error') {
                             alert(response.message); // Tampilkan pesan error jika ada
                         }
                     },
                     error: function(xhr, status, error) {
                         console.error("Failed to update permissions: " + error);
                     }
                 });
             });
         });
     </script> -->

     <script>
         $(document).ready(function() {
             // Listen for checkbox changes
             $('.access-checkbox').change(function() {
                 var userId = $(this).data('user-id'); // Get user ID from data-user-id
                 var permissionType = $(this).data('permission'); // Get permission type from data-permission
                 var isChecked = $(this).is(':checked') ? 1 : 0; // Check if checkbox is checked

                 // Prepare data for the Ajax request
                 var postData = {
                     user_id: userId,
                     permission: permissionType, // Using data-permission for permission type
                     value: isChecked // 1 if checked, 0 if not
                 };

                 // Send the Ajax request to update permissions
                 $.ajax({
                     url: '<?= base_url("admin/role/update_permissions"); ?>', // URL controller
                     type: 'POST',
                     data: postData,
                     dataType: 'json', // Ensure we expect JSON response
                     success: function(response) {
                         console.log("Server response:", response); // Log server response for debugging

                         // Show success message using SweetAlert only if the update is successful
                         if (response && response.status === 'success') {
                             Swal.fire({
                                 icon: 'success',
                                 title: 'Success!',
                                 text: 'Permissions updated successfully.',
                                 confirmButtonText: 'OK'
                             });
                         }
                     },
                     error: function(xhr, status, error) {
                         console.error("Failed to update permissions: " + error);
                         // Do nothing for errors
                     }
                 });
             });
         });
     </script>