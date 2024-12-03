     <!-- Begin Page Content -->
     <div class="container-fluid">

         <!-- DataTales Example -->
         <div class="card shadow mb-4">
             <div class="card-header py-3 d-flex justify-content-between align-items-center">
                 <!-- Title on the left -->
                 <h6 class="m-0 font-weight-bold" style="color: maroon;">Events Calendar</h6>

                 <a href="#" data-toggle="modal" data-target="#addUserModal" class="btn btn-danger btn-sm btn-icon-split">
                     <span class="icon text-white-50">
                         <i class="fas fa-plus"></i>
                     </span>
                     <span class="text">New Event</span>
                 </a>
             </div>

             <div class="card-body">
                 <div id="calendar"></div>
             </div>
         </div>

     </div>
     <!-- /.container-fluid -->

     </div>
     <!-- End of Main Content -->

     <!-- Modal untuk Tambah Pengguna Baru -->
     <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
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
                             <label for="title">Event Name</label>
                             <input type="text" name="event_name" id="title" class="form-control" required>
                         </div>
                         <div class="form-group">
                             <label for="title">Event Title</label>
                             <input type="text" name="title" id="title" class="form-control" required>
                         </div>
                         <div class="form-group">
                             <label for="title">Event Image <small class="text-danger">*opional</small></label>
                             <input type="file" name="image" id="title" class="form-control">
                         </div>
                         <div class="form-group">
                             <label for="start_date">Start Date</label>
                             <input type="datetime-local" name="start_date" id="start_date" class="form-control" required>
                         </div>
                         <div class="form-group">
                             <label for="end_date">End Date</label>
                             <input type="datetime-local" name="end_date" id="end_date" class="form-control" required>
                         </div>
                         <div class="form-group">
                             <label for="color">Event Color</label>
                             <input type="color" name="color" id="color" class="form-control" value="#007bff">
                         </div>
                         <div class="form-group">
                             <label for="location">Location <small class="text-danger">*optional</small></label>
                             <input type="text" name="location" id="location" class="form-control" required>
                         </div>
                         <div class="form-group">
                             <label for="description">Description</label>
                             <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
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