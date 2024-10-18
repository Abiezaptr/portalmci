     <!-- Begin Page Content -->
     <div class="container-fluid">

         <!-- DataTales Example -->
         <div class="card shadow mb-4">
             <div class="card-header py-3 d-flex justify-content-between align-items-center">
                 <!-- Title on the left -->
                 <h6 class="m-0 font-weight-bold" style="color: maroon;">Threads Categories</h6>

                 <!-- Add button on the right -->
                 <a href="#" class="btn btn-danger btn-sm btn-icon-split" data-toggle="modal" data-target="#newCategoryModal">
                     <span class="icon text-white-50">
                         <i class="fas fa-plus"></i>
                     </span>
                     <span class="text">New Categories</span>
                 </a>
             </div>

             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>#</th>
                                 <th>Threads Categories</th>
                                 <th></th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php if (!empty($categories)) : ?>
                                 <?php $no = 1; ?>
                                 <?php foreach ($categories as $category) : ?>
                                     <tr>
                                         <td><?= $no++; ?></td>
                                         <td style="color: maroon;"><?= $category['name']; ?></td>
                                         <td>
                                             <!-- Edit button always visible -->
                                             <a href="#" class="btn btn-sm" data-toggle="modal" data-target="#updateCategoryModal<?= $category['id']; ?>">
                                                 <i class="fa fa-pencil-alt" style="color: maroon;"></i>
                                             </a>&nbsp;

                                             <!-- Delete button only visible if session role is 1 -->
                                             <?php if ($this->session->userdata('role') == 1) : ?>
                                                 <a href="<?= site_url('delete-categories/' . $category['id']); ?>" class="btn btn-sm">
                                                     <i class="fa fa-trash-alt" style="color: maroon;"></i>
                                                 </a>
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

     <!-- Modal Structure (Centered) -->
     <div class="modal fade" id="newCategoryModal" tabindex="-1" role="dialog" aria-labelledby="newCategoryModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document"> <!-- Added modal-dialog-centered -->
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="newCategoryModalLabel">Add New Category</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <form id="categoryForm" action="<?= site_url('insert-categories') ?>" method="post">
                     <div class="modal-body">
                         <div class="form-group">
                             <label for="categoryName">Category Name</label>
                             <input type="text" class="form-control" id="categoryName" name="name" placeholder="Enter category name" required>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary" form="categoryForm">Save Category</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>

     <?php foreach ($categories as $category) : ?>
         <div class="modal fade" id="updateCategoryModal<?= $category['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateCategoryModalLabel" aria-hidden="true">
             <div class="modal-dialog modal-dialog-centered" role="document"> <!-- Added modal-dialog-centered -->
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="updateCategoryModalLabel">Update Category</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <form id="categoryForm<?= $category['id']; ?>" action="<?= site_url('update-categories/' . $category['id']); ?>" method="post">
                         <div class="modal-body">
                             <div class="form-group">
                                 <label for="categoryName">Category Name</label>
                                 <input type="text" class="form-control" id="categoryName" name="name" value="<?= $category['name']; ?>" required>
                                 <input type="hidden" name="id" value="<?= $category['id']; ?>"> <!-- Menyimpan ID sebagai hidden field -->
                             </div>
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                             <button type="submit" class="btn btn-primary">Save Category</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     <?php endforeach; ?>