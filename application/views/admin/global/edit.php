<!-- Begin Page Content -->
<div class="container-fluid d-flex justify-content-center">

    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="width: 80%;">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <!-- Title on the left -->
            <h6 class="m-0 font-weight-bold" style="color: maroon;">Update Report : <?= $report['title']; ?></h6>

            <!-- Back button on the right -->
            <a href="<?= site_url('global-report') ?>" class="btn btn-danger btn-sm btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fa fa-arrow-left"></i>
                </span>
                <span class="text">Back</span>
            </a>
        </div>

        <div class="card-body">
            <form action="<?= base_url('edit/global-report/' . $report['id']); ?>" method="POST" enctype="multipart/form-data">

                <!-- Title Row (Full Width) -->
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

                <!-- Category and Type Row (Side-by-Side) -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category" style="font-size: 13px; font-weight: 600;">Category</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-list"></i></span>
                                </div>
                                <select class="form-control" id="category" name="category">
                                    <option value="mobile" <?= $report['category'] == 'mobile' ? 'selected' : ''; ?>>Mobile</option>
                                    <option value="fixed" <?= $report['category'] == 'fixed' ? 'selected' : ''; ?>>Fixed</option>
                                    <option value="digital insight" <?= $report['category'] == 'digital insight' ? 'selected' : ''; ?>>Digital Insight</option>
                                    <option value="global" <?= $report['category'] == 'global' ? 'selected' : ''; ?>>Global</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type" style="font-size: 13px; font-weight: 600;">Type</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-file"></i></span>
                                </div>
                                <select class="form-control" id="type" name="type">
                                    <option value="pdf" <?= $report['type'] == 'pdf' ? 'selected' : ''; ?>>PDF</option>
                                    <option value="article" <?= $report['type'] == 'article' ? 'selected' : ''; ?>>Articles</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image" style="font-size: 13px; font-weight: 600;">Upload Image (Leave empty if not changing)</label>
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
                            <label for="file" style="font-size: 13px; font-weight: 600;">Upload File (Leave empty if not changing)</label>
                            <div class="custom-file">
                                <input type="file" class="form-control" id="file" name="file">
                            </div>
                            <?php if (!empty($report['file'])): ?>
                                <p style="font-size: 12px; margin-left: 10px; margin-top: 10px;">Current File: <a href="<?= base_url('uploads/report/' . $report['file']); ?>" target="_blank">Open File</a></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Submit button -->
                <div class="form-group text-center mt-4">
                    <button type="submit" class="btn btn-sm text-white" style="background-color: maroon;">
                        <i class="fa fa-save"></i> Save Report
                    </button>
                </div>
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->