<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.19/jquery.touchSwipe.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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