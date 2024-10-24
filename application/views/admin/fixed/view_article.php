     <!-- Begin Page Content -->
     <div class="container-fluid">

         <!-- DataTales Example -->
         <div class="card shadow mb-4">
             <div class="card-header py-3 d-flex justify-content-between align-items-center">
                 <!-- Title on the left -->
                 <h6 class="m-0 font-weight-bold" style="color: maroon;">Fixed Articles</h6>

                 <!-- Add button on the right -->
                 <a href="#" data-toggle="modal" data-target="#addArticleModal" class="btn btn-danger btn-sm btn-icon-split">
                     <span class="icon text-white-50">
                         <i class="fas fa-plus"></i>
                     </span>
                     <span class="text">New Articles</span>
                 </a>
             </div>

             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>#</th>
                                 <th>Title</th>
                                 <th>Image</th>
                                 <th>Description</th>
                                 <th>Category</th>
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
                                         <td><?= $report['desc']; ?></td>
                                         <td>
                                             <span class="badge badge-warning"><?= $report['category']; ?></span>
                                         </td>
                                         <td>
                                             <?php if (!empty($report['file'])): ?>
                                                 <a style="color: maroon;" href="<?= base_url('uploads/articles/fixed/' . $report['file']); ?>" target="_blank">Open</a>
                                             <?php else: ?>
                                                 No file available
                                             <?php endif; ?>
                                         </td>
                                         <td>
                                             <a href="#" class="btn btn-sm" class="btn btn-sm" data-toggle="modal" data-target="#editArticleModal<?= $report['id']; ?>"><i class="fa fa-pencil-alt" style="color: maroon;"></i></a>&nbsp;
                                             <?php if ($this->session->userdata('role') == 1) : ?>
                                                 <a href="<?= site_url('delete/fixed-article/' . $report['id']); ?>" class="btn btn-sm"><i class="fa fa-trash-alt" style="color: maroon;"></i></a>
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

     <div class="modal fade" id="addArticleModal" tabindex="-1" role="dialog" aria-labelledby="addArticleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg modal-dialog-centered" role="document"> <!-- Added modal-dialog-centered -->
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="addArticleModalLabel">Add New Articles</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <form id="categoryForm" action="<?= site_url('insert/fixed-article'); ?>" method="post" enctype="multipart/form-data">
                     <div class="modal-body">
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
                                     <textarea name="desc" class="form-control" placeholder="Enter a description"></textarea>
                                 </div>
                             </div>
                         </div>

                         <div class="row">
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label for="title" style="font-size: 13px; font-weight: 600;">Content</label>
                                     <textarea name="content" id="summernote"></textarea>
                                 </div>
                             </div>
                         </div>

                         <hr>

                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label for="image" style="font-size: 13px; font-weight: 600;">Update Cover Image (Leave empty if not changing)</label>
                                     <div class="custom-file">
                                         <input type="file" class="form-control" id="image" name="image">
                                     </div>
                                     <?php if (!empty($report['image'])): ?>
                                         <p style="font-size: 12px; margin-left: 10px; margin-top: 10px;">Current Image: <a href="<?= base_url('uploads/image/' . $report['image']); ?>" target="_blank">View Image</a></p>
                                     <?php endif; ?>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label for="file" style="font-size: 13px; font-weight: 600;">Update File (Leave empty if not changing)</label>
                                     <div class="custom-file">
                                         <input type="file" class="form-control" id="file" name="file">
                                     </div>
                                     <?php if (!empty($report['file'])): ?>
                                         <p style="font-size: 12px; margin-left: 10px; margin-top: 10px;">Current File: <a href="<?= base_url('uploads/articles/mobile/' . $report['file']); ?>" target="_blank">Open File</a></p>
                                     <?php endif; ?>
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

     <?php foreach ($reports as $report) : ?>
         <div class="modal fade" id="editArticleModal<?= $report['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editArticleModalLabel" aria-hidden="true">
             <div class="modal-dialog modal-lg modal-dialog-centered" role="document"> <!-- Added modal-dialog-centered -->
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="editArticleModalLabel">Update Articles</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <form id="categoryForm<?= $report['id']; ?>" action="<?= site_url('update/fixed-article/' . $report['id']); ?>" method="post" enctype="multipart/form-data">
                         <div class="modal-body">
                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="form-group">
                                         <label for="title" style="font-size: 13px; font-weight: 600;">Title</label>
                                         <div class="input-group">
                                             <div class="input-group-prepend">
                                                 <span class="input-group-text"><i class="fa fa-heading"></i></span>
                                             </div>
                                             <input type="text" class="form-control" id="title" name="title" value="<?= $report['title']; ?>" required>
                                         </div>
                                     </div>
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="form-group">
                                         <label for="title" style="font-size: 13px; font-weight: 600;">Description</label>
                                         <textarea name="desc" class="form-control"><?= $report['desc'] ?></textarea>
                                     </div>
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="form-group">
                                         <label for="title" style="font-size: 13px; font-weight: 600;">Content</label>
                                         <textarea name="content" id="summernote1<?= $report['id']; ?>"><?= $report['content']; ?></textarea>
                                     </div>
                                 </div>
                             </div>

                             <hr>

                             <div class="row">
                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label for="image" style="font-size: 13px; font-weight: 600;">Update Cover Image (Leave empty if not changing)</label>
                                         <div class="custom-file">
                                             <input type="file" class="form-control" id="image" name="image">
                                         </div>
                                         <?php if (!empty($report['image'])): ?>
                                             <p style="font-size: 12px; margin-left: 10px; margin-top: 10px;">Current Image: <a href="<?= base_url('uploads/image/' . $report['image']); ?>" target="_blank">View Image</a></p>
                                         <?php endif; ?>
                                     </div>
                                 </div>
                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label for="file" style="font-size: 13px; font-weight: 600;">Update File (Leave empty if not changing)</label>
                                         <div class="custom-file">
                                             <input type="file" class="form-control" id="file" name="file">
                                         </div>
                                         <?php if (!empty($report['file'])): ?>
                                             <p style="font-size: 12px; margin-left: 10px; margin-top: 10px;">Current File: <a href="<?= base_url('uploads/articles/fixed/' . $report['file']); ?>" target="_blank">Open File</a></p>
                                         <?php endif; ?>
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