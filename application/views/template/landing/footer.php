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

 <!-- <script>
     var searchIcon = document.getElementById('search-icon');
     var searchField = document.getElementById('search-field');
     var searchInput = document.getElementById('search-input');
     var searchReport = document.getElementById('search-report');
     var searchResultHr = document.getElementById('search-result-hr');
     var searchResultTitle = document.getElementById('search-result-title');

     searchIcon.addEventListener('click', function(event) {
         event.preventDefault(); // Mencegah aksi default tombol            

         if (searchField.style.display === 'none' || searchField.style.display === '') {
             searchField.style.display = 'block'; // Tampilkan field pencarian              
             searchIcon.style.display = 'none'; // Sembunyikan ikon pencarian            
         } else {
             searchField.style.display = 'none'; // Sembunyikan field pencarian              
             searchIcon.style.display = 'block'; // Tampilkan kembali ikon pencarian            
         }
     });

     // Event listener untuk klik di luar field pencarian            
     document.addEventListener('click', function(event) {
         // Cek apakah klik terjadi di luar ikon pencarian dan field pencarian            
         if (!searchIcon.contains(event.target) && !searchField.contains(event.target)) {
             searchField.style.display = 'none'; // Sembunyikan field pencarian            
             searchIcon.style.display = 'block'; // Tampilkan kembali ikon pencarian            
         }
     });

     // Event listener untuk menangani pencarian saat menekan Enter          
     searchInput.addEventListener('keypress', function(event) {
         if (event.key === 'Enter') {
             event.preventDefault(); // Mencegah aksi default Enter          

             var query = searchInput.value; // Ambil query dari input      
             var baseUrl = '<?= site_url('home/search') ?>'; // URL untuk controller search      

             // AJAX call untuk pencarian          
             var xhr = new XMLHttpRequest();
             xhr.open('POST', baseUrl, true);
             xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
             xhr.onreadystatechange = function() {
                 if (xhr.readyState === 4 && xhr.status === 200) {
                     // Tampilkan hasil pencarian          
                     var results = JSON.parse(xhr.responseText); // Asumsikan respons adalah JSON          
                     var html = '';
                     var indicatorsHtml = '';

                     // Reset tampilan hasil pencarian      
                     searchResultHr.style.display = 'block';
                     searchResultTitle.style.display = 'block';
                     searchReport.style.display = 'block';

                     if (results.length > 0) {
                         // Mengelompokkan hasil ke dalam carousel      
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
                             html += '</div>'; // Close row      
                             html += '</div>'; // Close carousel-item      
                         });

                         // Membuat indikator carousel      
                         chunks.forEach(function(_, index) {
                             indicatorsHtml += '<li data-target="#searchCarousel" data-slide-to="' + index + '" class="' + (index === 0 ? 'active' : '') + '"></li>';
                         });

                     } else {
                         // Jika tidak ada hasil, sembunyikan elemen dan tampilkan SweetAlert2  
                         searchResultHr.style.display = 'none'; // Sembunyikan elemen  
                         searchReport.style.display = 'none'; // Sembunyikan elemen  
                         Swal.fire({
                             icon: 'warning',
                             title: 'No Results Found',
                             text: 'Sorry, no results match your search.',
                             confirmButtonText: 'OK'
                         });
                         return; // Keluar dari fungsi jika tidak ada hasil  
                     }

                     // Menyisipkan hasil ke dalam carousel      
                     searchReport.querySelector('.carousel-inner').innerHTML = html;
                     searchReport.querySelector('.carousel-indicators').innerHTML = indicatorsHtml;

                     // Ganti referensi ID di JavaScript      
                     var carouselId = 'searchCarousel'; // ID baru untuk carousel      

                     // Di dalam AJAX call, ubah referensi ke carousel      
                     searchReport.querySelector('.carousel-control-prev').setAttribute('href', '#' + carouselId);
                     searchReport.querySelector('.carousel-control-next').setAttribute('href', '#' + carouselId);

                     // Scroll ke elemen search-result-hr  
                     searchResultHr.scrollIntoView({
                         behavior: 'smooth'
                     }); // Menggulung ke elemen  
                 }
             };
             xhr.send('query=' + encodeURIComponent(query)); // Kirimkan query          
         }
     });
 </script> -->

 <script>
     var searchIcon = document.getElementById('search-icon');
     var searchField = document.getElementById('search-field');
     var searchInput = document.getElementById('search-input');
     var searchReport = document.getElementById('search-report');
     var searchResultHr = document.getElementById('search-result-hr');
     var searchResultTitle = document.getElementById('search-result-title');

     searchIcon.addEventListener('click', function(event) {
         event.preventDefault(); // Mencegah aksi default tombol              

         if (searchField.style.display === 'none' || searchField.style.display === '') {
             searchField.style.display = 'block'; // Tampilkan field pencarian                
             searchIcon.style.display = 'none'; // Sembunyikan ikon pencarian              
         } else {
             searchField.style.display = 'none'; // Sembunyikan field pencarian                
             searchIcon.style.display = 'block'; // Tampilkan kembali ikon pencarian              
         }
     });

     // Event listener untuk klik di luar field pencarian              
     document.addEventListener('click', function(event) {
         // Cek apakah klik terjadi di luar ikon pencarian dan field pencarian              
         if (!searchIcon.contains(event.target) && !searchField.contains(event.target)) {
             searchField.style.display = 'none'; // Sembunyikan field pencarian              
             searchIcon.style.display = 'block'; // Tampilkan kembali ikon pencarian              
         }
     });

     // Event listener untuk menangani pencarian saat menekan Enter            
     searchInput.addEventListener('keypress', function(event) {
         if (event.key === 'Enter') {
             event.preventDefault(); // Mencegah aksi default Enter            

             var query = searchInput.value.trim(); // Ambil query dari input dan hapus spasi di awal/akhir  
             if (query === '') { // Cek apakah query kosong  
                 Swal.fire({
                     icon: 'warning',
                     title: 'Input Required',
                     text: 'Please enter a keyword or name to search for reports.',
                     confirmButtonText: 'OK'
                 });
                 return; // Keluar dari fungsi jika input kosong  
             }

             var baseUrl = '<?= site_url('home/search') ?>'; // URL untuk controller search        

             // AJAX call untuk pencarian            
             var xhr = new XMLHttpRequest();
             xhr.open('POST', baseUrl, true);
             xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
             xhr.onreadystatechange = function() {
                 if (xhr.readyState === 4 && xhr.status === 200) {
                     // Tampilkan hasil pencarian            
                     var results = JSON.parse(xhr.responseText); // Asumsikan respons adalah JSON            
                     var html = '';
                     var indicatorsHtml = '';

                     // Reset tampilan hasil pencarian        
                     searchResultHr.style.display = 'block';
                     searchResultTitle.style.display = 'block';
                     searchReport.style.display = 'block';

                     if (results.length > 0) {
                         // Mengelompokkan hasil ke dalam carousel        
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
                             html += '</div>'; // Close row        
                             html += '</div>'; // Close carousel-item        
                         });

                         // Membuat indikator carousel        
                         chunks.forEach(function(_, index) {
                             indicatorsHtml += '<li data-target="#searchCarousel" data-slide-to="' + index + '" class="' + (index === 0 ? 'active' : '') + '"></li>';
                         });

                     } else {
                         // Jika tidak ada hasil, sembunyikan elemen dan tampilkan SweetAlert2    
                         searchResultHr.style.display = 'none'; // Sembunyikan elemen    
                         searchReport.style.display = 'none'; // Sembunyikan elemen    
                         Swal.fire({
                             icon: 'warning',
                             title: 'No Results Found',
                             text: 'Sorry, no reports match your search criteria.',
                             confirmButtonText: 'OK'
                         });
                         return; // Keluar dari fungsi jika tidak ada hasil    
                     }

                     // Menyisipkan hasil ke dalam carousel        
                     searchReport.querySelector('.carousel-inner').innerHTML = html;
                     searchReport.querySelector('.carousel-indicators').innerHTML = indicatorsHtml;

                     // Ganti referensi ID di JavaScript        
                     var carouselId = 'searchCarousel'; // ID baru untuk carousel        

                     // Di dalam AJAX call, ubah referensi ke carousel        
                     searchReport.querySelector('.carousel-control-prev').setAttribute('href', '#' + carouselId);
                     searchReport.querySelector('.carousel-control-next').setAttribute('href', '#' + carouselId);

                     // Scroll ke elemen search-result-hr    
                     searchResultHr.scrollIntoView({
                         behavior: 'smooth'
                     }); // Menggulung ke elemen    
                 }
             };
             xhr.send('query=' + encodeURIComponent(query)); // Kirimkan query            
         }
     });

     // Event listener untuk menghapus hasil pencarian saat input dihapus  
     searchInput.addEventListener('input', function() {
         if (searchInput.value.trim() === '') {
             // Jika input kosong, sembunyikan hasil pencarian  
             searchResultHr.style.display = 'none'; // Sembunyikan elemen    
             searchReport.style.display = 'none'; // Sembunyikan elemen    
         }
     });
 </script>


 </body>

 </html>