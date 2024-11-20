 <!-- Footer -->
 <footer class="footer">
     <div class="container">
         <div class="text-left mt-5 d-flex justify-content-between">
             <p>&copy; 2024 MCI Online Repository.</p>
             <span>Advance Analytics and Growth Marketing</span>
         </div>
     </div>
 </footer>


 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.19/jquery.touchSwipe.min.js"></script>

 <script>
     window.addEventListener('scroll', function() {
         const navbar = document.querySelector('.navbar');
         if (window.scrollY > 0) {
             navbar.classList.add('red');
         } else {
             navbar.classList.remove('red');
         }
     });

     document.getElementById('mobileMenu').addEventListener('mouseover', function() {
         const navbar = document.querySelector('.navbar');
         navbar.classList.add('red');
     });

     document.getElementById('fixedMenu').addEventListener('mouseover', function() {
         const navbar = document.querySelector('.navbar');
         navbar.classList.add('red');
     });

     document.querySelector('.navbar-nav').addEventListener('mouseleave', function() {
         const page1 = document.getElementById('page-1');
         const page1Rect = page1.getBoundingClientRect();
         // Hanya menghapus kelas 'red' jika mouse leave terjadi di area page-1
         if (page1Rect.top <= 0 && page1Rect.bottom >= 0) {
             const navbar = document.querySelector('.navbar');
             navbar.classList.remove('red');
         }
     });

     function adjustDropdownMargin() {
         const dropdownMenu = document.querySelector('.navbar-nav .dropdown-menu');
         const screenWidth = window.innerWidth;

         if (screenWidth > 1200) {
             dropdownMenu.style.marginLeft = '-65px';
         } else if (screenWidth > 992) {
             dropdownMenu.style.marginLeft = '-50px';
         } else if (screenWidth > 768) {
             dropdownMenu.style.marginLeft = '-40px';
         } else if (screenWidth > 576) {
             dropdownMenu.style.marginLeft = '-30px';
         } else {
             dropdownMenu.style.marginLeft = '-20px';
         }
     }

     window.addEventListener('resize', adjustDropdownMargin);
     window.addEventListener('load', adjustDropdownMargin);
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

 <script>
     document.getElementById('mobileMenu').addEventListener('click', function(event) {
         // Prevent dropdown from opening
         event.preventDefault();
         // Redirect to the link
         window.location.href = this.href;
     });

     document.getElementById('fixedMenu').addEventListener('click', function(event) {
         // Prevent dropdown from opening
         event.preventDefault();
         // Redirect to the link
         window.location.href = this.href;
     });
 </script>

 <script>
     document.getElementById('scroll-to-events').addEventListener('click', function() {
         document.getElementById('events-section').scrollIntoView({
             behavior: 'smooth' // untuk scroll halus
         });
     });
 </script>

 </body>

 </html>