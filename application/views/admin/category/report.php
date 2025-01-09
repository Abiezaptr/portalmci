     <!-- Begin Page Content -->
     <div class="container-fluid">

         <!-- DataTales Example -->
         <div class="card shadow mb-4">
             <div class="card-header py-3 d-flex justify-content-between align-items-center">
                 <!-- Title on the left -->
                 <h6 class="m-0 font-weight-bold" style="color: maroon;">REPORT CATEGORY LIST</h6>

                 <!-- Button group on the right -->
                 <div class="btn-group" role="group">
                     <!-- Add button -->
                     <a href="#" data-toggle="modal" data-target="#addModal" class="btn btn-danger btn-sm btn-icon-split">
                         <span class="icon text-white-50">
                             <i class="fas fa-plus"></i>
                         </span>
                         <span class="text">ADD ROW</span>
                     </a>

                     <!-- New button for category report -->
                     <div class="dropdown">
                         <a href="#" class="btn btn-secondary btn-sm btn-icon-split ml-2 dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <span class="icon text-white-50">
                                 <i class="fas fa-folder"></i>
                             </span>
                             <span class="text">REPORT LIST</span>
                         </a>
                         <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                             <a class="dropdown-item" href="<?= site_url('admin/mobile') ?>">MOBILE</a>
                             <a class="dropdown-item" href="<?= site_url('fixed-report') ?>">FIXED</a>
                             <a class="dropdown-item" href="<?= site_url('digital-report') ?>">DIGITAL INSIGHTS</a>
                             <a class="dropdown-item" href="<?= site_url('global-report') ?>">GLOBAL</a>
                         </div>
                     </div>

                 </div>
             </div>


             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>#</th>
                                 <th>CATEGORY NAME</th>
                                 <th>DESCRIPTION</th>
                                 <!-- <th>SUB CATEGORY</th> -->
                                 <th></th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php if (!empty($category)) : ?>
                                 <?php $no = 1; ?>
                                 <?php foreach ($category as $cat) : ?>
                                     <tr>
                                         <td><?= $no++; ?></td>
                                         <td><?= $cat['name']; ?></td>
                                         <td><?= $cat['description']; ?></td>
                                         <!-- <td>
                                             <div class="card">
                                                 <div class="card-body">
                                                     <h6 class="card-title">Sub Categories</h6>
                                                     <ul class="list-unstyled">
                                                         <?php
                                                            $sub_categories = explode(',', $cat['sub_report']);
                                                            foreach ($sub_categories as $index => $sub_cat) : ?>
                                                             <li><?= ($index + 1) . '. ' . trim($sub_cat); ?></li> 
                                                         <?php endforeach; ?>
                                                     </ul>
                                                 </div>
                                             </div>
                                         </td> -->
                                         <td>
                                             <!-- Dropdown button -->
                                             <div class="dropdown">
                                                 <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                     Action
                                                 </button>
                                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                     <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal<?= $cat['id']; ?>">Update</a>
                                                     <?php if ($this->session->userdata('role') == 1) : ?>
                                                         <div class="dropdown-divider" style="border-top: 1px dashed #ccc; margin: 5px 0;"></div>
                                                         <a class="dropdown-item" href="<?= site_url('admin/category/delete_category_report/' . $cat['id']); ?>">Remove</a>
                                                     <?php endif; ?>
                                                 </div>
                                             </div>
                                         </td>
                                     </tr>
                                 <?php endforeach; ?>
                             <?php else : ?>
                                 <tr>
                                     <td colspan="5" class="text-center">No categories found.</td>
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

     <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg modal-dialog-centered" role="document"> <!-- Added modal-dialog-centered -->
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="addModalLabel">Add Report Category</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <form id="categoryForm" action="<?= site_url('admin/category/submit_category_report'); ?>" method="post">
                     <div class="modal-body">
                         <div class="row">
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label for="title" style="font-size: 13px; font-weight: 600;">Category Name</label>
                                     <input type="text" class="form-control" id="name" name="name" placeholder="Enter a category name" required>
                                 </div>
                             </div>
                         </div>

                         <div class="row">
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label for="title" style="font-size: 13px; font-weight: 600;">Description</label>
                                     <textarea name="description" class="form-control" placeholder="Enter a description"></textarea>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-danger">Submit</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>

     <?php foreach ($category as $cat) : ?>
         <div class="modal fade" id="editModal<?= $cat['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
             <div class="modal-dialog modal-lg modal-dialog-centered" role="document"> <!-- Added modal-dialog-centered -->
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="editModalLabel">Report Category : <?= $cat['name']; ?></h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <form id="categoryForm" action="<?= site_url('admin/category/update_category_report/' . $cat['id']); ?>" method="post">
                         <div class="modal-body">
                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="form-group">
                                         <label for="title" style="font-size: 13px; font-weight: 600;">Category Name</label>
                                         <input type="text" class="form-control" id="name" name="name" value="<?= $cat['name']; ?>">
                                     </div>
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="form-group">
                                         <label for="title" style="font-size: 13px; font-weight: 600;">Description</label>
                                         <textarea name="description" class="form-control"><?= $cat['description']; ?></textarea>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                             <button type="submit" class="btn btn-danger">Submit</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     <?php endforeach; ?>