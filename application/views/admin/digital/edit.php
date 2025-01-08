<!-- Begin Page Content -->
<div class="container-fluid d-flex justify-content-center">

    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="width: 80%;">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <!-- Title on the left -->
            <h6 class="m-0 font-weight-bold" style="color: maroon;">Update Report : <?= $report['title']; ?></h6>

            <!-- Back button on the right -->
            <a href="<?= site_url('digital-report') ?>" class="btn btn-danger btn-sm btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fa fa-arrow-left"></i>
                </span>
                <span class="text">Back</span>
            </a>
        </div>

        <div class="card-body">
            <form action="<?= base_url('edit/digital-report/' . $report['id']); ?>" method="POST" enctype="multipart/form-data">

                <!-- Title Row (Full Width) -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title" style="font-size: 13px; font-weight: 600;">Title</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-heading"></i></span>
                                </div>
                                <input type="text" class="form-control" id="title" name="title" value="<?= $report['title']; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                // Misalkan ini adalah data keyword yang diambil dari database  
                $keywordsArray = explode(',', $report['keywords']); // Mengambil dari database dan memisahkan berdasarkan koma  
                ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="category" style="font-size: 13px; font-weight: 600;">Keyword</label>
                            <div id="keyword-container" class="mb-2">
                                <!-- Keyword akan ditampilkan di sini -->
                                <?php if ($report['keywords'] !== null && !empty($keywordsArray)): ?>
                                    <?php foreach ($keywordsArray as $keyword): ?>
                                        <span class="badge badge-primary mr-1"><?= htmlspecialchars(trim($keyword)) ?>
                                            <button class="close ml-1" onclick="removeKeyword(this)">×</button>
                                        </span>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <input type="text" id="new-keyword" class="form-control mt-2" placeholder="Masukkan keyword baru" style="display: none;">
                            <button type="button" id="add-button" class="btn btn-danger btn-sm btn-icon-split mt-2" onclick="toggleInput()">
                                <span class="icon text-white-50">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <span class="text">Add keyword</span>
                            </button>
                            <input type="hidden" id="keyword-input-hidden" name="keywords" value="<?= htmlspecialchars($report['keywords']) ?>">
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image" style="font-size: 13px; font-weight: 600;">Upload Image (Leave empty if not changing)</label>
                            <div class="custom-file">
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <?php if (!empty($report['image'])): ?>
                                <p style="font-size: 12px; margin-left: 10px; margin-top: 10px;">Current Image: <a href="<?= base_url('uploads/image/' . $report['image']); ?>" target="_blank">View Image</a></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="file" style="font-size: 13px; font-weight: 600;">Upload File (Leave empty if not changing)</label>
                            <div class="custom-file">
                                <input type="file" class="form-control" id="file" name="file">
                            </div>
                            <?php if (!empty($report['file'])): ?>
                                <p style="font-size: 12px; margin-left: 10px; margin-top: 10px;">Current File: <a href="<?= base_url('uploads/report/' . $report['file']); ?>" target="_blank">Open File</a></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Submit button -->
                <div class="form-group text-center mt-4">
                    <button type="submit" class="btn btn-sm text-white" style="background-color: maroon;">
                        <i class="fa fa-save"></i> Save Report
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
        const button = document.getElementById('add-button');

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

    function removeKeyword(button) {
        const keywordContainer = document.getElementById('keyword-container');
        keywordContainer.removeChild(button.parentElement); // Hapus tag keyword      
        updateHiddenInput(); // Update input tersembunyi setelah menghapus      
    }

    function updateHiddenInput() {
        const keywordContainer = document.getElementById('keyword-container');
        const hiddenInput = document.getElementById('keyword-input-hidden');
        const keywords = Array.from(keywordContainer.children).map(tag => tag.textContent.replace('×', '').trim());
        hiddenInput.value = keywords.join(', '); // Format keyword dengan koma      
    }
</script>