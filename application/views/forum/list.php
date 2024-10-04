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

    .forum-table {
        width: 100%;
        border-collapse: collapse;
        border: none;
        /* Menghapus border di seluruh tabel */
    }

    .forum-table th,
    .forum-table td {
        padding: 15px;
        text-align: left;
        border-bottom: none;
        /* Menghapus garis bawah */
        vertical-align: middle;
        /* Menjaga konten tetap di tengah secara vertikal */
    }

    .forum-table th {
        font-size: 0.85rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Striping untuk baris tabel */
    .forum-table tbody tr:nth-child(odd) {
        background-color: #f8f9fa;
        /* Warna latar belakang untuk baris ganjil */
    }

    .forum-table tbody tr:nth-child(even) {
        background-color: #ffffff;
        /* Warna latar belakang untuk baris genap */
    }

    .forum-table .category-dot {
        height: 8px;
        width: 8px;
        background-color: #007bff;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
    }

    .forum-table .users {
        display: flex;
        align-items: center;
    }

    .forum-table .user-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #adb5bd;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        margin-right: 5px;
        line-height: 1;
        /* Menyelaraskan teks dalam avatar */
    }

    .forum-table .tag {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 3px;
        font-size: 0.75rem;
        margin-right: 5px;
        color: white;
    }

    .tag-gaming {
        background-color: #17a2b8;
    }

    .tag-nature {
        background-color: #28a745;
    }

    .tag-entertainment {
        background-color: #007bff;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .text-small {
        font-size: 0.8rem;
    }

    /* Ubah warna topic link menjadi hitam */
    .forum-table .topic-link {
        font-weight: 500;
        color: #343a40;
        text-decoration: none;
    }

    .forum-table .topic-link:hover {
        text-decoration: underline;
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
                List of Topics
            </li>
        </ol>
    </nav>
    <br>
    <div class="row mb-3">
        <div class="col-md-6 position-relative">
            <i class="fas fa-search position-absolute" style="left: 35px; top: 50%; transform: translateY(-50%); color: #999;"></i>
            <input type="text" class="form-control pl-5 py-2" name="topicSearch" id="topicSearch" placeholder="Search by topics">
        </div>

        <div class="col-auto">
            <div class="d-inline-block">
                <select class="form-select px-4 py-2" name="categorySelect" id="categorySelect">
                    <option value="all">All Categories</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo htmlspecialchars($category['id']); ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Spacing to push the button to the right -->
        <div class="col"></div>

        <!-- Create Topic Button in the right corner -->
        <div class="col-auto text-end">
            <a href="#" class="btn btn-sm btn-light px-4 py-2 rounded-pill shadow-sm">Create a new Thread</a>
        </div>
    </div>

    <div>
        <div class="thread-list" id="threadList">
            <?php foreach ($threads as $thread): ?>
                <div class="card thread-card" style="margin-bottom: 20px; padding: 20px; border-left: 4px solid #800000;">
                    <div class="thread-info" style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <a href="<?php echo base_url('form-discussion/' . $thread['id']); ?>" class="thread-title" style="font-weight: bold; color: #800000;"><?php echo $thread['title']; ?></a>
                            <div class="thread-tags mt-2">
                                <?php
                                $tags = explode(',', $thread['tags']);
                                foreach ($tags as $tag) {
                                    echo '<span class="tag">' . htmlspecialchars($tag) . '</span> ';
                                }
                                ?>
                            </div>
                        </div>

                        <div class="thread-stats" style="display: flex; align-items: center; gap: 20px;">
                            <div class="replies-count" style="text-align: center;">
                                <i class="fas fa-reply"></i>
                                <div>
                                    <?php
                                    $repliesCount = $thread['replies_count'];
                                    if ($repliesCount < 1000) {
                                        echo $repliesCount . ' Replies';
                                    } elseif ($repliesCount < 1000000) {
                                        echo number_format($repliesCount / 1000, 1) . 'K Replies';
                                    } else {
                                        echo number_format($repliesCount / 1000000, 1) . 'M Replies';
                                    }
                                    ?>
                                </div>
                            </div>

                            &nbsp;
                            <div class="views-count" style="text-align: center;">
                                <i class="fas fa-eye"></i>
                                <div>
                                    <?php
                                    $viewsCount = $thread['views_count'];
                                    if ($viewsCount < 1000) {
                                        echo $viewsCount . ' Views';
                                    } elseif ($viewsCount < 1000000) {
                                        echo number_format($viewsCount / 1000, 1) . 'K Views';
                                    } else {
                                        echo number_format($viewsCount / 1000000, 1) . 'M Views';
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="thread-meta" style="display: flex; align-items: center; margin-top: 10px;">
                        <div class="user-details" style="margin-left: 10px;">
                            <span style="font-size: 12px;" class="posted-time" data-transaction-time="<?= htmlspecialchars($thread['created_at']); ?>">
                                Posted <span style="font-weight: 600;" id="time-ago"></span> by <?php echo htmlspecialchars($thread['name']); ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>


</div>

<style>
    .thread-list {
        margin: 0;
        padding: 0;
    }

    .card {
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .thread-card {
        border-left: 4px solid #800000;
        /* Mengganti warna border menjadi maroon */
    }

    .thread-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .thread-title {
        font-size: 18px;
        font-weight: bold;
        color: #800000;
        /* Mengganti warna teks menjadi maroon */
        text-decoration: none;
    }

    .thread-tags .tag {
        background-color: #f1f1f1;
        border-radius: 3px;
        padding: 3px 8px;
        font-size: 12px;
        margin-right: 5px;
    }

    .thread-meta {
        display: flex;
        align-items: center;
        margin-top: 10px;
    }

    .user-avatar {
        background-color: #800000;
        /* Mengganti warna avatar menjadi maroon */
        color: white;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .user-details {
        margin-left: 10px;
        color: #6c757d;
    }

    .thread-stats {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .replies-count,
    .views-count {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .replies-count i,
    .views-count i {
        font-size: 20px;
        color: #6c757d;
    }

    .replies-count div,
    .views-count div {
        font-size: 14px;
        color: #6c757d;
    }


    .thread-stats div {
        display: flex;
        align-items: center;
        color: #6c757d;
    }

    .thread-stats i {
        margin-right: 5px;
    }

    .form-select {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        transition: all 0.3s ease;
    }

    .form-select:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .btn-light {
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        transition: background-color 0.3s ease;
    }

    .btn-light:hover {
        background-color: #e2e6ea;
    }

    .card {
        border-radius: 15px;
    }

    .card-body {
        padding: 1.5rem;
    }

    .table {
        font-size: 0.95rem;
    }

    .thead-light th {
        color: #495057;
        font-weight: 500;
        text-transform: uppercase;
    }

    .topic-link {
        font-weight: 600;
        color: #343a40;
        transition: color 0.2s ease-in-out;
    }

    .topic-link:hover {
        color: #0d6efd;
    }

    .table-row:hover {
        background-color: #f1f3f5;
        transition: background-color 0.2s ease;
    }

    .user-avatars {
        display: flex;
        align-items: center;
    }

    .user-avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-weight: bold;
        margin-right: 6px;
    }

    .extra-users {
        width: 35px;
        height: 35px;
        background-color: #adb5bd;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-weight: bold;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .small {
        font-size: 0.8rem;
    }

    @media (max-width: 768px) {
        .table {
            font-size: 0.85rem;
        }

        .btn {
            padding: 0.5rem 1rem;
        }
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
    // JavaScript to update time dynamically
    // JavaScript to update time dynamically
    function updateTimeAgo() {
        const postedTimes = document.querySelectorAll('.posted-time');

        postedTimes.forEach(function(postedTime) {
            const transactionTime = postedTime.getAttribute('data-transaction-time');
            const transactionDate = new Date(transactionTime); // Convert the time from the backend to JS date
            const currentDate = new Date(); // Current time
            const interval = Math.floor((currentDate - transactionDate) / 1000); // Get the difference in seconds

            let timeAgo = '';

            if (interval >= 31536000) { // 1 year
                timeAgo = Math.floor(interval / 31536000) + ' year' + (Math.floor(interval / 31536000) > 1 ? 's' : '') + ' ago';
            } else if (interval >= 2592000) { // 1 month
                timeAgo = Math.floor(interval / 2592000) + ' month' + (Math.floor(interval / 2592000) > 1 ? 's' : '') + ' ago';
            } else if (interval >= 86400) { // 1 day
                timeAgo = Math.floor(interval / 86400) + ' day' + (Math.floor(interval / 86400) > 1 ? 's' : '') + ' ago';
            } else if (interval >= 3600) { // 1 hour
                timeAgo = Math.floor(interval / 3600) + ' hour' + (Math.floor(interval / 3600) > 1 ? 's' : '') + ' ago';
            } else if (interval >= 60) { // 1 minute
                timeAgo = Math.floor(interval / 60) + ' min' + (Math.floor(interval / 60) > 1 ? 's' : '') + ' ago';
            } else {
                timeAgo = 'Just now';
            }

            // Update the displayed time
            postedTime.querySelector('#time-ago').textContent = timeAgo;
        });
    }

    // Initial call to set the time ago when the page loads
    updateTimeAgo();

    // Update the time every minute
    setInterval(updateTimeAgo, 60000); // Refresh every 60 seconds


    // Initial call to set the time ago when the page loads
    updateTimeAgo();

    // Update the time every minute
    setInterval(updateTimeAgo, 60000); // Refresh every 60 seconds
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to fetch filtered threads
        function fetchFilteredThreads() {
            const topicSearch = document.getElementById('topicSearch').value;
            const categorySelect = document.getElementById('categorySelect').value;

            // AJAX request
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php echo base_url('forum/filter'); ?>', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const threads = JSON.parse(xhr.responseText);
                    updateThreadList(threads);
                    updateTimeAgo(); // Call updateTimeAgo after updating the thread list
                }
            };
            xhr.send('topicSearch=' + encodeURIComponent(topicSearch) + '&categorySelect=' + encodeURIComponent(categorySelect));
        }

        // Function to format numbers
        function formatNumber(num) {
            if (num < 1000) {
                return num;
            } else if (num < 1000000) {
                return (num / 1000).toFixed(1) + 'K';
            } else {
                return (num / 1000000).toFixed(1) + 'M';
            }
        }

        // Function to update thread list
        function updateThreadList(threads) {
            const threadList = document.getElementById('threadList');
            threadList.innerHTML = '';

            threads.forEach(thread => {
                const threadCard = `
                    <div class="card thread-card" style="margin-bottom: 20px; padding: 20px; border-left: 4px solid #800000;">
                        <div class="thread-info" style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <a href="<?php echo base_url('form-discussion/'); ?>${thread.id}" class="thread-title" style="font-weight: bold; color: #800000;">${thread.title}</a>
                                <div class="thread-tags mt-2">
                                    ${thread.tags.split(',').map(tag => `<span class="tag">${tag.trim()}</span>`).join(' ')}
                                </div>
                            </div>
                            <div class="thread-stats" style="display: flex; align-items: center; gap: 20px;">
                                <div class="replies-count" style="text-align: center;">
                                    <i class="fas fa-reply"></i>
                                    <div>${formatNumber(thread.replies_count)} Replies</div>
                                </div>
                                &nbsp;
                                <div class="views-count" style="text-align: center;">
                                    <i class="fas fa-eye"></i>
                                    <div>${formatNumber(thread.views_count)} Views</div>
                                </div>
                            </div>
                        </div>
                        <div class="thread-meta" style="display: flex; align-items: center; margin-top: 10px;">
                            <div class="user-details" style="margin-left: 10px;">
                                <span style="font-size: 12px;" class="posted-time" data-transaction-time="${thread.created_at}">
                                    Posted <span style="font-weight: 600;" id="time-ago"></span> by ${thread.name}
                                </span>
                            </div>
                        </div>
                    </div>
                `;
                threadList.innerHTML += threadCard;
            });
        }

        // Event listeners
        document.getElementById('topicSearch').addEventListener('input', fetchFilteredThreads);
        document.getElementById('categorySelect').addEventListener('change', fetchFilteredThreads);
    });

    // JavaScript to update time dynamically
    function updateTimeAgo() {
        const postedTimes = document.querySelectorAll('.posted-time');

        postedTimes.forEach(function(postedTime) {
            const transactionTime = postedTime.getAttribute('data-transaction-time');
            const transactionDate = new Date(transactionTime); // Convert the time from the backend to JS date
            const currentDate = new Date(); // Current time
            const interval = Math.floor((currentDate - transactionDate) / 1000); // Get the difference in seconds

            let timeAgo = '';

            if (interval >= 31536000) { // 1 year
                timeAgo = Math.floor(interval / 31536000) + ' year' + (Math.floor(interval / 31536000) > 1 ? 's' : '') + ' ago';
            } else if (interval >= 2592000) { // 1 month
                timeAgo = Math.floor(interval / 2592000) + ' month' + (Math.floor(interval / 2592000) > 1 ? 's' : '') + ' ago';
            } else if (interval >= 86400) { // 1 day
                timeAgo = Math.floor(interval / 86400) + ' day' + (Math.floor(interval / 86400) > 1 ? 's' : '') + ' ago';
            } else if (interval >= 3600) { // 1 hour
                timeAgo = Math.floor(interval / 3600) + ' hour' + (Math.floor(interval / 3600) > 1 ? 's' : '') + ' ago';
            } else if (interval >= 60) { // 1 minute
                timeAgo = Math.floor(interval / 60) + ' min' + (Math.floor(interval / 60) > 1 ? 's' : '') + ' ago';
            } else {
                timeAgo = 'Just now';
            }

            // Update the displayed time
            postedTime.querySelector('#time-ago').textContent = timeAgo;
        });
    }

    // Initial call to set the time ago when the page loads
    updateTimeAgo();

    // Update the time every minute
    setInterval(updateTimeAgo, 60000); // Refresh every 60 seconds
</script>