<div class="page-content mb-1">
    <br><br><br>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="list-style: none; padding: 0; margin: 0;">
            <li class="breadcrumb-item" style="display: inline; color: black;">
                <a href="<?= site_url('home') ?>" style="color: black; text-decoration: none;">Home</a>
            </li>
            <li class="breadcrumb-item" style="display: inline; color: black;">
                <a href="<?= site_url('forum') ?>" style="color: black; text-decoration: none;">Forum List</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" style="color: rgb(177, 41, 41); display: inline;">
                Form Discussion
            </li>
        </ol>
    </nav>
    <br>

    <div class="container">
        <!-- Topic Section -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
            <div class="topic" style="font-size: 1.5em; font-weight: bold;">
                <?php echo htmlspecialchars($thread['title']); ?>
            </div>
            <a href="#" class="btn add-comment-button btn-light px-4 py-2 rounded-pill shadow-sm">Add Comment</a>
        </div>


        <!-- Info Pemilik Thread -->
        <div class="user-info" style="display: flex; align-items: center; margin-bottom: 10px;">
            <div class="user-avatar" style="background-color: #007bff; color: white; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-weight: bold; margin-right: 10px;">
                <?php echo strtoupper(substr($thread['name'], 0, 1)); // Ganti dengan nama pemilik thread 
                ?>
            </div>
            <div class="user-details">
                <strong><?php echo htmlspecialchars($thread['name']); // Ganti dengan nama pemilik thread 
                        ?></strong>
                <small style="display: block; color: #6c757d;" data-transaction-time="<?= htmlspecialchars($thread['created_at']); ?>">
                    <span id="time-ago"></span>
                </small>
            </div>
        </div>
        <br>
        <!-- Tag untuk Thread -->
        <?php if (!empty($thread['tags'])): ?>
            <div class="tags">
                <?php
                // Assuming $thread['tags'] contains something like "game,action,arcade"
                $tags = explode(',', $thread['tags']); // Split the string by commas

                // Remove empty and invalid tags
                $tags = array_filter(array_map('trim', $tags)); // Trim each tag and remove any empty ones

                // Only display tags if there are valid tags
                if (!empty($tags)) {
                    foreach ($tags as $tag) {
                        echo '<span class="tag">' . htmlspecialchars($tag) . '</span>'; // Output tag with proper escaping
                    }
                }
                ?>
            </div>
        <?php endif; ?>



        <div class="card" style="background-color: #f8f9fa; border: 1px solid #d6d8db;">
            <div class="card-body text-secondary">
                <?php echo $thread['content']; ?>
            </div>
        </div>


        <div class="add-comment-input" style="display: none; margin-top: 15px;">
            <form id="commentForm" action="<?= site_url('forum/add_comment') ?>" method="post">
                <textarea class="form-control" rows="3" name="comment" placeholder="Write your comment..." style="resize: none;"></textarea>
                <input type="hidden" name="thread_id" value="<?php echo ($thread['id']); ?>">
                <button class="btn btn-danger" type="submit" style="margin-top: 5px;">Send</button>
            </form>
        </div>

        <br>

        <?php foreach ($comments as $comment): ?>
            <!-- Card untuk Thread Utama -->
            <div class="card">
                <div class="user-info">
                    <div class="user-avatar"><?php echo strtoupper(substr($comment['name'], 0, 1)); ?></div>
                    <div class="user-details">
                        <h6> <?php echo $comment['name']; ?></h6>
                        <small style="display: block; color: #6c757d;" data-transaction-time="<?= htmlspecialchars($comment['created_at']); ?>">
                            <span id="time-ago"></span>
                        </small>
                    </div>
                </div>

                <!-- Post Content untuk Thread -->
                <div class="post-content">
                    <?php echo $comment['comment']; ?>
                </div>

                <!-- Actions Section untuk Thread -->
                <div class="actions" style="margin-top: 10px; display: flex; gap: 15px;">
                    <div>
                        <i class="fas fa-arrow-up" style="font-size: 17px; color: #28a745;" onclick="likeComment(<?= $comment['id'] ?>)"></i>&nbsp;
                        <span id="like-count-<?= $comment['id'] ?>"><?php echo $comment['likes']; ?></span>
                    </div>

                    <div>
                        <i class="fas fa-arrow-down" style="font-size: 17px; color: #dc3545;" onclick="unlikeComment(<?= $comment['id'] ?>)"></i>&nbsp;
                        <span id="unlike-count-<?= $comment['id'] ?>"><?php echo $comment['unlikes']; ?></span>
                    </div>

                    <div class="reply-button" style="cursor: pointer; color: #007bff;"><i class="fas fa-reply" style="font-size: 17px;"></i>&nbsp; Reply</div>
                </div>

                <!-- Comment Input Section untuk Thread (Initially Hidden) -->
                <div class="comment-input" style="display: none; margin-top: 15px;">
                    <form id="repliesForm" action="<?= site_url('forum/add_comment_user') ?>" method="post">
                        <textarea class="form-control" rows="3" name="reply_text" placeholder="Write your comment..." style="resize: none;"></textarea>
                        <input type="hidden" name="thread_id" value="<?php echo ($thread['id']); ?>">
                        <input type="hidden" name="comment_id" value="<?php echo ($comment['id']); ?>">
                        <button class="btn btn-primary btn-sm" style="margin-top: 5px;">Submit</button>
                    </form>
                </div>
            </div>

            <!-- Looping untuk Balasan Komentar -->
            <?php if (!empty($comment['replies'])): ?>
                <?php foreach ($comment['replies'] as $reply): ?>
                    <!-- Card untuk Balasan Komentar -->
                    <div class="card reply-card" style="margin-left: 20px; border-left: 3px solid #007bff; padding-left: 15px; margin-bottom: 15px;">
                        <div class="user-info">
                            <div class="user-avatar" style="background-color: #007bff; color: white; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                <?php echo strtoupper(substr($reply['name'], 0, 1)); ?>
                            </div>
                            <div class="user-details">
                                <h6 style="margin-bottom: 0;"><?php echo $reply['name']; ?></h6>
                                <small style="display: block; color: #6c757d;" data-transaction-time="<?= htmlspecialchars($reply['created_at']); ?>">
                                    <span id="time-ago"></span>
                                </small>
                            </div>
                        </div>

                        <!-- Menampilkan informasi "balasan ke" dengan gaya modern -->
                        <?php if (!empty($reply['parent_name'])): ?>
                            <div class="reply-to-info" style="margin-top: 5px; font-style: italic;">
                                <small style="color: #007bff;"><i class="fas fa-reply"></i> Replying to <strong><?= htmlspecialchars($reply['parent_name']) ?></strong></small>
                            </div>
                        <?php endif; ?>

                        <!-- Post Content untuk Balasan -->
                        <div class="post-content" style="margin-top: 10px;">
                            <p style="margin-bottom: 0;"><?php echo $reply['reply_text']; ?></p>
                        </div>

                        <!-- Actions Section untuk Balasan -->
                        <div class="actions" style="margin-top: 10px; display: flex; gap: 15px;">
                            <div>
                                <i class="fas fa-arrow-up" style="font-size: 17px; color: #28a745;" onclick="likeReply(<?= $reply['id'] ?>)"></i>&nbsp;
                                <span id="likes-count-<?= $reply['id'] ?>"><?php echo $reply['likes']; ?></span>
                            </div>

                            <div>
                                <i class="fas fa-arrow-down" style="font-size: 17px; color: #dc3545;" onclick="unlikeReply(<?= $reply['id'] ?>)"></i>&nbsp;
                                <span id="unlikes-count-<?= $reply['id'] ?>"><?php echo $reply['unlikes']; ?></span>
                            </div>
                            <div class="reply-button" style="cursor: pointer; color: #007bff;"><i class="fas fa-reply" style="font-size: 17px;"></i>&nbsp; Reply</div>
                        </div>

                        <!-- Comment Input Section untuk Balasan (Initially Hidden) -->
                        <div class="comment-input" style="display: none; margin-top: 15px;">
                            <form id="repliesForm" action="<?= site_url('forum/add_reply_user') ?>" method="post">
                                <textarea class="form-control" rows="3" name="reply_text" placeholder="Write your comment..." style="resize: none;"></textarea>
                                <input type="hidden" name="thread_id" value="<?php echo ($thread['id']); ?>">
                                <input type="hidden" name="comment_id" value="<?php echo ($comment['id']); ?>">
                                <input type="hidden" name="parent_id" value="<?= htmlspecialchars($reply['id']) ?>">
                                <button class="btn btn-primary btn-sm" type="submit" style="margin-top: 5px;">Submit</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        <?php endforeach; ?>

    </div>
</div>

<style>
    .actions div:last-child {
        margin-left: auto;
    }

    .container {
        width: 100%;
        margin-left: 0;
        margin-right: auto;
        padding-left: 10px;
    }

    /* Topic Section */
    .topic {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .tags {
        margin-bottom: 30px;
    }

    .tag {
        display: inline-block;
        background-color: #e0e0e0;
        color: #333;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        margin-right: 5px;
    }

    /* Card Section */
    .card {
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 20px;
        margin-left: 0;
        margin-bottom: 20px;
    }

    /* Card Reply Section */
    .reply-card {
        background-color: #f8f9fa;
        border-left: 4px solid #007bff;
        margin-left: 50px;
        /* Indented for replies */
        padding: 15px;
    }

    /* User Info Section */
    .user-info {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .user-avatar {
        width: 50px;
        height: 50px;
        background-color: #007bff;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        font-size: 18px;
        font-weight: bold;
    }

    .user-details {
        margin-left: 15px;
    }

    .user-details h6 {
        margin: 0;
        font-weight: 600;
    }

    .user-details small {
        color: #777;
    }

    .post-date {
        margin-left: auto;
        color: #777;
        font-size: 12px;
        display: flex;
        align-items: center;
    }

    /* Post Content */
    .post-content {
        color: #555;
        line-height: 1.6;
        font-size: 15px;
        margin-bottom: 20px;
    }

    /* Icons Section */
    .actions {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        color: #888;
        font-size: 14px;
    }

    .actions div {
        margin-right: 20px;
        display: flex;
        align-items: center;
    }

    .actions div i {
        margin-right: 5px;
    }

    .actions div:hover {
        color: #007bff;
        cursor: pointer;
    }

    .comment-input textarea {
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        padding: 10px;
        font-size: 14px;
        width: 100%;
        transition: border-color 0.2s;
    }

    .comment-input textarea:focus {
        border-color: #80bdff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: background-color 0.2s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<script>
    // JavaScript untuk memperbarui waktu secara dinamis
    function updateTimeAgo() {
        const timeAgoElements = document.querySelectorAll('[data-transaction-time]');

        timeAgoElements.forEach(function(element) {
            const transactionTime = element.getAttribute('data-transaction-time');
            const transactionDate = new Date(transactionTime); // Mengonversi waktu dari backend ke tanggal JS
            const currentDate = new Date(); // Waktu saat ini
            const interval = Math.floor((currentDate - transactionDate) / 1000); // Menghitung selisih dalam detik

            let timeAgo = '';

            if (interval >= 31536000) { // 1 tahun
                timeAgo = Math.floor(interval / 31536000) + ' year' + (Math.floor(interval / 31536000) > 1 ? 's' : '') + ' ago';
            } else if (interval >= 2592000) { // 1 bulan
                timeAgo = Math.floor(interval / 2592000) + ' month' + (Math.floor(interval / 2592000) > 1 ? 's' : '') + ' ago';
            } else if (interval >= 86400) { // 1 hari
                timeAgo = Math.floor(interval / 86400) + ' day' + (Math.floor(interval / 86400) > 1 ? 's' : '') + ' ago';
            } else if (interval >= 3600) { // 1 jam
                timeAgo = Math.floor(interval / 3600) + ' hour' + (Math.floor(interval / 3600) > 1 ? 's' : '') + ' ago';
            } else if (interval >= 60) { // 1 menit
                timeAgo = Math.floor(interval / 60) + ' min' + (Math.floor(interval / 60) > 1 ? 's' : '') + ' ago';
            } else {
                timeAgo = 'Just now';
            }

            // Memperbarui teks yang ditampilkan
            element.querySelector('#time-ago').textContent = timeAgo;
        });
    }

    // Panggilan awal untuk mengatur waktu yang lalu saat halaman dimuat
    updateTimeAgo();

    // Memperbarui waktu setiap menit
    setInterval(updateTimeAgo, 60000); // Segarkan setiap 60 detik
</script>


<script>
    document.querySelectorAll('.reply-button').forEach(button => {
        button.addEventListener('click', function() {
            const commentInput = this.closest('.card').querySelector('.comment-input');
            commentInput.style.display = commentInput.style.display === 'none' ? 'block' : 'none';
        });
    });

    // Add event listener for textarea to handle Enter key for new lines
    document.querySelectorAll('.comment-input textarea').forEach(textarea => {
        textarea.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault(); // Prevent default behavior of Enter key for submission
                this.value += '\n'; // Add a new line
            }
        });
    });
</script>


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

<!-- JavaScript -->
<script>
    // Event listener untuk tombol Add Comment
    document.querySelector('.add-comment-button').addEventListener('click', function(e) {
        e.preventDefault(); // Mencegah aksi default link
        const commentInput = document.querySelector('.add-comment-input');

        // Toggle tampilkan/sembunyikan form textarea
        if (commentInput.style.display === 'none') {
            commentInput.style.display = 'block';

            // Scroll dengan offset
            const yOffset = -100; // Adjust the offset value as needed
            const y = commentInput.getBoundingClientRect().top + window.pageYOffset + yOffset;

            window.scrollTo({
                top: y,
                behavior: 'smooth'
            });

            // Fokuskan pada textarea setelah scroll
            setTimeout(() => {
                commentInput.querySelector('textarea').focus();
            }, 300);
        } else {
            commentInput.style.display = 'none';
        }
    });

    // Add event listener untuk textarea agar Enter menambah baris baru
    document.querySelector('.add-comment-input textarea').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault(); // Prevent default behavior of Enter key for form submission
            this.value += '\n'; // Add new line to the textarea
        }
    });
</script>

<script>
    function likeComment(id) {
        $.ajax({
            url: '<?= site_url('forum/likeComment') ?>',
            type: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#like-count-' + id).text(data.likes);

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
            url: '<?= site_url('forum/unlikeComment') ?>',
            type: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#unlike-count-' + id).text(data.unlikes);

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
            url: '<?= site_url('forum/likeReply') ?>',
            type: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#likes-count-' + id).text(data.likes);

                // Show success message using SweetAlert
                Swal.fire({
                    title: 'Success',
                    text: 'You liked this reply.',
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
            url: '<?= site_url('forum/unlikeReply') ?>',
            type: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#unlikes-count-' + id).text(data.unlikes);

                // Show success message using SweetAlert
                Swal.fire({
                    title: 'Success',
                    text: 'You unliked this reply.',
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