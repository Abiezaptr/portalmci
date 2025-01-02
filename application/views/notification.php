<!-- New section for "Our latest news" -->
<div class="page-content mb-1">
    <br><br><br>
    <?php if (count($notifications) > 0): ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="list-style: none; padding: 0; margin: 0;">
                <li class="breadcrumb-item" style="display: inline; color: black;">
                    <a href="<?= site_url('home') ?>" style="color: black; text-decoration: none;">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" style="color: rgb(177, 41, 41); display: inline;">
                    Notifikasi
                </li>
            </ol>
        </nav>
    <?php endif; ?>

    <!-- Notification Cards -->
    <div class="card-container" style="display: flex; flex-direction: column; align-items: stretch; margin-top: 20px;">
        <?php if (count($notifications) > 0): ?>
            <?php
            date_default_timezone_set('Asia/Jakarta'); // Set the timezone to Asia/Jakarta
            foreach ($notifications as $notification):
                // Format the timestamp
                $formatted_date = date('d F Y, H:i', strtotime($notification['timestamp'])) . ' WIB';
            ?>
                <div class="card" style="border: 1px solid #e0e0e0; border-radius: 8px; margin-bottom: 15px; padding: 15px; background-color: #ffffff; box-shadow: none; position: relative;">
                    <i class="fas fa-circle notification-icon" style="position: absolute; top: 10px; right: 10px; color:#e7edf0;"></i>
                    <div class="card-title" style="font-weight: bold; color: #333;"><?php echo $notification['title']; ?></div>
                    <div class="card-text" style="color: #666;"><?php echo $notification['message']; ?></div>
                    <div class="card-date" style="font-size: 0.9em; color: #999;"><?php echo $formatted_date; ?></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center mt-5">
                <img src="<?= base_url('assets/images/bell.png') ?>" alt="No Videos" style="width: 150px; height: auto;">
            </div>
            <p class="text-center mt-4">Sorry, your notifications are not yet available.</p>
        <?php endif; ?>

    </div>
</div>

<style>
    body {
        background-color: #e7edf0;
        /* Light gray background for the entire page */
    }

    .notification-icon {
        font-size: 1.0em;
        /* Adjust icon size as needed */
    }
</style>