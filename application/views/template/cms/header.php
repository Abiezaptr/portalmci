<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?> | Content Management System</title>

    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('assets') ?>/images/favicon.png">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/cms') ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/cms') ?>/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/cms') ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>



</head>

<style>
    .checkbox-group {
        display: flex;
        flex-wrap: wrap;
        /* Allow checkboxes to wrap into the next line */
        gap: 15px;
        /* Increase gap between checkboxes */
    }

    .checkbox-group label {
        display: flex;
        /* Align items in a row */
        align-items: center;
        /* Center the checkbox and text vertically */
        margin: 5px;
        /* Add margin around each label */
    }


    /* Menambahkan gaya tambahan untuk checkbox */
    .access-checkbox {
        transform: scale(1.2);
        /* Memperbesar ukuran checkbox */
        margin-right: 10px;
        /* Memberikan jarak antara checkbox dan label */
        accent-color: maroon;
        /* Mengatur warna kotak dan tanda centang */
        /* Note: pastikan ini didukung oleh browser */
    }
</style>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: rgba(128, 0, 0, 1);">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-left" href="index.html">
                <div class="sidebar-brand-text mx-3">PORTAL CMS</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?= site_url('admin/dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Manage Content
            </div>

            <?php
            $permissions = $this->session->userdata('permissions'); // Assume this data is stored in session
            $role = $this->session->userdata('role'); // Retrieve the user role
            ?>

            <!-- Display all items if role is 1 -->
            <?php if ($role == 1): ?>
                <!-- Mobile Content -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Mobile Content</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="<?= site_url('admin/mobile') ?>">Reports</a>
                            <a class="collapse-item" href="<?= site_url('mobile-article') ?>">Articles</a>
                            <a class="collapse-item" href="<?= site_url('mobile-videos') ?>">Videos</a>
                        </div>
                    </div>
                </li>

                <!-- Fixed Content -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                        aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Fixed Content</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="<?= site_url('fixed-report') ?>">Reports</a>
                            <a class="collapse-item" href="<?= site_url('fixed-article') ?>">Articles</a>
                            <a class="collapse-item" href="<?= site_url('fixed-videos') ?>">Videos</a>
                        </div>
                    </div>
                </li>

                <!-- Digital Content -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesDigital"
                        aria-expanded="true" aria-controls="collapsePagesDigital">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Digital Content</span>
                    </a>
                    <div id="collapsePagesDigital" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="<?= site_url('digital-report') ?>">Reports</a>
                            <a class="collapse-item" href="<?= site_url('digital-article') ?>">Articles</a>
                            <a class="collapse-item" href="<?= site_url('digital-videos') ?>">Videos</a>
                        </div>
                    </div>
                </li>

                <!-- Global Content -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesGlobal"
                        aria-expanded="true" aria-controls="collapsePagesGlobal">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Global Content</span>
                    </a>
                    <div id="collapsePagesGlobal" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="<?= site_url('global-report') ?>">Reports</a>
                            <a class="collapse-item" href="<?= site_url('global-article') ?>">Articles</a>
                            <a class="collapse-item" href="<?= site_url('global-videos') ?>">Videos</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesForum"
                        aria-expanded="true" aria-controls="collapsePagesForum">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Manage Forum</span>
                    </a>
                    <div id="collapsePagesForum" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="<?= site_url('admin/forum') ?>">Threads</a>
                            <a class="collapse-item" href="<?= site_url('threads-category') ?>">Category</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('event') ?>">
                        <i class="fas fa-fw fa-calendar-alt"></i>
                        <span>Event Calendar</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    User & Permissions
                </div>

                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('manage-user') ?>">
                        <i class="fas fa-fw fa-user-cog"></i>
                        <span>Manage Users</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('role-admin') ?>">
                        <i class="fas fa-fw fa-users-cog"></i>
                        <span>Role Permissions</span></a>
                </li>
            <?php else: ?>
                <!-- Mobile Content -->
                <?php if (isset($permissions['mobile']) && $permissions['mobile'] == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fas fa-fw fa-folder"></i>
                            <span>Mobile Content</span>
                        </a>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="<?= site_url('admin/mobile') ?>">Reports</a>
                                <a class="collapse-item" href="<?= site_url('mobile-article') ?>">Articles</a>
                                <a class="collapse-item" href="<?= site_url('mobile-videos') ?>">Videos</a>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>

                <!-- Fixed Content -->
                <?php if (isset($permissions['fixed']) && $permissions['fixed'] == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                            aria-expanded="true" aria-controls="collapsePages">
                            <i class="fas fa-fw fa-folder"></i>
                            <span>Fixed Content</span>
                        </a>
                        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="<?= site_url('fixed-report') ?>">Reports</a>
                                <a class="collapse-item" href="<?= site_url('fixed-article') ?>">Articles</a>
                                <a class="collapse-item" href="<?= site_url('fixed-videos') ?>">Videos</a>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>

                <!-- Digital Content -->
                <?php if (isset($permissions['digital']) && $permissions['digital'] == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesDigital"
                            aria-expanded="true" aria-controls="collapsePagesDigital">
                            <i class="fas fa-fw fa-folder"></i>
                            <span>Digital Content</span>
                        </a>
                        <div id="collapsePagesDigital" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="<?= site_url('digital-report') ?>">Reports</a>
                                <a class="collapse-item" href="<?= site_url('digital-article') ?>">Articles</a>
                                <a class="collapse-item" href="<?= site_url('digital-videos') ?>">Videos</a>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>

                <!-- Global Content -->
                <?php if (isset($permissions['global']) && $permissions['global'] == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesGlobal"
                            aria-expanded="true" aria-controls="collapsePagesGlobal">
                            <i class="fas fa-fw fa-folder"></i>
                            <span>Global Content</span>
                        </a>
                        <div id="collapsePagesGlobal" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="<?= site_url('global-report') ?>">Reports</a>
                                <a class="collapse-item" href="<?= site_url('global-article') ?>">Articles</a>
                                <a class="collapse-item" href="<?= site_url('global-videos') ?>">Videos</a>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if (isset($permissions['forum']) && $permissions['forum'] == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesForum"
                            aria-expanded="true" aria-controls="collapsePagesForum">
                            <i class="fas fa-fw fa-users"></i>
                            <span>Manage Forum</span>
                        </a>
                        <div id="collapsePagesForum" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="<?= site_url('admin/forum') ?>">Threads</a>
                                <a class="collapse-item" href="<?= site_url('threads-category') ?>">Category</a>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if (isset($permissions['event']) && $permissions['event'] == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('event') ?>">
                            <i class="fas fa-fw fa-calendar-alt"></i>
                            <span>Event Calendar</span></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <!-- <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div> -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <?php if ($this->session->userdata('role') == 1): ?>
                            <?php
                            // Query to get users with status "NONAKTIF"
                            $nonaktif_users = $this->db->where('status', 'NONAKTIF')->get('users')->result_array();
                            $nonaktif_count = count($nonaktif_users);
                            ?>

                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <span class="badge badge-danger badge-counter"><?php echo $total_notifications; ?></span>
                                </a>

                                <!-- Dropdown - Alerts -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header" style="background-color: maroon;">
                                        Notifikasi Terbaru
                                    </h6>

                                    <!-- Display each "NONAKTIF" user with a new account request message -->
                                    <?php if ($notifications > 0): ?>
                                        <?php
                                        date_default_timezone_set('Asia/Jakarta'); // Set the timezone to Asia/Jakarta
                                        foreach ($notifications as $notification): ?>
                                            <a class="dropdown-item d-flex align-items-center" href="#">

                                                <div>
                                                    <div class="small text-gray-500" data-timestamp="<?php echo strtotime($notification['timestamp']) * 1000; ?>">
                                                        <!-- Initial display will be handled by JavaScript -->
                                                    </div>
                                                    <span class="font-weight-bold"><?php echo $notification['message']; ?></span>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <a class="dropdown-item text-center small text-gray-500" href="#">No new alerts</a>
                                    <?php endif; ?>

                                    <a class="dropdown-item text-center small text-gray-500" href="#">Read All</a>

                                </div>
                            </li>
                        <?php endif; ?>

                        <?php if ($this->session->userdata('role') == 1): ?>
                            <div class="topbar-divider d-none d-sm-block"></div>
                        <?php endif; ?>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle"
                                    src="<?= base_url('assets/cms') ?>/img/undraw_profile.svg">
                                <div class="ml-2 d-none d-lg-inline text-gray-600">
                                    <span class="d-block"><small><?php echo $this->session->userdata('username'); ?></small></span>
                                    <span class="text-gray-500 small" style="margin-top: -2px;"><?php echo $this->session->userdata('job_title'); ?></span>
                                </div>
                            </a>


                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <!-- Link to Dashboard -->
                                <a class="dropdown-item" href="<?= site_url('home'); ?>">
                                    <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Homepage
                                </a>

                                <!-- Divider -->
                                <div class="dropdown-divider"></div>


                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>

                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <script>
                    function timeAgo(timestamp) {
                        const now = new Date();
                        const seconds = Math.floor((now - timestamp) / 1000);
                        let interval = Math.floor(seconds / 31536000);

                        if (interval === 1) return "1 year ago";
                        if (interval > 1) return interval + " years ago";

                        interval = Math.floor(seconds / 2592000);
                        if (interval === 1) return "1 month ago";
                        if (interval > 1) return interval + " months ago";

                        interval = Math.floor(seconds / 86400);
                        if (interval === 1) return "1 day ago";
                        if (interval > 1) return interval + " days ago";

                        interval = Math.floor(seconds / 3600);
                        if (interval === 1) return "1 hour ago";
                        if (interval > 1) return interval + " hours ago";

                        interval = Math.floor(seconds / 60);
                        if (interval === 1) return "1 minute ago";
                        if (interval > 1) return interval + " minutes ago";

                        return seconds === 1 ? "1 second ago" : seconds + " seconds ago";
                    }

                    function updateTimestamps() {
                        const elements = document.querySelectorAll('.small.text-gray-500[data-timestamp]');
                        elements.forEach(element => {
                            const timestamp = new Date(parseInt(element.getAttribute('data-timestamp')));
                            element.textContent = timeAgo(timestamp);
                        });
                    }

                    // Initial update
                    updateTimestamps();
                    // Update every minute
                    setInterval(updateTimestamps, 60000);
                </script>