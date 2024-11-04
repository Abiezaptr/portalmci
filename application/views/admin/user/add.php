<!-- Begin Page Content -->
<div class="container-fluid d-flex justify-content-center">

    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="width: 80%;">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <!-- Title on the left -->
            <h6 class="m-0 font-weight-bold" style="color: maroon;">Add Users</h6>

            <!-- Back button on the right -->
            <a href="<?= site_url('manage-user') ?>" class="btn btn-danger btn-sm btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fa fa-arrow-left"></i>
                </span>
                <span class="text">Back</span>
            </a>
        </div>

        <div class="card-body">
            <form action="<?= site_url('admin/forum/submit'); ?>" method="POST">

                <input type="hidden" name="posted_by" value="<?php echo $this->session->userdata('id'); ?>">

                <!-- Title Row (Full Width) -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <select class="form-control username" id="username" name="username" style="width: 100%;">
                                <option value="">Pilih Username</option>
                                <?php foreach ($all_users as $u): ?>
                                    <option value="<?= $u['username']; ?>"><?= $u['username']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>


                <!-- Category and Type Row (Side-by-Side) -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email akan terisi otomatis" readonly required>
                        </div>
                    </div>


                    <div class="col-md-6">
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


                </div>

                <hr>

                <!-- Submit button -->
                <div class="form-group text-center mt-4">
                    <button type="submit" class="btn btn-sm text-white" style="background-color: maroon;">
                        <i class="fa fa-save"></i> Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->