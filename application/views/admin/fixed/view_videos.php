     <!-- Begin Page Content -->
     <div class="container-fluid">

         <!-- DataTales Example -->
         <div class="card shadow mb-4">
             <div class="card-header py-3 d-flex justify-content-between align-items-center">
                 <!-- Title on the left -->
                 <h6 class="m-0 font-weight-bold" style="color: maroon;">Fixed Videos</h6>

                 <!-- Add button on the right -->
                 <a href="#" data-toggle="modal" data-target="#addVideosModal" class="btn btn-danger btn-sm btn-icon-split">
                     <span class="icon text-white-50">
                         <i class="fas fa-plus"></i>
                     </span>
                     <span class="text">New Videos</span>
                 </a>
             </div>

             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>#</th>
                                 <th>Title</th>
                                 <th>Description</th>
                                 <th>Category</th>
                                 <th>URL Videos</th>
                                 <th></th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php if (!empty($videos)) : ?>
                                 <?php $no = 1; ?>
                                 <?php foreach ($videos as $video) : ?>
                                     <tr>
                                         <td><?= $no++; ?></td>
                                         <td><?= $video['title']; ?></td>
                                         <td><?= $video['description']; ?></td>
                                         <td>
                                             <span class="badge badge-warning"><?= $video['category']; ?></span>
                                         </td>
                                         <td>
                                             <a href="<?= $video['link']; ?>" target="_blank"><?= $video['link']; ?></a>
                                         </td>
                                         <td>
                                             <a href="#" class="btn btn-sm" class="btn btn-sm" data-toggle="modal" data-target="#updateVideoModal<?= $video['id']; ?>"><i class="fa fa-pencil-alt" style="color: maroon;"></i></a>&nbsp;
                                             <?php if ($this->session->userdata('role') == 1) : ?>
                                                 <a href="<?= site_url('delete/fixed-videos/' . $video['id']); ?>" class="btn btn-sm"><i class="fa fa-trash-alt" style="color: maroon;"></i></a>
                                             <?php endif; ?>
                                         </td>
                                     </tr>
                                 <?php endforeach; ?>
                             <?php else : ?>
                                 <tr>
                                     <td colspan="6" class="text-center">No articles mobile found.</td>
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

     <div class="modal fade" id="addVideosModal" tabindex="-1" role="dialog" aria-labelledby="addVideosModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg modal-dialog-centered" role="document"> <!-- Added modal-dialog-centered -->
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="addVideosModalLabel">Add Fixed Videos</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <form id="categoryForm" action="<?= site_url('insert/fixed-videos'); ?>" method="post">
                     <div class=" modal-body">
                         <div class="row">
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label for="title" style="font-size: 13px; font-weight: 600;">Title</label>
                                     <div class="input-group">
                                         <div class="input-group-prepend">
                                             <span class="input-group-text"><i class="fa fa-heading"></i></span>
                                         </div>
                                         <input type="text" class="form-control" id="title" name="title" placeholder="Enter a title" required>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <div class="row">
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label for="title" style="font-size: 13px; font-weight: 600;">Description</label>
                                     <textarea name="description" class="form-control" placeholder="Enter description"></textarea>
                                 </div>
                             </div>
                         </div>

                         <div class="row">
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label for="title" style="font-size: 13px; font-weight: 600;">URL Videos</label>

                                     <!-- Input group with icon -->
                                     <div class="input-group">
                                         <div class="input-group-prepend">
                                             <span class="input-group-text" id="basic-addon3"><i class="fas fa-link"></i></span>
                                         </div>
                                         <input type="url" name="link" class="form-control" placeholder="Enter video URL" aria-describedby="basic-addon3">
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary">Save</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>

     <?php foreach ($videos as $video) : ?>
         <div class="modal fade" id="updateVideoModal<?= $video['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateVideoModalLabel" aria-hidden="true">
             <div class="modal-dialog modal-lg modal-dialog-centered" role="document"> <!-- Added modal-dialog-centered -->
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="updateVideoModalLabel">Update Videos</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <form id="categoryForm<?= $video['id']; ?>" action="<?= site_url('update/fixed-videos/' . $video['id']); ?>" method="post">
                         <div class="modal-body">
                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="form-group">
                                         <label for="title" style="font-size: 13px; font-weight: 600;">Title</label>
                                         <div class="input-group">
                                             <div class="input-group-prepend">
                                                 <span class="input-group-text"><i class="fa fa-heading"></i></span>
                                             </div>
                                             <input type="text" class="form-control" id="title" name="title" value="<?= $video['title'] ?>">
                                         </div>
                                     </div>
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="form-group">
                                         <label for="title" style="font-size: 13px; font-weight: 600;">Description</label>
                                         <textarea name="description" class="form-control"><?= $video['description'] ?></textarea>
                                     </div>
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="form-group">
                                         <label for="title" style="font-size: 13px; font-weight: 600;">URL Videos</label>

                                         <!-- Input group with icon -->
                                         <div class="input-group">
                                             <div class="input-group-prepend">
                                                 <span class="input-group-text" id="basic-addon3"><i class="fas fa-link"></i></span>
                                             </div>
                                             <input type="url" name="link" class="form-control" value="<?= $video['link'] ?>" aria-describedby="basic-addon3">
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                             <button type="submit" class="btn btn-primary">Save</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     <?php endforeach; ?>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>