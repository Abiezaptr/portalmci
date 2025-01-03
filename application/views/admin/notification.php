<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Notifications</h1>
    </div>

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <?php if (count($notifications) > 0): ?>
            <?php
            date_default_timezone_set('Asia/Jakarta'); // Set the timezone to Asia/Jakarta
            foreach ($notifications as $notification):
                // Format the timestamp
                $formatted_date = date('d F Y, H:i', strtotime($notification['timestamp'])) . ' WIB';
            ?>
                <div class="col-xl-12 col-md-6 mb-4">
                    <div class="card" style="border-left: 5px solid #800000; background-color: #ffffff; box-shadow: h-100 py-2;">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: maroon; font-size: 15px;">
                                        <?php echo $notification['title']; ?>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" style="font-size: 14px;"><?php echo $notification['message']; ?></div>
                                    <div class="card-date" style="font-size: 0.9em; color: #999;"><?php echo $formatted_date; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-circle text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center mt-5">
                <img src="<?= base_url('assets/images/bell.png') ?>" alt="No Videos" style="width: 150px; height: auto;">
            </div>
            <p class="text-center mt-4">Sorry, your notifications are not yet available.</p>
        <?php endif; ?>

    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->