<div id="page-1">
    <div class="hero-section">
        <video id="bg-video" autoplay muted loop class="bg-video">
            <source src="video.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="content">
            <!-- <h2>Together with our members, <br>we make connectivity work for all.</h2> -->
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
            <h2>
                <?php echo $newTitle; ?><br>
                <?php if ($remainingTitle): ?>
                    <span class="subtitle"><?php echo $remainingTitle; ?></span>
                <?php endif; ?>
            </h2>
            <button class="custom-btn mt-3">More on what we do</button>
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
        <a href="https://192.168.0.178/mcitsel" target="_blank" class="btn-quick btn-danger">Libraries</a>
        <button class="btn-quick btn-danger">Articles</button>
        <button class="btn-quick btn-danger">Forum</button>
        <button class="btn-quick btn-danger">Events</button>
        <a href="https://forms.gle/g6mapWMKBdzRoHqFA" target="_blank" class="btn-quick btn-danger">Request</a>
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
                                                    <p class="card-text text-dark"><small><?php echo htmlspecialchars($report['title']); ?></small></p>
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
                        <p class="card-text"><small>Your video description here.</small></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row justify-content-center mt-5">
        <button class="btn btn-danger">More insight video</button>
    </div>
</div>

<div class="page-content">
    <h4>Events Calendar</h4>
    <br>
    <div class="upcoming-events">
        <div class="event event-left">
            <img src="assets/images/lasvegas.webp" alt="MWC Las Vegas">
            <div class="event-info">
                <h5><small>Upcoming</small></h5>
                <h3>MWC Las Vegas</h3>
                <p>October 8 - 10, 2024</p>
                <p>Las Vegas Convention Center</p>
                <button class="btn btn-danger mt-4">Register your interest</button>
            </div>
        </div>
        <div class="event event-right">
            <img src="assets/images/kwali.webp" alt="MWC Kigali">
            <div class="event-info">
                <h5><small>Upcoming</small></h5>
                <h3>MWC Kigali</h3>
                <p>26 - 29 October, 2024</p>
                <p>Kigali Convention Centre</p>
                <button class="btn btn-danger mt-4">Register your interest</button>
            </div>
        </div>
        <div class="event event-right">
            <img src="assets/images/kwali.webp" alt="MWC Kigali">
        </div>
    </div>
</div>

<br><br><br>