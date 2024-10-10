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
                                <h5><a href="" class="text-white"><small>Breaking Barriers</small></a></h5>
                            </div>
                            <div>
                                <h5><a href="" class="text-white"><small>Gender Equality</small></a></h5>
                            </div>
                        </div>
                    </div>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('mobile') ?>">Mobile</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= site_url('fixed') ?>">Fixed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('digital-insight') ?>">Digital Insight</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('global') ?>">Global</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('contact-us') ?>">Contact Us</a>
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
    <div class="page-content page-2 mb-1 mt-5">
        <!-- New section for breadcrumb navigation -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="list-style: none; padding: 0; margin: 0;">
                <li class="breadcrumb-item" style="display: inline; color: black;">
                    <a href="<?= site_url('home') ?>" style="color: black; text-decoration: none;">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" style="color: rgb(177, 41, 41); display: inline;">
                    Articles
                </li>
            </ol>
        </nav>

        <p class="mt-5"><small><?php echo date('l j M, Y', strtotime($viewreports['created_at'])); ?></small></p>
        <h2><b><?php echo $page_title; ?></b></h2>
    </div>

    <div class="page-content">

        <div class="article-body mt-2" style="color: gray;">
            <p>
                <?php echo $viewreports['content']; ?>
            </p>
            <br>
            <!-- <p><a href="<?php echo base_url('uploads/articles/fixed/' . $viewreports['file']); ?>" target="_blank" class="text-danger">Read more...</a></p> -->
            <p><a href="<?php echo site_url('read-article/' . $viewreports['id']); ?>" target="_blank" class="text-danger">Read more...</a></p>
        </div>
    </div>

    <div class="page-content page-2">
        <div class="comment-section">
            <div class="reaction-icons">
                <button class="btn btn-sm btn-light mr-3 position-relative" id="btn-like" data-id="<?= $viewreports['id'] ?>">
                    <i class="fa-regular fa-thumbs-up"></i>
                    <?php if ($viewreports['likes'] > 0): ?>
                        <span class="badge badge-pill badge-danger" style="position: absolute; top: -10px; right: -10px;" id="like-badge-<?= $viewreports['id'] ?>">
                            <?= $viewreports['likes'] ?>
                        </span>
                    <?php endif; ?>
                </button>

                <button class="btn btn-sm btn-light mr-3 position-relative" id="btn-unlike" data-id="<?= $viewreports['id'] ?>">
                    <i class="fa-regular fa-thumbs-down"></i>
                    <?php if ($viewreports['unlikes'] > 0): ?>
                        <span class="badge badge-pill badge-danger" style="position: absolute; top: -10px; right: -10px;" id="unlike-badge-<?= $viewreports['id'] ?>">
                            <?= $viewreports['unlikes'] ?>
                        </span>
                    <?php endif; ?>
                </button>

                <button class="btn btn-sm btn-light mr-3" data-toggle="modal" data-target="#shareModal">
                    <i class="fa-solid fa-share-nodes"></i>
                </button>

                <a class="btn btn-sm btn-light mr-3 position-relative">
                    <i class="fa-regular fa-comment"></i>
                    <?php if ($comment_count > 0): ?>
                        <span class="badge badge-pill badge-danger" style="position: absolute; top: -10px; right: -10px;">
                            <?= $comment_count ?> <!-- Menampilkan jumlah komentar secara dinamis -->
                        </span>
                    <?php endif; ?>
                </a>
            </div>
        </div>

        <div class="comment-section">
            <div class="comment-box mt-4">
                <?php if (count($comments) > 0): ?>
                    <p>Komentar</p>
                <?php endif; ?>

                <div class="comment-card mt-4">
                    <form id="commentForm" action="<?= site_url('fixed/add_comment') ?>" method="post">
                        <div class="input-group mb-3">
                            <textarea class="form-control" name="comment" id="commentInput" placeholder="Tulis Komentar" rows="1" oninput="autoResize(this); updateCharacterCount()" style="resize: none;"></textarea>
                            <input type="hidden" name="id_report" value="<?= $report_id ?>">
                            <input type="hidden" name="user_id" value="<?= $this->session->userdata('id'); ?>">
                        </div>
                        <div class="divider"></div>
                        <div class="card-footer">
                            <small id="charCount" class="form-text text-muted">1000 Karakter tersisa</small>
                            <button class="btn btn-danger btn-sm" type="submit">Kirim <i class="fa-regular fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
                <br>

                <?php if (!empty($comments)): ?>
                    <?php foreach ($comments as $comment): ?>
                        <?php
                        // Ensure timezone is set correctly
                        date_default_timezone_set('Asia/Jakarta');

                        // Define the timeAgo function directly in the view
                        if (!function_exists('timeAgo')) {
                            function timeAgo($datetime, $full = false)
                            {
                                $now = new DateTime();
                                $ago = new DateTime($datetime);
                                $diff = $now->diff($ago);

                                $diff->w = floor($diff->d / 7);
                                $diff->d -= $diff->w * 7;

                                $string = array(
                                    'y' => 'year',
                                    'm' => 'month',
                                    'w' => 'week',
                                    'd' => 'day',
                                    'h' => 'hour',
                                    'i' => 'minute',
                                    's' => 'second',
                                );
                                foreach ($string as $k => &$v) {
                                    if ($diff->$k) {
                                        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                                    } else {
                                        unset($string[$k]);
                                    }
                                }

                                if (!$full) $string = array_slice($string, 0, 1);
                                return $string ? implode(', ', $string) . ' ago' : 'just now';
                            }
                        }
                        ?>

                        <div class="card mt-2">
                            <div class="card-body">
                                <div class="comment-item d-flex">
                                    <img src="<?= base_url('assets/images/consumer.png') ?>" alt="Author" class="author-image" style="border-radius: 50%; width: 40px; height: 40px; margin-right: 10px;">
                                    <div class="d-flex flex-column">
                                        <div>
                                            <strong><?= htmlspecialchars($comment['username']) ?></strong>
                                            <br>
                                            <span class="comment-time" data-timestamp="<?= $comment['created_at'] ?>" style="font-size: 0.75rem; color: gray;"><small><?= timeAgo($comment['created_at']) ?></small></span>
                                            <br>
                                            <span class="comment-text"><?= htmlspecialchars($comment['comment_text']) ?></span>
                                        </div>
                                        <div class="like-unlike mt-3 d-flex align-items-center">
                                            <button class="btn btn-link text-muted p-0 me-3" onclick="likeComment(<?= $comment['id'] ?>)">
                                                <i class="fa-regular fa-thumbs-up fa-xs"></i> <span class="ms-1 small"><?= $comment['likes'] ?></span>
                                            </button>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button class="btn btn-link text-muted p-0 me-3" onclick="unlikeComment(<?= $comment['id'] ?>)">
                                                <i class="fa-regular fa-thumbs-down fa-xs"></i> <span class="ms-1 small"><?= $comment['unlikes'] ?></span>
                                            </button>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button class="btn btn-link text-muted p-0 ms-3" data-toggle="modal" data-target="#replyModal<?= $comment['id'] ?>">
                                                <small>Balas</small>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <?php if (!empty($comment['replies'])): ?>
                                    <div class="replies mt-3" id="replies-<?= $comment['id'] ?>">
                                        <?php foreach ($comment['replies'] as $reply): ?>
                                            <div class="card mt-2 ms-4 reply-card">
                                                <div class="card-body">
                                                    <div class="comment-item d-flex">
                                                        <img src="<?= base_url('assets/images/consumer.png') ?>" alt="Author" class="author-image" style="border-radius: 50%; width: 40px; height: 40px; margin-right: 10px;">
                                                        <div class="d-flex flex-column">
                                                            <div>
                                                                <strong><?= htmlspecialchars($reply['reply_username']) ?></strong>
                                                                <br>
                                                                <span class="comment-time" data-timestamp="<?= $reply['created_at'] ?>" style="font-size: 0.75rem; color: gray;"><small><?= timeAgo($reply['created_at']) ?></small></span>
                                                                <br>
                                                                <span class="comment-text"><?= htmlspecialchars($reply['reply_text']) ?></span>
                                                            </div>
                                                            <div class="like-unlike mt-3 d-flex align-items-center">
                                                                <button class="btn btn-link text-muted p-0 me-3" onclick="likeReply(<?= $reply['id'] ?>)">
                                                                    <i class="fa-regular fa-thumbs-up fa-xs"></i> <span class="ms-1 small"><?= $reply['likes'] ?></span>
                                                                </button>&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <button class="btn btn-link text-muted p-0 me-3" onclick="unlikeReply(<?= $reply['id'] ?>)">
                                                                    <i class="fa-regular fa-thumbs-down fa-xs"></i> <span class="ms-1 small"><?= $reply['unlikes'] ?></span>
                                                                </button>&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <button class="btn btn-link text-muted p-0 ms-3" data-toggle="modal" data-target="#replyUserModal<?= $reply['id'] ?>">
                                                                    <small>Balas</small>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <!-- Show/Hide button placed below the replies -->
                                    <button class="btn btn-link text-primary p-0 mt-4 ms-4" onclick="toggleReplies(<?= $comment['id'] ?>)">
                                        <small>Sembunyikan balasan</small>
                                    </button>
                                <?php endif; ?>
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


    <?php foreach ($comments as $comment): ?>
        <div class="modal fade" id="replyModal<?= $comment['id'] ?>" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <h6>Berikan Komentar</h6>
                        <div class="comment-card mt-4">
                            <form id="commentForm" action="<?= site_url('fixed/add_comment_user') ?>" method="post">
                                <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                <input type="hidden" name="id_report" value="<?= $comment['id_report'] ?>">
                                <input type="hidden" name="user_id" value="<?= $this->session->userdata('id'); ?>">
                                <div class="input-group mb-3">
                                    <textarea class="form-control" name="reply_text" id="commentInput" placeholder="Tulis Komentar" rows="1" oninput="autoResize(this); updateCharacterCount()" style="resize: none;"></textarea>
                                </div>
                                <small id="charCount" class="form-text text-muted">1000 Karakter tersisa</small>
                                <div class="divider"></div>
                                <br>
                                <div class="card-footer">
                                    <button class="btn btn-danger btn-sm btn-block" type="submit">Kirim <i class="fa-regular fa-paper-plane"></i></button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php if (!empty($comment['replies'])): ?>
        <?php foreach ($comment['replies'] as $reply): ?>
            <div class="modal fade" id="replyUserModal<?= htmlspecialchars($reply['id']) ?>" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <h6>Berikan Komentar</h6>
                            <div class="comment-card mt-4">
                                <form id="commentForm" action="<?= site_url('fixed/add_reply_user') ?>" method="post">
                                    <!-- Hidden fields for comment_id, parent_id, and id_report -->
                                    <input type="hidden" name="comment_id" value="<?= htmlspecialchars($comment['id']) ?>">
                                    <input type="hidden" name="parent_id" value="<?= htmlspecialchars($reply['id']) ?>">
                                    <input type="hidden" name="id_report" value="<?= htmlspecialchars($comment['id_report']) ?>">
                                    <input type="hidden" name="user_id" value="<?= $this->session->userdata('id'); ?>">

                                    <div class="input-group mb-3">
                                        <textarea class="form-control" name="reply_text" id="commentInput<?= htmlspecialchars($reply['id']) ?>" placeholder="Tulis Komentar" rows="1" oninput="autoResize(this); updateCharacterCount()" style="resize: none;"></textarea>
                                    </div>
                                    <small id="charCount" class="form-text text-muted">1000 Karakter tersisa</small>
                                    <div class="divider"></div>
                                    <br>
                                    <div class="card-footer">
                                        <button class="btn btn-danger btn-sm btn-block" type="submit">Kirim <i class="fa-regular fa-paper-plane"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>


    <!-- Modal structure -->
    <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shareModalLabel"><?php echo $page_title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>Bagikan artikel ini melalui</p>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-outline-primary btn-circle mx-2" disabled>
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a class="btn btn-outline-dark btn-circle mx-2" disabled>
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="btn btn-outline-success btn-circle mx-2" disabled>
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="mailto:?subject=<?= urlencode($page_title) ?>&body=<?= urlencode(current_url()) ?>" class="btn btn-outline-secondary btn-circle mx-2">
                            <i class="fa-solid fa-envelope"></i>
                        </a>
                        <a href="#" class="btn btn-outline-secondary btn-circle mx-2" onclick="navigator.clipboard.writeText('<?= current_url() ?>'); alert('Link copied to clipboard!');">
                            <i class="fa-solid fa-link"></i>
                        </a>
                    </div>
                </div>
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
        function toggleReplies(commentId) {
            const repliesSection = document.getElementById('replies-' + commentId);
            const toggleButton = repliesSection.nextElementSibling;

            if (repliesSection.style.display === 'none') {
                repliesSection.style.display = 'block';
                toggleButton.innerHTML = '<small>Sembunyikan balasan</small>';
            } else {
                repliesSection.style.display = 'none';
                toggleButton.innerHTML = '<small>Tampilkan balasan</small>';
            }
        }
    </script>


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
            function timeAgo(dateString) {
                const date = new Date(dateString);
                const now = new Date();
                const seconds = Math.floor((now - date) / 1000);
                const interval = Math.floor(seconds / 31536000);

                let output = '';

                if (interval > 1) {
                    output = interval + ' years ago';
                } else if (interval === 1) {
                    output = '1 year ago';
                } else {
                    const interval = Math.floor(seconds / 2592000);
                    if (interval > 1) {
                        output = interval + ' months ago';
                    } else if (interval === 1) {
                        output = '1 month ago';
                    } else {
                        const interval = Math.floor(seconds / 86400);
                        if (interval > 1) {
                            output = interval + ' days ago';
                        } else if (interval === 1) {
                            output = '1 day ago';
                        } else {
                            const interval = Math.floor(seconds / 3600);
                            if (interval > 1) {
                                output = interval + ' hours ago';
                            } else if (interval === 1) {
                                output = '1 hour ago';
                            } else {
                                const interval = Math.floor(seconds / 60);
                                if (interval > 1) {
                                    output = interval + ' minutes ago';
                                } else if (interval === 1) {
                                    output = '1 minute ago';
                                } else {
                                    output = 'just now';
                                }
                            }
                        }
                    }
                }

                return output;
            }

            function updateTimes() {
                document.querySelectorAll('.comment-time').forEach(function(element) {
                    const timestamp = element.dataset.timestamp;
                    element.textContent = timeAgo(timestamp);
                });
            }

            // Initial update
            updateTimes();

            // Update times every minute
            setInterval(updateTimes, 60000);
        });
    </script>

    <script>
        function likeComment(id) {
            $.ajax({
                url: '<?= site_url('fixed/likeComment') ?>',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    $('button[onclick="likeComment(' + id + ')"] span').text(data.likes);

                    // Show success message using SweetAlert
                    Swal.fire({
                        title: 'Success',
                        text: 'You liked this comment.',
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
        }

        function unlikeComment(id) {
            $.ajax({
                url: '<?= site_url('fixed/unlikeComment') ?>',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    $('button[onclick="unlikeComment(' + id + ')"] span').text(data.unlikes);

                    // Show success message using SweetAlert
                    Swal.fire({
                        title: 'Success',
                        text: 'You unliked this comment.',
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
        }
    </script>

    <script>
        function likeReply(id) {
            $.ajax({
                url: '<?= site_url('fixed/likeReply') ?>',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    $('button[onclick="likeReply(' + id + ')"] span').text(data.likes);

                    // Show success message using SweetAlert
                    Swal.fire({
                        title: 'Success',
                        text: 'You liked this comment.',
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
        }

        function unlikeReply(id) {
            $.ajax({
                url: '<?= site_url('fixed/unlikeReply') ?>',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    $('button[onclick="unlikeReply(' + id + ')"] span').text(data.unlikes);

                    // Show success message using SweetAlert
                    Swal.fire({
                        title: 'Success',
                        text: 'You unliked this comment.',
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



</body>

</html>