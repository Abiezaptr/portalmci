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
                Fixed
            </li>
        </ol>
    </nav>

    <!-- carousel report -->
    <div class="d-flex justify-content-between align-items-center mt-5">
        <h5>New Report</h5>
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

        <?php if (!empty($reports)) : ?>
            <br><br><br><br>
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
                <p>No reports found.</p>
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
        <a href="<?= site_url('libraries') ?>" target="_blank" class="btn-quick btn-danger">Libraries</a>
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
            url: '<?= site_url('fixed/search_reports') ?>', // Adjust the controller method URL        
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

    // Add event listener for Enter key on the input fields  
    document.getElementById('fileNameField').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent default action  
            applyFilters(); // Call the applyFilters function  
        }
    });

    document.getElementById('keywordsField').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent default action  
            applyFilters(); // Call the applyFilters function  
        }
    });

    document.getElementById('postedDateField').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent default action  
            applyFilters(); // Call the applyFilters function  
        }
    });

    // Optionally, you can also add it to the category select if you want to trigger on Enter  
    document.getElementById('categoryField').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent default action  
            applyFilters(); // Call the applyFilters function  
        }
    });

    // Add event listener to clear filters when input is cleared  
    document.getElementById('fileNameField').addEventListener('input', function() {
        if (this.value.trim() === '') {
            applyFilters(); // Call applyFilters to reset to default data  
        }
    });

    document.getElementById('keywordsField').addEventListener('input', function() {
        if (this.value.trim() === '') {
            applyFilters(); // Call applyFilters to reset to default data  
        }
    });

    document.getElementById('postedDateField').addEventListener('input', function() {
        if (this.value.trim() === '') {
            applyFilters(); // Call applyFilters to reset to default data  
        }
    });

    // Optionally, you can also add it to the category select if you want to trigger on input clear  
    document.getElementById('categoryField').addEventListener('change', function() {
        if (this.value === '') {
            applyFilters(); // Call applyFilters to reset to default data  
        }
    });
</script>