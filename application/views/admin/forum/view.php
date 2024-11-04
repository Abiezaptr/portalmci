     <!-- Begin Page Content -->
     <div class="container-fluid">

         <!-- DataTales Example -->
         <div class="card shadow mb-4">
             <div class="card-header py-3 d-flex justify-content-between align-items-center">
                 <!-- Title on the left -->
                 <h6 class="m-0 font-weight-bold" style="color: maroon;">Forum Threads</h6>

                 <!-- Add button on the right -->
                 <a href="<?= site_url('admin/forum/add') ?>" class="btn btn-danger btn-sm btn-icon-split">
                     <span class="icon text-white-50">
                         <i class="fas fa-plus"></i>
                     </span>
                     <span class="text">New Threads</span>
                 </a>
             </div>

             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>#</th>
                                 <th>Threads</th>
                                 <th>Image</th>
                                 <th>Prolog</th>
                                 <th>Category</th>
                                 <th>Replies</th>
                                 <th>Views</th>
                                 <th>Users</th> <!-- Kolom untuk menampilkan avatar pengguna -->
                                 <th></th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php if (!empty($threads)) : ?>
                                 <?php $no = 1; ?>
                                 <?php foreach ($threads as $thread) : ?>
                                     <tr>
                                         <td><?= $no++; ?></td>
                                         <td style="color: maroon;"><?= $thread['title']; ?></td>
                                         <td>
                                             <!-- Displaying image from uploads/image folder -->
                                             <?php if (!empty($thread['image'])): ?>
                                                 <img src="<?= base_url('uploads/forum_threads/' . $thread['image']); ?>" alt="Report Image" width="100">
                                             <?php else: ?>
                                                 No image available
                                             <?php endif; ?>
                                         </td>
                                         <td><?= $thread['content']; ?></td>
                                         <td><?= $thread['category_name']; ?></td>
                                         <td><?= isset($thread['replies_count']) ? $thread['replies_count'] : 0; ?></td>
                                         <td><?= isset($thread['views_count']) ? $thread['views_count'] : 0; ?></td>
                                         <td>
                                             <div class="thread-meta" style="display: flex; align-items: center; margin-top: 2px;">
                                                 <div class="user-avatars" style="display: flex; align-items: center;">
                                                     <?php
                                                        // Mengambil user_id dari string yang dipisahkan koma
                                                        $user_ids = explode(',', $thread['user_id']); // Contoh: '1,3,4'
                                                        $usernames = []; // Array untuk menyimpan username

                                                        // Ambil username dari database berdasarkan user_id
                                                        foreach ($user_ids as $user_id) {
                                                            $this->db->select('username');
                                                            $this->db->where('id', trim($user_id));
                                                            $query = $this->db->get('users');
                                                            if ($query->num_rows() > 0) {
                                                                $usernames[] = $query->row()->username;
                                                            }
                                                        }

                                                        // Jika tidak ada users
                                                        if (empty($usernames)) {
                                                            echo '<span>No users joined</span>'; // Teks jika tidak ada user yang bergabung
                                                        } else {
                                                            // Ambil 3 pengguna terakhir
                                                            $latest_users = array_slice($usernames, -3);
                                                            foreach ($latest_users as $username) : ?>
                                                             <div class="user-avatar" style="background-color: #6c757d; 
                                            color: white; 
                                            border-radius: 50%; 
                                            width: 30px; 
                                            height: 30px; 
                                            display: flex; 
                                            align-items: center; 
                                            justify-content: center; 
                                            margin-right: -10px; 
                                            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
                                                                 <?= strtoupper(substr($username, 0, 1)); // Inisial dari username 
                                                                    ?>
                                                             </div>
                                                         <?php endforeach; ?>

                                                         <?php if (count($usernames) > 3): ?>
                                                             <div class="user-avatar" style="background-color: #6c757d; 
                                            color: white; 
                                            border-radius: 50%; 
                                            width: 30px; 
                                            height: 30px; 
                                            display: flex; 
                                            align-items: center; 
                                            justify-content: center; 
                                            margin-right: -10px; 
                                            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
                                                                 <?= '3+'; ?>
                                                             </div>
                                                     <?php endif;
                                                        } ?>
                                                 </div>
                                             </div>
                                         </td>
                                         <td>
                                             <a href="<?= site_url('admin/forum/edit/' . $thread['id']); ?>" class="btn btn-sm"><i class="fa fa-pencil-alt" style="color: maroon;"></i></a>&nbsp;
                                             <?php if ($this->session->userdata('role') == 1) : ?>
                                                 <a href="<?= site_url('admin/forum/delete/' . $thread['id']); ?>" class="btn btn-sm"><i class="fa fa-trash-alt" style="color: maroon;"></i></a>
                                             <?php endif; ?>
                                         </td>
                                     </tr>
                                 <?php endforeach; ?>
                             <?php else : ?>
                                 <tr>
                                     <td colspan="8" class="text-center">No threads found.</td>
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