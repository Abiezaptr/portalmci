     <!-- Begin Page Content -->
     <style>
         .purple {
             background-color: rgb(77, 7, 61);
             /* Warna latar belakang */
             color: white;
             /* Warna teks */
         }

         .maroon {
             background-color: rgb(202, 119, 119);
             color: white;
         }
     </style>
     <div class="container-fluid">

         <!-- DataTales Example -->
         <div class="card shadow mb-4">
             <div class="card-header py-3 d-flex justify-content-between align-items-center">
                 <!-- Title on the left -->
                 <h6 class="m-0 font-weight-bold" style="color: maroon;">Manage User</h6>

                 <a href="<?= site_url('admin/user/add') ?>" class="btn btn-danger btn-sm btn-icon-split">
                     <span class="icon text-white-50">
                         <i class="fas fa-plus"></i>
                     </span>
                     <span class="text">New Users</span>
                 </a>
             </div>

             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>#</th>
                                 <th>Username</th>
                                 <th>Email</th>
                                 <th>Role</th>
                                 <th>Status</th>
                                 <th></th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php if (!empty($users)) : ?>
                                 <?php $no = 1; ?>
                                 <?php foreach ($users as $user) : ?>
                                     <tr>
                                         <td><?= $no++; ?></td>
                                         <td><?= $user['username']; ?></td>
                                         <td style="color: maroon;"><?= $user['email']; ?></td>
                                         <td>
                                             <?php if ($user['role'] == '1'): ?>
                                                 <span class="badge bg-primary text-white">Superadmin</span>
                                             <?php elseif ($user['role'] == '2'): ?>
                                                 <span class="badge bg-danger text-white">Guest</span>
                                             <?php elseif ($user['role'] == '3'): ?>
                                                 <span class="badge bg-success text-white">Admin Mobile</span>
                                             <?php elseif ($user['role'] == '4'): ?>
                                                 <span class="badge bg-warning text-white">Admin Fixed</span>
                                             <?php elseif ($user['role'] == '5'): ?>
                                                 <span class="badge purple text-white">Admin Digital</span>
                                             <?php elseif ($user['role'] == '6'): ?>
                                                 <span class="badge maroon">Admin Global</span>
                                             <?php endif; ?>
                                         </td>
                                         <td>
                                             <?php if ($user['status'] == 'AKTIF'): ?>
                                                 <span class="badge badge-success">Active</span>
                                             <?php elseif ($user['status'] == 'NONAKTIF'): ?>
                                                 <span class="badge badge-danger">Deactivate</span>
                                             <?php endif; ?>
                                         </td>
                                         <td>
                                             <a href="#" data-toggle="modal" data-target="#updateUserModal<?= $user['id']; ?>" class="btn btn-sm"><i class="fa fa-pencil-alt" style="color: maroon;"></i></a>&nbsp;
                                             <?php if ($this->session->userdata('role') == 1) : ?>
                                                 <a href="<?= site_url('delete-user/' . $user['id']); ?>" class="btn btn-sm"><i class="fa fa-trash-alt" style="color: maroon;"></i></a>
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

     <!-- Modal untuk Tambah Pengguna Baru -->
     <div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="newUserModalLabel">Add New User</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <form action="<?= site_url('add-user'); ?>" method="post">
                     <div class="modal-body">
                         <div class="form-group">
                             <label for="username">Username</label>
                             <select class="form-control username" id="username" name="username" style="width: 100%;">
                                 <option value="">Pilih Username</option>
                                 <?php foreach ($all_users as $u): ?>
                                     <option value="<?= $u['username']; ?>"><?= $u['username']; ?></option>
                                 <?php endforeach; ?>
                             </select>


                         </div>
                         <div class="form-group">
                             <label for="email">Email</label>
                             <input type="email" class="form-control" id="email" name="email" placeholder="Email akan terisi otomatis" readonly required>
                         </div>
                         <div class="form-group">
                             <label for="role">Role</label>
                             <select class="form-control" id="role" name="role" required>
                                 <option value="3">Admin Mobile</option>
                                 <option value="4">Admin Fixed</option>
                                 <option value="5">Admin Digital Insight</option>
                                 <option value="6">Admin Global</option>
                             </select>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary">Add User</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>

     <!-- Modal update -->
     <?php foreach ($users as $user) : ?>
         <div class="modal fade" id="updateUserModal<?= $user['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateUserModal" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h6 class="modal-title" id="updateUserModal">Update Users</h6>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <form action="<?= site_url('update-user/' . $user['id']); ?>" method="post">
                         <div class="modal-body">
                             <div class="form-group">
                                 <label for="username">Username</label>
                                 <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>">
                             </div>
                             <div class="form-group">
                                 <label for="email">Email</label>
                                 <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>">
                             </div>
                             <div class="form-group">
                                 <label for="role">Role</label>
                                 <select class="form-control" id="role" name="role">
                                     <option value="1" <?= $user['role'] == '1' ? 'selected' : ''; ?>>Superadmin</option>
                                     <option value="3" <?= $user['role'] == '3' ? 'selected' : ''; ?>>Admin Mobile</option>
                                     <option value="4" <?= $user['role'] == '4' ? 'selected' : ''; ?>>Admin Fixed</option>
                                     <option value="5" <?= $user['role'] == '5' ? 'selected' : ''; ?>>Admin Digital Insight</option>
                                     <option value="6" <?= $user['role'] == '6' ? 'selected' : ''; ?>>Admin Global</option>
                                     <option value="2" <?= $user['role'] == '2' ? 'selected' : ''; ?>>Guest</option>
                                 </select>
                             </div>
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                             <button type="submit" class="btn btn-danger text-white">Update User</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     <?php endforeach; ?>