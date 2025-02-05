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

 <script>
     var searchField = document.getElementById('search-field');
     var searchInput = document.getElementById('search-input');
     var searchReport = document.getElementById('search-report');
     var searchResultHr = document.getElementById('search-result-hr');
     var searchResultTitle = document.getElementById('search-result-title');
     var searchButton = document.getElementById('search-button');
     var searchResultsContainer = document.getElementById('search-results'); // Tambahkan elemen untuk hasil

     // Tampilkan form pencarian langsung tanpa ikon
     searchField.style.display = 'block';

     function handleSearch() {
         var query = searchInput.value.trim();
         if (query === '') {
             Swal.fire({
                 icon: 'warning',
                 title: 'Input Required',
                 text: 'Please enter a keyword or name to search for reports.',
                 confirmButtonText: 'OK'
             });
             return;
         }

         var baseUrl = '<?= site_url('home/search') ?>';

         var xhr = new XMLHttpRequest();
         xhr.open('POST', baseUrl, true);
         xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
         xhr.onreadystatechange = function() {
             if (xhr.readyState === 4 && xhr.status === 200) {
                 var results = JSON.parse(xhr.responseText);
                 var html = '';
                 var indicatorsHtml = '';

                 if (results.length > 0) {
                     searchResultHr.style.display = 'block';
                     searchReport.style.display = 'block';
                     searchResultTitle.style.display = 'block'; // Tampilkan judul hasil pencarian

                     var chunks = [];
                     for (var i = 0; i < results.length; i += 4) {
                         chunks.push(results.slice(i, i + 4));
                     }

                     chunks.forEach(function(chunk, index) {
                         html += '<div class="carousel-item ' + (index === 0 ? 'active' : '') + '">';
                         html += '<div class="row">';
                         chunk.forEach(function(report) {
                             html += '<div class="col-md-3">';
                             html += '    <a href="' + (report.type === 'article' ?
                                 '<?= site_url('view-article/') ?>' + encodeURIComponent(report.title.replace(/ /g, '-')) :
                                 '<?= site_url('view-report/') ?>' + encodeURIComponent(report.title.replace(/ /g, '-'))) + '">';
                             html += '        <div class="card" style="width: 100%; max-width: 250px; overflow: hidden; margin: 0 auto;">';
                             html += '            <div class="skeleton">';
                             html += '                <img src="<?= base_url('uploads/image/') ?>' + report.image + '" class="card-img-top" alt="">';
                             html += '                <div class="card-body">';
                             html += '                    <p class="card-text text-dark"><small>' + report.title + '</small></p>';
                             html += '                </div>';
                             html += '            </div>';
                             html += '        </div>';
                             html += '    </a>';
                             html += '</div>';
                         });
                         html += '</div>';
                         html += '</div>';
                     });

                     chunks.forEach(function(_, index) {
                         indicatorsHtml += '<li data-target="#searchCarousel" data-slide-to="' + index + '" class="' + (index === 0 ? 'active' : '') + '"></li>';
                     });

                     searchReport.querySelector('.carousel-inner').innerHTML = html;
                     searchReport.querySelector('.carousel-indicators').innerHTML = indicatorsHtml;

                     // Scroll ke hasil pencarian setelah data ditampilkan
                     setTimeout(function() {
                         searchResultHr.scrollIntoView({
                             behavior: 'smooth',
                             block: 'start'
                         });
                     }, 500);

                 } else {
                     searchResultHr.style.display = 'none';
                     searchReport.style.display = 'none';
                     searchResultTitle.style.display = 'none'; // Sembunyikan jika tidak ada hasil

                     Swal.fire({
                         icon: 'warning',
                         title: 'No Results Found',
                         text: 'Sorry, no reports match your search criteria.',
                         confirmButtonText: 'OK'
                     });
                 }
             }
         };
         xhr.send('query=' + encodeURIComponent(query));
     }


     searchInput.addEventListener('keypress', function(event) {
         if (event.key === 'Enter') {
             event.preventDefault();
             handleSearch();
         }
     });

     searchButton.addEventListener('click', function() {
         handleSearch();
     });

     searchInput.addEventListener('input', function() {
         if (searchInput.value.trim() === '') {
             searchResultHr.style.display = 'none';
             searchReport.style.display = 'none';
         }
     });
 </script>

 </body>

 </html>