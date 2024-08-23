<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> | MCI Online Repository</title>
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('assets') ?>/images/favicon.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">



    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            transition: background-color 0.3s;
            padding: 1rem 3rem;
        }

        .navbar.red {
            background-color: #D62424 !important;
        }

        .navbar-nav .nav-link,
        .navbar-brand {
            color: white !important;
        }

        .navbar.red .navbar-nav .nav-link,
        .navbar.red .navbar-brand {
            color: white !important;
        }

        .navbar-nav .nav-item {
            margin-left: 40px;
            /* Add spacing between menu items */
        }

        .navbar-nav .nav-item.active .nav-link {
            border-bottom: 3px solid white;
            /* Add a white bottom border */
        }

        .page-content {
            padding: 50px;
            padding-left: 100px;
            color: black;
            /* Set content text to black for better readability */
        }

        .page-content.page-2 {
            background-color: #F3EDF7;
            /* Background color for page 2 */
            padding: 60px;
            /* Add padding for better spacing */
            text-align: left;
            /* Align text to the left */
            padding-left: 100px;
            /* Increase padding to the left to move content further to the right */
        }

        .page-content.page-2 h2 {
            font-size: 1.5rem;
            /* Adjust font size for the heading */
            margin-bottom: 20px;
            /* Space between heading and buttons */
        }

        .page-content.page-2 .btn-container {
            display: flex;
            gap: 10px;
            /* Space between buttons */
        }

        .search-icon {
            color: white;
            font-size: 1rem;
            /* Adjusted size to match menu text */
        }

        .navbar-brand {
            padding-left: 50px;
            /* Add more padding to move the brand text further to the right */
        }

        .navbar-nav {
            margin-right: 60px;
            /* Increase margin to keep menu items away from the edge */
        }

        @media (max-width: 768px) {
            .navbar-brand {
                padding-left: 30px;
                /* Adjust padding for smaller screens */
            }

            .navbar-nav {
                margin-right: 20px;
                /* Adjust margin for smaller screens */
            }

            .hero-section .content h1 {
                font-size: 2rem;
                /* Adjust font size for smaller screens */
            }

            .navbar-nav .nav-item {
                margin-left: 10px;
                /* Adjust spacing for smaller screens */
            }

            .hero-section .content {
                left: 30px;
                /* Adjust left value for smaller screens */
            }
        }

        /* CSS untuk dropdown umum */
        .navbar-nav .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 50%;
            /* Pusatkan secara umum */
            transform: translateX(-40%);
            /* Pusatkan secara umum */
            width: 100vw;
            max-width: 1200px;
            background-color: #c42323;
            color: white;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* CSS spesifik untuk dropdown 'Mobile' */
        #mobileMenu+.dropdown-menu {
            left: 50%;
            /* Sesuaikan ini jika perlu */
            transform: translateX(-47%);
            /* Pastikan ini memusatkan dropdown */
        }

        /* CSS spesifik untuk dropdown 'Fixed' */
        #fixedMenu+.dropdown-menu {
            left: 50%;
            /* Sesuaikan ini jika perlu */
            transform: translateX(-56%);
            /* Pastikan ini memusatkan dropdown */
        }

        .navbar-nav .nav-item.dropdown:hover .dropdown-menu,
        .navbar-nav .nav-item.dropdown.show .dropdown-menu {
            display: block;
        }

        .dropdown-menu .submenu {
            display: flex;
            justify-content: flex-start;
            /* Align items to the start */
            padding: 0;
            /* Remove padding from submenu */
        }

        .dropdown-menu .submenu div {
            flex: 0 1 auto;
            /* Allow items to shrink and grow */
            padding: 0 20px;
            /* Reduce padding */
            margin: 0;
            /* Remove margin */
        }

        .dropdown-menu .submenu div h5 {
            margin: 0;
            /* Remove margin */
            color: white;
            /* Adjust text color */
            text-align: left;
            /* Left align text */
            margin-bottom: 10px;
        }

        .dropdown-menu .submenu div h5 small {
            font-size: 1rem;
            /* Adjust font size */
        }

        .dropdown-menu .submenu div h4 {
            margin-bottom: 10px;
        }

        .dropdown-menu .submenu div ul {
            list-style: none;
            padding: 0;
        }

        .dropdown-menu .submenu div ul li {
            margin-bottom: 5px;
        }

        .dropdown-menu .submenu div ul li a {
            color: white;
            text-decoration: none;
        }

        .dropdown-menu .submenu div ul li a:hover {
            text-decoration: underline;
        }

        /* New styles for the button */
        .hero-section .content .custom-btn {
            background: transparent;
            border: 2px solid white;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s, color 0.3s;
        }

        .hero-section .content .custom-btn:hover {
            background: white;
            color: #000000;
        }

        /* Styles for the active menu item */
        .navbar-nav .nav-item.dropdown.show .nav-link::after {
            content: '';
            display: block;
            width: 100%;
            height: 3px;
            background-color: #D62424;
            position: absolute;
            bottom: -5px;
            left: 0;
        }

        /* Media queries for responsive margin adjustment */
        @media (max-width: 1200px) {
            .navbar-nav .dropdown-menu {
                margin-left: -50px;
                /* Adjust this value as needed */
            }
        }

        @media (max-width: 992px) {
            .navbar-nav .dropdown-menu {
                margin-left: -40px;
                /* Adjust this value as needed */
            }
        }

        @media (max-width: 768px) {
            .navbar-nav .dropdown-menu {
                margin-left: -30px;
                /* Adjust this value as needed */
            }
        }

        @media (max-width: 576px) {
            .navbar-nav .dropdown-menu {
                margin-left: -20px;
                /* Adjust this value as needed */
            }
        }

        /* Styles for the search input */
        .search-input {
            display: none;
            width: 300px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-left: 10px;
        }

        .search-input.show {
            display: inline-block;
        }

        .author-info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .author-image {
            border-radius: 50%;
            width: 60px;
            height: 60px;
            margin-right: 15px;
        }

        article {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .footer {
            background-color: #ffffff;
            /* White background */
            color: #000000;
            /* Black text */
            padding: 40px 0;
            padding-left: 100px;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .footer h5 {
            margin-bottom: 20px;
            font-weight: bold;
        }

        .footer ul {
            list-style: none;
            padding: 0;
        }

        .footer ul li {
            margin-bottom: 10px;
        }

        .footer ul li a {
            color: #000000;
            /* Black text */
            text-decoration: none;
        }

        .footer ul li a:hover {
            text-decoration: underline;
        }

        .footer .container {
            max-width: 1200px;
        }

        .footer .text-center {
            margin-top: 20px;
        }

        #brand-title {
            font-family: 'Hammersmith One', sans-serif;
            font-size: 1.5rem;
            /* Atur ukuran font */
        }

        .article-body {
            margin-top: 30px;
            line-height: 1.6;
        }

        .breadcrumb {
            background: none;
            /* Remove background */
            padding: 0;
            /* Remove padding */
            margin: 0;
            /* Remove margin */
        }

        .breadcrumb-item {
            display: inline;
            /* Keep items inline */
            color: black;
            /* Set text color */
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: ">";
            /* Change separator to > */
            padding: 0 5px;
            /* Add some spacing */
        }

        .toast-light {
            background-color: #ffffff;
            /* White background */
            color: #000000;
            /* Black text color */
            border: 1px solid #dddddd;
            /* Light grey border */
        }

        .toast-light .toast-title {
            color: #000000;
            /* Black title text color */
        }

        .toast-light .toast-message {
            color: #666666;
            /* Dark grey message text color */
        }

        .toast-light .toast-success {
            background-color: #e8f5e9;
            /* Light green background for success */
            color: #2e7d32;
            /* Dark green text color */
        }

        .toast-light .toast-error {
            background-color: #fbe9e7;
            /* Light red background for error */
            color: #c62828;
            /* Dark red text color */
        }

        .bg-maroon {
            background-color: #c42323 !important;
            /* Define the maroon color */
        }

        .filter-btn {
            background-color: white;
            color: black;
            border: 1px solid #ccc;
        }

        .filter-btn.active {
            background-color: #c42323;
            color: white;
        }

        .comment-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff;
            max-width: 900px;
            /* Align to the left */
            margin-left: 0;
            margin-right: auto;
            /* Alternatively, use margin: 0; to remove any extra spacing */
        }

        #commentInput {
            border: none;
            border-radius: 5px;
            padding: 10px;
            box-shadow: none;
            outline: none;
            width: 100%;
        }

        .divider {
            height: 1px;
            background-color: #ddd;
            margin: 0;
        }

        .card-footer .btn {
            border-radius: 5px;
            background-color: #c42323;
            color: white;
            font-weight: bold;
        }

        .card-footer .btn:hover {
            background-color: #DC143C;
            /* Changed to light color */
        }

        .card-footer {
            border-top: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #charCount {
            font-size: 12px;
            margin: 0;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top red">
        <a class="navbar-brand" id="brand-title" href="<?= site_url('home') ?>"><b>MCI ONLINE REPOSITORY</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="mobileMenu" role="button" aria-haspopup="true" aria-expanded="false">Mobile</a>
                    <div class="dropdown-menu" aria-labelledby="mobileMenu">
                        <span class="ml-3 mb-4"><b>Mobile</b> &nbsp; - &nbsp; <span style="font-weight: 100;">Quickly find what you need from our curated library of resources.</span></span>
                        <div class="submenu mt-4">
                            <div>
                                <h5><a href="#" class="text-white"><small>5G-Advanced</small></a></h5>
                            </div>
                            <div>
                                <h5><a href="" class="text-white"><small>Breaking Barriers</small></a></h5>
                            </div>
                            <div>
                                <h5><a href="" class="text-white"><small>Gender Equality</small></a></h5>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= site_url('fixed') ?>">Fixed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Digital Insight</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Global</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('contact-us') ?>">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link search-icon" href="#" id="searchIcon">
                        <i class="fa fa-search"></i>
                    </a>
                    <input type="text" class="search-input" id="searchInput" placeholder="Search all">
                </li>
            </ul>
        </div>
    </nav>

    <div class="page-content page-2 mt-5">
        <!-- New section for breadcrumb navigation -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="list-style: none; padding: 0; margin: 0;">
                <li class="breadcrumb-item" style="display: inline; color: black;">
                    <a href="<?= site_url('home') ?>" style="color: black; text-decoration: none;">Home</a>
                </li>
                <li class="breadcrumb-item" aria-current="page" style="display: inline; color: black;">
                    Fixed
                </li>
                <li class="breadcrumb-item active" aria-current="page" style="color: rgb(177, 41, 41); display: inline;">
                    Comments Articles
                </li>
            </ol>
        </nav>
    </div>

    <div class="page-content">
        <div class="article-body">
            <!-- Article Card -->
            <div class="card text-white bg-maroon mb-5"> <!-- Changed bg-dark to bg-maroon -->
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?= base_url('uploads/image/' . $image_report) ?>" class="card-img" alt="Article Image" style="height: 220px; object-fit: cover;"> <!-- Set fixed height and object-fit -->
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($page_title) ?></h5> <!-- Display the dynamic page title -->
                            <p class="card-text small"><?php echo date('d/m/Y h:i', strtotime($date_report)); ?> WIB</p> <!-- Date --> <!-- Date -->
                            <p class="card-text small"><?= htmlspecialchars($desc) ?></p> <!-- Article description -->
                            <br>
                            <a href="" class="text-white" style="position: absolute; bottom: 20px;"><small>Kembali ke artikel...</small></a> <!-- Back link -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="comment-section">
                <h6>Berikan Komentar</h6>
                <div class="comment-card mt-4">
                    <form id="commentForm" action="<?= site_url('fixed/add_comment') ?>" method="post">
                        <div class="input-group mb-3">
                            <textarea class="form-control" name="comment" id="commentInput" placeholder="Tulis Komentar" rows="1" oninput="autoResize(this); updateCharacterCount()" style="resize: none;"></textarea>
                            <input type="hidden" name="id_report" value="<?= $report_id ?>">
                        </div>
                        <div class="divider"></div>
                        <div class="card-footer">
                            <small id="charCount" class="form-text text-muted">1000 Karakter tersisa</small>
                            <button class="btn btn-danger btn-sm" type="submit">Kirim <i class="fa-regular fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>

                <h6 class="mt-4"><small><?= count($comments) ?> Komentar</small></h6> <!-- Display the number of comments -->
                <div class="btn-group mb-3" role="group">
                    <button type="button" class="btn btn-danger btn-sm filter-btn active" data-filter="terbaru">Terbaru</button>
                    <button type="button" class="btn btn-danger btn-sm filter-btn" data-filter="terlama">Terlama</button>
                </div>

                <?php if (!empty($comments)): ?>
                    <?php foreach ($comments as $comment): ?>
                        <div class="card mt-2">
                            <div class="card-body">
                                <div class="comment-item d-flex align-items-center">
                                    <img src="<?= base_url('assets/images/consumer.png') ?>" alt="Author" class="author-image" style="border-radius: 50%; width: 40px; height: 40px; margin-right: 10px;">
                                    <div>
                                        <strong><?= htmlspecialchars($comment['name']) ?></strong>
                                        <br>
                                        <span class="comment-text"><?= htmlspecialchars($comment['comment_text']) ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center">
                        <img src="<?= base_url('assets/images/no-comments.png') ?>" alt="No Comments" style="width: 100px; height: auto;">
                    </div>
                    <p class="text-center"><small>Belum ada komentar. Jadilah yang pertama untuk berkomentar!</small></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.19/jquery.touchSwipe.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function updateCharacterCount() {
            const maxLength = 1000;
            const currentLength = document.getElementById('commentInput').value.length;
            const remainingChars = maxLength - currentLength;
            document.getElementById('charCount').textContent = `${remainingChars} Karakter tersisa`;
        }

        function autoResize(textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + 'px';
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scrollDown = document.getElementById('scroll-down');
            const page1 = document.getElementById('page-1');

            // Hide scroll-down initially
            scrollDown.style.display = 'none';

            // Show scroll-down when mouse enters page-1
            page1.addEventListener('mouseenter', function() {
                scrollDown.style.display = 'block';
            });

            // Hide scroll-down when mouse leaves page-1
            page1.addEventListener('mouseleave', function() {
                scrollDown.style.display = 'none';
            });

            // Handle click event for scroll-down
            scrollDown.addEventListener('click', function() {
                document.getElementById('page-2').scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#carouselExampleControls").swipe({
                swipe: function(event, direction) {
                    if (direction === 'left') {
                        $(this).carousel('next');
                    } else if (direction === 'right') {
                        $(this).carousel('prev');
                    }
                },
                allowPageScroll: "vertical"
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Event handler for the like button
            $('#btn-like').on('click', function() {
                var reportId = $(this).data('id');
                $.ajax({
                    url: '<?= site_url('fixed/like'); ?>',
                    type: 'POST',
                    data: {
                        id: reportId
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response); // Log the response to check the format

                        if (response.likes !== undefined) {
                            var likesCount = parseInt(response.likes, 10); // Convert to integer
                            var likeBadge = $('#like-badge-' + reportId);

                            if (likesCount > 0) {
                                if (likeBadge.length) {
                                    // If badge exists, update the count
                                    likeBadge.text(likesCount);
                                } else {
                                    // If badge does not exist, create it
                                    $('#btn-like[data-id="' + reportId + '"]').append(
                                        '<span class="badge badge-pill badge-danger" style="position: absolute; top: -10px; right: -10px;" id="like-badge-' + reportId + '">' + likesCount + '</span>'
                                    );
                                }
                            } else {
                                // If likesCount is 0, remove the badge if it exists
                                likeBadge.remove();
                            }
                            Swal.fire({
                                title: 'Success',
                                text: 'You liked this articles.',
                                toast: true,
                                position: 'top-end',
                                timer: 2000,
                                showConfirmButton: false,
                                background: '#f8f9fa', // Light background color
                                customClass: {
                                    container: 'swal2-container',
                                    title: 'swal2-title',
                                    popup: 'swal2-popup'
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText); // Debugging: Log any error response
                        Swal.fire({
                            title: 'Error',
                            text: 'Failed to like the report.',
                            toast: true,
                            position: 'top-end',
                            timer: 2000,
                            showConfirmButton: false,
                            background: '#f8f9fa', // Light background color
                            customClass: {
                                container: 'swal2-container',
                                title: 'swal2-title',
                                popup: 'swal2-popup'
                            }
                        });
                    }
                });
            });

            // Event handler for the unlike button
            $('#btn-unlike').on('click', function() {
                var reportId = $(this).data('id');
                $.ajax({
                    url: '<?= site_url('fixed/unlike'); ?>',
                    type: 'POST',
                    data: {
                        id: reportId
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response); // Log the response to check the format

                        if (response.unlikes !== undefined) {
                            var unlikesCount = parseInt(response.unlikes, 10); // Convert to integer
                            var unlikeBadge = $('#unlike-badge-' + reportId);

                            if (unlikesCount > 0) {
                                if (unlikeBadge.length) {
                                    // If badge exists, update the count
                                    unlikeBadge.text(unlikesCount);
                                } else {
                                    // If badge does not exist, create it
                                    $('#btn-unlike[data-id="' + reportId + '"]').append(
                                        '<span class="badge badge-pill badge-danger" style="position: absolute; top: -10px; right: -10px;" id="unlike-badge-' + reportId + '">' + unlikesCount + '</span>'
                                    );
                                }
                            } else {
                                // If unlikesCount is 0, remove the badge if it exists
                                unlikeBadge.remove();
                            }
                            Swal.fire({
                                title: 'Success',
                                text: 'You unliked this articles.',
                                toast: true,
                                position: 'top-end',
                                timer: 2000,
                                showConfirmButton: false,
                                background: '#f8f9fa', // Light background color
                                customClass: {
                                    container: 'swal2-container',
                                    title: 'swal2-title',
                                    popup: 'swal2-popup'
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText); // Debugging: Log any error response
                        Swal.fire({
                            title: 'Error',
                            text: 'Failed to unlike the report.',
                            toast: true,
                            position: 'top-end',
                            timer: 2000,
                            showConfirmButton: false,
                            background: '#f8f9fa', // Light background color
                            customClass: {
                                container: 'swal2-container',
                                title: 'swal2-title',
                                popup: 'swal2-popup'
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script>
        <?php if ($this->session->flashdata('message')): ?>
            Swal.fire({
                title: 'Success',
                text: '<?php echo $this->session->flashdata('message'); ?>',
                toast: true,
                position: 'top-end',
                timer: 2000,
                showConfirmButton: false,
                background: '#f8f9fa', // Light background color
                customClass: {
                    container: 'swal2-container',
                    title: 'swal2-title',
                    popup: 'swal2-popup'
                }
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            Swal.fire({
                title: 'Success',
                text: '<?php echo $this->session->flashdata('error'); ?>',
                toast: true,
                position: 'top-end',
                timer: 2000,
                showConfirmButton: false,
                background: '#f8f9fa', // Light background color
                customClass: {
                    container: 'swal2-container',
                    title: 'swal2-title',
                    popup: 'swal2-popup'
                }
            });
        <?php endif; ?>
    </script>

    <script>
        document.getElementById('commentForm').addEventListener('submit', function(event) {

            const restrictedWords = [

                'anjing', 'tai', 'babi', 'jorok', 'sara', 'kontol', 'memek', 'ngentot', 'goblok', 'tolol', 'bangsat',
                'brengsek', 'kampret', 'setan', 'iblis', 'perek', 'lonte', 'pelacur', 'sundal', 'bajingan', 'keparat',

                'monyet', 'asu', 'jancok', 'pantek', 'pepek', 'pukimak', 'kimak', 'bitch', 'fuck', 'shit', 'asshole',

                'bastard', 'cunt', 'dick', 'pussy', 'slut', 'whore', 'faggot', 'nigger', 'chink', 'kike', 'spic', 'wetback'

            ]; // Add more words as needed

            const comment = document.getElementById('commentInput').value.toLowerCase();

            for (let word of restrictedWords) {
                if (comment.includes(word)) {
                    alert('Komentar mengandung kata yang tidak diperbolehkan.');
                    event.preventDefault();

                    return;

                }
            }

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    // Add your filtering logic here
                });
            });
        });
    </script>

</body>

</html>