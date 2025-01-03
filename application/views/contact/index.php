<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | MCI Online Repository</title>
    <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicon.png">
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
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top red">
        <a class="navbar-brand" id="brand-title" href="<?= site_url('home') ?>" style="font-size: 17px;"><b>MCI ONLINE REPOSITORY</b></a>
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
                    <a class="nav-link" href="<?= site_url('mobile') ?>" style="font-size: 14px;">Mobile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('fixed') ?>" style="font-size: 14px;">Fixed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('digital-insight') ?>" style="font-size: 14px;">Digital Insight</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('global') ?>" style="font-size: 14px;">Global</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= site_url('contact') ?>" style="font-size: 14px;">Contact</a>
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

    <!-- New section for "Our latest news" -->
    <div class="news-section">
        <h3><b>Dieky Budiman</b></h3>
        <p class="mt-4">Fixed Market Reserach and Actionable <br>Insight Department</p>
        <p class="mt-1"><i class="fas fa-envelope"></i>&nbsp;&nbsp; dieky_budiman@telkomsel.co.id</p>
        <p class="mt-1"><i class="fas fa-phone"></i>&nbsp;&nbsp; +62 811220001</p>
    </div>

    <!-- Footer -->
    <footer class="footer">
    </footer>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.19/jquery.touchSwipe.min.js"></script>

    <script>
        // Removed JavaScript that toggles the 'red' class
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

</body>

</html>