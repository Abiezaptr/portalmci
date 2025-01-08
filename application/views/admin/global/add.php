<!-- Begin Page Content -->
<div class="container-fluid d-flex justify-content-center">

    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="width: 80%;">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <!-- Title on the left -->
            <h6 class="m-0 font-weight-bold" style="color: maroon;">Add Global Report</h6>

            <!-- Back button on the right -->
            <a href="<?= site_url('global-report') ?>" class="btn btn-danger btn-sm btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fa fa-arrow-left"></i>
                </span>
                <span class="text">Back</span>
            </a>
        </div>

        <div class="card-body">
            <form action="<?= site_url('insert/global-report'); ?>" method="POST" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title" style="font-size: 13px; font-weight: 600;">Report Title <span class="text-danger" style="font-weight: bold;">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-heading"></i></span>
                                </div>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter report title" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image" style="font-size: 13px; font-weight: 600;">Upload Image <span class="text-danger" style="font-weight: bold;">*</span></label>
                            <div class="custom-file">
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="file" style="font-size: 13px; font-weight: 600;">Upload File <span class="text-danger" style="font-weight: bold;">*</span></label>
                            <div class="custom-file">
                                <input type="file" class="form-control" id="file" name="file" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="category" style="font-size: 13px; font-weight: 600;">Keyword</label>
                            <div id="keyword-container" class="mb-2">
                                <!-- Keyword akan ditampilkan di sini -->
                            </div>
                            <input type="text" id="new-keyword" class="form-control mt-2" placeholder="Masukkan keyword baru" style="display: none;">
                            <input type="hidden" id="keyword-input-hidden" name="keywords">
                            <button type="button" id="add-button" class="btn btn-danger btn-sm btn-icon-split mt-2" onclick="toggleInput()">
                                <span class="icon text-white-50">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <span class="text">Add keyword</span>
                            </button>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Submit button -->
                <div class="form-group text-center mt-4">
                    <button type="submit" class="btn btn-sm text-white" style="background-color: maroon;">
                        <i class="fa fa-save"></i>&nbsp; Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<script>
    function toggleInput() {
        const input = document.getElementById('new-keyword');
        const button = document.getElementById('add-button'); // Ambil elemen tombol  

        if (input.style.display === 'none') {
            input.style.display = 'block'; // Tampilkan input    
            input.focus(); // Fokus pada input    
            button.querySelector('.text').textContent = 'Submit keyword'; // Ubah teks tombol  
        } else {
            addKeyword(); // Jika input sudah terlihat, tambahkan keyword    
            input.style.display = 'none'; // Sembunyikan input setelah menambahkan    
            button.querySelector('.text').textContent = 'Add keyword'; // Kembalikan teks tombol  
        }
    }

    function addKeyword() {
        const input = document.getElementById('new-keyword');
        const keywordContainer = document.getElementById('keyword-container');
        const hiddenInput = document.getElementById('keyword-input-hidden');

        if (input.value.trim() !== '') {
            // Buat elemen baru untuk keyword      
            const keywordTag = document.createElement('span');
            keywordTag.className = 'badge badge-primary mr-1'; // Gaya untuk tag      
            keywordTag.textContent = input.value;

            // Buat tombol untuk menghapus tag      
            const removeButton = document.createElement('button');
            removeButton.className = 'close ml-1';
            removeButton.innerHTML = '&times;'; // Simbol untuk menghapus      
            removeButton.onclick = function() {
                keywordContainer.removeChild(keywordTag);
                updateHiddenInput(); // Update input tersembunyi setelah menghapus    
            };

            // Tambahkan tombol ke tag      
            keywordTag.appendChild(removeButton);
            // Tambahkan tag ke container      
            keywordContainer.appendChild(keywordTag);

            // Kosongkan input setelah menambahkan      
            input.value = '';

            // Update input tersembunyi    
            updateHiddenInput();
        }
    }

    function updateHiddenInput() {
        const keywordContainer = document.getElementById('keyword-container');
        const hiddenInput = document.getElementById('keyword-input-hidden');
        const keywords = Array.from(keywordContainer.children).map(tag => tag.textContent.replace('×', '').trim());
        hiddenInput.value = keywords.join(', '); // Format keyword dengan koma    
    }
</script>