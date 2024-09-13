<!-- New section for "Our latest news" -->
<style>
    .placeholder {
        background-color: #e0e0e0;
        height: 200px;
        /* Adjust this height according to your image size */
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
</style>

<div class="page-content mb-1">
    <br><br><br>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="list-style: none; padding: 0; margin: 0;">
            <li class="breadcrumb-item" style="display: inline; color: black;">
                <a href="<?= site_url('home') ?>" style="color: black; text-decoration: none;">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" style="color: rgb(177, 41, 41); display: inline;">
                Digital Insight
            </li>
        </ol>
    </nav>
    <br>

    <!-- carousel report -->
    <h5 class="mt-5">Report</h5>
    <hr>
    <br>
    <div id="carouselExampleControls1" class="carousel slide" data-ride="carousel" data-interval="5000">
        <div class="carousel-inner">
            <?php if (!empty($reports)) : ?>
                <?php $chunks = array_chunk($reports, 4); ?>
                <?php foreach ($chunks as $index => $chunk) : ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <div class="row">
                            <?php foreach ($chunk as $report) : ?>
                                <div class="col-md-3">
                                    <?php if ($report['type'] === 'article') : ?>
                                        <?php
                                        $title = str_replace(' ', '-', $report['title']);
                                        ?>
                                        <a href="<?= site_url('view-article/' . urlencode($title)) ?>">

                                        <?php else : ?>
                                            <?php
                                            $title = str_replace(' ', '-', $report['title']);
                                            ?>
                                            <a href="<?= site_url('view-report/' . urlencode($title)) ?>">
                                            <?php endif; ?>
                                            <div class="card" style="width: 100%; max-width: 250px; overflow: hidden; margin: 0 auto;">
                                                <div class="skeleton">
                                                    <img src="<?php echo base_url('uploads/image/' . $report['image']); ?>" class="card-img-top" alt="">
                                                    <div class="card-body">
                                                        <p class="card-text text-dark">
                                                            <small>
                                                                <?php
                                                                $maxLength = 50; // Set the maximum length
                                                                if (strlen($report['title']) > $maxLength) {
                                                                    echo substr($report['title'], 0, $maxLength) . '...';
                                                                } else {
                                                                    echo $report['title'];
                                                                }
                                                                ?>
                                                            </small>
                                                        </p>
                                                    </div>
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

        <br><br><br><br>
        <ol class="carousel-indicators custom-indicators mt-4">
            <?php foreach ($chunks as $index => $chunk) : ?>
                <li data-target="#carouselExampleControls1" data-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>"></li>
            <?php endforeach; ?>
        </ol>
    </div>

    <!-- carousel articles -->
    <h5 class="mt-3">Articles</h5>
    <hr>
    <br>
    <div id="carouselExampleControls2" class="carousel slide" data-ride="carousel" data-interval="5000">
        <div class="carousel-inner">
            <?php if (!empty($articles)) : ?>
                <?php $chunks = array_chunk($articles, 4); ?>
                <?php foreach ($chunks as $index => $chunk) : ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <div class="row">
                            <?php foreach ($chunk as $report) : ?>
                                <div class="col-md-3 d-flex">
                                    <?php if ($report['type'] === 'article') : ?>
                                        <?php $title = str_replace(' ', '-', $report['title']); ?>
                                        <a href="<?= site_url('view-article/' . urlencode($title)) ?>">
                                        <?php else : ?>
                                            <?php $title = str_replace(' ', '-', $report['title']); ?>
                                            <a href="<?= site_url('view-report/' . urlencode($title)) ?>">
                                            <?php endif; ?>
                                            <div class="card" style="width: 100%; max-width: 250px; overflow: hidden; margin: 0 auto; display: flex; flex-direction: column; height: 100%;">
                                                <div class="skeleton" style="height: 200px; display: flex; align-items: center; justify-content: center; text-align: center;">
                                                    <img src="<?php echo base_url('uploads/image/' . $report['image']); ?>" class="card-img-top" alt="" style="height: 200px; object-fit: cover; display: none;">
                                                </div>
                                                <div class="card-body" style="padding: 0.5rem; display: flex; flex-direction: column; justify-content: flex-start;">
                                                    <p class="card-text text-dark" style="margin: 0;">
                                                        <small>
                                                            <?php
                                                            $title = htmlspecialchars($report['title']);
                                                            echo mb_strimwidth($title, 0, 60, '...');
                                                            ?>
                                                        </small>
                                                    </p>
                                                </div>
                                            </div>
                                            </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="text-center">
                    <img src="<?= base_url('assets/9315315.jpg') ?>" alt="No Articles" style="width: 150px; height: auto;">
                </div>
                <p class="text-center"><small>There are no interesting articles available yet, please check back later for the latest news.</small></p>
            <?php endif; ?>
        </div>

        <?php if (!empty($articles)) : ?>
            <br><br><br><br>
            <ol class="carousel-indicators custom-indicators mt-4">
                <?php foreach ($chunks as $index => $chunk) : ?>
                    <li data-target="#carouselExampleControls2" data-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>"></li>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>
    </div>
    <br>

    <!-- carousel videos -->
    <h5 class="mt-3">Videos</h5>
    <hr>
    <br>
    <div id="carouselExampleControls3" class="carousel slide" data-ride="carousel" data-interval="5000">
        <div class="carousel-inner">
            <?php if (!empty($videos)) : ?>
                <?php $video = array_chunk($videos, 4); ?>
                <?php foreach ($video as $index => $chunk) : ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <div class="row">
                            <?php foreach ($chunk as $report) : ?>
                                <?php
                                // Extract the YouTube video ID from the link
                                parse_str(parse_url($report->link, PHP_URL_QUERY), $url_params);
                                $video_id = isset($url_params['v']) ? $url_params['v'] : basename(parse_url($report->link, PHP_URL_PATH));
                                $thumbnail = "https://img.youtube.com/vi/{$video_id}/hqdefault.jpg";
                                ?>
                                <div class="col-md-3">
                                    <a href="<?= $report->link ?>">
                                        <div class="card" style="width: 100%; max-width: 250px; overflow: hidden; margin: 0 auto;">
                                            <a href="<?= $report->link ?>" target="_blank" class="card-img-wrapper position-relative">
                                                <div class="skeleton">
                                                    <img src="<?= $thumbnail ?>" class="card-img-top" alt="Video Thumbnail">
                                                    <div class="play-icon-overlay">
                                                        <i class="fas fa-play-circle"></i>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="card-body">
                                                <p class="card-text"><small>Your video description here.</small></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="text-center">
                    <img src="<?= base_url('assets/9315315.jpg') ?>" alt="No Videos" style="width: 150px; height: auto;">
                </div>
                <p class="text-center"><small>There are no insight videos available yet. Please check back later for the latest video.</small></p>
            <?php endif; ?>
        </div>

        <br><br><br><br>
        <ol class="carousel-indicators custom-indicators mt-4">
            <?php foreach ($videos as $index => $chunk) : ?>
                <li data-target="#carouselExampleControls3" data-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>"></li>
            <?php endforeach; ?>
        </ol>
    </div>
</div>

<div class="page-content page-2" id="page-2">
    <h2>Quick links</h2>
    <div class="btn-container">
        <a href="https://10.2.114.197/mcirepository" target="_blank" class="btn-quick btn-danger">Libraries</a>
        <button class="btn-quick btn-danger">Articles</button>
        <button class="btn-quick btn-danger">Forum</button>
        <button class="btn-quick btn-danger">Events</button>
        <a href="https://forms.gle/g6mapWMKBdzRoHqFA" target="_blank" class="btn-quick btn-danger">Request</a>
    </div>
</div>

<style>
    /* Skeleton CSS */
    .skeleton {
        background-color: #e0e0e0;
        border-radius: 4px;
        width: 100%;
        height: 200px;
        /* Adjust this height according to your image size */
        position: relative;
        overflow: hidden;
    }

    .skeleton::after {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        left: -100%;
        height: 100%;
        width: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent);
        animation: loading 1.5s infinite;
    }

    @keyframes loading {
        100% {
            left: 100%;
        }
    }

    /* Hide the actual image until it's fully loaded */
    .card-img-top {
        display: none;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const images = document.querySelectorAll(".card-img-top");

        images.forEach((img) => {
            img.addEventListener("load", function() {
                setTimeout(() => {
                    const skeleton = img.closest(".skeleton");
                    skeleton.classList.remove("skeleton");
                    img.style.display = "block"; // Show the actual image
                }, 3000); // Delay of 3 seconds
            });

            // If the image is already cached by the browser, trigger the load event
            if (img.complete) {
                img.dispatchEvent(new Event("load"));
            }
        });
    });
</script>