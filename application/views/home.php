<style>
    .report-title {
        max-width: 900px;
        /* Adjust the width as needed */
        word-wrap: break-word;
    }

    .report-title .subtitle {
        display: block;
    }
</style>
<div id="page-1">
    <div class="hero-section">
        <video id="bg-video" autoplay muted loop class="bg-video">
            <source src="<?= base_url('assets/video.mp4') ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="content">
            <?php
            // Display the specific report with name like 'Are mobile and fixed broadband'
            if (!empty($specificReport)) {
                $title = htmlspecialchars($specificReport['title']);
                $maxLength = 100; // Set the maximum character length before breaking

                if (strlen($title) > $maxLength) {
                    // Find the last space within the max length to break the title
                    $breakPoint = strrpos(substr($title, 0, $maxLength), ' ');
                    if ($breakPoint !== false) {
                        $newTitle = substr($title, 0, $breakPoint); // Title up to the break point
                        $remainingTitle = substr($title, $breakPoint + 1); // Remaining title
                    } else {
                        $newTitle = $title; // If no space found, keep the title as is
                        $remainingTitle = '';
                    }
                } else {
                    $newTitle = $title; // If within limit, keep the title as is
                    $remainingTitle = '';
                }
            ?>
                <h2 class="report-title">
                    <?php echo $newTitle; ?><br>
                    <?php if ($remainingTitle): ?>
                        <span class="subtitle"><?php echo $remainingTitle; ?></span>
                    <?php endif; ?>
                </h2>
                <br>
                <a href="<?= site_url('view-article/' . urlencode(str_replace(' ', '-', $specificReport['title']))) ?>" class="custom-btn mt-5">More on what we do</a>
            <?php
            }
            ?>
        </div>
        <div class="scroll-down mb-4" id="scroll-down">
            <small>Scroll down</small><br>
            <i class="fas fa-chevron-down"></i>
        </div>
    </div>
</div>



<div class="page-content page-2" id="page-2">
    <h2>Quick links</h2>
    <div class="btn-container">
        <a href="https://10.2.114.197/mcirepository" target="_blank" class="btn-quick btn-danger">Libraries</a>
        <a href="<?= site_url('articles') ?>" class="btn-quick btn-danger">Articles</a>
        <a href="<?= site_url('forum') ?>" class="btn-quick btn-danger">Forum</a>
        <button class="btn-quick btn-danger" id="scroll-to-events">Events</button>
        <a href="https://tsel.id/RequestResearch" target="_blank" class="btn-quick btn-danger">Request</a>
    </div>
</div>

<div class="page-content">
    <h4>Latest report</h4>
</div>

<div class="page-content page-2">

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="5000">
        <div class="carousel-inner">
            <?php if (!empty($reports)) : ?>
                <?php $chunks = array_chunk($reports, 4); ?>
                <?php foreach ($chunks as $index => $chunk) : ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <div class="row">
                            <?php foreach ($chunk as $report) : ?>
                                <div class="col-md-3">
                                    <a href="<?php echo $report['type'] === 'article'
                                                    ? site_url('view-article/' . urlencode(str_replace(' ', '-', $report['title'])))
                                                    : site_url('view-report/' . urlencode(str_replace(' ', '-', $report['title']))); ?>">
                                        <div class="card" style="width: 100%; max-width: 250px; overflow: hidden; margin: 0 auto;">
                                            <div class="skeleton">
                                                <img src="<?php echo base_url('uploads/image/' . $report['image']); ?>" class="card-img-top" alt="">
                                                <div class="card-body">
                                                    <p class="card-text text-dark">
                                                        <small>
                                                            <?php
                                                            $maxLength = 50;
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

        <!-- Next and Previous buttons with added maroon color and spacing -->
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev" style="width: 5%; left: -4%; color: maroon;">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: maroon; border-radius: 50%;"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next" style="width: 5%; right: -4%; color: maroon;">
            <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: maroon; border-radius: 50%;"></span>
            <span class="sr-only">Next</span>
        </a>

        <br><br><br><br>
        <ol class="carousel-indicators custom-indicators mt-4">
            <?php foreach ($chunks as $index => $chunk) : ?>
                <li data-target="#carouselExampleControls" data-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>"></li>
            <?php endforeach; ?>
        </ol>
    </div>

</div>

<div class="page-content">
    <h4>Our latest news</h4>
</div>

<!-- New section for "Our latest news" -->
<div class="news-section">
    <?php
    $title = htmlspecialchars($articleReport['title']);
    $maxLength = 60; // Set the maximum character length before breaking

    if (strlen($title) > $maxLength) {
        // Find the last space within the max length to break the title
        $breakPoint = strrpos(substr($title, 0, $maxLength), ' ');
        if ($breakPoint !== false) {
            $newTitle = substr($title, 0, $breakPoint); // Title up to the break point
            $remainingTitle = substr($title, $breakPoint + 1); // Remaining title
        } else {
            $newTitle = $title; // If no space found, keep the title as is
            $remainingTitle = '';
        }
    } else {
        $newTitle = $title; // If within limit, keep the title as is
        $remainingTitle = '';
    }
    ?>
    <p><b><?php echo $newTitle; ?><br>
            <?php if ($remainingTitle): ?>
                <span class="subtitle"><?php echo $remainingTitle; ?></span>
            <?php endif; ?></b></p>
    <p><?= $articleReport['desc'] ?></p>
    <?php
    $title = str_replace(' ', '-', $articleReport['title']);
    ?>
    <a href="<?= site_url('view-article/' . urlencode($title)) ?>" class="btn">Read more</a>
</div>

<div class="page-content">
    <h4>Video Insights</h4>
    <br>
    <div class="row">
        <?php foreach ($videos as $video): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <?php
                    // Extract the YouTube video ID from the link
                    parse_str(parse_url($video->link, PHP_URL_QUERY), $url_params);
                    $video_id = isset($url_params['v']) ? $url_params['v'] : basename(parse_url($video->link, PHP_URL_PATH));
                    $thumbnail = "https://img.youtube.com/vi/{$video_id}/hqdefault.jpg";
                    ?>
                    <a href="<?= $video->link ?>" target="_blank" class="card-img-wrapper position-relative">
                        <img src="<?= $thumbnail ?>" class="card-img-top" alt="Video Thumbnail">
                        <div class="play-icon-overlay">
                            <i class="fas fa-play-circle"></i>
                        </div>
                    </a>
                    <div class="card-body">
                        <p class="card-text">
                            <small>
                                <?php
                                $maxLength = 140; // Set the maximum length
                                if (strlen($video->description) > $maxLength) {
                                    echo substr($video->description, 0, $maxLength) . '...';
                                } else {
                                    echo $video->description;
                                }
                                ?>
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row justify-content-center mt-5">
        <button class="btn btn-danger">More insight video</button>
    </div>
</div>

<div class="page-content" id="events-section">
    <h4>Upcoming Events</h4>
    <br>
    <div class="upcoming-events">
        <?php foreach ($upcoming_events as $index => $event): ?>
            <div class="event <?php echo $index % 2 == 0 ? 'event-left' : 'event-right'; ?>">
                <img src="<?= base_url('assets/images/event3.jpg'); ?>" alt="<?php echo $event->title; ?>" style="filter: blur(2px);">
                <div class="event-info">
                    <h5><small>Upcoming</small></h5>
                    <h4><?php echo $event->title; ?></h4>
                    <p><?php echo date('F j, Y', strtotime($event->start_date)); ?></p>
                    <p><?php echo $event->location; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<br><br><br>