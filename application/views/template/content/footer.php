<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.19/jquery.touchSwipe.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            timeZone: 'Asia/Jakarta',
            nowIndicator: true,
            events: function(fetchInfo, successCallback, failureCallback) {
                fetch('<?= base_url("events/getEvents") ?>')
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // Log the data to check the structure
                        data.forEach(event => {
                            event.backgroundColor = event.color;
                        });
                        successCallback(data);
                    })
                    .catch(error => failureCallback(error));
            },
            eventClick: function(info) {
                // Update the Upcoming Event section
                const upcomingEventSection = document.querySelector('.upcoming-event-section');
                const startDate = new Date(info.event.start);
                const formattedStartDate = startDate.toLocaleDateString('en-US', {
                    month: 'long',
                    day: 'numeric',
                    year: 'numeric'
                });

                // Construct the image URL
                const imageUrl = `<?= base_url('uploads/event/') ?>${info.event.extendedProps.image || 'default-event.png'}`;

                upcomingEventSection.innerHTML = `
                <div class="event-card mb-4 p-3" style="border-radius: 10px; background-color: #f9f9f9; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <div class="text-center">
                        <img src="${imageUrl}" alt="${info.event.title}" style="width: 100%; height: auto; border-radius: 10px 10px 0 0;">
                    </div>
                    <div style="padding: 10px;">
                        <h6 style="font-weight: bold; color: #800000;">
                          ${info.event.title}
                        </h6>
                        <hr>
                        <p style="font-size: 14px; color: #777; margin-bottom: 5px;">
                            <i class="fa fa-calendar-day"></i>&nbsp; ${formattedStartDate}
                        </p>
                        <p style="font-size: 14px; color: #555; margin-top: -5px;">
                            <i class="fa fa-map-marker-alt"></i>&nbsp; ${info.event.extendedProps.location || 'Location not available'}
                        </p>
                    </div>
                </div>
            `;
            }
        });

        calendar.render();
    });
</script> -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            timeZone: 'Asia/Jakarta',
            nowIndicator: true,
            events: function(fetchInfo, successCallback, failureCallback) {
                fetch('<?= base_url("events/getEvents") ?>')
                    .then(response => response.json())
                    .then(data => {
                        console.log("Events loaded:", data); // Debugging

                        data.forEach(event => {
                            event.backgroundColor = event.color;
                        });

                        successCallback(data);
                    })
                    .catch(error => failureCallback(error));
            },
            eventClick: function(info) {
                const today = new Date().toISOString().split('T')[0]; // Format YYYY-MM-DD
                const eventDate = new Date(info.event.start).toISOString().split('T')[0]; // Pastikan format sama

                // Tentukan tempat event masuk (Upcoming atau Past)
                const eventSection = eventDate < today ?
                    document.querySelector('.past-event-section') :
                    document.querySelector('.upcoming-event-section');

                // Kosongkan jika pertama kali event diklik
                eventSection.innerHTML = '';

                // Construct the image URL
                const imageUrl = `<?= base_url('uploads/event/') ?>${info.event.extendedProps.image || 'default-event.png'}`;

                // Tambahkan event ke card yang sesuai
                eventSection.innerHTML = `
            <div class="event-card mb-4 p-3" style="border-radius: 10px; background-color: #f9f9f9; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                <div class="text-center">
                    <img src="${imageUrl}" alt="${info.event.title}" style="width: 100%; height: auto; border-radius: 10px 10px 0 0;">
                </div>
                <div style="padding: 10px;">
                    <h6 style="font-weight: bold; color: #800000;">
                      ${info.event.title}
                    </h6>
                    <hr>
                    <p style="font-size: 14px; color: #777; margin-bottom: 5px;">
                        <i class="fa fa-calendar-day"></i>&nbsp; ${eventDate}
                    </p>
                    <p style="font-size: 14px; color: #555; margin-top: -5px;">
                        <i class="fa fa-map-marker-alt"></i>&nbsp; ${info.event.extendedProps.location || 'Location not available'}
                    </p>
                </div>
            </div>
        `;
            }
        });

        calendar.render();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scrollDown = document.getElementById('scroll-down');
        const page1 = document.getElementById('page-1');

        // Hide scroll-down initially
        scrollDown.style.display = 'none';

        // Show scroll-down when mouse enters page-1
        page1.addEventListener('mouseenter', function() {
            scrollDown.style.display = 'block';
        });

        // Hide scroll-down when mouse leaves page-1
        page1.addEventListener('mouseleave', function() {
            scrollDown.style.display = 'none';
        });

        // Handle click event for scroll-down
        scrollDown.addEventListener('click', function() {
            document.getElementById('page-2').scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#carouselExampleControls").swipe({
            swipe: function(event, direction) {
                if (direction === 'left') {
                    $(this).carousel('next');
                } else if (direction === 'right') {
                    $(this).carousel('prev');
                }
            },
            allowPageScroll: "vertical"
        });
    });
</script>

<!-- Cek apakah ada flashdata untuk pesan sukses atau error -->
<?php if ($this->session->flashdata('message')): ?>
    <script>
        Swal.fire({
            title: 'Success',
            text: '<?php echo $this->session->flashdata('message'); ?>',
            toast: true,
            position: 'top-end',
            timer: 2000,
            showConfirmButton: false,
            background: '#f8f9fa', // Warna latar belakang terang
            customClass: {
                container: 'swal2-container',
                title: 'swal2-title',
                popup: 'swal2-popup'
            }
        });
    </script>
<?php elseif ($this->session->flashdata('error')): ?>
    <script>
        Swal.fire({
            title: 'Error',
            text: '<?php echo $this->session->flashdata('error'); ?>',
            toast: true,
            position: 'top-end',
            timer: 2000,
            showConfirmButton: false,
            background: '#f8f9fa', // Warna latar belakang terang
            customClass: {
                container: 'swal2-container',
                title: 'swal2-title',
                popup: 'swal2-popup'
            }
        });
    </script>
<?php endif; ?>

</body>

</html>