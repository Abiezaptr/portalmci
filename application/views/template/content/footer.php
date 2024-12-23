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
            initialView: 'dayGridMonth', // Tampilan default bulan
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            timeZone: 'Asia/Jakarta', // Zona waktu
            nowIndicator: true, // Garis waktu saat ini
            events: function(fetchInfo, successCallback, failureCallback) {
                // Ambil data dari server
                fetch('<?= base_url("events/getEvents") ?>')
                    .then(response => response.json())
                    .then(data => {
                        // Update data event dengan warna dari database
                        data.forEach(event => {
                            event.backgroundColor = event.color; // Menambahkan warna dari field 'color' di database
                        });
                        successCallback(data);
                    })
                    .catch(error => failureCallback(error));
            },
            eventClick: function(info) {
                // SweetAlert2 untuk menampilkan detail event
                const startDate = new Date(info.event.start);
                const formattedStartDate = startDate.toLocaleDateString('en-US', {
                    month: 'long',
                    day: 'numeric',
                    year: 'numeric'
                });

                Swal.fire({
                    title: info.event.title, // Judul event
                    html: `
                    <hr style="border: 0; border-top: 1px dashed #ccc; margin: 10px 0;">
                    <div style="font-size: 16px; color: #333; line-height: 1.6;">
                        <div style="background-color: #f8f9fa; border: 1px solid #ddd; border-radius: 5px; padding: 15px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                            <p style="margin-bottom: 10px;">
                                ${info.event.extendedProps.description || 'No description available.'}
                            </p>
                            <p style="font-size: 14px; color: #007bff; font-weight: bold;">
                                 ${info.event.extendedProps.location || 'Location not available'}
                            </p>
                            <hr style="border: 0; border-top: 1px dashed #ccc; margin: 10px 0;">
                            <p style="font-size: 14px; color: #555; margin-top: 10px;">${formattedStartDate}</p>
                        </div>
                    </div>
                `,
                    icon: 'info',
                    confirmButtonText: 'Close',
                });
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
</script>

<script>
    // Removed JavaScript that toggles the 'red' class
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