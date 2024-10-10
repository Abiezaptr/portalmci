<div class="page-content mb-1">
    <br><br><br>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="list-style: none; padding: 0; margin: 0;">
            <li class="breadcrumb-item" style="display: inline; color: black;">
                <a href="<?= site_url('home') ?>" style="color: black; text-decoration: none;">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" style="color: rgb(177, 41, 41); display: inline;">
                Topics
            </li>
        </ol>
    </nav>
    <br>

    <div class="row">
        <div class="col-md-8">
            <div class="thread-list" id="threadList">
                <?php foreach ($threads as $thread): ?>
                    <div class="card thread-card" style="margin-bottom: 20px; padding: 20px; position: relative; border-radius: 0;">
                        <div class="border-gradient" style="
                        position: absolute;
                        left: 0;
                        top: 0;
                        bottom: 0;
                        width: 8px;
                        background: linear-gradient(180deg, #ff6a00, #ee0979, #fc6767, #ec008c); /* Gradasi warna */
                        border-radius: 0;
                    "></div>

                        <div class="thread-info" style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <a href="<?php echo base_url('form-discussion/' . $thread['id']); ?>" class="thread-title" style="font-weight: bold; color: #800000;"><?php echo $thread['title']; ?></a>
                            </div>
                        </div>

                        <div class="thread-meta" style="display: flex; align-items: center; margin-top: 2px;">
                            <div class="user-avatars">
                                <img src="<?php echo base_url('assets/images/user.png'); ?>" alt="Avatar A" class="user-avatar" style="background-color: #6c757d;">
                                <img src="<?php echo base_url('assets/images/avatar2.jpg'); ?>" alt="Avatar B" class="user-avatar" style="background-color: #6c757d;">
                                <img src="<?php echo base_url('assets/images/avatar3.jpg'); ?>" alt="Avatar C" class="user-avatar" style="background-color: #6c757d;">
                            </div>

                            <span class="posted-time small text-muted" style="margin-left: 10px;" data-transaction-time="<?= htmlspecialchars($thread['created_at']); ?>">
                                3 kontribusi&nbsp; ·&nbsp;
                                <span style="font-size: 12px;" class="posted-time" data-transaction-time="<?= htmlspecialchars($thread['created_at']); ?>">
                                    <span style="font-weight: 500;" class="waktu-lalu"></span>
                                </span>
                            </span>
                        </div>

                        <p class="thread-description" style="font-size: 14px; color: black; margin-left: 2px; margin-top: 12px;">
                            <?= htmlspecialchars($thread['content']); ?>
                        </p>

                        <!-- Bagian kategori -->
                        <div class="thread-category" style="font-size: 12px; color: black; margin-left: 2px; margin-top: 0px;">
                            <strong><?php echo $thread['category_name']; ?></strong>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-md-3">
            <!-- Modern journey section with a bold title -->
            <h5 style="font-weight: bold; font-size: 18px; margin-bottom: 15px;" class="mb-4">Jelajahi ini juga</h5>

            <!-- Tag-style links -->
            <div class="category-tags" style="display: flex; flex-wrap: wrap; gap: 15px;">
                <?php foreach ($categories as $category): ?>
                    <a href="<?php echo base_url('forum/category/' . $category['id']); ?>" style="
                padding: 8px 14px;      /* Padding for a compact tag feel */
                font-size: 14px;        /* Reduced font size for minimalistic design */
                font-weight: 500;       /* Font weight to keep it modern and readable */
                color: #333;            /* Neutral text color */
                background-color: #f8f9fa;  /* Light background for a tag look */
                border-radius: 30px;    /* Round the edges for a tag style */
                text-decoration: none;  /* Remove underline for clean look */
                transition: background-color 0.3s ease, transform 0.2s ease; /* Smooth hover effect */
                flex-basis: 100%;       /* Each tag takes full width of the row */
            "
                        onmouseover="this.style.backgroundColor='#eee'; this.style.transform='scale(1.05)'"
                        onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.transform='scale(1)'">
                        <?php echo $category['name']; ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- Button to see all topics with an icon on the right -->
            <div class="text-center mt-4">
                <a href="<?php echo base_url('all-topics'); ?>" class="btn btn-block" style="
        padding: 10px 30px;
        font-size: 16px;
        font-weight: 500;
        border-radius: 50px;  /* Rounded button */
        text-decoration: none;
        color: white;         /* Ensure the text is visible */
        background: linear-gradient(45deg, #b34700, #a1005d); /* Darker gradient from dark orange to dark red */
        border: none;         /* Remove border */
    ">
                    Lihat Semua Topik
                    <i class="fas fa-arrow-right" style="margin-left: 10px;"></i> <!-- Icon on the right -->
                </a>
            </div>


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
        width: 24px;
        /* Atur ukuran yang sedikit lebih besar */
        height: 24px;
        /* Atur ukuran yang sedikit lebih besar */
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-weight: bold;
        margin: 0;
        /* Hapus margin untuk membuatnya mepet */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        /* Tambahkan efek timbul */
        transition: box-shadow 0.3s, transform 0.3s;
        /* Tambahkan transisi untuk efek hover */
    }

    .user-avatar:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        /* Efek timbul lebih dalam saat hover */
        transform: translateY(-2px);
        /* Meningkatkan efek timbul dengan sedikit mengangkat */
    }

    /* Jika Anda ingin mengatur spacing antara avatars */
    .user-avatars>.user-avatar:not(:last-child) {
        margin-right: -4px;
        /* Menambahkan margin negatif untuk lebih mendekatkan */
    }


    .extra-users {
        width: 20px;
        height: 20px;
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
    // JavaScript untuk memperbarui waktu dinamis dalam bahasa Indonesia
    function updateTimeAgo() {
        const postedTimes = document.querySelectorAll('.posted-time');

        postedTimes.forEach(function(postedTime) {
            const transactionTime = postedTime.getAttribute('data-transaction-time');
            const transactionDate = new Date(transactionTime); // Mengubah waktu dari backend ke tanggal JS
            const currentDate = new Date(); // Waktu sekarang
            const interval = Math.floor((currentDate - transactionDate) / 1000); // Mendapatkan selisih dalam detik

            let timeAgo = '';

            if (interval >= 31536000) { // 1 tahun
                timeAgo = Math.floor(interval / 31536000) + ' tahun lalu';
            } else if (interval >= 2592000) { // 1 bulan
                timeAgo = Math.floor(interval / 2592000) + ' bulan lalu';
            } else if (interval >= 86400) { // 1 hari
                timeAgo = Math.floor(interval / 86400) + ' hari lalu';
            } else if (interval >= 3600) { // 1 jam
                timeAgo = Math.floor(interval / 3600) + ' jam lalu';
            } else if (interval >= 60) { // 1 menit
                timeAgo = Math.floor(interval / 60) + ' menit lalu';
            } else {
                timeAgo = 'Baru saja';
            }

            // Memperbarui tampilan waktu
            postedTime.querySelector('.waktu-lalu').textContent = timeAgo;
        });
    }

    // Pemanggilan awal untuk mengatur waktu saat halaman dimuat
    updateTimeAgo();

    // Memperbarui waktu setiap menit
    setInterval(updateTimeAgo, 60000); // Perbarui setiap 60 detik
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