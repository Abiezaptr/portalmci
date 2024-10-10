<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title; ?> | MCI Online Repository</title>
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('assets') ?>/images/favicon.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .hero-section {
            position: relative;
            height: 100vh;
            overflow: hidden;
        }

        .hero-section .bg-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .hero-section .content {
            position: absolute;
            top: 50%;
            left: 100px;
            transform: translateY(-50%);
            text-align: left;
            color: white;
        }

        .hero-section.shrink {
            height: 50vh;
            /* Adjust height when menu is open */
        }

        .hero-section .content h1 {
            font-size: 3rem;
            font-weight: semibold;
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

        .page-content.page-2 .btn-quick {
            background-color: #D62424;
            /* Button background color */
            color: white;
            /* Button text color */
            border: none;
            /* Remove border */
            padding: 10px 85px;
            /* Adjust padding for buttons to make them larger */
            font-size: 0.9rem;
            /* Adjust font size for buttons */
        }

        .page-content.page-2 .btn:hover {
            background-color: #a81b1b;
            /* Darker shade on hover */
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

        /* General dropdown styling */
        .dropdown-menu {
            display: none;
            /* Default is hidden */
            background-color: white;
            /* Warna latar belakang putih */
            border: 1px solid #dee2e6;
            /* Border tipis */
            border-radius: 0.25rem;
            /* Sudut melengkung */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            /* Efek bayangan */
            margin-left: -15px;
            /* Penyesuaian margin kiri */
            position: absolute;
            /* Posisi absolut */
            left: 0;
            /* Dipegang ke kiri */
            right: auto;
            /* Atur auto untuk menghindari konflik */
            z-index: 1000;
            /* Pastikan dropdown berada di atas elemen lain */
        }

        /* Display dropdown on hover */
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            /* Tampilkan dropdown saat hover */
        }

        /* Styling for dropdown items */
        .dropdown-item {
            color: #212529;
            /* Warna teks */
            padding: 10px 20px;
            /* Padding item dropdown */
            text-decoration: none;
            /* Hilangkan underline */
            display: block;
            /* Pastikan item ditampilkan sebagai blok */
        }

        /* Hover effect for dropdown items */
        .dropdown-item:hover {
            background-color: #f8f9fa;
            /* Background abu-abu muda saat hover */
            color: #0056b3;
            /* Warna teks saat hover */
        }

        /* User image inside dropdown */
        .user-image {
            margin-right: 8px;
            /* Jarak antara gambar dan teks */
        }

        /* Optional: Media queries for responsiveness */
        @media (max-width: 768px) {
            .dropdown-menu {
                margin-left: 0;
                width: 100%;
                /* Atur agar dropdown mengisi lebar layar di mobile */
            }
        }


        .btn-download,
        .btn-report {
            padding: 10px 30px;
            /* Pastikan padding sama */
            font-size: 1rem;
            /* Pastikan ukuran font sama */
            width: 300px;
            /* Atur lebar tombol agar sama */
            cursor: pointer;
            transition: background 0.3s, color 0.3s, border-color 0.3s;
            /* Tambahkan transisi untuk border */
        }

        .btn-download {
            background: #DC002b;
            border: 2px solid #DC002b;
            /* Pastikan border memiliki ketebalan */
            color: white;
        }

        .btn-download:focus {
            outline: none;
            /* Menghilangkan outline saat tombol fokus */
        }

        .btn-report {
            background: transparent;
            border: 2px solid white;
            color: white;
        }

        .btn-report:hover {
            background: white;
            /* Background color on hover */
            color: #000000;
            /* Text color on hover */
            border-color: #ffffff;
            /* Ubah warna border saat hover */
        }

        .btn-report:focus {
            outline: none;
            /* Menghilangkan outline saat tombol fokus */
            border-color: #ffffff;
            /* Tetap pertahankan warna border saat fokus */
        }

        .button-container {
            margin-top: 20px;
            /* Tambahkan jarak antara tombol */
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

        /* New styles for the news section */
        .news-section {
            position: relative;
            /* Make sure the position is relative */
            background: url('<?php echo base_url('uploads/image/' . $viewreports['image']); ?>') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 200px;
            text-align: left;
            padding-left: 100px;
            z-index: 1;
            /* Set a higher z-index to make the content appear on top of the overlay */
        }

        .news-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Adjust the color and opacity */
            z-index: -1;
            /* Put the overlay behind the content */
        }


        .news-section h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .news-section p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .news-section .btn {
            background-color: #D62424;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
        }

        .news-section .btn:hover {
            background-color: #a81b1b;
        }

        .scroll-down {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1.2rem;
            color: white;
            text-align: center;
            cursor: pointer;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
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

        .upcoming-events {
            display: flex;
            justify-content: space-between;
            margin: 0;
            /* Remove any default margin */
            padding: 0;
            /* Remove any default padding */
        }

        .event {
            position: relative;
            width: 50%;
            /* Each event takes half of the container width */
            overflow: hidden;
        }

        .event img {
            width: 100%;
            height: auto;
            display: block;
            /* Remove any space below the image */
        }

        .event-info {
            position: absolute;
            bottom: 20px;
            /* Position info at the bottom of the image */
            left: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Semi-transparent background for the text */
            color: white;
            padding: 10px;
            text-align: center;
        }

        .btn {
            background-color: #D62424;
            border: none;
            padding: 10px 20px;
            color: white;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #a81b1b;
        }

        #brand-title {
            font-family: 'Hammersmith One', sans-serif;
            font-size: 1.5rem;
            /* Atur ukuran font */
        }

        .report-container {
            display: flex;
            justify-content: space-between;
            /* Space between items */
            flex-wrap: wrap;
            /* Allow wrapping */
            margin: 20px 0;
            /* Add margin */
        }

        .report-item {
            text-align: center;
            /* Center text */
            width: 18%;
            /* Adjust width as needed */
        }

        .report-item img {
            width: 100%;
            /* Make images responsive */
            height: auto;
            /* Maintain aspect ratio */
            max-height: 300px;
            /* Set a maximum height */
            object-fit: cover;
            /* Maintain aspect ratio */
        }

        .report-item p {
            margin-top: 10px;
            /* Space between image and text */
            font-weight: bold;
            /* Bold text */
        }

        .carousel-indicators {
            position: absolute;
            bottom: 10px;
            /* Adjust as needed */
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: center;
            padding-left: 0;
            margin-left: 0;
            list-style: none;
        }

        .carousel-indicators li {
            background-color: #000;
            /* Color of the dots */
            border-radius: 50%;
            width: 12px;
            /* Size of the dots */
            height: 12px;
            /* Size of the dots */
        }

        .carousel-indicators .active {
            background-color: maroon;
            /* Color of the active dot */
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
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="mobileMenu" role="button" aria-haspopup="true" aria-expanded="false">Mobile</a>
                    <div class="dropdown-menu" aria-labelledby="mobileMenu">
                        <span class="ml-3 mb-4"><b>Mobile</b> &nbsp; - &nbsp; <span style="font-weight: 100;">Quickly find what you need from our curated library of resources.</span></span>
                        <div class="submenu mt-4">
                            <div>
                                <h5><a href="#" class="text-white"><small>5G-Advanced</small></a></h5>
                            </div>
                            <div>
                                <h5><a href="#" class="text-white"><small>Breaking Barriers</small></a></h5>
                            </div>
                            <div>
                                <h5><a href="#" class="text-white"><small>Gender Equality</small></a></h5>
                            </div>
                        </div>
                    </div>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('mobile') ?>">Mobile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('fixed') ?>">Fixed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('digital-insight') ?>">Digital Insight</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('global') ?>">Global</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('contact') ?>">Contact Us</a>
                </li>
                <?php if ($this->session->userdata('id')): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?= base_url('assets/images/user.png') ?>" alt="User Image" class="user-image" style="width: 30px; height: 30px; border-radius: 50%;">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= site_url('login/logout') ?>">Logout</a>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link search-icon" href="<?= base_url('login'); ?>">
                            <b><i class="fa-regular fa-user"></i>&nbsp; Sign in</b>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- New section for "Our latest news" -->
    <div class="news-section">
        <a href="<?php echo site_url('fixed/view_pdf/' . $viewreports['id']); ?>" target="_blank" class="btn-download text-white">View Report</a>


        <!-- <a href="<?php echo base_url('uploads/report/' . $viewreports['file']); ?>" target="_blank" class="btn-download text-white">Download report</a> -->
    </div>

    <div class="page-content">
        <h4><b>Other reports</b></h4>
        <br>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="3000">
            <div class="carousel-inner">
                <?php if (!empty($others)) : ?>
                    <?php $chunks = array_chunk($others, 4); ?>
                    <?php foreach ($chunks as $index => $chunk) : ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <div class="row">
                                <?php foreach ($chunk as $report) : ?>
                                    <div class="col-md-3">
                                        <?php if ($report['type'] === 'article') : ?>
                                            <a href="<?= site_url('view-articles') ?>">
                                            <?php else : ?>
                                                <?php
                                                $title = str_replace(' ', '-', $report['title']);
                                                ?>
                                                <a href="<?= site_url('view-report/' . urlencode($title)) ?>">
                                                <?php endif; ?>
                                                <div class="card">
                                                    <div class="skeleton">
                                                        <img src="<?php echo base_url('uploads/image/' . $report['image']); ?>" class="card-img-top" alt="">
                                                    </div>
                                                </div>
                                                </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No reports found.</p>
                <?php endif; ?>
            </div>
            <!-- Carousel Dots -->
            <br><br><br><br>
            <?php if ($chunks && count($chunks) > 0) : ?>
                <ol class="carousel-indicators custom-indicators mt-4">
                    <?php foreach ($chunks as $index => $chunk) : ?>
                        <li data-target="#carouselExampleControls" data-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>"></li>
                    <?php endforeach; ?>
                </ol>
            <?php endif; ?>

        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.19/jquery.touchSwipe.min.js"></script>

    <script>
        // Ensure 'red' class is added on scroll (not necessary since the class is already added by default)
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.add('red'); // This ensures the 'red' class is present
        });

        // Add 'red' class on mobile menu hover
        document.getElementById('mobileMenu').addEventListener('mouseover', function() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.add('red');
        });

        // Add 'red' class on fixed menu hover
        document.getElementById('fixedMenu').addEventListener('mouseover', function() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.add('red');
        });

        // Remove unnecessary logic for removing the 'red' class
        // No need to remove 'red' class on mouse leave
        // Removed the code inside .navbar-nav mouseleave event listener

        // Adjust dropdown menu margin based on screen size
        function adjustDropdownMargin() {
            const dropdownMenu = document.querySelector('.navbar-nav .dropdown-menu');
            const screenWidth = window.innerWidth;

            if (screenWidth > 1200) {
                dropdownMenu.style.marginLeft = '-65px';
            } else if (screenWidth > 992) {
                dropdownMenu.style.marginLeft = '-50px';
            } else if (screenWidth > 768) {
                dropdownMenu.style.marginLeft = '-40px';
            } else if (screenWidth > 576) {
                dropdownMenu.style.marginLeft = '-30px';
            } else {
                dropdownMenu.style.marginLeft = '-20px';
            }
        }

        window.addEventListener('resize', adjustDropdownMargin);
        window.addEventListener('load', adjustDropdownMargin);
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
        document.getElementById('mobileMenu').addEventListener('click', function(event) {
            // Prevent dropdown from opening
            event.preventDefault();
            // Redirect to the link
            window.location.href = this.href;
        });

        document.getElementById('fixedMenu').addEventListener('click', function(event) {
            // Prevent dropdown from opening
            event.preventDefault();
            // Redirect to the link
            window.location.href = this.href;
        });
    </script>

</body>

</html>