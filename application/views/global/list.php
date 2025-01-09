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

    .search-filters {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-control {
        padding: 10px 12px;
        /* Tambahkan padding horizontal */
        border: 2px solid #ccc;
        border-radius: 0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        font-size: 16px;
        transition: border-color 0.3s;
        flex-grow: 1;
        /* Membuat field mengisi ruang */
        min-width: 150px;
        /* Atur lebar minimum untuk field */
        height: auto;
        /* Pastikan tinggi otomatis */
        line-height: 1.5;
        /* Atur line-height untuk meningkatkan keterbacaan */
    }


    .form-control:focus {
        border-color: rgb(155, 17, 13);
        outline: none;
    }

    .filter-button {
        padding: 10px 20px;
        background-color: rgb(155, 17, 13);
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .selected-filters {
        margin-top: 10px;
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    .filter-tag {
        background-color: #e0f7fa;
        padding: 5px 10px;
        border-radius: 15px;
        display: flex;
        align-items: center;
    }

    .remove-tag {
        margin-left: 5px;
        cursor: pointer;
        color: rgb(155, 17, 13);
    }

    .clear-all {
        margin-left: auto;
        background-color: transparent;
        border: none;
        color: rgb(155, 17, 13);
        cursor: pointer;
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
                Global
            </li>
        </ol>
    </nav>

    <!-- carousel report -->
    <h5 class="mt-5">Report</h5>
    <hr>

    <!-- filter search report -->
    <div class="row">
        <div class="col-md-12">
            <div class="document-directory">
                <div class="search-filters">
                    <input type="text" id="fileNameField" class="form-control" placeholder="Search by name" oninput="updateSelectedFilters()">
                    <input type="text" id="keywordsField" class="form-control" placeholder="Search by keyword" oninput="updateSelectedFilters()">
                    <select id="categoryField" class="form-control" onchange="updateSelectedFilters()">
                        <option value="" hidden>Categories</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="date" id="postedDateField" class="form-control" placeholder="Posted Date" oninput="updateSelectedFilters()">
                    <button class="filter-button" onclick="applyFilters()">Search</button>
                </div>
                <div class="selected-filters" id="selectedFilters"></div>
            </div>
        </div>
    </div>

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
                                                                $maxLength = 25; // Set the maximum length
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
                <div class="carousel-item active">
                    <div class="text-center">
                        <img src="<?= base_url('assets/9315315.jpg') ?>" alt="No Articles" style="width: 150px; height: auto;">
                    </div>
                    <p class="text-center"><small>There are no reports available yet, please check back later for the latest report.</small></p>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($reports)) : ?>
            <!-- Next and Previous buttons with added maroon color and spacing -->
            <a class="carousel-control-prev" href="#carouselExampleControls1" role="button" data-slide="prev" style="width: 5%; left: -4%; color: maroon;">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: maroon; border-radius: 50%;"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls1" role="button" data-slide="next" style="width: 5%; right: -4%; color: maroon;">
                <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: maroon; border-radius: 50%;"></span>
                <span class="sr-only">Next</span>
            </a>
        <?php endif; ?>

        <br><br><br><br>
        <?php if (!empty($reports)) : ?>
            <ol class="carousel-indicators custom-indicators mt-4">
                <?php foreach ($chunks as $index => $chunk) : ?>
                    <li data-target="#carouselExampleControls1" data-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>"></li>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>
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
                <div class="text-center">
                    <img src="<?= base_url('assets/9315315.jpg') ?>" alt="No Videos" style="width: 150px; height: auto;">
                </div>
                <p class="text-center"><small>There are no insight videos available yet. Please check back later for the latest video.</small></p>
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
                <?php foreach ($videos as $index => $chunk) : ?>
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

<script>
    function updateSelectedFilters() {
        const fileName = document.getElementById('fileNameField').value;
        const keywords = document.getElementById('keywordsField').value;
        const categorySelect = document.getElementById('categoryField');
        const categoryName = categorySelect.options[categorySelect.selectedIndex].text; // Ambil nama kategori  
        const categoryId = categorySelect.value; // Ambil ID kategori  
        const postedDate = document.getElementById('postedDateField').value;

        const selectedFilters = document.getElementById('selectedFilters');
        selectedFilters.innerHTML = ''; // Clear previous filters          

        if (fileName) {
            selectedFilters.innerHTML += `<span class="badge badge-primary mr-1">${fileName}<button class="close ml-1" onclick="removeKeyword(this)">×</button></span>`;
        }
        if (keywords) {
            selectedFilters.innerHTML += `<span class="badge badge-primary mr-1">${keywords}<button class="close ml-1" onclick="removeKeyword(this)">×</button></span>`;
        }
        if (categoryId) {
            selectedFilters.innerHTML += `<span class="badge badge-primary mr-1" data-category-id="${categoryId}">${categoryName}<button class="close ml-1" onclick="removeKeyword(this)">×</button></span>`;
        }
        if (postedDate) {
            selectedFilters.innerHTML += `<span class="badge badge-primary mr-1">${postedDate}<button class="close ml-1" onclick="removeKeyword(this)">×</button></span>`;
        }
    }

    function removeKeyword(button) {
        const badge = button.parentElement;
        badge.remove();

        // Check if all badges are removed    
        const selectedFilters = document.getElementById('selectedFilters');
        if (selectedFilters.innerHTML.trim() === '') {
            // Clear all input fields    
            document.getElementById('fileNameField').value = '';
            document.getElementById('keywordsField').value = '';
            document.getElementById('categoryField').value = '';
            document.getElementById('postedDateField').value = '';

            // Apply filters with empty values to show initial data    
            applyFilters();
        }
    }

    function applyFilters() {
        const fileName = document.getElementById('fileNameField').value;
        const keywords = document.getElementById('keywordsField').value;
        const category = document.getElementById('categoryField').value;
        const postedDate = document.getElementById('postedDateField').value;

        console.log("Sending data:", {
            file_name: fileName,
            keywords: keywords,
            category: category,
            posted_date: postedDate
        });

        // AJAX call to apply filters      
        $.ajax({
            url: '<?= site_url('globals/search_reports') ?>', // Adjust the controller method URL      
            type: 'POST',
            data: {
                file_name: fileName,
                keywords: keywords,
                category: category,
                posted_date: postedDate
            },
            dataType: 'json',
            success: function(response) {
                console.log("Response from server:", response);
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
    }
</script>