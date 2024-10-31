<!-- Begin Page Content -->
<div class="container-fluid d-flex justify-content-center">

    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="width: 80%;">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <!-- Title on the left -->
            <h6 class="m-0 font-weight-bold" style="color: maroon;">Update threads : <?= $threads['title']; ?></h6>

            <!-- Back button on the right -->
            <a href="<?= site_url('admin/forum') ?>" class="btn btn-danger btn-sm btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fa fa-arrow-left"></i>
                </span>
                <span class="text">Back</span>
            </a>
        </div>

        <div class="card-body">
            <form action="<?= base_url('admin/forum/update/' . $threads['id']); ?>" method="POST">

                <!-- Title Row (Full Width) -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title" style="font-size: 13px; font-weight: 600;">Title</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-heading"></i></span>
                                </div>
                                <input type="text" class="form-control" id="title" name="title" value="<?= $threads['title']; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="prolog" style="font-size: 13px; font-weight: 600;">Prolog</label>
                            <!-- <textarea class="form-control" id="prolog" name="content" rows="4" required><?= $threads['content']; ?></textarea> -->
                            <textarea name="content" id="summernote"><?= $threads['content']; ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- Category and Type Row (Side-by-Side) -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category" style="font-size: 13px; font-weight: 600;">Category</label>
                            <select name="category_id" id="category" class="form-control select2" required>
                                <option hidden>-- Select Category --</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id']; ?>" <?= ($category['id'] == $threads['category_id']) ? 'selected' : ''; ?>><?= $category['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="users" style="font-size: 13px; font-weight: 600;">Users Joined</label>
                            <select class="form-control" id="users" name="user_id[]" multiple="multiple">
                                <?php foreach ($users as $user): ?>
                                    <option value="<?= $user['id']; ?>" <?= in_array($user['id'], $joined_user_ids) ? 'selected' : ''; ?>>
                                        <?= $user['username']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                </div>

                <hr>

                <!-- Submit button -->
                <div class="form-group text-center mt-4">
                    <button type="submit" class="btn btn-sm text-white" style="background-color: maroon;">
                        <i class="fa fa-save"></i> Save Threads
                    </button>
                </div>
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->