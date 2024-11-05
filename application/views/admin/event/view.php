     <!-- Begin Page Content -->
     <div class="container-fluid">

         <!-- DataTales Example -->
         <div class="card shadow mb-4">
             <div class="card-header py-3 d-flex justify-content-between align-items-center">
                 <!-- Title on the left -->
                 <h6 class="m-0 font-weight-bold" style="color: maroon;">Manage Event Calendar</h6>

                 <!-- Add button on the right -->
                 <!-- <a href="#" class="btn btn-danger btn-sm btn-icon-split" data-toggle="modal" data-target="#newUserModal">
                     <span class="icon text-white-50">
                         <i class="fas fa-plus"></i>
                     </span>
                     <span class="text">New Users</span>
                 </a> -->

                 <a href="#" data-toggle="modal" data-target="#addUserModal" class="btn btn-danger btn-sm btn-icon-split">
                     <span class="icon text-white-50">
                         <i class="fas fa-plus"></i>
                     </span>
                     <span class="text">New Event</span>
                 </a>
             </div>

             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>#</th>
                                 <th>Event Name</th>
                                 <th>Image</th>
                                 <th>Description</th>
                                 <th>Location</th>
                                 <th>Date</th>
                                 <th></th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php if (!empty($events)) : ?>
                                 <?php $no = 1; ?>
                                 <?php foreach ($events as $event) : ?>
                                     <tr>
                                         <td><?= $no++; ?></td>
                                         <td style="color: maroon;"><?= $event->title; ?></td>
                                         <td>
                                             <?php if (!empty($event->image)): ?>
                                                 <img src="<?= base_url('uploads/event/' . $event->image); ?>" alt="Report Image" width="100">
                                             <?php else: ?>
                                                 No image available
                                             <?php endif; ?>
                                         </td>
                                         <td><?= $event->description; ?></td>
                                         <td><?= $event->location; ?></td>
                                         <td><?= date('d M Y, H:i', strtotime($event->date)); ?></td>
                                         <td>
                                             <a href="#" data-toggle="modal" data-target="#updateUserModal<?= $event->id; ?>" class="btn btn-sm"><i class="fa fa-pencil-alt" style="color: maroon;"></i></a>&nbsp;
                                             <?php if ($this->session->userdata('role') == 1) : ?>
                                                 <a href="<?= site_url('delete-event/' . $event->id); ?>" class="btn btn-sm"><i class="fa fa-trash-alt" style="color: maroon;"></i></a>
                                             <?php endif; ?>
                                         </td>
                                     </tr>
                                 <?php endforeach; ?>
                             <?php else : ?>
                                 <tr>
                                     <td colspan="7" class="text-center">No events found.</td>
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
     <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="addUserModalLabel">Add New Event</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <form action="<?= site_url('add-event'); ?>" method="post" enctype="multipart/form-data">
                     <div class="modal-body">
                         <div class="form-group">
                             <label>Name</label>
                             <input type="text" class="form-control" name="title" placeholder="Enter event name" autocomplete="off" required>
                         </div>
                         <div class="form-group">
                             <label>Image</label>
                             <input type="file" class="form-control" name="image" required>
                         </div>
                         <div class="form-group">
                             <label>Description</label>
                             <textarea name="description" class="form-control"></textarea>
                         </div>

                         <div class="form-group">
                             <label>Location</label>
                             <input type="text" class="form-control" name="location" required>
                         </div>

                         <div class="form-group">
                             <label>Date</label>
                             <input type="datetime-local" class="form-control" name="date" required>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-success">Add Events</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>

     <?php foreach ($events as $event) : ?>
         <div class="modal fade" id="updateUserModal<?= $event->id; ?>" tabindex="-1" role="dialog" aria-labelledby="updateUserModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="updateUserModalLabel">Update Event</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <form action="<?= site_url('update-event/' . $event->id); ?>" method="post" enctype="multipart/form-data">
                         <div class="modal-body">
                             <div class="form-group">
                                 <label>Name</label>
                                 <input type="text" class="form-control" name="title" value="<?= $event->title ?>" autocomplete="off" required>
                             </div>
                             <div class="form-group">
                                 <label>Image <small class="text-danger">*optional</small></label>
                                 <input type="file" class="form-control" name="image">
                             </div>
                             <div class="form-group">
                                 <label>Description</label>
                                 <textarea name="description" class="form-control"><?= $event->description ?></textarea>
                             </div>

                             <div class="form-group">
                                 <label>Location</label>
                                 <input type="text" class="form-control" name="location" value="<?= $event->location ?>" required>
                             </div>

                             <div class="form-group">
                                 <label>Date</label>
                                 <input type="datetime-local" class="form-control" name="date" value="<?= $event->date ?>" required>
                             </div>
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                             <button type="submit" class="btn btn-danger">Update Events</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     <?php endforeach; ?>