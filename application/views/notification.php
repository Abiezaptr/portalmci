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
            date_default_timezone_set('Asia/Jakarta');
            foreach ($notifications as $notification):
                $formatted_date = date('d F Y, H:i', strtotime($notification['timestamp'])) . ' WIB';

                // Tentukan apakah notifikasi sudah dibaca
                $is_read = isset($notification['is_read']) && $notification['is_read'] == 1 ? 'disabled-card' : '';
                $background_color = isset($notification['is_read']) && $notification['is_read'] == 1 ? '#f0f0f0' : '#ffffff';
                $cursor_style = isset($notification['is_read']) && $notification['is_read'] == 1 ? 'not-allowed' : 'pointer';

                // Warna ikon lingkaran
                $icon_color = isset($notification['is_read']) && $notification['is_read'] == 1 ? '#0056b3' : '#e7edf0';

                // Tambahkan animasi jika belum dibaca
                $icon_animation = isset($notification['is_read']) && $notification['is_read'] == 0 ? 'pulse' : '';
            ?>
                <div
                    class="card notification-card <?= $is_read ?>"
                    data-id="<?= $notification['id'] ?>"
                    data-type="<?= $notification['type'] ?>"
                    style="border: 1px solid #e0e0e0; border-radius: 8px; margin-bottom: 15px; padding: 15px; background-color: <?= $background_color; ?>; position: relative; cursor: <?= $cursor_style; ?>;">

                    <!-- Ikon lingkaran dengan animasi jika belum dibaca -->
                    <i class="fas fa-circle notification-icons <?= $icon_animation ?>"
                        style="position: absolute; top: 10px; right: 10px; color: <?= $icon_color; ?>;"></i>

                    <div class="card-title" style="font-weight: bold; color: #333;"><?php echo $notification['title']; ?></div>
                    <div class="card-text" style="color: #666;"><?php echo $notification['message']; ?></div>
                    <div class="card-date" style="font-size: 0.9em; color: #999;"><?php echo $formatted_date; ?></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center mt-5">
                <img src="<?= base_url('assets/images/bell.png') ?>" alt="No Notifications" style="width: 150px; height: auto;">
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

    .notification-icons {
        font-size: 1.0em;
        /* Adjust icon size as needed */
    }

    /* Efek Berdenyut (Pulse) */
    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.2);
        }

        100% {
            transform: scale(1);
        }
    }

    .pulse {
        animation: pulse 1s infinite ease-in-out;
    }

    /* Efek Bergetar (Shake) */
    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-2px);
        }

        50% {
            transform: translateX(2px);
        }

        75% {
            transform: translateX(-2px);
        }
    }

    .shake {
        animation: shake 0.5s infinite;
    }
</style>

<script>
    $(document).ready(function() {
        // Default Toastr Configuration
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        };

        $('.notification-card').on('click', function() {
            if ($(this).hasClass('disabled-card')) {
                // Display Toastr if the notification has already been read
                toastr.warning('You have already viewed this notification.', 'Notification Read');
                return; // Prevent further actions
            }

            var notificationId = $(this).data('id');
            var notificationType = $(this).data('type');
            var cardElement = $(this);

            $.ajax({
                url: '<?= base_url("notification/update_notification_status"); ?>',
                type: 'POST',
                data: {
                    id: notificationId,
                    type: notificationType
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status === 'success') {
                        // Mark the notification as read
                        cardElement.addClass('disabled-card');
                        cardElement.css('background-color', '#f0f0f0');
                        cardElement.css('cursor', 'not-allowed');

                        // Show success Toastr notification
                        toastr.success('Notification successfully marked as read.', 'Success!');
                    } else {
                        // Show error Toastr if update fails
                        toastr.error('Failed to update notification status. Please try again later.', 'Update Failed!');
                    }
                },
                error: function() {
                    // Show error Toastr if AJAX fails
                    toastr.error('An error occurred while connecting to the server.', 'Server Error!');
                }
            });
        });
    });
</script>