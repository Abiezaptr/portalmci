<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="" class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background-color: maroon; color: white;">
            <i class="fa-solid fa-arrows-rotate fa-sm text-white-50"></i>&nbsp; Refresh Data
        </a>
    </div>

    <?php if ($this->session->userdata('role') == 1): ?>
        <div class="row">
            <?php if ($nonaktif_count > 0): ?>
                <div class="col-xl-12 col-md-6 mb-4">
                    <div class="card" style="border-left: 5px solid #800000; background-color: #ffffff; box-shadow: h-100 py-2;">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: maroon;">
                                        <i class="fa fa-info-circle"></i>&nbsp; Notification
                                    </div>
                                    <div class="h7 mb-0">You have <?php if (!empty($nonaktif_count) && $nonaktif_count > 0): ?>
                                            <?= $nonaktif_count ?>
                                        <?php endif; ?> login access request
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-sm" data-toggle="modal" data-target="#listModal" style="color: #800000;">View requests</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>


    <!-- Modal for User List -->
    <div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="listModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="listModalLabel">Login access request</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Users</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($nonaktif_users as $user): ?>
                                    <tr id="user-<?= $user->id ?>">
                                        <td><?= $no++ ?></td>
                                        <td><?= $user->username ?></td>
                                        <td><?= $user->email ?></td>
                                        <td id="status-<?= $user->id ?>"><?= $user->status ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-success activate-user"
                                                data-user-id="<?= $user->id ?>">
                                                Activate
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card" style="border-left: 5px solid #800000; background-color: #ffffff; box-shadow: h-100 py-2;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: maroon;">
                                Total Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_users; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card" style="border-left: 5px solid #800000; background-color: #ffffff; box-shadow: h-100 py-2;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: maroon;">
                                Total Reports</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $report; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card" style="border-left: 5px solid #800000; background-color: #ffffff; box-shadow: h-100 py-2;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: maroon;">
                                Total Articles</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $article; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card" style="border-left: 5px solid #800000; background-color: #ffffff; box-shadow: h-100 py-2;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: maroon;">
                                Total Videos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $videos; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-clapperboard fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold" style="color: maroon;">Top 5 Most Viewed Reports</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Report Name</th>
                                    <th><i class="fa-solid fa-arrow-up-wide-short"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($top_reports)) : ?>
                                    <?php foreach ($top_reports as $report): ?>
                                        <tr>
                                            <td><?= $report->name; ?></td>
                                            <td><?= number_format($report->visit_count) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No reports found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold" style="color: maroon;">Top 5 Users by Report Access</h6>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Accessed Report</th>
                                    <!-- <th><i class="fa-solid fa-arrow-up-wide-short"></i></th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($top_users)) : ?>
                                    <?php foreach ($top_users as $index => $user) : ?>
                                        <tr>
                                            <td><?= htmlspecialchars(ucwords(strtolower($user->username))) ?></td>
                                            <td>
                                                <?php
                                                $max_length = 50; // Max length before truncation
                                                $reports = $user->accessed_reports ?: 'No reports accessed';
                                                $short_text = htmlspecialchars(mb_strimwidth($reports, 0, $max_length, '...'));
                                                ?>
                                                <a href="#" data-toggle="modal" data-target="#reportModal<?= $index ?>">
                                                    <?= $short_text ?>
                                                </a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="reportModal<?= $index ?>" tabindex="-1" aria-labelledby="modalTitle<?= $index ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalTitle<?= $index ?>">Accessed Reports</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php if ($user->accessed_reports) : ?>
                                                                    <ul>
                                                                        <?php foreach (explode(', ', $user->accessed_reports) as $report) : ?>
                                                                            <li><?= htmlspecialchars($report) ?></li>
                                                                        <?php endforeach; ?>
                                                                    </ul>
                                                                <?php else : ?>
                                                                    <p>No reports accessed</p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- <td><?= $user->total_views + $user->total_downloads ?></td> Total views + downloads -->
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="3" class="text-center">No data available</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold" style="color: maroon;">Forum Thread Trends</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myThreadChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold" style="color: maroon;">Content by Category</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myDoughnutChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: rgba(255, 0, 0, 0.6);"></i> Reports
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: rgba(0, 255, 0, 0.6);"></i> Articles
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: rgba(0, 0, 255, 0.6);"></i> Videos
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold" style="color: maroon;">Visitor Activity</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="activityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold" style="color: maroon;">Upcoming Event</h6>
                </div>
                <div class="card-body">
                    <?php if (!empty($upcoming_events)): ?>
                        <?php foreach ($upcoming_events as $event): ?>
                            <div class="event-card mb-4 p-3" style="border-radius: 10px; background-color: #f9f9f9; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                <div class="text-center">
                                    <img src="<?php echo base_url('uploads/event/' . $event->image); ?>" alt="" style="width: 100%; height: auto; border-radius: 10px 10px 0 0;">
                                </div>

                                <div style="padding: 10px;">
                                    <h6 style="font-weight: bold; color: #800000;">
                                        <?php echo $event->title; ?>
                                    </h6>
                                    <hr>
                                    <p style="font-size: 14px; color: #777; margin-bottom: 5px;">
                                        <i class="fa fa-calendar-day"></i>&nbsp; <?php echo date('F j, Y', strtotime($event->start_date)); ?>
                                    </p>
                                    <p style="font-size: 14px; color: #555; margin-top: -5px;">
                                        <i class="fa fa-map-marker-alt"></i>&nbsp; <?php echo $event->location; ?>
                                    </p>
                                </div>
                                <!-- Tombol Detail -->
                                <a href="<?= site_url('event') ?>" class="btn btn-sm" style="border-radius: 20px; text-transform: uppercase; background-color: maroon; color: white; padding: 5px 10px; font-size: 12px; border: none;">View Events</a>
                            </div>
                            <hr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <p>No upcoming events found.</p>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>


    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->