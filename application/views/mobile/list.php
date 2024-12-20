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
                Mobile
            </li>
        </ol>
    </nav>
    <br>

    <!-- carousel report -->
    <div class="d-flex justify-content-between align-items-center mt-5">
        <h5>Report</h5>
        <div>
            <input type="text" id="searchField" class="form-control" placeholder="Search reports..." style="width: 300px;">
        </div>
    </div>
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

        <!-- Next and Previous buttons with added maroon color and spacing -->
        <a class="carousel-control-prev" href="#carouselExampleControls1" role="button" data-slide="prev" style="width: 5%; left: -4%; color: maroon;">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: maroon; border-radius: 50%;"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls1" role="button" data-slide="next" style="width: 5%; right: -4%; color: maroon;">
            <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: maroon; border-radius: 50%;"></span>
            <span class="sr-only">Next</span>
        </a>

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
            <!-- Next and Previous buttons with added maroon color and spacing -->
            <a class="carousel-control-prev" href="#carouselExampleControls2" role="button" data-slide="prev" style="width: 5%; left: -4%; color: maroon;">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: maroon; border-radius: 50%;"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls2" role="button" data-slide="next" style="width: 5%; right: -4%; color: maroon;">
                <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: maroon; border-radius: 50%;"></span>
                <span class="sr-only">Next</span>
            </a>
        <?php endif; ?>

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
                                                <p class="card-text">
                                                    <small>
                                                        <?php
                                                        $maxLength = 100; // Set the maximum length
                                                        if (strlen($report->description) > $maxLength) {
                                                            echo substr($report->description, 0, $maxLength) . '...';
                                                        } else {
                                                            echo $report->description;
                                                        }
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
                <p>No reports found.</p>
            <?php endif; ?>
        </div>

        <?php if (!empty($videos)) : ?>
            <!-- Next and Previous buttons with added maroon color and spacing -->
            <a class="carousel-control-prev" href="#carouselExampleControls3" role="button" data-slide="prev" style="width: 5%; left: -4%; color: maroon;">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: maroon; border-radius: 50%;"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls3" role="button" data-slide="next" style="width: 5%; right: -4%; color: maroon;">
                <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: maroon; border-radius: 50%;"></span>
                <span class="sr-only">Next</span>
            </a>
        <?php endif; ?>

        <?php if (!empty($videos)) : ?>
            <br><br><br><br>
            <ol class="carousel-indicators custom-indicators mt-4">
                <?php foreach ($video as $index => $chunk) : ?>
                    <li data-target="#carouselExampleControls3" data-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>"></li>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>
    </div>
</div>

<div class="page-content page-2" id="page-2">
    <h2>Quick links</h2>
    <div class="btn-container">
        <a href="https://10.2.114.197/mcirepository" target="_blank" class="btn-quick btn-danger">Libraries</a>
        <a href="<?= site_url('articles') ?>" class="btn-quick btn-danger">Articles</a>
        <a href="<?= site_url('forum') ?>" class="btn-quick btn-danger">Forum</a>
        <a href="<?= site_url('events-calendar') ?>" class="btn-quick btn-danger">Events</a>
        <a href="https://tsel.id/RequestResearch" target="_blank" class="btn-quick btn-danger">Request</a>
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

<script>
    $(document).ready(function() {
        $('#searchField').on('input', function() {
            var query = $(this).val();

            $.ajax({
                url: '<?= site_url('mobile/search_reports') ?>', // Adjust the controller method URL
                type: 'POST',
                data: {
                    search_query: query
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'success') {
                        // Update the carousel with the new reports
                        var carouselContent = '';
                        var carouselIndicators = '';
                        $.each(response.reports, function(index, chunk) {
                            carouselContent += '<div class="carousel-item' + (index === 0 ? ' active' : '') + '">';
                            carouselContent += '<div class="row">';
                            $.each(chunk, function(i, report) {
                                var title = report.title.replace(/\s+/g, '-');
                                var url = report.type === 'article' ? 'view-article/' + encodeURIComponent(title) : 'view-report/' + encodeURIComponent(title);
                                carouselContent += '<div class="col-md-3">';
                                carouselContent += '<a href="<?= site_url('') ?>' + url + '">';
                                carouselContent += '<div class="card" style="width: 100%; max-width: 250px; overflow: hidden; margin: 0 auto;">';
                                carouselContent += '<div class="skeleton">';
                                carouselContent += '<img src="<?= base_url('uploads/image/') ?>' + report.image + '" class="card-img-top" alt="">';
                                carouselContent += '<div class="card-body">';
                                carouselContent += '<p class="card-text text-dark"><small>' + (report.title.length > 50 ? report.title.substring(0, 50) + '...' : report.title) + '</small></p>';
                                carouselContent += '</div>';
                                carouselContent += '</div>';
                                carouselContent += '</div>';
                                carouselContent += '</a>';
                                carouselContent += '</div>';
                            });
                            carouselContent += '</div>';
                            carouselContent += '</div>';
                        });

                        // Update the carousel inner
                        $('#carouselExampleControls1 .carousel-inner').html(carouselContent);

                        // Update carousel indicators
                        var indicatorHtml = '';
                        $.each(response.reports, function(index, chunk) {
                            indicatorHtml += '<li data-target="#carouselExampleControls1" data-slide-to="' + index + '" class="' + (index === 0 ? 'active' : '') + '"></li>';
                        });
                        $('#carouselExampleControls1 .carousel-indicators').html(indicatorHtml);
                    } else {
                        // If no reports found, display a message
                        $('#carouselExampleControls1 .carousel-inner').html('<p>No reports found.</p>');
                        $('#carouselExampleControls1 .carousel-indicators').html('');
                    }
                }
            });
        });
    });
</script>