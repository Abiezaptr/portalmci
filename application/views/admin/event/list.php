     <!-- Begin Page Content -->
     <div class="container-fluid">

         <!-- DataTales Example -->
         <div class="card shadow mb-4">
             <div class="card-header py-3 d-flex justify-content-between align-items-center">
                 <!-- Title on the left -->
                 <h6 class="m-0 font-weight-bold" style="color: maroon;">Event List</h6>



                 <div class="d-flex gap-2">
                     <!-- New Event Button -->
                     <a href="#" data-toggle="modal" data-target="#addUserModal" class="btn btn-primary btn-sm btn-icon-split">
                         <span class="icon text-white-50">
                             <i class="fas fa-plus"></i>
                         </span>
                         <span class="text">New Event</span>
                     </a>&nbsp;

                     <!-- Add button on the right -->
                     <a href="<?= site_url('event') ?>" class="btn btn-danger btn-sm btn-icon-split">
                         <span class="icon text-white-50">
                             <i class="fa-solid fa-arrow-left-long"></i>
                         </span>
                         <span class="text">Back to Calendar</span>
                     </a>
                 </div>
             </div>

             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>#</th>
                                 <th>Event Name</th>
                                 <th>Image</th>
                                 <th>Start Date</th>
                                 <th>End Date</th>
                                 <th>Location</th>
                                 <th>Description</th>
                                 <th></th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php if (!empty($events)): ?>
                                 <?php $no = 1; ?>
                                 <?php foreach ($events as $index => $event): ?>
                                     <tr>
                                         <td><?= $index + 1; ?></td>
                                         <td><?= htmlspecialchars($event->title); ?></td>
                                         <td>
                                             <?php if (!empty($event->image)): ?>
                                                 <img src="<?= base_url('uploads/event/' . $event->image); ?>" alt="Event Image" style="width: 80px; height: auto;">
                                             <?php else: ?>
                                                 <img src="<?= base_url('assets/images/no-img.jpg'); ?>" alt="Event Image" style="width: 80px; height: auto;">
                                             <?php endif; ?>
                                         </td>
                                         <td><?= date('d M Y H:i', strtotime($event->start_date)); ?></td>
                                         <td><?= date('d M Y H:i', strtotime($event->end_date)); ?></td>
                                         <td><?= htmlspecialchars($event->location); ?></td>
                                         <td>
                                             <?= strlen($event->description) > 50
                                                    ? htmlspecialchars(substr($event->description, 0, 50)) . '...'
                                                    : htmlspecialchars($event->description);
                                                ?>
                                         </td>
                                         <td>
                                             <a href="#" data-toggle="modal" data-target="#updateModal<?= htmlspecialchars($event->id); ?>" class="btn btn-sm"><i class="fa fa-pencil-alt" style="color: maroon;"></i></a>&nbsp;
                                             <?php if ($this->session->userdata('role') == 1) : ?>
                                                 <a href="<?= site_url('admin/event/delete/' . $event->id); ?>" class="btn btn-sm"><i class="fa fa-trash-alt" style="color: maroon;"></i></a>
                                             <?php endif; ?>
                                         </td>
                                     </tr>
                                 <?php endforeach; ?>
                             <?php else : ?>
                                 <tr>
                                     <td colspan="8" class="text-center">No event found.</td>
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
                             <input type="text" name="title" id="title" class="form-control" placeholder="Enter your event name" required>
                         </div>
                         <div class="form-group">
                             <label for="title">Event Title <small class="text-danger">*optional</small></label>
                             <input type="text" name="event_name" id="title" class="form-control" placeholder="Enter your event title">
                         </div>
                         <div class="form-group">
                             <label for="title">Event Image <small class="text-danger">*optional</small></label>
                             <input type="file" name="image" class="form-control">
                         </div>
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label for="start_date">Start Date</label>
                                     <input type="datetime-local" name="start_date" id="start_date" class="form-control" required>
                                 </div>
                             </div>

                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label for="end_date">End Date</label>
                                     <input type="datetime-local" name="end_date" id="end_date" class="form-control" required>
                                 </div>
                             </div>
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

     <?php foreach ($events as $index => $event): ?>
         <div class="modal fade" id="updateModal<?= htmlspecialchars($event->id); ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
             <div class="modal-dialog modal-lg" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="updateModalLabel">Event Update</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <form action="<?= site_url('admin/event/update/' . $event->id); ?>" method="post" enctype="multipart/form-data">
                         <div class="modal-body">
                             <div class="form-group">
                                 <label for="title">Event Name</label>
                                 <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($event->title); ?>">
                             </div>
                             <div class="form-group">
                                 <label for="title">Event Image <small class="text-danger"></small></label>
                                 <input type="file" name="image" class="form-control">
                             </div>
                             <?php if (!empty($event->image)): ?>
                                 <p style="font-size: 12px; margin-left: 10px; margin-top: 10px;">Current Image: <a href="<?= base_url('uploads/event/' . $event->image); ?>" target="_blank">View Image</a></p>
                             <?php endif; ?>

                             <div class="row">
                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label for="start_date">Start Date</label>
                                         <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="<?= htmlspecialchars($event->start_date); ?>">
                                     </div>
                                 </div>

                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label for="end_date">End Date</label>
                                         <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="<?= htmlspecialchars($event->end_date); ?>">
                                     </div>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label for="location">Location <small class="text-danger"></small></label>
                                 <input type="text" name="location" id="location" class="form-control" value="<?= htmlspecialchars($event->location); ?>">
                             </div>
                             <div class="form-group">
                                 <label for="description">Description</label>
                                 <textarea name="description" id="description" class="form-control" rows="5" required><?= htmlspecialchars($event->description); ?></textarea>
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
     <?php endforeach; ?>