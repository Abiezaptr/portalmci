<!-- New section for "Our latest news" -->
<style>
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 0.5em 0.75em;
        border-radius: 0.5em;
        background-color: rgb(240, 240, 240);
        /* Warna latar belakang */
        color: black;
        /* Warna teks */
    }

    .document-directory {
        padding: 20px;
        background-color: #f9f9f9;
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
                Search Report
            </li>
        </ol>
    </nav>

    <!-- carousel report -->
    <div class="d-flex justify-content-between align-items-center mt-5">
        <h5>Search Result</h5>
    </div>
    <hr>


    <br>
    <div id="carouselExampleControls1" class="carousel slide" data-ride="carousel" data-interval="5000">
        <div class="carousel-inner">
            <?php if (!empty($search_results)): ?>
                <?php $chunks = array_chunk($search_results, 4); ?>
                <?php foreach ($chunks as $index => $chunk) : ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <div class="row">
                            <?php foreach ($chunk as $report) : ?>
                                <div class="col-md-3">
                                    <?php
                                    $title = str_replace(' ', '-', $report['title']);
                                    $url = ($report['type'] === 'article') ? site_url('view-article/' . urlencode($title)) : site_url('view-report/' . urlencode($title));
                                    ?>
                                    <a href="<?= $url ?>">
                                        <div class="card" style="width: 100%; max-width: 250px; overflow: hidden; margin: 0 auto;">
                                            <div class="skeleton">
                                                <img src="<?php echo base_url('uploads/image/' . $report['image']); ?>" class="card-img-top" alt="">
                                                <div class="card-body">
                                                    <p class="card-text text-dark">
                                                        <small>
                                                            <?php
                                                            $maxLength = 50;
                                                            echo (strlen($report['title']) > $maxLength) ? substr($report['title'], 0, $maxLength) . '...' : $report['title'];
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
            <?php if (!empty($search_results)): ?>
                <?php foreach ($chunks as $index => $chunk) : ?>
                    <li data-target="#carouselExampleControls1" data-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>"></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ol>
    </div>

</div>