<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?> | MCI Online Repository</title>
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('assets') ?>/images/favicon.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

        .dropdown-menu {
            background-color: white;
            /* Change to your desired background color */
            border: 1px solid #dee2e6;
            /* Subtle border for the dropdown */
            border-radius: 0.25rem;
            /* Rounded corners */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            /* Shadow effect for depth */
            margin-left: -15px;
            /* Adjust this value to move left */
            position: absolute;
            /* Use absolute positioning */
            left: 0;
            /* Align to the left */
            right: auto;
            /* Ensure right is set to auto to avoid conflicts */
        }

        .dropdown-item {
            color: #212529;
            /* Change text color */
            padding: 10px 20px;
            /* Padding for dropdown items */
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            /* Light gray background on hover */
            color: #0056b3;
            /* Change text color on hover */
        }

        .user-image {
            margin-right: 8px;
            /* Space between image and text */
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

        .play-icon-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 3rem;
            color: white;
            opacity: 0.7;
            cursor: pointer;
        }

        .play-icon-overlay:hover {
            opacity: 1;
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

        @keyframes pulse {
            0% {
                transform: translateY(-50%) scale(1);
            }

            50% {
                transform: translateY(-50%) scale(1.2);
                /* Scale up */
            }

            100% {
                transform: translateY(-50%) scale(1);
                /* Scale back to original */
            }
        }

        .notification-icon {
            position: absolute;
            top: 26%;
            /* Center vertically */
            left: 17px;
            /* Adjust this value to position it horizontally to the left of the bell */
            transform: translateY(-50%);
            /* Center the icon vertically */
            font-size: 0.6rem;
            /* Adjust size as needed */
            color: white;
            /* Change color if needed */
            animation: pulse 1s infinite;
            /* Apply the pulse animation */
        }

        /* New styles for the news section */
        .news-section {
            background: url('./assets/images/contact.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 160px;
            text-align: left;
            padding-left: 100px;
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
            background-color: #ffffff;
            color: rgb(0, 0, 0);
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
        }

        .news-section .btn:hover {
            background-color: white;
            /* Keep the background color on hover */
            color: #000000;
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

        .notification-icon {
            position: absolute;
            top: 26%;
            /* Center vertically */
            left: 17px;
            /* Adjust this value to position it horizontally to the left of the bell */
            transform: translateY(-50%);
            /* Center the icon vertically */
            font-size: 0.6rem;
            /* Adjust size as needed */
            color: white;
            /* Change color if needed */
            animation: pulse 1s infinite;
            /* Apply the pulse animation */
        }

        .search-container {
            position: relative;
            /* Untuk posisi ikon */
        }

        .search-input {
            width: 350px;
            /* Lebar input yang lebih panjang */
            padding: 10px;
            /* Padding untuk input */
            border: 2px solid #007bff;
            /* Warna border */
            border-radius: 25px;
            /* Membuat sudut input melengkung */
            font-size: 16px;
            /* Ukuran font untuk teks input */
            transition: border-color 0.3s, box-shadow 0.3s;
            /* Transisi untuk efek hover */
            outline: none;
            /* Menghilangkan outline default */
        }

        .search-input::placeholder {
            color: #aaa;
            /* Warna placeholder */
            font-size: 10px;
            /* Ukuran font placeholder lebih kecil */
            opacity: 1;
            /* Opacity placeholder */
        }

        .search-input:focus {
            border-color: #0056b3;
            /* Warna border saat fokus */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            /* Efek bayangan saat fokus */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top red">
        <a class="navbar-brand" id="brand-title" href="<?= site_url('home') ?>" style="font-size: 17px;"><b>MCI ONLINE REPOSITORY</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php
            // Dapatkan segmen URI saat ini
            $current_uri = $this->uri->segment(1);
            ?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?= ($current_uri == 'mobile') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= site_url('mobile') ?>" style="font-size: 14px;">Mobile</a>
                </li>
                <li class="nav-item <?= ($current_uri == 'fixed') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= site_url('fixed') ?>" style="font-size: 14px;">Fixed</a>
                </li>
                <li class="nav-item <?= ($current_uri == 'digital-insight') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= site_url('digital-insight') ?>" style="font-size: 14px;">Digital</a>
                </li>
                <li class="nav-item <?= ($current_uri == 'global') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= site_url('global') ?>" style="font-size: 14px;">Global</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('contact-us') ?>" style="font-size: 14px;">Contact</a>
                </li>
                <li class="nav-item">
                    <form action="<?= site_url('home/search_report'); ?>" method="POST">
                        <div id="search-field">
                            <div class="input-group align-items-center" style="width: 300px;">
                                <input class="mt-1 form-control" type="text" name="query" placeholder="by name or keyword" autocomplete="off" style="font-size: 0.8em; width: 230px;">
                                <div class="input-group-append">
                                    <button style="margin-top: 3px; background-color: #a81b1b; color:#f8f9fa; border: none; font-size: 1.2em; padding: 3px 10px;" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" href="<?= site_url('notification') ?>">
                        <?php if ($total_relevant_notifications > 0): ?>
                            <i class="fas fa-circle notification-icon"></i> <!-- Circular icon -->
                        <?php endif; ?>
                        <i class="fas fa-bell"></i>
                    </a>
                </li>
                <?php if ($this->session->userdata('id')): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?= base_url('assets/images/user.png') ?>" alt="User Image" class="user-image" style="width: 25px; height: 25px; border-radius: 40%;">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="userDropdown">
                            <?php if (in_array($this->session->userdata('role'), [1, 3, 4, 5, 6])): ?>
                                <a class="dropdown-item" href="<?= site_url('dashboard') ?>">Dashboard</a>
                            <?php endif; ?>
                            <a class="dropdown-item" href="<?= site_url('login/logout') ?>">Logout</a>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link search-icon" href="<?= base_url('login'); ?>" style="font-size: 14px;">
                            Login
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </nav>