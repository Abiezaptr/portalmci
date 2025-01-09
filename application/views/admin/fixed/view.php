     <!-- Begin Page Content -->
     <div class="container-fluid">

         <!-- DataTales Example -->
         <div class="card shadow mb-4">
             <div class="card-header py-3 d-flex justify-content-between align-items-center">
                 <!-- Title on the left -->
                 <h6 class="m-0 font-weight-bold" style="color: maroon;">FIXED REPORT LIST</h6>

                 <!-- Button group on the right -->
                 <div class="btn-group" role="group">
                     <!-- Add button -->
                     <a href="<?= site_url('add/fixed-report') ?>" class="btn btn-danger btn-sm btn-icon-split">
                         <span class="icon text-white-50">
                             <i class="fas fa-plus"></i>
                         </span>
                         <span class="text">ADD ROW</span>
                     </a>

                     <!-- New button for category report -->
                     <a href="<?= site_url('admin/category/report') ?>" class="btn btn-info btn-sm btn-icon-split ml-2">
                         <span class="icon text-white-50">
                             <i class="fas fa-list"></i>
                         </span>
                         <span class="text">CATEGORY REPORT</span>
                     </a>
                 </div>
             </div>

             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>#</th>
                                 <th>FILENAME</th>
                                 <th>IMAGE</th>
                                 <th>GROUP</th>
                                 <th>TYPE</th>
                                 <th>LOCATION</th>
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
                                             <div style="border: 1px solid #ffc107; border-radius: 5px; padding: 5px; background-color: #fff3cd; color: #856404;">
                                                 <center> <strong>Fixed</strong>
                                             </div>
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
                                                 <a style="color: maroon;" href="<?= base_url('uploads/report/' . $report['file']); ?>" target="_blank">Open</a>
                                             <?php else: ?>
                                                 No file available
                                             <?php endif; ?>
                                         </td>
                                         <td>
                                             <!-- Dropdown button -->
                                             <div class="dropdown">
                                                 <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                     Action
                                                 </button>
                                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                     <a class="dropdown-item" href="<?= site_url('update/fixed-report/' . $report['id']); ?>">Update</a>
                                                     <?php if ($this->session->userdata('role') == 1) : ?>
                                                         <div class="dropdown-divider" style="border-top: 1px dashed #ccc; margin: 5px 0;"></div>
                                                         <a class="dropdown-item" href="<?= site_url('delete/fixed-report/' . $report['id']); ?>">Remove</a>
                                                     <?php endif; ?>
                                                 </div>
                                             </div>
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