<br><br><br><br>
<div class="container">
    <!-- Left side content with gray background and centered text -->
    <div class="left">
        <div class="vertical-bar"></div>
        <div class="content">
            <h6 class="mb-5">
                <a href="<?= site_url('forum') ?>" style="font-size: 14px; color: gray;">All /</a>
                <span style="color: black; font-weight: bold; font-size: 14px;"><?php echo htmlspecialchars($thread['category_name']); ?></span>
            </h6>
            <h4><?php echo htmlspecialchars($thread['title']); ?></h4>
            <p class="mt-5" style="font-size: 14px;"><?php echo htmlspecialchars($thread['content']); ?></p>

            <!-- New Comment Button -->
            <?php
            // Check if the user is logged in
            if ($this->session->userdata('id')):
                // Check if the user is authorized to comment
                if ($is_authorized): ?>
                    <button class="new-comment-btn mt-5" id="toggleCommentInput">Add Response</button>
                <?php else: ?>
                    <p class="mt-5">
                        <a class="new-comment-btn mt-5">You are not authorized to comment on this thread.</a>
                    </p>
                <?php endif;
            else: ?>
                <br><br>
                <a href="<?= site_url('login') ?>" class="new-comment-btn mt-5">Add Response</a>
            <?php endif; ?>


        </div>
    </div>

    <!-- Right side content -->
    <div class="right">
        <br><br><br><br>
        <?php if (!empty($comments)): ?> <!-- Cek apakah ada komentar -->
            <?php foreach ($comments as $comment): ?>
                <div class="comment ml-5 mt-5">
                    <div class="user-info">
                        <img src="<?= base_url('assets/images/user.png') ?>" alt="User Image">
                        <div>
                            <span style="font-size: 14px;"><?php echo $comment['username']; ?></span><br>
                            <span class="user-title" style="font-size: 12px;"><?php echo $comment['job_title']; ?></span>
                        </div>
                    </div>
                    <p style="font-size: 14px;">
                        <?php echo $comment['comment']; ?>
                    </p>
                    <div class="like">
                        <i style="color: black;" class="fa-regular fa-thumbs-up mr-2" onclick="likeComment(<?= $comment['id'] ?>)"></i>
                        <span style="color: black;" id="like-count-<?= $comment['id'] ?>"><?php echo $comment['likes']; ?> Likes</span>
                    </div>

                    <div class="comment">
                        <div class="add-comment-input" style="display: none; margin-top: 25px;">
                            <form id="replyCommentInputForm-<?= $thread['id'] ?>" action="<?= site_url('forum/add_comment') ?>" method="post">
                                <div class="textarea-wrapper" style="position: relative;">
                                    <textarea class="form-control" rows="3" name="comment" placeholder="Write your comment..." style="resize: none; padding-right: 40px;"></textarea>
                                    <input type="hidden" name="thread_id" value="<?php echo ($thread['id']); ?>">
                                    <button type="submit" class="send-icon" aria-label="Send Comment">
                                        <i class="fa-solid fa-paper-plane"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?> <!-- Kondisi jika tidak ada komentar -->
            <br><br><br><br><br>
            <div class="text-center mt-5">
                <img src="<?= base_url('assets/images/no-comments.png') ?>" alt="No Comments" style="width: 100px; height: auto;">
            </div>
            <p class="text-center"><small>There are no discussions here yet. Share your thoughts to start a conversation!</small></p>
        <?php endif; ?>

        <!-- More comments -->
        <br>
        <div class="add-comment-input" id="commentInput" style="display: none; margin-top: 25px;">
            <form id="commentForm" action="<?= site_url('forum/add_comment') ?>" method="post">
                <div class="textarea-wrapper" style="position: relative;">
                    <textarea class="form-control" rows="3" name="comment" placeholder="Write your comment..." style="resize: none; padding-right: 40px;"></textarea>
                    <input type="hidden" name="thread_id" value="<?php echo ($thread['id']); ?>">
                    <input type="hidden" name="user_id" value="<?= $this->session->userdata('id'); ?>">
                    <button type="submit" class="send-icon" aria-label="Send Comment">
                        <i class="fa-solid fa-paper-plane"></i> <!-- Font Awesome paper plane icon -->
                    </button>
                </div>
            </form>
        </div>
        <br><br><br>
    </div>
</div>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f3f6f9;
        margin: 0;
        /* Ensure no margin on body */
        padding: 0;
        /* Ensure no padding on body */
        height: 100vh;
        /* Use full viewport height */
        overflow: hidden;
        /* Hide overflow */
    }

    .container {
        display: flex;
        max-width: 100%;
        margin: 0;
        /* Remove margin */
        padding: 0;
        /* Remove padding */
        height: 100%;
        /* Ensure it takes full height */
        justify-content: flex-start;
        /* Align items to the left */
        position: absolute;
        /* Use absolute positioning */
        top: 0;
        /* Align to the top of the viewport */
        left: 0;
        /* Align to the left of the viewport */
        align-items: stretch;
        /* Stretch items to the full height */
    }

    .textarea-wrapper {
        position: relative;
    }

    .send-icon {
        position: absolute;
        right: 10px;
        /* Adjust based on padding */
        top: 50%;
        transform: translateY(-50%);
        /* Center vertically */
        border: none;
        /* No border */
        background: transparent;
        /* Transparent background */
        cursor: pointer;
        /* Pointer cursor on hover */
        color: #007bff;
        /* Icon color */
        font-size: 20px;
        /* Icon size */
        z-index: 1;
        /* Ensure it's above other elements */
    }

    .form-control {
        padding-right: 40px;
        /* Adjust to give space for the icon */
    }

    .send-icon:hover {
        color: #0056b3;
        /* Darker shade on hover */
    }

    .left {
        flex: 1;
        /* Flex-grow */
        background-color: #f0f0f0;
        display: flex;
        align-items: center;
        /* Center content vertically */
        padding: 0;
        /* Remove padding */
        max-width: 35%;
        /* Control width */
        height: 100%;
        /* Ensure full height */
    }

    .new-comment-btn {
        background-color: #fff6eb;
        /* Light beige color matching the background in the image */
        color: #4a4a4a;
        /* Darker text color */
        border: 1px solid #e2c396;
        /* Light border to match the subtle outline */
        border-radius: 25px;
        /* Rounded corners */
        padding: 10px 20px;
        /* Same padding */
        font-size: 14px;
        /* Font size */
        cursor: pointer;
        /* Pointer cursor on hover */
        transition: background-color 0.3s ease, color 0.3s ease;
        /* Smooth transition for hover */
        outline: none;
        /* Remove default focus outline */
    }

    .new-comment-btn:hover {
        background-color: #fbe4b7;
        /* Slightly darker beige on hover */
        color: #333333;
        /* Darker text on hover */
    }




    .vertical-bar {
        width: 30px;
        background: linear-gradient(to bottom, #A6A6A6, #F2F2F2);
        /* Gradient from maroon to a lighter shade */
        height: 100%;
        /* Ensure full height */
        position: absolute;
        left: 0;
        /* Align to the left */
        top: 0;
        /* Align to the top */
    }

    .content {
        margin-left: 20px;
        /* Space from the vertical bar */
        text-align: center;
        /* Center text */
        padding: 20px;
        /* Adjust padding as needed */
    }

    .right {
        flex: 2;
        /* Flex-grow */
        padding: 0 30px;
        /* Adjust padding */
        background-color: #fff;
        /* Background color */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        /* Box shadow */
        overflow-y: auto;
        /* Enable scrolling if necessary */
        max-height: 100vh;
        /* Full viewport height */
        max-width: 65%;
        /* Control width */
    }

    .comment {
        margin-bottom: 20px;
        /* Space between comments */
    }

    .user-info {
        display: flex;
        /* Flexbox for user info */
        align-items: center;
        /* Center user info vertically */
        margin-bottom: 10px;
        /* Space below user info */
    }

    .user-info img {
        border-radius: 50%;
        /* Circular image */
        width: 40px;
        /* Image width */
        height: 40px;
        /* Image height */
        margin-right: 10px;
        /* Space between image and text */
    }

    .user-info span {
        font-weight: bold;
        /* Bold text */
        font-size: 16px;
        /* Font size */
    }

    .user-title {
        color: #777;
        /* Grey color */
        font-size: 14px;
        /* Font size */
    }

    .like {
        font-size: 14px;
        /* Font size */
        color: #0073b1;
        /* Like color */
        display: flex;
        /* Flexbox for like */
        align-items: center;
        /* Center like vertically */
        margin-top: 10px;
        /* Space above like */
    }


    .like img {
        margin-right: 5px;
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
    // Fungsionalitas untuk tombol Toggle
    document.getElementById('toggleCommentInput').addEventListener('click', function() {
        const commentInput = document.getElementById('commentInput');

        // Toggle tampilan input komentar
        if (commentInput.style.display === 'none' || commentInput.style.display === '') {
            commentInput.style.display = 'block'; // Tampilkan input

            // Smoothly scroll to the comment input form
            commentInput.scrollIntoView({
                behavior: 'smooth'
            });
        } else {
            commentInput.style.display = 'none'; // Sembunyikan input
        }
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

                // Update the like count in the span element
                $('#like-count-' + id).text(data.likes + ' Likes');

                // Display success message using SweetAlert
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
            },
            error: function(xhr, status, error) {
                console.error('Error liking the comment: ', error);
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