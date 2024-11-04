<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="" class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background-color: maroon; color: white;">
            <i class="fa-solid fa-arrows-rotate fa-sm text-white-50"></i>&nbsp; Refresh Data
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card" style="border-left: 5px solid #800000; background-color: #ffffff; shadow h-100 py-2;">
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
            <div class="card" style="border-left: 5px solid #800000; background-color: #ffffff; shadow h-100 py-2;">
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
            <div class="card" style="border-left: 5px solid #800000; background-color: #ffffff; shadow h-100 py-2;">
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
            <div class="card" style="border-left: 5px solid #800000; background-color: #ffffff; shadow h-100 py-2;">
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
                    <?php foreach ($upcoming_events as $event): ?>
                        <div class="mb-3">
                            <h6 style="font-weight: bold; color: maroon;">
                                <i class="fa fa-calendar-alt"></i>&nbsp; <?php echo $event->title; ?>
                            </h6>
                            <p style="margin-bottom: 5px;">Date: <?php echo date('F j, Y', strtotime($event->date)); ?></p>
                            <p style="margin-top: -5px;">Location: <?php echo $event->location; ?></p>
                        </div>
                        <hr>
                    <?php endforeach; ?>
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