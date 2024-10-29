     <!-- Begin Page Content -->
     <div class="container-fluid">

         <!-- DataTales Example -->
         <div class="card shadow mb-4">
             <div class="card-header py-3">
                 <h6 class="m-0 font-weight-bold" style="color: maroon;">Role Permissions</h6>
             </div>
             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>#</th>
                                 <th>Users</th>
                                 <th>Role</th>
                                 <th>Access</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php if (!empty($users)) : ?>
                                 <?php $no = 1; ?>
                                 <?php foreach ($users as $user) : ?>
                                     <tr>
                                         <td><?= $no++; ?></td>
                                         <td>
                                             <span style="font-weight: 700;"><?= $user['username']; ?></span><br>
                                             <span style="font-weight: 300; color: maroon;"><?= $user['email']; ?></span>
                                         </td>
                                         <td>
                                             <?php if ($user['role'] == 3): ?>
                                                 <span class="badge bg-success text-white">Admin Mobile</span>
                                             <?php elseif ($user['role'] == 4): ?>
                                                 <span class="badge bg-danger text-white">Admin Fixed</span>
                                             <?php elseif ($user['role'] == 5): ?>
                                                 <span class="badge bg-warning text-white">Admin Digital</span>
                                             <?php elseif ($user['role'] == 6): ?>
                                                 <span class="badge bg-secondary text-white">Admin Global</span>
                                             <?php endif; ?>
                                         </td>
                                         <td>
                                             <div class="checkbox-group">
                                                 <label>
                                                     <input type="checkbox" class="access-checkbox" data-user-id="<?= $user['id']; ?>" data-permission="mobile" <?= isset($user['permissions']['mobile']) && $user['permissions']['mobile'] ? 'checked' : ''; ?>> Mobile
                                                 </label>
                                                 <label>
                                                     <input type="checkbox" class="access-checkbox" data-user-id="<?= $user['id']; ?>" data-permission="fixed" <?= isset($user['permissions']['fixed']) && $user['permissions']['fixed'] ? 'checked' : ''; ?>> Fixed
                                                 </label>
                                                 <label>
                                                     <input type="checkbox" class="access-checkbox" data-user-id="<?= $user['id']; ?>" data-permission="digital" <?= isset($user['permissions']['digital']) && $user['permissions']['digital'] ? 'checked' : ''; ?>> Digital
                                                 </label>
                                                 <label>
                                                     <input type="checkbox" class="access-checkbox" data-user-id="<?= $user['id']; ?>" data-permission="global" <?= isset($user['permissions']['global']) && $user['permissions']['global'] ? 'checked' : ''; ?>> Global
                                                 </label>
                                                 <label>
                                                     <input type="checkbox" class="access-checkbox" data-user-id="<?= $user['id']; ?>" data-permission="forum" <?= isset($user['permissions']['forum']) && $user['permissions']['forum'] ? 'checked' : ''; ?>> Forum
                                                 </label>
                                                 <label>
                                                     <input type="checkbox" class="access-checkbox" data-user-id="<?= $user['id']; ?>" data-permission="event" <?= isset($user['permissions']['event']) && $user['permissions']['event'] ? 'checked' : ''; ?>> Event
                                                 </label>
                                             </div>
                                         </td>
                                     </tr>
                                 <?php endforeach; ?>
                             <?php else : ?>
                                 <tr>
                                     <td colspan="6" class="text-center">No users found.</td>
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